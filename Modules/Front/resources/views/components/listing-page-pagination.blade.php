@if($paginator->count() >= 1 && $paginator->lastPage() > 1)
    <div class="paging">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($paginator->currentPage() > 1)
                <li><a href="{{ $paginator->previousPageUrl() }}">قبلی</a></li>
            @endif

            <!-- First Page Link -->
            @if ($paginator->currentPage() > 3)
                <li><a href="{{ $paginator->url(1) }}">1</a></li>
                @if ($paginator->currentPage() > 4)
                    <li><span>...</span></li>
                @endif
            @endif

            <!-- Pagination Elements -->
            @foreach(range(1, $paginator->lastPage()) as $page)
                @if (
                    $page >= $paginator->currentPage() - 2 &&
                    $page <= $paginator->currentPage() + 2
                )
                    @if ($page === $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endif
            @endforeach

            <!-- Last Page Link -->
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                    <li><span>...</span></li>
                @endif
                <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @endif

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}">بعدی</a></li>
            @endif

            <!-- Page Numbers -->
            <li>
                <span class="page-numbers">صفحه {{ $paginator->currentPage() }} از {{ $paginator->lastPage() }}</span>
            </li>
        </ul>
    </div><!-- Paging end -->
@endif
