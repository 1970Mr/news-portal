<div class="comments-form">
    <h3 class="title-normal">دیدگاه خود را بیان کنید</h3>

    <form role="form" action="{{ route('comments.store') }}" method="POST">
        @if(session()->has('errors'))
            <div class="alert alert-danger">
                <strong>خطا!</strong>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @include('front::single-post.partials.comment-form-inputs')
    </form><!-- Form end -->
</div><!-- Comments form end -->
