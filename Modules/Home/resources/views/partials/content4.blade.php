<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="more-news block color-red">
        <h3 class="block-title"><span>خبرهای بیشتر</span></h3>

        <div id="more-news-slide" class="owl-carousel owl-theme more-news-slide">
        @foreach($fourth_content['latest_articles']->chunk(4) as $articles)
                <div class="item">
                    @foreach($articles as $article)
                        <div class="post-block-style post-float-half clearfix">
                            <div class="post-thumb">
                                <a href="{{ $article->getUrl() }}">
                                    <img class="img-responsive" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}">
                                </a>
                            </div>
                            <a class="post-cat" href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a>
                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="{{ $article->getUrl() }}">{{ $article->title }}</a>
                                </h2>
                                <div class="post-meta">
                                    <span class="post-author"><a href="{{ route('author.index', $article->user->username) }}">{{ $article->user->full_name }}</a></span>
                                    <span class="post-date">{{ jalalian()->forge($article->created_at)->format(config('common.front_date_format')) }}</span>
                                </div>
                                <p>{{ $article->bodyText(200) }}</p>
                            </div><!-- Post content end -->
                        </div><!-- Post Block style 1 end -->

                        @if(!$loop->last)
                            <div class="gap-30"></div>
                        @endif
                    @endforeach
                </div><!-- Item 1 end -->
        @endforeach
        </div><!-- More news carousel end -->
    </div><!--More news block end -->
</div><!-- Content Col end -->
