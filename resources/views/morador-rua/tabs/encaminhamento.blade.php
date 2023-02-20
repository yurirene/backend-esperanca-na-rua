<div id="tracking" class="overflow-scroll ">
    <div class="tracking-list">
        @foreach($morador->encaminhamentos as $encaminhamento)
        @include('morador-rua.tabs.encaminhamentoItem', [
            'dado' => $encaminhamento->toArray()
        ])
        @endforeach
    </div>
</div>
