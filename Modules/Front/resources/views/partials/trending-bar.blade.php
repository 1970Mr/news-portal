<div class="trending-bar hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="trending-title">خبرهای داغ</h3>
                <div id="trending-slide" class="owl-carousel owl-theme trending-slide">
                    @foreach($trending_bar['hot_articles'] as $article)
                        <div class="item">
                            <div class="post-content">
                                <h2 class="post-title title-small">
                                    <a href="{{ $article->getUrl() }}">{{ $article->title }}</a>
                                </h2>
                            </div><!-- Post content end -->
                        </div>
                    @endforeach
                </div><!-- Carousel end -->
            </div><!-- Col end -->
        </div><!--/ Row end -->
    </div><!--/ Container end -->
</div><!--/ Trending end -->
