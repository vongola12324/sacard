@extends('admin-layout')

@php($isEditMode = isset($shop))
@php($methodText = $isEditMode ? '編輯' : '新增')

@section('title', $methodText . '商店')

@section('admin-content')
    <h2 class="ui teal header center aligned">
        {{ $methodText }}商店
    </h2>
    @if($isEditMode)
        {!! SemanticForm::open()->patch()->action(route('shop.update', $shop)) !!}
        {!! SemanticForm::bind($shop) !!}
    @else
        {!! SemanticForm::open()->action(route('shop.store')) !!}
    @endif
    <div class="ui stacked segment">
        {!! SemanticForm::text('name')->label('商店名稱')->placeholder('例如：萊爾富')->required() !!}
        {!! SemanticForm::textarea('description')->label('商店描述')->placeholder('例如：24H便利商店') !!}
        {!! SemanticForm::text('url')->label('網址')->placeholder('例如：https://www.fcu.edu.tw') !!}
        {!! SemanticForm::text('tel')->label('電話')->placeholder('例如：04-20000000') !!}
        <div class="field">
            <div class="two fields">
                <div class="field{{ ($errors->has('role'))?' error':'' }}">
                    <label>開始營業時間</label>
                    @if($isEditMode)
                        <input type="time" name="open_at" title="open_at" value={{$shop->open_at->format('H:i')}}>
                    @else
                        <input type="time" name="open_at" title="open_at" value="08:00">
                    @endif
                </div>
                <div class="field{{ ($errors->has('role'))?' error':'' }}">
                    <label>結束營業時間</label>
                    @if($isEditMode)
                        <input type="time" name="close_at" title="close_at" value={{$shop->close_at->format('H:i')}}>
                    @else
                        <input type="time" name="close_at" title="close_at" value="18:00">
                    @endif
                </div>
            </div>
        </div>
        <div style="text-align: center">
            <a href="{{ route('shop.index') }}" class="ui blue inverted icon button">
                <i class="icon arrow left"></i> 返回列表
            </a>
            @if($isEditMode)
            <a href="{{ route('shop.show', $shop) }}" class="ui blue inverted icon button">
                <i class="icon arrow left"></i> 返回商店資料
            </a>
            @endif
            {!! SemanticForm::submit('<i class="checkmark icon"></i> 確認')->addClass('ui icon submit red inverted button') !!}
        </div>
    </div>
    @if($errors->count())
        <div class="ui error message" style="display: block">
            <ul class="list">
                @foreach($errors->all('<li>:message</li>') as $error)
                    {!! $error !!}
                @endforeach
            </ul>
        </div>
    @endif
    {!! SemanticForm::close() !!}
@endsection
