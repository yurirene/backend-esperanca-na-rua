<?php

namespace App\Http\Controllers;

use App\DataTables\MoradorRuaDataTable;
use App\Models\IdentificacaoMoradorRua;
use App\Models\MoradorRua;
use App\Models\OutrasInformacoesMoradorRua;
use App\Services\MoradorRuaService;
use App\Services\ParceiroService;
use Illuminate\Http\Request;

class MoradorRuaController extends Controller
{
    public function index(MoradorRuaDataTable $dataTable)
    {
        try {
            return $dataTable->render('morador-rua.index');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function show(MoradorRua $morador)
    {
        try {
            return view('morador-rua.show', [
                'morador' => $morador,
                'parceiros' => ParceiroService::getParceirosForSelect(),
                'historicos' => MoradorRuaService::getHistorico($morador)
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getFile(), $th->getLine());
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function edit(MoradorRua $morador)
    {
        try {
            return view('morador-rua.form', [
                'morador' => $morador
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function update(MoradorRua $morador, Request $request)
    {
        try {
            MoradorRuaService::update($morador, $request->all())
                ->with('sucesso', 'Dados atualizados com sucesso');
            return redirect()->route('morador-rua.index');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function delete(MoradorRua $morador)
    {
        try {
            MoradorRuaService::delete($morador);
            return redirect()->route('morador-rua.index')
                ->with('sucesso', 'Remoção realizada com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function encaminhar(MoradorRua $morador, Request $request)
    {

        try {
            MoradorRuaService::encaminhar($morador, $request->all());
            return redirect()->route('morador-rua.index')
                ->with('sucesso', 'Encaminhado com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function alterarFoto(MoradorRua $morador, Request $request)
    {
        try {
            MoradorRuaService::alterarFoto($morador, $request);
            return redirect()->route('morador-rua.show', $morador->id)
                ->with('sucesso', 'Foto alterada com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('morador-rua.show', $morador->id)
                ->with('erro', 'Erro ao Alterar Foto');
        }
    }

    public function identificacao(IdentificacaoMoradorRua $identificacao, Request $request)
    {
        try {
            MoradorRuaService::atualizarIdentificacao($identificacao, $request->except(['_token']));
            return redirect()->route('morador-rua.show', $identificacao->morador_rua_id)
                ->with('sucesso', 'Identificação atualizada com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('morador-rua.show', $identificacao->morador_rua_id)
                ->withInput()
                ->with('erro', 'Erro ao atualizar Identificação');
        }
    }

    public function outrasInformacoes(OutrasInformacoesMoradorRua $informacao, Request $request)
    {
        try {
            MoradorRuaService::atualizarOutrasInformacoes($informacao, $request->except(['_token']));
            return redirect()->route('morador-rua.show', $informacao->morador_rua_id)
                ->with('sucesso', 'Identificação atualizada com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('morador-rua.show', $informacao->morador_rua_id)
                ->withInput()
                ->with('erro', 'Erro ao atualizar Identificação');
        }
    }
}
