<div class="block category-listing">
    <div class="row" style="min-height: 5rem">
        @if($articles->count() < 1)
            <p class="alert-warning" style="padding: 1rem; border-radius: 5px;">
                مطلبی با محتوای موردنظر شما یافت نشد!
            </p>
        @endif
        @foreach($articles as $article)
            <div class="col-md-6 col-sm-6">
                <div class="post-block-style post-grid clearfix">
                    <div class="post-thumb">
                        <a href="{{ route('news.show', [$article->category->slug, $article->slug]) }}">
                            <img class="img-responsive" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}" style="height: 240px">
                        </a>
                    </div>
                    <a class="post-cat" href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a>
                    <div class="post-content">
                        <h2 class="post-title title-large">
                            <a href="{{ route('news.show', [$article->category->slug, $article->slug]) }}">{{ $article->title }}</a>
                        </h2>
                        <div class="post-meta">
                            <span class="post-author"><a href="{{ route('author.index', $article->user->username) }}">{{ $article->user->full_name }}</a></span>
                            <span class="post-date">{{ jalalian()->forge($article->created_at)->format(config('common.front_date_format')) }}</span>
                            <span class="post-comment pull-right">
                            <span class="post-hits"><i class="fa fa-eye"></i> {{ visits($article)->count() }}</span>
                                <i class="fa fa-comments-o"></i>
								<a href="{{ route('news.show', [$article->category->slug, $article->slug]) . '#comments' }}" class="comments-link">
                                    <span>{{ $article->approvedComments()->count() }}</span>
                                </a>
                            </span>
                        </div>
                        <p>{{ $article->bodyText() }}</p>
                    </div><!-- Post content end -->
                </div><!-- Post Block style end -->
            </div>
        @endforeach
    </div><!-- Row end -->
</div><!-- Block Lifestyle end -->
