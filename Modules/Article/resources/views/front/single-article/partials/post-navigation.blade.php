<nav class="post-navigation clearfix">
    <div class="post-previous">
        <a href="{{ route('news.show', [$previous_article->category->slug, $previous_article->slug]) }}">
            <span><i class="fa fa-angle-right"></i>مطلب قبلی</span>
            <h3>
                {{ $previous_article->title }}
            </h3>
        </a>
    </div>
    <div class="post-next">
        <a href="{{ route('news.show', [$next_article->category->slug, $next_article->slug]) }}">
            <span>مطلب بعدی <i class="fa fa-angle-left"></i></span>
            <h3>
                {{ $next_article->title }}
            </h3>
        </a>
    </div>
</nav><!-- Post navigation end -->
