@extends('admin-layout')

@section('title', '商店管理')

@section('admin-content')
    <h2 class="ui teal header center aligned">
        商店管理
    </h2>
    <h3 class="ui header center aligned">商店清單</h3>
    <a href="{{ route('shop.create') }}" class="ui icon brown inverted button">
        <i class="plus icon" aria-hidden="true"></i> 新增商店
    </a>
    <table class="ui selectable celled padded unstackable table">
        <thead>
            <tr style="text-align: center">
                <th class="single line">店名</th>
                <th class="single line">網址</th>
                <th class="single line">電話</th>
                <th class="single line">營業時間</th>
                <th class="single line">位置</th>
                <th class="single line">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shops as $shop)
                <tr>
                    <td>
                        {{ $shop->name }}<br/>
                        <small><i class="angle double right icon"></i> {{ $shop->description }}</small>
                    </td>
                    <td class="one wide center aligned">
                        @if($shop->url)
                            <a href="{{ $shop->url }}" target="_blank" class="ui blue inverted icon button">
                                <i class="external icon"></i>
                            </a>
                        @else
                            <i class="large red remove icon popup" data-content="這個商家沒有任何網址資訊！"></i>
                        @endif
                    </td>
                    <td class="two wide center aligned">
                        @if($shop->tel)
                            {{ $shop->tel }}
                        @else
                            <i class="large red remove icon popup" data-content="這個商家沒有任何電話資訊！"></i>
                        @endif
                    </td>
                    <td class="two wide center aligned">
                        {{ $shop->open_at->format('H:i') }} - {{ $shop->close_at->format('H:i') }}
                    </td>
                    <td class="one wide center aligned">
                        <a href="{{ route('position.edit', $shop) }}"><nobr>
                            @if(count($shop->positions))
                                <i class="large green icons popup" data-content="點擊編輯位置資訊">
                                    <i class="green marker icon"></i>
                                    @if(count($shop->positions) > 1)
                                    <i class="corner icon"><div class="ui tiny circular label">{{ count($shop->positions) }}</div></i>
                                    @endif
                                </i>
                            @else
                                <i class="large red remove icon popup" data-content="這個商家找不到任何位置資訊！（點擊編輯位置資訊）"></i>
                            @endif
                        </nobr></a>
                    </td>
                    <td class="three wide">
                        <a href="{{ route('shop.show', $shop) }}" class="ui icon blue inverted button">
                            <i class="search icon"></i>
                        </a>
                        <a href="{{ route('shop.edit', $shop) }}" class="ui icon brown inverted button">
                            <i class="edit icon"></i>
                        </a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['shop.destroy', $shop],
                            'style' => 'display: inline',
                            'onSubmit' => "return confirm('確定要刪除此商店嗎？');"
                        ]) !!}
                        <button type="submit" class="ui icon red inverted button">
                            <i class="trash icon"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="ui center aligned attached segment" style="border: none">
        {!! (new Landish\Pagination\SemanticUI($shops))->render() !!}
    </div>
@endsection

@section('admin-js')
    <script>
        $('i.popup').popup({
            variation: 'inverted'
        });
        $('a.popup').popup();
    </script>
@endsection
