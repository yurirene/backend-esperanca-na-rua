
@extends('layouts.template')

@section('cabecalho', 'Dashboard')

@section('conteudo')
    @include('dashboard.cards')
    <div class="row mt-4">
        <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="map"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Solicitações</h6>
                </div>
                <div class="card-body">
                    @livewire('solicitacoes')
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function() {



        var map = L.map('map', {doubleClickZoom: false}).locate({setView: true, maxZoom: 16, minZoom: 5});
        if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    console.log('a');
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var abc = L.marker([lat, lng]).addTo(map);
                    map.setView([lat, lng], 15);
                }, function() {
                    var lat = -23.6693537;
                    var lng = -46.8341868;
                    var abc = L.marker([lat, lng]).addTo(map);
                    map.setView([lat, lng], 15);
                });
        }


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            minZoom: 5,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        $('.solicitacao_mapa').on('click', function(){
            let lat = $(this).data('latitude');
            let lng = $(this).data('longitude');
            var marker = L.marker([lat, lng],{}).addTo(map);
            map.setView([lat, lng], 15);
        });

        window.livewire.on('infoSolicitacao', () => {
            $('#modal-info-solicitacao').modal('show');
        });
    })

</script>
@endpush
