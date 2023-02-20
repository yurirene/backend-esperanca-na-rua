
@extends('layouts.template')

@section('cabecalho', 'Parceiros')

@section('header')
Parceiros
@stop

@section('conteudo')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Parceiros</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('parceiros.modalUsuarios')
@endsection
@push('js')

{!! $dataTable->scripts() !!}
@endpush
