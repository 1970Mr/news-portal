<div class="block category-listing categories-list">
    <h3 class="block-title"><span>دسته‌بندی‌ها</span></h3>

    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-6 col-sm-6">
                <div class="post-block-style post-grid clearfix">
                    <div class="post-thumb">
                        <a href="{{ route('categories.show', $category->slug) }}">
                            @if($category->image)
                                <img class="img-responsive" src="{{ asset('storage/' . $category->image->file_path) }}" alt="{{ $category->image->alt_text }}" style="height: 240px">
                            @endif
                        </a>
                    </div>
                    <a class="post-cat" href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                    <div class="post-content">
                        <h2 class="post-title title-large">
                            <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                        </h2>
                        <div class="post-meta">
                            <span class="post-date">تعداد مقالات: {{ $category->articles_count }}</span>
                        </div>
                    </div><!-- Post content end -->
                </div><!-- Post Block style end -->
            </div>
        @endforeach
    </div><!-- Row end -->
</div>
