<div class="post-title-area">
    <a class="post-cat" href="#">{{ $category->name }}</a>
    <h2 class="post-title">
        {{ $article->title }}
    </h2>
    <div class="post-meta">
        <span class="post-author">
            <a href="#">{{ $article->user->full_name }}</a>
        </span>
        <span class="post-date"><i class="fa fa-clock-o"></i> {{ jalalian()->forge($article->updated_at)->format(config('common.front_date_format')) }}</span>
        <span class="post-hits"><i class="fa fa-eye"></i> {{ visits($article)->count() }}</span>
        <span class="post-comment">
            <i class="fa fa-comments-o"></i>
            <a href="#comments" class="comments-link">
                <span>{{ $article->approvedComments->count() }}</span>
            </a>
        </span>
    </div>
</div><!-- Post title end -->
