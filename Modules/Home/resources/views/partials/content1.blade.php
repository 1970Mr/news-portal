<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="latest-news block color-red">
        <h3 class="block-title"><span>جدیدترین خبرها</span></h3>

        <div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
            @foreach ($first_content['latest_articles']->chunk(2) as $articles)
                <div class="item">
                    <ul class="list-post">
                        @foreach ($articles as $key => $article)
                            <li class="clearfix">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ $article->getUrl() }}">
                                            <img class="img-responsive" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="{{ $article->getUrl() }}">{{ $article->title }}</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="{{ route('author.index', $article->user->username) }}">{{ $article->user->full_name }}</a></span>
                                            <span class="post-date">{{ jalalian()->forge($article->created_at)->format(config('common.front_date_format')) }}</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </li><!-- Li end -->

                            @if(!$loop->last)
                                <div class="gap-60"></div>
                            @endif
                        @endforeach
                    </ul><!-- List post 1 end -->
                </div><!-- Item 1 end -->
            @endforeach
        </div><!-- Latest News owl carousel end-->
    </div><!--- Latest news end -->
</div><!-- Content Col end -->
