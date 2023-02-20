<div id="tracking" class="overflow-scroll ">
    <div class="tracking-list">
        @foreach($historicos as $historico)
        @include('morador-rua.tabs.historicoitem', [
            'dado' => $historico
        ])
        @endforeach
    </div>
</div>
