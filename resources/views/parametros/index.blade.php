
@extends('layouts.template')

@section('cabecalho', 'Parametros')

@section('header')
Parametros
@stop

@section('conteudo')
    <div class="row">
        @foreach ($parametrosFormularios as $parametroForm)
        <div class="col-lg-6 col-xl-4 col-md-6 mt-3">
            <div class="card mb-4 h-100">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6>{{ $parametroForm['titulo'] }}</h6>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-secondary"
                                data-id="{{ $parametroForm['id'] }}"
                                data-toggle="modal"
                                data-target="#addParametroModal"
                            >
                                <em class="fas fa-plus"></em>Valor
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body"  style="max-height: 300px; overflow-x: hidden;">
                    <div class="table-responsive">
                        <table class="table table-stripped"
                            id="tabela_form"
                            aria-label="tabela formulario {{$parametroForm['nome']}}"
                        >
                            <thead>
                                <tr>
                                    <th>Ações</th>
                                    <th class="text-right">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parametroForm['valores'] as $valorForm)
                                <tr>
                                    <td>
                                    @include('parametros.action', [
                                        'id' => $valorForm['id'],
                                        'valor' => $valorForm['valor']
                                    ])
                                    </td>
                                    <td class="text-right">{{ $valorForm['valor'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @include('parametros.modalParametros')
@endsection
@push('js')
<script>
$('.delete-valor').on('click', function() {
    let id = $(this).data('id');
    var route = "{{ route('configuracoes.parametros.delete') }}";
    var data = {
        _token: "{{ csrf_token() }}",
        valor_id: id
    };
    confirmacao(route, data, 'POST');
});
</script>
@endpush
