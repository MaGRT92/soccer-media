@if ($paginator->hasPages())
    <div class="w3-bar">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="w3-button w3-hover-text-white" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
              <span class="disabled">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                       <span class="w3-green w3-button w3-hover-text-white">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}" class="w3-button w3-hover-text-white">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="w3-button w3-hover-text-white" rel="next">&raquo;</a>
        @else
           
        @endif
    </div>
@endif