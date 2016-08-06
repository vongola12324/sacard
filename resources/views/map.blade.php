@extends('app')

@section('title', '地圖')

@section('css')
    <style>
        a#backHomeButton {
            position: fixed;
            z-index: 2;
            top: 6vh;
            left: 10px;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map {
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <a class="ui brown button" id="backHomeButton" href="{{ route('index') }}">
    返回
    </a>
    <div id="map"></div>
@endsection

@section('js')
    <script>
        $('div#footer').hide();
    </script>
    <script>
        function initMap() {
            // Create a map object and specify the DOM element for display.
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.182, lng: 120.643},
                zoom: 16
            });

            @foreach($positions as $position)
                @php($shop = $position->shop)
                //Create a marker and set its position.
                new google.maps.Marker({
                    map: map,
                    position: {lat: {{ $position->latitude }}, lng: {{ $position->longitude }}},
                }).addListener('click', function () {
                    new google.maps.InfoWindow({
                        content: '<div id="content">'+
                        '<h1 id="firstHeading" class="firstHeading">'+
                        '{{ $shop->name }}({{ $position->description }})'+
                        '</h1>'+
                        '<div id="bodyContent">'+
                        @if($shop->description)
                        '<p>{{ $shop->description }}</p>'+
                        @endif
                        @if($shop->open_at && $shop->close_at)
                            '<p>營業時間：{{ $shop->open_at->format('H:i') }}-{{ $shop->close_at->format('H:i') }}</p>'+
                        @endif
                        @if($shop->tel)
                            '<p>電話：{{ $shop->tel }}</p>'+
                        @endif
                        @if($shop->url)
                            '<p>詳細請上<a href="{{ $shop->url }}" target="_blank">商店網站/粉專</a>查詢</p>'+
                        @endif
                        '</div>'+
                        '</div>'
                    }).open(map, this);
                });

            @endforeach


        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_BROWSER_KEY') }}&callback=initMap"></script>
@endsection