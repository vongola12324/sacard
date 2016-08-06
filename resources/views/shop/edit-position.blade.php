@extends('admin-layout')

@section('title', "{$shop->name} - 編輯位置")

@php($i = 0)

@section('admin-content')
    <h2 class="ui teal header center aligned">
        {{ $shop->name }} - 編輯位置
    </h2>

    {!! SemanticForm::open()->action(route('position.update', $shop)) !!}
    <div class="ui stacked segment">
        <div class="ui green inverted icon button" id="addNewFieldButton"><i class="plus icon"></i> 新增地址</div>
        @forelse($shop->positions as $key => $position)
            {{ $i = $i + 1}}
            <div class="field group">
                <h3 class="ui header">分店 #{{ $i }}</h3>
                <div class="ui red inverted icon button" id="removeFieldButton"><i class="remove icon"></i></div>
                <div class="fields">
                    <div class="field{{ ($errors->has('role'))?' error':'' }}">
                        <label>分店名稱</label>
                        <input type="text" name="description[{{$i}}]" placeholder="Ex: 逢甲店">
                    </div>
                    <div class="field{{ ($errors->has('role'))?' error':'' }}">
                        <label>分店地址</label>
                        <input type="text" name="address[{{$i}}]">
                    </div>
                </div>
            </div>
        @empty
            <div class="field group">
                <h3 class="ui header">分店 #0</h3>
                <a href="#" class="ui red inverted icon button" id="removeFieldButton"><i class="remove icon"></i></a>
                <div class="field{{ ($errors->has('role'))?' error':'' }}">
                    <label>分店名稱</label>
                    <input type="text" name="description[0]" placeholder="Ex: 逢甲店">
                </div>
                <div class="field{{ ($errors->has('role'))?' error':'' }}">
                    <label>分店地址</label>
                    <input type="text" name="address[0]">
                </div>
            </div>
        @endforelse
        <div style="text-align: center">
            <a href="{{ route('shop.index') }}" class="ui blue inverted icon button">
                <i class="icon arrow left"></i> 返回列表
            </a>
            {!! SemanticForm::submit('<i class="checkmark icon"></i> 確認')->addClass('ui icon submit red inverted button') !!}
        </div>
    </div>
    {!! SemanticForm::close() !!}
@endsection

@section('admin-js')
    <script>
        $(document).ready(function() {
            var fieldGroup         = $("div.field.group"); //Fields wrapper
            var add_button      = $("div#addNewFieldButton"); //Add button ID
            var i = {{ $i }} + 1;

            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                $(fieldGroup).append('<h3 class="ui header">分店 #'+i+'</h3><div class="ui red inverted icon button" id="removeFieldButton"><i class="remove icon"></i></div><div class="field"> <label>分店名稱</label> <input type="text" name="description['+i+']" placeholder="Ex: 逢甲店"> </div> <div class="field"> <label>分店地址</label> <input type="text" name="address['+i+']"> </div>'); //add input box
                i+=1;
            });

            $(fieldGroup).on("click","div#removeFieldButton", function(e){ //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();

            })
        });
    </script>
@endsection
