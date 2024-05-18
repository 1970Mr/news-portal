<div class="related-posts block">
    <h3 class="block-title"><span>مطالب مرتبط</span></h3>

    <div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
        @foreach($related_articles as $related_article)
            <div class="item">
                <div class="post-block-style clearfix">
                    <div class="post-thumb">
                        <a href="{{ route('news.show', [$related_article->category->slug, $related_article->slug]) }}">
                            <img class="img-responsive" src="{{ asset('storage/' . $related_article->image->file_path) }}" alt="{{ $related_article->image->alt_text }}">
                        </a>
                    </div>
                    <a class="post-cat" href="{{ route('categories.show', $related_article->category->slug) }}">{{ $related_article->category->name }}</a>
                    <div class="post-content">
                        <h2 class="post-title title-medium">
                            <a href="{{ route('news.show', [$related_article->category->slug, $related_article->slug]) }}">{{ $related_article->title }}</a>
                        </h2>
                        <div class="post-meta">
                            <span class="post-author"><a href="{{ route('author.index', $related_article->user->username) }}">{{ $related_article->user->full_name }}</a></span>
                            <span class="post-date">{{ jalalian()->forge($related_article->created_at)->format(config('common.front_date_format')) }}</span>
                        </div>
                    </div><!-- Post content end -->
                </div><!-- Post Block style end -->
            </div>
        @endforeach
    </div><!-- Carousel end -->

</div><!-- Related posts end -->
