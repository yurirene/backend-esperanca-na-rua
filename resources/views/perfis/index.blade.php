
@extends('layouts.template')

@section('cabecalho', 'Configuração de Perfis')

@section('header')
Configuração de Perfis
@stop

@section('conteudo')
    <div class="row">
        @foreach ($perfis as $perfil)
        <div class="col-lg-6 mt-3">
            <div class="card mb-4 h-100">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h4>{{ $perfil['nome'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body"  style="max-height: 300px; overflow-x: hidden;">
                    @foreach ($perfil['rotas'] as $modulo)
                    <h4 class="bg-secondary text-white rounded-top px-3 py-2">
                        <em data-feather="chevron-down" class="svg-icon"></em>
                        {{ $modulo['nome'] }}
                    </h4>
                    @foreach ($modulo['rotas'] as $rota)
                    <div class="row">
                        <div class="col">
                            <div class="form-group form-check">
                                <input
                                    type="checkbox" class="form-check-input rota"
                                    data-rota="{{ $rota['id'] }}"
                                    data-perfil="{{ $perfil['id'] }}"
                                    id="perfil_rota_{{$perfil['id'].'_'.$rota['id']}}"
                                    {{$rota['checked'] ? 'checked' : ''}}
                                >
                                <label class="form-check-label"
                                    for="perfil_rota_{{$perfil['id'].'_'.$rota['id']}}"
                                >
                                    {{ $rota['nome'] }}
                                </label>
                                <small>{{ $rota['uri'] }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@push('js')
<script>
$('.rota').on('click', function() {
    console.log($(this).is(':checked'));
    $.ajax({
        url: "{{ route('perfil.atualizar-rotas') }}",
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            perfil_id: $(this).data('perfil'),
            rota_id: $(this).data('rota'),
            checked: $(this).is(':checked') ? 'ativo' : 'desativado'
        },
        success: function(response) {
            toastr.success('Rota atualizada com sucesso', 'Sucesso!')
        },
        error: function(response) {
            toastr.error('Erro ao atualizar rota', 'Erro!')
        }
    })
});
</script>
@endpush
