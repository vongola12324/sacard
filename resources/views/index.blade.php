@extends('app')

@section('title', '首頁')

@section('css')
    <style>
        div.fullscreen {
            height: 100vh;
        }
        div.fullpage.background {
            background: url("{{ asset('img/background/index.jpg') }}") no-repeat fixed center;
        }
        div.translucent {
            background-color: rgba(0, 0, 0, 0.6) !important;
        }
    </style>
@endsection

@section('content')
    <div class="fullpage background">
        <div class="ui inverted translucent vertical center aligned fullscreen segment">
            <h1 class="ui inverted center aligned icon header" style="margin-top: 20vh;">
                <i class="circular inverted red massive marker icon"></i>
                逢甲大學學生會特約商店
                <p class="ui sub header">
                    由學生會提供的線上特約商店資料！
                </p>
            </h1>
            <a href="{{ route('map.index') }}" class="ui large inverted red center aligned button" style="margin-top: 10vh;">開始查特約</a>
        </div>
    </div>
@endsection