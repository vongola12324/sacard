@extends('admin-layout')

@section('title', "{$shop->name} - 編輯位置")

@php($i = 0)

@section('admin-content')
    <h2 class="ui teal header center aligned">
        {{ $shop->name }} - 編輯位置
    </h2>

    {!! SemanticForm::open()->action(route('position.update', $shop)) !!}
    @forelse($shop->positions as $key => $position)
        <div class="field group" style="margin-bottom: 20px">
            <h3 class="ui header">分店 #{{ $i }}</h3>
            <div class="field" hidden>
                <input type="text" name="posID[{{ $i }}]" value="{{ $position->id }}">
            </div>
            <div class="field{{ ($errors->has('role'))?' error':'' }}">
                <label>分店名稱</label>
                <input type="text" name="description[{{$i}}]" placeholder="Ex: 逢甲店" value="{{ $position->description }}"
                       required>
            </div>
            <div class="field{{ ($errors->has('role'))?' error':'' }}">
                <label>分店地址</label>
                <input type="text" name="address[{{$i}}]" placeholder="例如：台中市西屯區文華路100號"
                       value="{{ $position->address }}" required>
            </div>
            <div class="ui tiny red inverted icon button" id="removeFieldButton"><i class="remove icon"></i>刪除分店
                #{{ $i }}</div>
        </div>
        @php($i = $i+1)
    @empty
        <div class="field group" style="margin-bottom: 20px">
            <h3 class="ui header">分店 #0</h3>
            <div class="field" hidden>
                <input type="text" name="posID[0]" value="">
            </div>
            <div class="required field{{ ($errors->has('role'))?' error':'' }}">
                <label>分店名稱</label>
                <input type="text" name="description[0]" placeholder="Ex: 逢甲店" required>
            </div>
            <div class="field{{ ($errors->has('role'))?' error':'' }}">
                <label>分店地址</label>
                <input type="text" name="address[0]" placeholder="例如：台中市西屯區文華路100號" required>
            </div>
            <div class="ui tiny red inverted icon button" id="removeFieldButton"><i class="remove icon"></i>刪除分店
                #{{ $i }}</div>
        </div>
    @endforelse
    <div class="ui green inverted icon button" id="addNewFieldButton"><i class="plus icon"></i> 新增地址</div>
    <div style="text-align: center; margin-top:10px">
        <a href="{{ route('shop.index') }}" class="ui blue inverted icon button">
            <i class="icon arrow left"></i> 返回列表
        </a>
        <a href="{{ route('shop.show', $shop) }}" class="ui blue inverted icon button">
            <i class="icon arrow left"></i> 返回商店資料
        </a>
        {!! SemanticForm::submit('<i class="checkmark icon"></i> 確認')->addClass('ui icon submit red inverted button') !!}
    </div>
    {!! SemanticForm::close() !!}
@endsection

@section('admin-js')
    <script>
        $(document).ready(function () {
            var fieldGroup = $("div.field.group"); //Fields wrapper
            var add_button = $("div#addNewFieldButton"); //Add button ID
            var i = {{ $i }};

            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                $('<div class="field group" style="margin-bottom: 20px"><h3 class="ui header">分店 #' + i + '</h3><div class="field" hidden><input type="text" name="posID[{{ $i }}]" value=""></div><div class="field"><label>分店名稱</label><input type="text" name="description[' + i + ']" placeholder="Ex: 逢甲店" required></div><div class="field"><label>分店地址</label><input type="text" name="address[' + i + ']" placeholder="例如：台中市西屯區文華路100號" required></div><div class="ui tiny red inverted icon button" id="removeFieldButton"><i class="remove icon"></i>刪除分店 #' + i + '</div></div>').insertBefore("div#addNewFieldButton");
                $('div#removeFieldButton').bind('click', function (e) {
//                    console.log($(this).parent('div'));
                    $(this).parent('div').remove();
                });
                i += 1;

            });
        });


        $('div#removeFieldButton').bind('click', function (e) {
//            console.log($(this).parent('div'));
            $(this).parent('div').remove();
        });

    </script>
@endsection
