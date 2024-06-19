@csrf
@honeypot
<input type="hidden" name="commentable_type" value="{{ get_class($article) }}"/>
<input type="hidden" name="commentable_id" value="{{ $article->getKey() }}"/>

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
