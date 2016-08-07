@extends('app')

@section('css')
    <style>
        .secondary.pointing.menu {
            border: none !important;
        }
        .secondary.pointing.menu .toc.item {
            display: none;
        }
        @media only screen and (max-width: 700px) {
            .secondary.pointing.menu .item,
            .secondary.pointing.menu .menu {
                display: none;
            }
            .secondary.pointing.menu .toc.item {
                display: block;
            }
        }
    </style>
    @yield('admin-css')
@endsection

@section('navbar')
    @include('navbar.menu')
@endsection

@section('content')
    <div class="ui container" style="margin-bottom: 100px">
        @yield('admin-content')
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
//            $('.toc.item').click(function () {
//                $('i.sidebar.icon').transition('fade out');
//            });
//            $('.ui.sidebar').sidebar('attach events', '.toc.item').sidebar('setting', 'transition', 'overlay');
            $('.ui.dropdown').each(function () {
                $(this).dropdown();
            });
            {{--//AlertifyJS--}}
            {{--alertify.defaults = {--}}
                {{--notifier: {--}}
                    {{--position: 'top-right'--}}
                {{--}--}}
            {{--};--}}
            {{--@if(Session::has('global'))--}}
                {{--alertify.success('{{ Session::get('global') }}');--}}
            {{--@endif--}}
            {{--@if(Session::has('warning'))--}}
                {{--alertify.error('{{ Session::get('warning') }}');--}}
            {{--@endif--}}
        });
    </script>
    @yield('admin-js')
@endsection