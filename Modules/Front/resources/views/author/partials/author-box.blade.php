<div class="author-box">
    <div class="author-img pull-left">
        <img src="{{ asset('storage/' . $author->image->file_path) }}" alt="{{ $author->image->alt_text }}">
    </div>
    <div class="author-info">
        <h3>{{ $author->name }}</h3>
        <div class="author-counter pull-right">
            <span>{{ $author->articles()->count() }} مطلب</span>
            <span>{{ $author->approvedComments()->count() }} دیدگاه</span>
        </div>
        <p>{{ $author->description }}</p>
        @if($socialNetworks = $author->socialNetworks)
            <div class="authors-social" style="clear: both">
                <span>مرا دنبال کنید: </span>
                @foreach($socialNetworks as $socialNetwork)
                    <a href="{{ $socialNetwork->url }}" title="{{ $socialNetwork->name }}"><i class="fa fa-{{ $socialNetwork->name }}"></i></a>
                @endforeach
            </div>
        @endif
    </div>
</div> <!-- Author box end -->
