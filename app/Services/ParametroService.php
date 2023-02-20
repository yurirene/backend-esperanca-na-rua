<?php

namespace App\Services;

use App\Models\Parametro;
use App\Models\ValorParametro;
use Illuminate\Support\Collection;

class ParametroService
{
    /**
     * Listar Parametros do Tipo Formulário
     *
     * @return Collection|null
     */
    public static function getParametrosFormulario(): ?Collection
    {
        try {
            return Parametro::with('valores')
                ->where('grupo_parametros', Parametro::GRUPO_FORMULARIO)
                ->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * Listar Parametros do Tipo Sistema
     *
     * @return Collection|null
     */
    public static function getParametrosSistema(): ?Collection
    {
        try {
            return Parametro::with('valores')
                ->where('grupo_parametros', Parametro::GRUPO_SISTEMA)
                ->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Cadastrar novo valor do parametro
     *
     * @param Parametro $parametro
     * @param array $request
     * @return void
     */
    public static function store(array $request): void
    {
        try {
            $parametro = Parametro::findOrFail($request['parametro_id']);
            ValorParametro::create([
                'valor' => $request['valor'],
                'parametro_id' => $parametro->id
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualiza valor do parametro
     *
     * @param Parametro $parametro
     * @param array $request
     * @return void
     */
    public static function update(array $request): void
    {
        try {
            $valor = ValorParametro::findOrFail($request['valor_id']);
            $valor->update([
                'valor' => $request['valor']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove valor do parametro
     *
     * @param Parametro $parametro
     * @param array $request
     * @return void
     */
    public static function delete(array $request): void
    {
        try {
            $valor = ValorParametro::findOrFail($request['valor_id']);
            $valor->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Listar Parametros do Tipo Formulário para a API
     *
     * @return Collection|null
     */
    public static function getParametrosFormularioApi(): array
    {
        try {
            return Parametro::with('valores')
                ->where('grupo_parametros', Parametro::GRUPO_FORMULARIO)
                ->get()
                ->map(function ($item) {
                    return [
                        $item->nome => [
                            'titulo' => $item->titulo,
                            'valores' => $item->valores->pluck('valor')
                        ]
                    ];
                })
                ->collapse()
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}