@if ($paginator->hasPages())
    <nav class="pagination_wrap" aria-label="Page navigation example">
        <ul class="pagination_list">
        @if ($paginator->onFirstPage())
            <li class="pagination_direct"><span class="pagination_direct_link"><span class="icon-chevron-left"></span></span></li>
        @else
            <li class="pagination_direct dormant"><a href="{{ $paginator->previousPageUrl() }}" class="pagination_direct_link prev"><span class="icon-chevron-left"></span></a></li>
        @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination_item"><span class="pagination_link dormant">...</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination_item"><span class="pagination_link active">{{ $page }}</span></li>
                        @else
                            <li class="pagination_item"><a href="{{ $url }}" class="pagination_link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @if ($paginator->hasMorePages())
            <li class="pagination_direct"><a href="{{ $paginator->nextPageUrl() }}" class="pagination_direct_link"><span class="icon-chevron-right"></span></a></li>
        @else
            <li class="pagination_direct"><span class="pagination_direct_link"><span class="icon-chevron-right"></span></span></li>
        @endif
        </ul>
    </nav>
@endif
