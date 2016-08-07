@if($models->lastPage() > 1)
    <div class="ui center aligned attached segment" style="border: none">
        <div class="ui pagination menu">
            <a href="{{ $models->url(1) }}" class="icon item" title="第一頁">
                <i class="angle double left icon"></i>
            </a>
            <a href="{{ $models->url($models->currentPage()-1) }}" class="icon item" title="上一頁">
                <i class="angle left icon"></i>
            </a>
            @if($models->lastPage() > 9 && $models->currentPage() != 1)
                <a class="disabled item">...</a>
            @endif

            @if($models->lastPage() > 9)
                @if($models->currentPage() <= 4)
                    @for($i = 1; $i <= 9; $i++)
                        <a href="{{ $models->url($i) }}"
                           class="@if($models->currentPage() == $i)active @endif item">{{ $i }}</a>
                    @endfor
                @elseif($models->currentPage() >= $models->lastPage()-4)
                    @for($i = $models->lastPage()-9; $i <= $models->lastPage(); $i++)
                        <a href="{{ $models->url($i) }}"
                           class="@if($models->currentPage() == $i)active @endif item">{{ $i }}</a>
                    @endfor
                @else
                    @for($i = $models->currentPage()-4; $i <= $models->currentPage()+4; $i++)
                        <a href="{{ $models->url($i) }}"
                           class="@if($models->currentPage() == $i)active @endif item">{{ $i }}</a>
                    @endfor
                @endif
            @else
                @for($i = 1; $i <= $models->lastPage(); $i++)
                    <a href="{{ $models->url($i) }}"
                       class="@if($models->currentPage() == $i)active @endif item">{{ $i }}</a>
                @endfor
            @endif

            @if($models->lastPage()>9 && $models->currentPage() != $models->lastPage())
                <a class="disabled item">...</a>
            @endif
            <a href="{{ $models->nextPageUrl() }}" class="icon item" title="下一頁">
                <i class="angle right icon"></i>
            </a>
            <a href="{{ $models->url($models->lastPage()) }}" class="icon item" title="最後一頁">
                <i class="angle double right icon"></i>
            </a>
        </div>
    </div>
@endif