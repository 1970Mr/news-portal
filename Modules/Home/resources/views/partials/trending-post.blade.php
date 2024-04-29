<section class="featured-post-area no-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-7 col-xs-12 pad-r">
                <div id="featured-slider" class="owl-carousel owl-theme featured-slider">

                    @foreach($trending_posts['five_latest_article'] as $trending_post)
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
                        <div class="post-overaly-style contentTop hot-post-top clearfix">
                            <div class="post-thumb">
                                <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/tech/gadget4.jpg') }}" alt=""></a>
                            </div>
                            <div class="post-content">
                                <a class="post-cat" href="#">ابزار</a>
                                <h2 class="post-title title-large">
                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                </h2>
                                <span class="post-date">لورم ایپسوم متن ساختگی</span>
                            </div><!-- Post content end -->
                        </div><!-- Post Overaly end -->
                    </div><!-- Col end -->

                    <div class="col-sm-6 pad-r-small">
                        <div class="post-overaly-style contentTop hot-post-bottom clearfix">
                            <div class="post-thumb">
                                <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel2.jpg') }}" alt=""></a>
                            </div>
                            <div class="post-content">
                                <a class="post-cat" href="#">مسافرت</a>
                                <h2 class="post-title title-medium">
                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>
                                </h2>
                            </div><!-- Post content end -->
                        </div><!-- Post Overaly end -->
                    </div><!-- Col end -->

                    <div class="col-sm-6 pad-l-small">
                        <div class="post-overaly-style contentTop hot-post-bottom clearfix">
                            <div class="post-thumb">
                                <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health1.jpg') }}" alt=""></a>
                            </div>
                            <div class="post-content">
                                <a class="post-cat" href="#">سلامتی</a>
                                <h2 class="post-title title-medium">
                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>
                                </h2>
                            </div><!-- Post content end -->
                        </div><!-- Post Overaly end -->
                    </div><!-- Col end -->
                </div>
            </div><!-- Col 5 end -->

        </div><!-- Row end -->
    </div><!-- Container end -->
</section><!-- Trending post end -->
