<div class="author-box">
    <div class="author-img pull-left">
        <img src="{{ asset('storage/' . $article->user->image->file_path) }}" alt="{{ $article->user->image->alt_text }}">
    </div>
    <div class="author-info">
        <h3>{{ $article->user->name }}</h3>
        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط</p>
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
