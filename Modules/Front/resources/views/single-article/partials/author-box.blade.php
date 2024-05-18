<div class="author-box">
    <div class="author-img pull-left">
        <a href="{{ route('author.index', $article->user->username) }}">
            <img src="{{ asset('storage/' . $article->user->image->file_path) }}" alt="{{ $article->user->image->alt_text }}">
        </a>
    </div>
    <div class="author-info">
        <h3>
            <a class="" href="{{ route('author.index', $article->user->username) }}">{{ $article->user->full_name }}</a>
        </h3>
        <p>{{ $article->user->about }}</p>
        @if($socialNetworks = $article->user->socialNetworks)
            <div class="authors-social" style="clear: both">
                <span>مرا دنبال کنید: </span>
                @foreach($socialNetworks as $socialNetwork)
                    <a href="{{ $socialNetwork->url }}" title="{{ $socialNetwork->name }}"><i class="fa fa-{{ $socialNetwork->name }}"></i></a>
                @endforeach
            </div>
        @endif
    </div>
</div> <!-- Author box end -->
