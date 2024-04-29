<section class="featured-post-area no-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-7 col-xs-12 pad-r">
                <div id="featured-slider" class="owl-carousel owl-theme featured-slider">

                    @foreach($trending_posts['five_latest_articles'] as $trending_post)
                        <div class="item">
                            <img src="{{ asset('storage/' . $trending_post->image->file_path) }}" alt="{{ $trending_post->image->alt_text }}">
                            <div class="featured-post">
                                <div class="post-content">
                                    <a class="post-cat" href="#">{{ $trending_post->category->name }}</a>
                                    <h2 class="post-title title-extra-large">
                                        <a href="single-post1.html">{{ $trending_post->title }}</a>
                                    </h2>
                                    <span class="post-date">{{ jalalian()->forge($trending_post->created_at)->format(config('common.front_date_format')) }}</span>
                                </div>
                            </div><!--/ Featured post end -->
                        </div>
                    @endforeach

                </div><!-- Featured owl carousel end-->
            </div><!-- Col 7 end -->

            <div class="col-md-5 col-xs-12 pad-l">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="post-overlay-style contentTop hot-post-top clearfix">
                            <div class="post-thumb">
                                <a href="single-post1.html">
                                    <img class="img-responsive" src="{{ asset('storage/' . $trending_posts['first_editor_choice']->image->file_path) }}"
                                         alt="{{ asset('storage/' . $trending_posts['first_editor_choice']->image->alt_text) }}">
                                </a>
                            </div>
                            <div class="post-content">
                                <a class="post-cat" href="#">{{ $trending_posts['first_editor_choice']->category->name }}</a>
                                <h2 class="post-title title-large">
                                    <a href="single-post1.html">{{ $trending_posts['first_editor_choice']->title }}</a>
                                </h2>
                                <span class="post-date">{{ jalalian()->forge($trending_posts['first_editor_choice']->created_at)->format(config('common.front_date_format')) }}</span>
                            </div><!-- Post content end -->
                        </div><!-- Post overlay end -->
                    </div><!-- Col end -->

                    @php($editor_choice_direction = collect(['r', 'l']))
                    @foreach($trending_posts['editor_choices'] as $editor_choice)
                        <div class="col-sm-6 pad-{{ $editor_choice_direction->shift() }}-small">
                            <div class="post-overlay-style contentTop hot-post-bottom clearfix">
                                <div class="post-thumb">
                                    <a href="single-post1.html">
                                        <img class="img-responsive" src="{{ asset('storage/' . $editor_choice->image->file_path) }}"
                                             alt="{{ asset('storage/' . $editor_choice->image->alt_text) }}">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <a class="post-cat" href="#">{{ $editor_choice->category->name }}</a>
                                    <h2 class="post-title title-medium">
                                        <a href="single-post1.html">{{ $editor_choice->title }}</a>
                                    </h2>
                                </div><!-- Post content end -->
                            </div><!-- Post overlay end -->
                        </div><!-- Col end -->
                    @endforeach

                </div>
            </div><!-- Col 5 end -->

        </div><!-- Row end -->
    </div><!-- Container end -->
</section><!-- Trending post end -->
