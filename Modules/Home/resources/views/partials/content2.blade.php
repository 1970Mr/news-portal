    <section class="block-wrapper">
        <div class="container">
            <div class="row" style="display: flex; gap: 3rem; justify-content: center">
                @foreach($second_content['parent_categories'] as $parent_category)

                <!--- Featured Tab starter -->
                <div class="featured-tab color-default col-12 col-md-6" style="padding: 0">
                    <h3 class="block-title"><span>{{ $parent_category->name }}</span></h3>
                    <ul class="nav nav-tabs">
                        @foreach($parent_category->categories as $category)
                            <li class="@if($loop->first) active @endif">
                                <a class="animated fadeIn" href="#category_{{ $category->id }}" data-toggle="tab">
										<span class="tab-head">
											<span class="tab-text-title">{{ $category->name }}</span>
										</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach($parent_category->categories as $category)
                            @php($first_article = $category->articles->pop())
                            <div class="tab-pane animated fadeInLeft @if($loop->first) active @endif" id="category_{{ $category->id }}">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="single-post1.html">
                                                    <img class="img-responsive" src="{{ asset('storage/' . $first_article->image->file_path) }}" alt="{{ $first_article->image->alt_text }}"
                                                    style="max-height: 20rem; object-fit: cover">
                                                </a>
                                            </div>
                                            <a class="post-cat" href="#">{{ $first_article->category->name }}</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="single-post1.html">{{ $first_article->title }}</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">{{ $first_article->user->name }}</a></span>
                                                    <span class="post-date">{{ jalalian()->forge($first_article->created_at)->format(config('common.front_date_format')) }}</span>
                                                </div>
                                                <p>{{ str(strip_tags($first_article->body))->limit(120) }}</p>
                                            </div>
                                        </div><!-- Post Block style end -->
                                    </div><!-- Col end -->

                                    <div class="col-md-6 col-sm-6">
                                        <div class="list-post-block">
                                            <ul class="list-post">
                                                @foreach($category->articles as $article)
                                                    <li class="clearfix" style="max-height: 10rem;">
                                                        <div class="post-block-style post-float clearfix">
                                                            <div class="post-thumb">
                                                                <a href="single-post1.html">
                                                                    <img class="img-responsive" src="{{ asset('storage/' . $article->image->file_path) }}"
                                                                         alt="{{ $article->image->alt_text }}" style="max-height: 10rem;">
                                                                </a>
                                                            </div><!-- Post thumb end -->

                                                            <div class="post-content">
                                                                <h2 class="post-title title-small">
                                                                    <a href="single-post1.html">{{ $article->title }}</a>
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
                                    </div><!-- List post Col end -->
                                </div><!-- Tab pane Row 1 end -->
                            </div><!-- Tab pane 1 end -->
                        @endforeach
                    </div><!-- tab content -->
                </div><!-- Technology Tab end -->

                @endforeach
            </div>
        </div>
    </section><!-- Second block end -->
