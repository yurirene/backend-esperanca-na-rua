<?php

namespace App\Services;

use App\Models\Encaminhamento;
use App\Models\IdentificacaoMoradorRua;
use App\Models\MoradorRua;
use App\Models\OutrasInformacoesMoradorRua;
use App\Models\Parceiro;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MoradorRuaService
{
    /**
     * Salvar Morador de Rua
     *
     * @param array $request
     * @return MoradorRua|null
     * @throws Exception
     */
    public static function store(array $request): ?MoradorRua
    {
        try {
            return MoradorRua::create([
                'nome' => $request['nome'] ?? null,
                'genero' => $request['genero'] ?? null,
                'faixa_etaria' => $request['faixaEtaria'] ?? null,
                'tempo_rua' => $request['tempoRua'] ?? null,
                'limpeza' => $request['limpeza'] ?? null,
                'sobriedade' => $request['sobriedade'] ?? null,
                'path_foto' => $request['path_foto'] ?? null,
                'passagem_policia' => $request['passagemPolicia'] ?? null
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Lançar Identificador Morador de Rua
     *
     * @param array $request
     * @return void
     * @throws Exception
     */
    public static function storeIdentificacao(MoradorRua $morador)
    {
        try {
            return IdentificacaoMoradorRua::create([
                'morador_rua_id' => $morador->id
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Lançar Outra Informações do Morador de Rua
     *
     * @param array $request
     * @return void
     * @throws Exception
     */
    public static function storeOutrasInformacoes(MoradorRua $morador)
    {
        try {
            return OutrasInformacoesMoradorRua::create([
                'morador_rua_id' => $morador->id
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualizar Morador de Rua
     *
     * @param MoradorRua $morador
     * @param array $request
     * @return MoradorRua|null
     * @throws Exception
     */
    public static function update(MoradorRua $morador, array $request): ?MoradorRua
    {
        try {
            $morador->update([
                'deseja_ajuda' => $request['deseja_ajuda'] == 'S',
                'condicao_fisica' => $request['condicao_fisica'],
                'genero' => $request['genero'],
                'nome' => $request['nome']
            ]);
            return $morador;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Apagar Morador de Rua
     *
     * @param MoradorRua $morador
     * @return void
     * @throws Exception
     */
    public static function delete(MoradorRua $morador): void
    {
        try {
            $morador->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Encaminhar Morador de Rua para um parceiro
     *
     * @param array $request
     * @return void
     */
    public static function encaminhar(array $request): void
    {
        try {
            $moradorRua = MoradorRua::findOrFail($request['morador_rua_id']);
            Encaminhamento::create([
                'parceiro_id' => $request['parceiro_id'],
                'morador_rua_id' => $moradorRua->id
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Alterar Foto do Morador de Rua
     *
     * @param MoradorRua $morador
     * @param Request $request
     * @return void
     */
    public static function alterarFoto(MoradorRua $morador, Request $request): void
    {
        try {
            $file = $request->file('foto');
            $path = 'fotos/moradores/';
            $fileName   = time() . $file->getClientOriginalName();
            Storage::disk('public')->put($path . $fileName, File::get($file));
            $filePath = 'storage/'.$path . $fileName;

            $morador->update([
                'path_foto' => $filePath
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualizar Identificação do Morador de Rua
     *
     * @param MoradorRua $morador
     * @param array $request
     * @return void
     */
    public static function atualizarIdentificacao(IdentificacaoMoradorRua $identificacao, array $request): void
    {
        try {
            $identificacao->update($request);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualizar Outras Informações
     *
     * @param OutrasInformacoesMoradorRua $identificacao
     * @param array $request
     * @return void
     */
    public static function atualizarOutrasInformacoes(OutrasInformacoesMoradorRua $identificacao, array $request): void
    {
        try {
            $identificacao->update($request);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getHistorico(MoradorRua $morador): array
    {
        try {
            $relacoes = [
                'morador_ruas' => [$morador->id],
                'identificacao_morador_ruas' => [$morador->identificacao->id],
                'outras_informacoes_morador_ruas' => [$morador->outraInformacao->id],
                'encaminhamentos' => [$morador->encaminhamentos->pluck('id')->toArray()]
            ];
            return AuditableService::getHistorico($relacoes);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
