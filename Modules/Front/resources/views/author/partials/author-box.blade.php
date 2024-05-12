<div class="author-box">
    <div class="author-img pull-left">
        <img src="{{ asset('storage/' . $author->image->file_path) }}" alt="{{ $author->image->alt_text }}">
    </div>
    <div class="author-info">
        <h3>{{ $author->full_name }}</h3>
        <div class="author-counter pull-right">
            <span>{{ $articlesCount }} مطلب</span>
            <span>{{ $commentsCount }} دیدگاه</span>
        </div>
        <p>{{ $author->about }}</p>
        @if($socialNetworks)
            <div class="authors-social" style="clear: both">
                <span>مرا دنبال کنید: </span>
                @foreach($socialNetworks as $socialNetwork)
                    <a href="{{ $socialNetwork->url }}" title="{{ $socialNetwork->name }}"><i class="fa fa-{{ $socialNetwork->name }}"></i></a>
                @endforeach
            </div>
        @endif
    </div>
</div> <!-- Author box end -->
