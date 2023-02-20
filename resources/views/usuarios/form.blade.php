@extends('layouts.template')
@section('header', 'Usuários')
@section('cabecalho', 'Usuários > Novo Usuários')

@section('conteudo')
<div class="row gutters-sm">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                @if(isset($usuario))
                {!! Form::model($usuario, [
                    'route' => ['usuarios.update', $usuario->id],
                    'method' => 'PUT'
                ]) !!}
                @else
                {!! Form::open([
                    'method' => 'POST',
                    'route' => 'usuarios.store'
                ]) !!}
                @endif
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('perfil_id', 'Perfil') !!}
                        {!! Form::select('perfil_id', $perfis, null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('name', 'Nome') !!}
                        {!! Form::text('name', null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::email('email', null, [
                            'class' => 'form-control',
                            'required' => 'required'
                        ]) !!}
                    </div>
                    <div class="col-sm-6 mb-3">
                        {!! Form::label('password', 'Senha') !!}
                        {!! Form::password('password', [
                            'class' => 'form-control',
                            'required' => isset($usuario) ? false : 'required'
                        ]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <button class="btn btn-success">{{isset($usuario) ? 'Atualizar' : 'Cadastrar'}}</button>
                        <a href="{{
                            session()->get('is_configuracao')
                            ? route('configuracoes.usuarios.index')
                            : route('usuarios.index')
                        }}" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
