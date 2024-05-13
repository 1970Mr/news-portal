@if($paginator->lastPage() > 1)
    <div class="paging">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($paginator->currentPage() > 1)
                <li><a href="{{ $paginator->previousPageUrl() }}">قبلی</a></li>
            @endif

            <!-- Pagination Elements -->
            @foreach(range(1, $paginator->lastPage()) as $page)
                @if ($page === $paginator->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endforeach

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
