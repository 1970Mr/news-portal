<div class="post-content-area">
    <div class="post-media post-featured-image">
        <a href="{{ asset('storage/' . $article->image->file_path) }}" class="gallery-popup">
            <img src="{{ asset('storage/' . $article->image->file_path) }}" class="img-responsive" alt="{{ $article->image->alt_text }}" style="max-height: 60rem; min-height: 10rem">
        </a>
    </div>
    <div class="entry-content">
        {!! $article->body !!}
    </div><!-- Entry content end -->
    @include('front::single-post.partials.tags-area')

    @include('front::single-post.partials.share-items')
</div><!-- Post content end -->
