<!DOCTYPE html>
<html lang="zh-Hant-TW">
    <head>
        {{-- Metatag --}}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <title>@yield('title')::SACard</title>

        {{-- CSS --}}
        {!! Html::style('semantic/semantic.min.css') !!}
        <style>
            {{--body.flex.body {--}}
                {{--display: flex;--}}
                {{--min-height: 100vh;--}}
                {{--flex-direction: column;--}}
            {{--}--}}

            {{--div.flex.content {--}}
                {{--flex: 1;--}}
            {{--}--}}

            div#footer {
                margin: 0;
                width: 100%;
                position: fixed;
                bottom: 0;
                opacity: 0.8;
            }
        </style>
        @yield('css')
    </head>
    <body>
        {{-- Navbar --}}
        @yield('navbar')

        {{-- Content --}}
        @yield('content')

        {{-- Footer --}}
        <div class="ui inverted center aligned segment" id="footer">
            <div class="ui container center aligned">
                <p>
                    Copyright (c) 2016 Feng Chia University Student Association, All rights reserved.@if(!auth()->check()) [{!! Html::linkRoute('auth.login', 'Staff Login') !!}]@endif
                </p>
            </div>
        </div>

        {{-- Javascript --}}
        {!! Html::script('//code.jquery.com/jquery-3.1.0.min.js') !!}
        {!! Html::script('semantic/semantic.js') !!}
        @yield('js')

    </body>
</html>