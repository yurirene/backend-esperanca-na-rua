<div class="table-responsive p-0"  wire:poll.5000ms>
    <table class="table align-items-center mb-0" id="tabela-solicitacoes">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Solicitado em</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Informações</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Solicitante</th>
                <th class="text-secondary opacity-7"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($solicitacoes as $solicitacao)
            <tr>
                <td>

                    @include('livewire.actions.solicitacao-action', [
                        'latitude' => $solicitacao->geo_lat,
                        'longitude' => $solicitacao->geo_lon,
                        'id' => $solicitacao->id
                    ])
                </td>
                <td class="align-middle text-center">

                    <span class="text-secondary text-xs font-weight-bold">{{ $solicitacao->criado_em }} <br> {{ $solicitacao->criado_hora_em }}</span>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $solicitacao->morador->nome }}</p>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $solicitacao->tipo_destino_formatado }}</p>
                    <p class="text-xs text-secondary mb-0">Sexo: {{ $solicitacao->morador->genero }} | Idade: {{ $solicitacao->morador->faixa_idade }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                    {!! $solicitacao->status_formatado !!}
                </td>

                <td>
                    <p class="text-xs font-weight-bold mb-0 text-center">{{ $solicitacao->solicitante->name }}</p>
                </td>
            </tr>
            @empty
            <tr>
                <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">Sem Solicitação</span>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@livewire('modal-informacao-solicitacao')