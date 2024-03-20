<div>
    <form action="{{ $route }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-sm btn-danger btn-icon round d-flex justify-content-center align-items-center"
                rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
            <i class="icon-trash fa-flip-horizontal"></i>
        </button>
    </form>
</div>
