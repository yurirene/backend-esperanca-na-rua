
@extends('layouts.template')

@section('cabecalho', 'Usuários')

@section('header')
Usuários
@stop

@section('conteudo')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Usuários</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')

{!! $dataTable->scripts() !!}
@endpush
