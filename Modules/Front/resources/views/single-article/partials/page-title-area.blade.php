<div class="post-title-area">
    <a class="post-cat" href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a>
    <h2 class="post-title">
        {{ $article->title }}
    </h2>
    <div class="post-meta">
        <span class="post-author">
            <a href="{{ route('author.index', $article->user->username) }}">{{ $article->user->full_name }}</a>
        </span>
        <span class="post-date"><i class="fa fa-clock-o"></i> {{ front_date_format($article->created_at) }}</span>
        <span class="post-hits"><i class="fa fa-eye"></i> {{ visits($article)->count() }}</span>
        {{--        <span class="post-like">--}}
        {{--            <form action="{{ route('news.like', $article) }}" method="post">--}}
        {{--                @csrf--}}
        {{--                @honeypot--}}
        {{--                <i class="fa fa-heart"></i> {{ $article->likeCount }}--}}
        {{--            </form>--}}
        {{--        </span>--}}

        @if(!$article->liked())
            <span class="post-like" title="لایک کردن">
                <form action="{{ route('news.like', $article->slug) }}" method="post" class="like-form">
                    @csrf
                    @method('patch')
                    @honeypot
                    <i class="fa fa-heart"></i>
                    <div class="like-count">{{ $article->likeCount }}</div>
                </form>
            </span>
        @endif

        @if($article->liked())
            <span class="post-unlike" title="برداشتن لایک">
                <form action="{{ route('news.unlike', $article->slug) }}" method="post" class="unlike-form">
                    @csrf
                    @method('patch')
                    @honeypot
                    <i class="fa fa-heart"></i>
                    <div class="like-count">{{ $article->likeCount }}</div>
                </form>
            </span>
        @endif

        <span class="post-comment">
            <a href="#comments" class="comments-link">
                <i class="fa fa-comments-o"></i>
                <span>{{ $article->approvedComments->count() }}</span>
            </a>
        </span>
    </div>
</div><!-- Post title end -->
