@extends('app')

@section('title', '地圖')

@section('css')
    <style>
        a#backHomeButton {
            position: fixed;
            z-index: 2;
            top: 10px;
            left: 10px;
        }
    </style>
@endsection

@section('content')
    <a class="ui inverted brown button" id="backHomeButton" href="{{ route('index') }}">
        返回
    </a>
    <div class="ui fluid container" id="map"></div>
@endsection

@section('js')
    <script>
        $('div#footer').hide();
    </script>
@endsection