<?php

namespace App\Services;

use App\Models\Auditable;
use App\Tradutor;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuditableService
{
    /**
     * Registrar os novos registros na tabela de log
     * @param $model
     * @param $usuario
     * @param $acao
     * @return bool|\Illuminate\Database\Eloquent\Model|Auditable
     */
    public static function store($model, $usuario, $acao)
    {
        try {
            $registros = self::formatarRegistros($model, $usuario, $acao);
            return !empty($registros) ? Auditable::create($registros) : false;
        } catch (Throwable $exception) {
            Log::error([
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile()
            ]);
            return false;
        }
    }

    /**
     * Formatar os dados que serão registrados
     * @param $model
     * @param $usuario
     * @param $acao
     * @return array
     */
    public static function formatarRegistros($model, $usuario, $acao)
    {
        try {
            $colunas = self::colunas($model, $acao);
            if (!empty($colunas)) {
                return [
                    'table' => $model->getTable(),
                    'table_id' => $model->getKey() ? $model->getKey() : null,
                    'acao' => $acao,
                    'coluna' => $colunas['coluna'],
                    'valor_antigo' => $colunas['coluna_antiga'],
                    'valor_novo' => $colunas['coluna_nova'],
                    'user_id' => $usuario,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ];
            }
            return [];
        } catch (Throwable $exception) {
            Log::error([
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile()
            ]);
            return [];
        }
    }

    /**
     * Tratar as colunas antigas e novas antes da realização do registro
     * @param $model
     * @param $acao
     * @return array
     */
    public static function colunas($model, $acao)
    {
        try {
            $oldValues = [];
            $dirty = $model->getDirty();
            $novos = json_encode($dirty);

            foreach ($dirty as $dirtyColumns => $value) {
                $oldValues[$dirtyColumns] = $model->getOriginal($dirtyColumns);
            }

            $colunas = array_keys($oldValues);

            if ($acao == 'deleting') {
                $colunas = array_keys($model->getOriginal());
                $antigos = json_encode($model->getOriginal());
            } else {
                $antigos = json_encode($oldValues);
            }

            return [
                'coluna' => json_encode($colunas),
                'coluna_antiga' => $acao != 'created' ? $antigos : null,
                'coluna_nova' => $acao != 'deleting' ? $novos : null,
            ];
        } catch (Throwable $exception) {
            Log::error([
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'file' => $exception->getFile()
            ]);
            return [];
        }
    }

    /**
     *  Padronizando registro de logs dos erros
     *  @param $exception
     */
    public static function setErrosLog(Exception $exception)
    {
        $trace = $exception->getTrace()[0];
        $message = $exception->getMessage();

        $errors = collect($trace)
            ->except(['type', 'function', 'args', 'class'])
            ->merge(['message' => $message])
            ->toArray();

        Log::error($errors);
    }

    /**
     * Lista Histórico com padrões
     *
     * @param array $relacoes['table' => 'valor']
     * @return array
     */
    public static function getHistorico(array $relacoes = []): array
    {
        try {
            $model = (new Auditable())->query();
            foreach ($relacoes as $tabela => $valor) {
                $model->orWhere(function ($sql) use ($tabela, $valor) {
                    return $sql->where('table', $tabela)
                        ->whereIn('table_id', $valor);
                });
            }
            return $model->orderBy('created_at', 'DESC')
                ->get()
                ->map(function ($item) {
                    return [
                        'table' => Tradutor::TABELAS[$item->table],
                        'acao' => Auditable::ACAO[$item->acao],
                        'colunas' => self::getColunas($item->coluna),
                        'data' => $item->dataFormatada,
                        'hora' => $item->horaFormatada
                    ];
                })
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Retorna as colunas formatados
     *
     * @param string $colunas
     * @return array
     */
    public static function getColunas(string $colunas): array
    {
        try {
            $dados = json_decode($colunas, true);
            $retorno = [];
            foreach ($dados as $dado) {
                $retorno[] = Tradutor::CAMPOS[$dado];
            }
            return $retorno;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
