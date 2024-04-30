<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

    <div class="latest-news block color-red">
        <h3 class="block-title"><span>جدیدترین خبر ها</span></h3>

        <div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
            @foreach ($first_content['latest_articles']->chunk(2) as $chunk)
                <div class="item">
                    <ul class="list-post">
                        @foreach ($chunk as $key => $item)
                            <li class="clearfix">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="single-post1.html">
                                            <img class="img-responsive" src="{{ asset('storage/' . $item->image->file_path) }}" alt="{{ asset('storage' . $item->image->alt_text) }}">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">{{ $item->category->name }}</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="single-post1.html">{{ $item->title }}</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">{{ $item->user->name }}</a></span>
                                            <span class="post-date">{{ jalalian()->forge($item->created_at)->format(config('common.front_date_format')) }}</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </li><!-- Li end -->

                            @if($key % 2 === 0)
                                <div class="gap-30"></div>
                            @endif
                        @endforeach
{{--                        <li class="clearfix">--}}
{{--                            <div class="post-block-style clearfix">--}}
{{--                                <div class="post-thumb">--}}
{{--                                    <a href="single-post1.html">--}}
{{--                                        <img class="img-responsive" src="{{ asset('storage' . $chunk[0]->image->file_path) }}" alt="{{ asset('storage' . $chunk[0]->image->alt_text) }}">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <a class="post-cat" href="#">{{ $chunk[0]->category->name }}</a>--}}
{{--                                <div class="post-content">--}}
{{--                                    <h2 class="post-title title-medium">--}}
{{--                                        <a href="single-post1.html">{{ $chunk[0]->title }}</a>--}}
{{--                                    </h2>--}}
{{--                                    <div class="post-meta">--}}
{{--                                        <span class="post-author"><a href="#">{{ $chunk[0]->user->name }}</a></span>--}}
{{--                                        <span class="post-date">{{ jalalian()->forge($chunk[0]->created_at)->format(config('common.front_date_format')) }}</span>--}}
{{--                                    </div>--}}
{{--                                </div><!-- Post content end -->--}}
{{--                            </div><!-- Post Block style end -->--}}
{{--                        </li><!-- Li end -->--}}

{{--                        <div class="gap-30"></div>--}}

