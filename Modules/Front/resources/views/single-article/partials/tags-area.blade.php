<div class="tags-area clearfix">
    <div class="post-tags">
        <span>برچسب‌ها:</span>
        @foreach($article->tags as $tag)
            <a href="{{ route('tags.show', $tag->slug) }}">{{ $tag->name }}</a>
        @endforeach
    </div>
</div><!-- Tags end -->
