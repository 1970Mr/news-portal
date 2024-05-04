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

        @csrf
        @honeypot
        <input type="hidden" name="commentable_type" value="{{ get_class($article) }}" />
        <input type="hidden" name="commentable_id" value="{{ $article->getKey() }}" />

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <textarea class="form-control required-field" name="comment" id="comment" placeholder="دیدگاه شما">{{ old('comment') }}</textarea>
                </div>
            </div><!-- Col end -->

            @guest
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" name="guest_name" id="guest_name" placeholder="نام" type="text" required value="{{ old('guest_name') }}">
                    </div>
                </div><!-- Col end -->

                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" name="guest_email" id="guest_email" placeholder="ایمیل" type="email" required value="{{ old('guest_email') }}">
                    </div>
                </div>
            @endguest
        </div><!-- Form row end -->
        <div class="clearfix">
            <button class="comments-btn btn btn-primary" type="submit">ارسال دیدگاه</button>
        </div>
    </form><!-- Form end -->
</div><!-- Comments form end -->
