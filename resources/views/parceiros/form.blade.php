@extends('layouts.template')
@section('header', 'Parceiro')
@section('cabecalho', 'Parceiro > Novo Parceiro')

@section('conteudo')
<div class="row gutters-sm">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                @if(isset($parceiro))
                {!! Form::model($parceiro, [
                    'route' => ['parceiros.update', $parceiro->id],
                    'method' => 'PUT'
                ]) !!}
                @else
                {!! Form::open([
                    'method' => 'POST',
                    'route' => 'parceiros.store'
                ]) !!}
                @endif
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('tipo_parceiro_id', 'Tipo') !!}
                        {!! Form::select('tipo_parceiro_id', $tipos_parceiros, null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::text('nome', null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('cpf_cnpj', 'CPF/CNPJ') !!}
                        {!! Form::text('cpf_cnpj', null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('endereco', 'Endereço') !!}
                        {!! Form::text('endereco', null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('telefone_principal', 'Telefone Principal') !!}
                        {!! Form::text('telefone_principal', null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('telefone_secundario', 'Telefone Secundário') !!}
                        {!! Form::text('telefone_secundario', null, [
                            'class' => 'form-control'
                        ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('ativo', 'Ativo') !!}
                        {!! Form::select('ativo', $status, null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <button class="btn btn-success">{{isset($parceiro) ? 'Atualizar' : 'Cadastrar'}}</button>
                        <a href="{{
                            session()->get('is_configuracao')
                            ? route('configuracoes.parceiros.index')
                            : route('parceiros.index')
                        }}" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
