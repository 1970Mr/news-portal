@extends('home::layouts.master', ['title' => 'News Site | سایت خبری'])

@section('content')

    <section class="featured-post-area no-padding">
        <div class="container">
            <div class="row">

                <div class="col-md-7 col-xs-12 pad-r">
                    <div id="featured-slider" class="owl-carousel owl-theme featured-slider">

                        <div class="item">
                            <img src="{{ asset('home/images/news/lifestyle/health5.jpg') }}" alt="">
                            <div class="featured-post">
                                <div class="post-content">
                                    <a class="post-cat" href="#">سلامتی</a>
                                    <h2 class="post-title title-extra-large">
                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                            صنعت چاپ و با استفاده از</a>
                                    </h2>
                                    <span class="post-date">16 دی 1396</span>
                                </div>
                            </div><!--/ Featured post end -->
                        </div><!-- Item 1 end -->

                        <div class="item">
                            <img src="{{ asset('home/images/news/tech/gadget2.jpg') }}" alt="">
                            <div class="featured-post">
                                <div class="post-content">
                                    <a class="post-cat" href="#">ابزار</a>
                                    <h2 class="post-title title-extra-large">
                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                            صنعت چاپ و با استفاده</a>
                                    </h2>
                                    <span class="post-date">16 دی 1396</span>
                                </div>
                            </div><!--/ Featured post end -->
                        </div><!-- Item 2 end -->

                        <div class="item">
                            <img src="{{ asset('home/images/news/lifestyle/travel5.jpg') }}" alt="">
                            <div class="featured-post">
                                <div class="post-content">
                                    <a class="post-cat" href="#">مسافرت</a>
                                    <h2 class="post-title title-extra-large">
                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                            صنعت چاپ و با</a>
                                    </h2>
                                    <span class="post-date">16 دی 1396</span>
                                </div>
                            </div><!--/ Featured post end -->
                        </div><!-- Item 3 end -->

                    </div><!-- Featured owl carousel end-->
                </div><!-- Col 7 end -->

                <div class="col-md-5 col-xs-12 pad-l">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="post-overaly-style contentTop hot-post-top clearfix">
                                <div class="post-thumb">
                                    <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/gadget4.jpg') }}" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <a class="post-cat" href="#">ابزار</a>
                                    <h2 class="post-title title-large">
                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                            صنعت چاپ و با</a>
                                    </h2>
                                    <span class="post-date">لورم ایپسوم متن ساختگی</span>
                                </div><!-- Post content end -->
                            </div><!-- Post Overaly end -->
                        </div><!-- Col end -->

                        <div class="col-sm-6 pad-r-small">
                            <div class="post-overaly-style contentTop hot-post-bottom clearfix">
                                <div class="post-thumb">
                                    <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                     src="{{ asset('home/images/news/lifestyle/travel2.jpg') }}" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <a class="post-cat" href="#">مسافرت</a>
                                    <h2 class="post-title title-medium">
                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>
                                    </h2>
                                </div><!-- Post content end -->
                            </div><!-- Post Overaly end -->
                        </div><!-- Col end -->

                        <div class="col-sm-6 pad-l-small">
                            <div class="post-overaly-style contentTop hot-post-bottom clearfix">
                                <div class="post-thumb">
                                    <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                     src="{{ asset('home/images/news/lifestyle/health1.jpg') }}" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <a class="post-cat" href="#">سلامتی</a>
                                    <h2 class="post-title title-medium">
                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>
                                    </h2>
                                </div><!-- Post content end -->
                            </div><!-- Post Overaly end -->
                        </div><!-- Col end -->
                    </div>
                </div><!-- Col 5 end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Trending post end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="latest-news block color-red">
                        <h3 class="block-title"><span>جدیدترین خبر ها</span></h3>

                        <div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
                            <div class="item">
                                <ul class="list-post">
                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                                 src="{{ asset('home/images/news/lifestyle/health5.jpg') }}"
                                                                                 alt=""></a>
                                            </div>
                                            <a class="post-cat" href="#">سلامتی</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">30 فروردین 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->

                                    <div class="gap-30"></div>

                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                                 src="{{ asset('home/images/news/lifestyle/travel4.jpg') }}"
                                                                                 alt=""></a>
                                            </div>
                                            <a class="post-cat" href="#">مسافرت</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">لورم ایپسوم متن</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->
                                </ul><!-- List post 1 end -->

                            </div><!-- Item 1 end -->

                            <div class="item">

                                <ul class="list-post">
                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                                 src="{{ asset('home/images/news/lifestyle/travel5.jpg') }}"
                                                                                 alt=""></a>
                                            </div>
                                            <a class="post-cat" href="#">مسافرت</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">لورم ایپسوم متن</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->

                                    <div class="gap-30"></div>

                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                                 src="{{ asset('home/images/news/lifestyle/health4.jpg') }}"
                                                                                 alt=""></a>
                                            </div>
                                            <a class="post-cat" href="#">سلامتی</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">لورم ایپسوم متن</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->
                                </ul><!-- List post 2 end -->

                            </div><!-- Item 2 end -->

                            <div class="item">

                                <ul class="list-post">
                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                                 src="{{ asset('home/images/news/tech/gadget2.jpg') }}"
                                                                                 alt=""></a>
                                            </div>
                                            <a class="post-cat" href="#">ابزار</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">18 مرداد 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->

                                    <div class="gap-30"></div>

                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}"><img class="img-responsive"
                                                                                 src="{{ asset('home/images/news/lifestyle/architecture3.jpg') }}"
                                                                                 alt=""></a>
                                            </div>
                                            <a class="post-cat" href="#">معماری</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">12 خرداد 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->
                                </ul><!-- List post 3 end -->

                            </div><!-- Item 3 end -->

                            <div class="item">
                                <ul class="list-post">
                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/food3.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <a class="post-cat" href="#">غذا</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">16 اسفند 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->

                                    <div class="gap-30"></div>

                                    <li class="clearfix">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/game1.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <a class="post-cat" href="#">بازی ها</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">6 تیر 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </li><!-- Li end -->
                                </ul><!-- List post 4 end -->

                            </div><!-- Item 4 end -->
                        </div><!-- Latest News owl carousel end-->
                    </div><!--- Latest news end -->

                    <div class="gap-50"></div>

                    <!--- Featured Tab startet -->
                    <div class="featured-tab color-blue">
                        <h3 class="block-title"><span>تکنولوژی</span></h3>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a class="animated fadeIn" href="#tab_a" data-toggle="tab">
										<span class="tab-head">
											<span class="tab-text-title">گجت ها</span>
										</span>
                                </a>
                            </li>
                            <li>
                                <a class="animated fadeIn" href="#tab_b" data-toggle="tab">
										<span class="tab-head">
											<span class="tab-text-title">بازی ها</span>
										</span>
                                </a>
                            </li>
                            <li>
                                <a class="animated fadeIn" href="#tab_c" data-toggle="tab">
										<span class="tab-head">
											<span class="tab-text-title">رباتیک</span>
										</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active animated fadeInLeft" id="tab_a">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget1.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <a class="post-cat" href="#">گجت ها</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از صنعت چاپ</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">24 تیر 1396</span>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                    ستون و سطرآنچنان که لازم</p>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </div><!-- Col end -->

                                    <div class="col-md-6 col-sm-6">
                                        <div class="list-post-block">
                                            <ul class="list-post">
                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/gadget2.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">25 فروردین 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 1 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/gadget3.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">18 بهمن 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 2 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/gadget4.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">30 فروردین 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 3 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/gadget5.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">27 خرداد 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 4 end -->
                                            </ul><!-- List post end -->
                                        </div><!-- List post block end -->
                                    </div><!-- List post Col end -->
                                </div><!-- Tab pane Row 1 end -->
                            </div><!-- Tab pane 1 end -->

                            <div class="tab-pane animated fadeInLeft" id="tab_b">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/game1.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <a class="post-cat" href="#">بازی ها</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از صنعت چاپ و </a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">24 تیر 1396</span>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                    ستون و سطرآنچنان که لازم</p>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </div><!-- Col end -->

                                    <div class="col-md-6 col-sm-6">
                                        <div class="list-post-block">
                                            <ul class="list-post">
                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/game2.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">25 فروردین 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 1 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/game3.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">18 بهمن 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 2 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/game4.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">30 فروردین 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 3 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/game5.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">27 خرداد 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 4 end -->
                                            </ul><!-- List post end -->
                                        </div><!-- List post block end -->
                                    </div><!-- List post Col end -->
                                </div><!-- Tab pane Row 2 end -->
                            </div><!-- Tab pane 2 end -->

                            <div class="tab-pane animated fadeInLeft" id="tab_c">

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="post-block-style clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/robot1.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <a class="post-cat" href="#">رباتیک</a>
                                            <div class="post-content">
                                                <h2 class="post-title title-medium">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از صنعت چاپ و</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-author"><a href="#">جان اسنو</a></span>
                                                    <span class="post-date">24 تیر 1396</span>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در
                                                    ستون و سطرآنچنان که لازم</p>
                                            </div><!-- Post content end -->
                                        </div><!-- Post Block style end -->
                                    </div><!-- Col end -->

                                    <div class="col-md-6 col-sm-6">
                                        <div class="list-post-block">
                                            <ul class="list-post">
                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/robot2.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">25 فروردین 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 1 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/robot3.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">18 بهمن 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 2 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/robot4.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">30 فروردین 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 3 end -->

                                                <li class="clearfix">
                                                    <div class="post-block-style post-float clearfix">
                                                        <div class="post-thumb">
                                                            <a href="{{ asset('home/single-post1.html') }}">
                                                                <img class="img-responsive"
                                                                     src="{{ asset('home/images/news/tech/robot5.jpg') }}" alt="">
                                                            </a>
                                                        </div><!-- Post thumb end -->

                                                        <div class="post-content">
                                                            <h2 class="post-title title-small">
                                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با
                                                                    تولید سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                            </h2>
                                                            <div class="post-meta">
                                                                <span class="post-date">27 خرداد 1396</span>
                                                            </div>
                                                        </div><!-- Post content end -->
                                                    </div><!-- Post block style end -->
                                                </li><!-- Li 4 end -->
                                            </ul><!-- List post end -->

                                        </div><!-- List post block end -->
                                    </div><!-- List post Col end -->
                                </div><!-- Tab pane Row 3 end -->
                            </div><!-- Tab pane 3 end -->
                        </div><!-- tab content -->
                    </div><!-- Technology Tab end -->

                    <div class="gap-40"></div>

                    <div class="block color-orange">
                        <h3 class="block-title"><span>سبک زندگی</span></h3>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="post-overaly-style clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel1.jpg') }}" alt="">
                                        </a>
                                    </div>

                                    <div class="post-content">
                                        <a class="post-cat" href="#">مسافرت</a>
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-date">3 فروردین 1396</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Overaly Article end -->

                                <div class="list-post-block">
                                    <ul class="list-post">
                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/food1.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">غذا</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از صنعت چاپ و با </a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">15 آذر 1396</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 1 end -->

                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/health1.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">سلامتی</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">18 بهمن 1396</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 2 end -->

                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/travel2.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">مسافرت</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">30 فروردین 1396</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 3 end -->

                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/architecture2.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">معماری</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">لورم ایپسوم متن</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 4 end -->

                                    </ul><!-- List post end -->
                                </div><!-- List post block end -->
                            </div><!-- Col 1 end -->

                            <div class="col-md-6 col-sm-6">
                                <div class="post-overaly-style last clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/architecture3.jpg') }}"
                                                 alt="">
                                        </a>
                                    </div>

                                    <div class="post-content">
                                        <a class="post-cat" href="#">معماری</a>
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-date">2 شهریور 1396</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Overaly Article end -->

                                <div class="list-post-block">
                                    <ul class="list-post">
                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/health2.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">سلامتی</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از صنعت چاپ</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">15 آذر 1396</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 1 end -->

                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/food2.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">غذا</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از صنعت چاپ و با استفاده</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">لورم ایپسوم متن</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 2 end -->

                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/architecture1.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">معماری</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از صنعت</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">لورم ایپسوم متن</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 3 end -->

                                        <li class="clearfix">
                                            <div class="post-block-style post-float clearfix">
                                                <div class="post-thumb">
                                                    <a href="{{ asset('home/single-post1.html') }}">
                                                        <img class="img-responsive"
                                                             src="{{ asset('home/images/news/lifestyle/travel5.jpg') }}" alt="">
                                                    </a>
                                                    <a class="post-cat" href="#">مسافرت</a>
                                                </div><!-- Post thumb end -->

                                                <div class="post-content">
                                                    <h2 class="post-title title-small">
                                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                            سادگی نامفهوم از</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-date">27 خرداد 1396</span>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 4 end -->

                                    </ul><!-- List post end -->
                                </div><!-- List post block end -->
                            </div><!-- Col 2 end -->
                        </div><!-- Row end -->
                    </div><!-- Block Lifestyle end -->


                </div><!-- Content Col end -->

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sidebar sidebar-right">
                        <div class="widget">
                            <h3 class="block-title"><span>ما را دنبال کنید</span></h3>

                            <ul class="social-icon">
                                <li><a href="#" target="_blank"><i class="fa fa-rss"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div><!-- Widget Social end -->

                        <div class="widget color-default">
                            <h3 class="block-title"><span>اخبار پربازدید</span></h3>

                            <div class="post-overaly-style clearfix">
                                <div class="post-thumb">
                                    <a href="{{ asset('home/single-post1.html') }}">
                                        <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health4.jpg') }}" alt="">
                                    </a>
                                </div>

                                <div class="post-content">
                                    <a class="post-cat" href="#">سلامتی</a>
                                    <h2 class="post-title">
                                        <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                            صنعت</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="post-date">2 شهریور 1396</span>
                                    </div>
                                </div><!-- Post content end -->
                            </div><!-- Post Overaly Article end -->


                            <div class="list-post-block">
                                <ul class="list-post">
                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget3.jpg') }}"
                                                         alt="">
                                                </a>
                                                <a class="post-cat" href="#">گجت ها</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از صنعت چاپ و با</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-date">15 آذر 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 1 end -->

                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel5.jpg') }}"
                                                         alt="">
                                                </a>
                                                <a class="post-cat" href="#">مسافرت</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از صنعت</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-date">18 بهمن 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 2 end -->

                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/robot5.jpg') }}"
                                                         alt="">
                                                </a>
                                                <a class="post-cat" href="#">رباتیک</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از صنعت چاپ و با</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-date">30 فروردین 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 3 end -->

                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/food1.jpg') }}"
                                                         alt="">
                                                </a>
                                                <a class="post-cat" href="#">غذا</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم از صنعت چاپ</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-date">27 خرداد 1396</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 4 end -->

                                </ul><!-- List post end -->
                            </div><!-- List post block end -->

                        </div><!-- Popular news widget end -->

                        <div class="widget text-center">
                            <img class="banner img-responsive" src="{{ asset('home/images/banner-ads/ad-sidebar.png') }}" alt="">
                        </div><!-- Sidebar Ad end -->

                        <div class="widget color-default m-bottom-0">
                            <h3 class="block-title"><span>لورم ایپسوم متن</span></h3>

                            <div id="post-slide" class="owl-carousel owl-theme post-slide">
                                <div class="item">
                                    <div class="post-overaly-style text-center clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget1.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <a class="post-cat" href="#">گجت ها</a>
                                            <h2 class="post-title">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">2 شهریور 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post Overaly Article 1 end -->

                                    <div class="post-overaly-style text-center clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/video/video1.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <a class="post-cat" href="#">ویدئو</a>
                                            <h2 class="post-title">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">12 مرداد 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post Overaly Article 2 end -->

                                </div><!-- Item 1 end -->

                                <div class="item">

                                    <div class="post-overaly-style text-center clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health5.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <a class="post-cat" href="#">سلامتی</a>
                                            <h2 class="post-title">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">2 شهریور 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post Overaly Article 3 end -->

                                    <div class="post-overaly-style text-center clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/tech/robot1.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <a class="post-cat" href="#">رباتیک</a>
                                            <h2 class="post-title">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">لورم ایپسوم متن</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post Overaly Article 4 end -->

                                </div><!-- Item 2 end -->

                            </div><!-- Post slide carousel end -->

                        </div><!-- Trending news end -->

                    </div><!-- Sidebar right end -->
                </div><!-- Sidebar Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->

    <section class="ad-content-area text-center no-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <img class="img-responsive" src="{{ asset('home/images/banner-ads/ad-content-one.jpg') }}" alt="">
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Ad content top end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="block color-dark-blue">
                        <h3 class="block-title"><span>مسافرت</span></h3>
                        <div class="post-overaly-style clearfix">
                            <div class="post-thumb">
                                <a href="{{ asset('home/single-post1.html') }}">
                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel1.jpg') }}" alt="">
                                </a>
                            </div>

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                        صنعت</a>
                                </h2>
                                <div class="post-meta">
                                    <span class="post-date">3 فروردین 1396</span>
                                </div>
                            </div><!-- Post content end -->
                        </div><!-- Post Overaly Article end -->

                        <div class="list-post-block">
                            <ul class="list-post">
                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel2.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ و با</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">15 آذر 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 1 end -->

                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel3.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ و با</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">18 بهمن 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 2 end -->

                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel4.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ و با</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">30 فروردین 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 3 end -->
                            </ul><!-- List post end -->
                        </div><!-- List post block end -->
                    </div><!-- Block end -->
                </div><!-- Travel Col end -->

                <div class="col-md-4">
                    <div class="block color-aqua">
                        <h3 class="block-title"><span>گجت ها</span></h3>
                        <div class="post-overaly-style clearfix">
                            <div class="post-thumb">
                                <a href="{{ asset('home/single-post1.html') }}">
                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget1.jpg') }}" alt="">
                                </a>
                            </div>

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                                        چاپ</a>
                                </h2>
                                <div class="post-meta">
                                    <span class="post-date">3 فروردین 1396</span>
                                </div>
                            </div><!-- Post content end -->
                        </div><!-- Post Overaly Article end -->

                        <div class="list-post-block">
                            <ul class="list-post">
                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget2.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ و با</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">13 فروردین 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 1 end -->

                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget3.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ و با</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">11 اسفند 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 2 end -->

                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget4.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ و با</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">30 فروردین 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 3 end -->
                            </ul><!-- List post end -->
                        </div><!-- List post block end -->
                    </div><!-- Block end -->
                </div><!-- Gadget Col end -->

                <div class="col-md-4">
                    <div class="block color-violet">
                        <h3 class="block-title"><span>سلامتی</span></h3>
                        <div class="post-overaly-style clearfix">
                            <div class="post-thumb">
                                <a href="{{ asset('home/single-post1.html') }}">
                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health1.jpg') }}" alt="">
                                </a>
                            </div>

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                                        چاپ و با</a>
                                </h2>
                                <div class="post-meta">
                                    <span class="post-date">3 فروردین 1396</span>
                                </div>
                            </div><!-- Post content end -->
                        </div><!-- Post Overaly Article end -->

                        <div class="list-post-block">
                            <ul class="list-post">
                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health2.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">15 آذر 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 1 end -->

                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health3.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ و با</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">18 بهمن 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 2 end -->

                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ asset('home/single-post1.html') }}">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health4.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                    نامفهوم از صنعت چاپ</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">30 فروردین 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 3 end -->
                            </ul><!-- List post end -->
                        </div><!-- List post block end -->
                    </div><!-- Block end -->
                </div><!-- Health Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- 2nd block end -->

    <section class="block-wrapper video-block">
        <div class="container">
            <div class="row">
                <div class="video-tab clearfix">
                    <h2 class="video-tab-title">تماشا کنید</h2>
                    <div class="col-md-7 pad-r-0">
                        <div class="tab-content">
                            <div class="tab-pane active animated fadeIn" id="video1">
                                <div class="post-overaly-style clearfix">
                                    <div class="post-thumb">
                                        <img class="img-responsive" src="{{ asset('home/images/news/video/video4.jpg') }}" alt="">
                                        <a class="popup"
                                           href="{{ asset('home/https://www.youtube.com/embed/XhveHKJWnOQ?autoplay=1&amp;loop=1') }}">
                                            <div class="video-icon">
                                                <i class="fa fa-play"></i>
                                            </div>
                                        </a>
                                    </div><!-- Post thumb end -->
                                    <div class="post-content">
                                        <a class="post-cat" href="#">ویدئو</a>
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و</a>
                                        </h2>
                                    </div><!-- Post content end -->
                                </div><!-- Post Overaly Article end -->
                            </div><!--Tab pane 1 end-->

                            <div class="tab-pane animated fadeIn" id="video2">
                                <div class="post-overaly-style clearfix">
                                    <div class="post-thumb">
                                        <img class="img-responsive" src="{{ asset('home/images/news/video/video3.jpg') }}" alt="">
                                        <a class="popup"
                                           href="{{ asset('home/https://www.youtube.com/embed/wJF5NXygL4k?autoplay=1&amp;loop=1') }}">
                                            <div class="video-icon">
                                                <i class="fa fa-play"></i>
                                            </div>
                                        </a>
                                    </div><!-- Post thumb end -->
                                    <div class="post-content">
                                        <a class="post-cat" href="#">ویدئو</a>
                                        <h2 class="post-title title-medium">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با استفاده</a>
                                        </h2>
                                    </div><!-- Post content end -->
                                </div><!-- Post Overaly Article 2 end -->
                            </div><!--Tab pane 2 end-->

                            <div class="tab-pane animated fadeIn" id="video3">
                                <div class="post-overaly-style clearfix">
                                    <div class="post-thumb">
                                        <img class="img-responsive" src="{{ asset('home/images/news/video/video2.jpg') }}" alt="">
                                        <a class="popup"
                                           href="{{ asset('home/https://www.youtube.com/embed/DQNDcxRo-2M?autoplay=1&amp;loop=1') }}">
                                            <div class="video-icon">
                                                <i class="fa fa-play"></i>
                                            </div>
                                        </a>
                                    </div><!-- Post thumb end -->
                                    <div class="post-content">
                                        <a class="post-cat" href="#">ویدئو</a>
                                        <h2 class="post-title title-medium">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت</a>
                                        </h2>
                                    </div><!-- Post content end -->
                                </div><!-- Post Overaly Article 2 end -->
                            </div><!--Tab pane 2 end-->


                        </div><!-- Tab content end -->
                    </div><!--Tab col end -->

                    <div class="col-md-5 pad-l-0">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a class="animated fadeIn" href="#video1" data-toggle="tab">
                                    <div class="post-thumb">
                                        <img class="img-responsive" src="{{ asset('home/images/news/video/video4.jpg') }}" alt="">
                                    </div><!-- Post thumb end -->
                                    <h3>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و</h3>
                                </a>
                            </li>
                            <li>
                                <a class="animated fadeIn" href="#video2" data-toggle="tab">
                                    <div class="post-thumb">
                                        <img class="img-responsive" src="{{ asset('home/images/news/video/video3.jpg') }}" alt="">
                                    </div><!-- Post thumb end -->
                                    <h3>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده</h3>
                                </a>
                            </li>
                            <li>
                                <a class="animated fadeIn" href="#video3" data-toggle="tab">
                                    <div class="post-thumb">
                                        <img class="img-responsive" src="{{ asset('home/images/news/video/video2.jpg') }}" alt="">
                                    </div><!-- Post thumb end -->
                                    <h3>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</h3>
                                </a>
                            </li>
                        </ul>
                    </div><!--Tab nav col end -->
                </div><!-- Video tab end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Video block end -->


    <section class="block-wrapper p-bottom-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="more-news block color-default">
                        <h3 class="block-title"><span>خبرهای بیشتر</span></h3>

                        <div id="more-news-slide" class="owl-carousel owl-theme more-news-slide">
                            <div class="item">
                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/video/video1.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">ویدئو</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با استفاده</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">29 خرداد 1396</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 1 end -->

                                <div class="gap-30"></div>

                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/tech/game5.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">بازی ها</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">27 اسفند 1395</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 2 end -->

                                <div class="gap-30"></div>

                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/tech/game4.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">بازی ها</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با استفاده</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">24 تیر 1396</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 3 end -->

                                <div class="gap-30"></div>

                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/tech/robot5.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">رباتیک</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با استفاده</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">24 تیر 1396</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 4 end -->
                            </div><!-- Item 1 end -->

                            <div class="item">
                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/video/video2.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">ویدئو</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">29 خرداد 1396</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 5 end -->

                                <div class="gap-30"></div>

                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/video/video3.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">ویدئو</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ و با</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">31 تیر 1396</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 6 end -->

                                <div class="gap-30"></div>

                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/architecture1.jpg') }}"
                                                 alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">معماری</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">23 مرداد 1396</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 7 end -->

                                <div class="gap-30"></div>

                                <div class="post-block-style post-float-half clearfix">
                                    <div class="post-thumb">
                                        <a href="{{ asset('home/single-post1.html') }}">
                                            <img class="img-responsive" src="{{ asset('home/images/news/tech/game1.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <a class="post-cat" href="#">رباتیک</a>
                                    <div class="post-content">
                                        <h2 class="post-title">
                                            <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                صنعت چاپ</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">24 تیر 1396</span>
                                        </div>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                                            طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                            لازم</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style 8 end -->
                            </div><!-- Item 2 end -->

                        </div><!-- More news carousel end -->
                    </div><!--More news block end -->
                </div><!-- Content Col end -->

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sidebar sidebar-right">

                        <div class="widget color-default">
                            <h3 class="block-title"><span>جدیدترین نقد و بررسی ها</span></h3>
                            <div class="list-post-block">
                                <ul class="list-post review-post-list">
                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/review/review1.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                        سادگی</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <div class="review-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div><!-- Post meta end -->
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 1 end -->

                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/review/review2.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید سادگی
                                                        نامفهوم</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <div class="review-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 2 end -->

                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/review/review3.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                        سادگی</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <div class="review-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 3 end -->

                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ asset('home/single-post1.html') }}">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/review/review4.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ asset('home/single-post1.html') }}">لورم ایپسوم متن ساختگی با تولید
                                                        سادگی</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <div class="review-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 4 end -->

                                </ul><!-- List post end -->
                            </div><!-- List post block end -->
                        </div><!-- Latest Review Widget end -->

                        <div class="widget m-bottom-0">
                            <h3 class="block-title"><span>خبرنامه</span></h3>
                            <div class="ts-newsletter">
                                <div class="newsletter-introtext">
                                    <h4>به روز باشید</h4>
                                    <p>با عضویت در خبرنامه جدیدترین اخبار را در ایمیل خود دریافت کنید!</p>
                                </div>

                                <div class="newsletter-form">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" name="email" id="newsletter-form-email"
                                                   class="form-control form-control-lg" placeholder="ایمیل"
                                                   autocomplete="off">
                                            <button class="btn btn-primary">عضویت</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- Newsletter end -->
                        </div><!-- Newsletter widget end -->
                    </div><!--Sidebar right end -->
                </div><!-- Sidebar col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- 3rd block end -->

    <section class="ad-content-area text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <img class="img-responsive" src="{{ asset('home/images/banner-ads/ad-content-two.png') }}" alt="">
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Ad content two end -->

@endsection
