<section class="block-wrapper">
    <div class="container">
        <div class="row third-content-row">
            @foreach($third_content['categories'] as $category)
                <div class="col-xl-12 col-md-4">
                    <div class="block color-red">
                        <h3 class="block-title"><span>{{ $category->name }}</span></h3>
                        <div class="post-overlay-style clearfix">
                            <div class="post-thumb">
                                <a href="{{ route('categories.show', $category->slug) }}">
                                    <img class="img-responsive third-img-category" src="{{ asset('storage/' . $category->image->file_path) }}" alt="{{ $category->image->alt_text }}">
                                </a>
                            </div>

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="{{ route('categories.show', $category->slug) }}">دسته‌بندی {{ $category->name }}</a>
                                </h2>
                            </div><!-- Post content end -->
                        </div><!-- Post overlay Article end -->

                        <div class="list-post-block">
                            <ul class="list-post">
                                @foreach($category->articles as $article)
                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ route('news.show', [$article->category->slug, $article->slug]) }}">
                                                    <img class="img-responsive" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->elt_text }}">
                                                </a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ route('news.show', [$article->category->slug, $article->slug]) }}">{{ $article->title }}</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-date">{{ jalalian()->forge($article->created_at)->format(config('common.front_date_format')) }}</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 1 end -->
                                @endforeach
                            </ul><!-- List post end -->
                        </div><!-- List post block end -->
                    </div><!-- Block end -->
                </div><!-- Travel Col end -->
            @endforeach
        </div><!-- Row end -->
    </div><!-- Container end -->
</section><!-- Third block end -->
