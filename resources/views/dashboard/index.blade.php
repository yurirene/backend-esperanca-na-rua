
@extends('template')

@section('title', 'Dashboard')

@section('header')
    Dashboard
@stop

@section('content')
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
@stop

@push('js')
<script>
    $(document).ready(function() {
        
        var map = L.map('map', {doubleClickZoom: false}).locate({setView: true, maxZoom: 16});
        if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                latit = position.coords.latitude;
                longit = position.coords.longitude;
                var abc = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
                
            });
        }

       
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);
    })
   
</script>
@endpush