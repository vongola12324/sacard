@extends('admin-layout')

@section('title', "{$shop->name} - 商店資料")

@section('admin-content')
    <h2 class="ui teal header center aligned">
        {{ $shop->name }} - 商店資料
    </h2>
    <div class="ui icon header center aligned">
        <i class="massive home icon"></i>
    </div>

    <table class="ui selectable stackable table">
        <tr>
            <td class="four wide right aligned">名稱：</td>
            <td>{{ $shop->name }}</td>
        </tr>
        <tr>
            <td class="four wide right aligned">描述：</td>
            <td>{{ $shop->description }}</td>
        </tr>
        <tr>
            <td class="four wide right aligned">網址：</td>
            <td>{{ $shop->url }}</td>
        </tr>
        <tr>
            <td class="four wide right aligned">電話：</td>
            <td>{{ $shop->tel }}</td>
        </tr>
        <tr>
            <td class="four wide right aligned">營業時間：</td>
            <td>{{ $shop->open_at->format('H:i') }} - {{ $shop->close_at->format('H:i') }}</td>
        </tr>
    </table>
    @if(count($shop->positions))
        <h3 class="ui header center aligned">位置</h3>
        <dl>
            @foreach($shop->positions as $position)
                <dt>{{ $position->name }}</dt>
                <dd>{{ $position->address }}</dd>
            @endforeach
        </dl>
    @endif

    {{-- TODO: text-align: center要獨立成一個text-center --}}
    <div style="text-align: center">
        <a href="{{ route('shop.index') }}" class="ui blue inverted icon button"><i class="arrow left icon"></i>
            會員清單</a>
        <a href="{{ route('shop.edit', $shop) }}" class="ui brown inverted icon button"><i class="edit icon"></i>
            編輯資料</a>
        <a href="{{ route('position.edit', $shop) }}" class="ui brown inverted icon button"><i class="edit icon"></i>
            編輯位置資料</a>
        {!! Form::open(['route' => ['shop.destroy', $shop], 'style' => 'display: inline', 'method' => 'DELETE', 'onSubmit' => "return confirm('確定要刪除此會員嗎？');"]) !!}
        <button type="submit" class="ui icon red inverted button">
            <i class="trash icon"></i> 刪除會員
        </button>
        {!! Form::close() !!}
    </div>

@endsection

@section('admin-js')
    <script>
        $('i.popup').popup({
            variation: 'inverted'
        });
    </script>
@endsection