{{--                        <li class="clearfix">--}}
{{--                            <div class="post-block-style clearfix">--}}
{{--                                <div class="post-thumb">--}}
{{--                                    <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel4.jpg') }}" alt=""></a>--}}
{{--                                </div>--}}
{{--                                <a class="post-cat" href="#">مسافرت</a>--}}
{{--                                <div class="post-content">--}}
{{--                                    <h2 class="post-title title-medium">--}}
{{--                                        <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a>--}}
{{--                                    </h2>--}}
{{--                                    <div class="post-meta">--}}
{{--                                        <span class="post-author"><a href="#">جان اسنو</a></span>--}}
{{--                                        <span class="post-date">لورم ایپسوم متن</span>--}}
{{--                                    </div>--}}
{{--                                </div><!-- Post content end -->--}}
{{--                            </div><!-- Post Block style end -->--}}
{{--                        </li><!-- Li end -->--}}
                    </ul><!-- List post 1 end -->

                </div><!-- Item 1 end -->
            @endforeach

{{--            <div class="item">--}}

{{--                <ul class="list-post">--}}
{{--                    <li class="clearfix">--}}
{{--                        <div class="post-block-style clearfix">--}}
{{--                            <div class="post-thumb">--}}
{{--                                <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel5.jpg') }}" alt=""></a>--}}
{{--                            </div>--}}
{{--                            <a class="post-cat" href="#">مسافرت</a>--}}
{{--                            <div class="post-content">--}}
{{--                                <h2 class="post-title title-medium">--}}
{{--                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a>--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta">--}}
{{--                                    <span class="post-author"><a href="#">جان اسنو</a></span>--}}
{{--                                    <span class="post-date">لورم ایپسوم متن</span>--}}
{{--                                </div>--}}
{{--                            </div><!-- Post content end -->--}}
{{--                        </div><!-- Post Block style end -->--}}
{{--                    </li><!-- Li end -->--}}

{{--                    <div class="gap-30"></div>--}}

{{--                    <li class="clearfix">--}}
{{--                        <div class="post-block-style clearfix">--}}
{{--                            <div class="post-thumb">--}}
{{--                                <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health4.jpg') }}" alt=""></a>--}}
{{--                            </div>--}}
{{--                            <a class="post-cat" href="#">سلامتی</a>--}}
{{--                            <div class="post-content">--}}
{{--                                <h2 class="post-title title-medium">--}}
{{--                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta">--}}
{{--                                    <span class="post-author"><a href="#">جان اسنو</a></span>--}}
{{--                                    <span class="post-date">لورم ایپسوم متن</span>--}}
{{--                                </div>--}}
{{--                            </div><!-- Post content end -->--}}
{{--                        </div><!-- Post Block style end -->--}}
{{--                    </li><!-- Li end -->--}}
{{--                </ul><!-- List post 2 end -->--}}

{{--            </div><!-- Item 2 end -->--}}

{{--            <div class="item">--}}

{{--                <ul class="list-post">--}}
{{--                    <li class="clearfix">--}}
{{--                        <div class="post-block-style clearfix">--}}
{{--                            <div class="post-thumb">--}}
{{--                                <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/tech/gadget2.jpg') }}" alt=""></a>--}}
{{--                            </div>--}}
{{--                            <a class="post-cat" href="#">ابزار</a>--}}
{{--                            <div class="post-content">--}}
{{--                                <h2 class="post-title title-medium">--}}
{{--                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta">--}}
{{--                                    <span class="post-author"><a href="#">جان اسنو</a></span>--}}
{{--                                    <span class="post-date">18 مرداد 1396</span>--}}
{{--                                </div>--}}
{{--                            </div><!-- Post content end -->--}}
{{--                        </div><!-- Post Block style end -->--}}
{{--                    </li><!-- Li end -->--}}

{{--                    <div class="gap-30"></div>--}}

{{--                    <li class="clearfix">--}}
{{--                        <div class="post-block-style clearfix">--}}
{{--                            <div class="post-thumb">--}}
{{--                                <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/architecture3.jpg') }}" alt=""></a>--}}
{{--                            </div>--}}
{{--                            <a class="post-cat" href="#">معماری</a>--}}
{{--                            <div class="post-content">--}}
{{--                                <h2 class="post-title title-medium">--}}
{{--                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a>--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta">--}}
{{--                                    <span class="post-author"><a href="#">جان اسنو</a></span>--}}
{{--                                    <span class="post-date">12 خرداد 1396</span>--}}
{{--                                </div>--}}
{{--                            </div><!-- Post content end -->--}}
{{--                        </div><!-- Post Block style end -->--}}
{{--                    </li><!-- Li end -->--}}
{{--                </ul><!-- List post 3 end -->--}}

{{--            </div><!-- Item 3 end -->--}}

{{--            <div class="item">--}}
{{--                <ul class="list-post">--}}
{{--                    <li class="clearfix">--}}
{{--                        <div class="post-block-style clearfix">--}}
{{--                            <div class="post-thumb">--}}
{{--                                <a href="single-post1.html">--}}
{{--                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/food3.jpg') }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <a class="post-cat" href="#">غذا</a>--}}
{{--                            <div class="post-content">--}}
{{--                                <h2 class="post-title title-medium">--}}
{{--                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a>--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta">--}}
{{--                                    <span class="post-author"><a href="#">جان اسنو</a></span>--}}
{{--                                    <span class="post-date">16 اسفند 1396</span>--}}
{{--                                </div>--}}
{{--                            </div><!-- Post content end -->--}}
{{--                        </div><!-- Post Block style end -->--}}
{{--                    </li><!-- Li end -->--}}

{{--                    <div class="gap-30"></div>--}}

{{--                    <li class="clearfix">--}}
{{--                        <div class="post-block-style clearfix">--}}
{{--                            <div class="post-thumb">--}}
{{--                                <a href="single-post1.html">--}}
{{--                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/game1.jpg') }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <a class="post-cat" href="#">بازی ها</a>--}}
{{--                            <div class="post-content">--}}
{{--                                <h2 class="post-title title-medium">--}}
{{--                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta">--}}
{{--                                    <span class="post-author"><a href="#">جان اسنو</a></span>--}}
{{--                                    <span class="post-date">6 تیر 1396</span>--}}
{{--                                </div>--}}
{{--                            </div><!-- Post content end -->--}}
{{--                        </div><!-- Post Block style end -->--}}
{{--                    </li><!-- Li end -->--}}
{{--                </ul><!-- List post 4 end -->--}}

{{--            </div><!-- Item 4 end -->--}}

        </div><!-- Latest News owl carousel end-->
    </div><!--- Latest news end -->
</div><!-- Content Col end -->
