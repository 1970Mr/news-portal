<div class="{{ $sidebar_classes ?? 'col-xs-12' }}" style="{{ $side_styles ?? 'margin-bottom: 3rem;' }}">
    <div class="sidebar sidebar-right first-sidebar">
        <div class="widget color-default m-bottom-0">
            <h3 class="block-title"><span>اخبار پربازدید</span></h3>
            @php($first_article = $first_sidebar['articles_with_most_visits']->shift())
            <div class="post-overlay-style clearfix">
                <div class="post-thumb">
                    <a href="{{ route('news.show', [$first_article->category->slug, $first_article->slug]) }}">
                        <img class="img-responsive" src="{{ asset('storage/' . $first_article->image->file_path) }}" alt="{{ $first_article->image->alt_text }}" style="height: 226px">
                    </a>
                </div>

                <div class="post-content">
                    <a class="post-cat" href="{{ route('categories.show', $first_article->category->slug) }}">{{ $first_article->category->name }}</a>
                    <h2 class="post-title">
                        <a href="{{ route('news.show', [$first_article->category->slug, $first_article->slug]) }}">{{ $first_article->title }}</a>
                    </h2>
                    <div class="post-meta">
                        <span class="post-date">{{ front_date_format($first_article->created_at) }}</span>
                    </div>
                </div><!-- Post content end -->
            </div><!-- Post overlay Article end -->

            <div class="list-post-block">
                <ul class="list-post">
                    @foreach($first_sidebar['articles_with_most_visits'] as $article)
                        <li class="clearfix">
                            <div class="post-block-style post-float clearfix">
                                <div class="post-thumb">
                                    <a href="{{ route('news.show', [$article->category->slug, $first_article->slug]) }}">
                                        <img class="img-responsive" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}" style="height: 75px">
                                    </a>
                                    <a class="post-cat" href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a>
                                </div><!-- Post thumb end -->

                                <div class="post-content">
                                    <h2 class="post-title title-small">
                                        <a href="{{ route('news.show', [$article->category->slug, $article->slug]) }}">{{ $article->title }}</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="post-date">{{ front_date_format($article->created_at) }}</span>
                                    </div>
                                </div><!-- Post content end -->
                            </div><!-- Post block style end -->
                        </li>
                    @endforeach
                </ul><!-- List post end -->
            </div><!-- List post block end -->
        </div><!-- Popular news widget end -->
    </div><!-- Sidebar right end -->
</div><!-- Sidebar Col end -->
