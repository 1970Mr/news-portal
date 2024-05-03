@extends('front::layouts.master', ['title' => "{$article->category->name}: {$article->title}"])

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li><a href="#">خانه</a></li>
                        <li>سبک زندگی</li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="single-post">

                        <div class="post-title-area">
                            <a class="post-cat" href="#">سلامتی</a>
                            <h2 class="post-title">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                            </h2>
                            <div class="post-meta">
									<span class="post-author">
										لورم <a href="#">جان اسنو</a>
									</span>
                                <span class="post-date"><i class="fa fa-clock-o"></i> لورم ایپسوم متن</span>
                                <span class="post-hits"><i class="fa fa-eye"></i> 21</span>
                                <span class="post-comment"><i class="fa fa-comments-o"></i>
										<a href="#" class="comments-link"><span>01</span></a></span>
                            </div>
                        </div><!-- Post title end -->

                        <div class="post-content-area">
                            <div class="post-media post-featured-image">
                                <a href="images/news/lifestyle/health5.jpg" class="gallery-popup"><img src="{{ asset('home/images/news/lifestyle/health5.jpg') }}" class="img-responsive" alt=""></a>
                            </div>
                            <div class="entry-content">
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای</p>

                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها</p>

                                <blockquote>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی</blockquote>

                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با</p>

                                <p><img src="{{ asset('home/images/news/news-details/news-details1.jpg') }}" class="img-responsive" alt=""></p>

                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت</p>
                                <h3>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</h3>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود</p>
                                <h3>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</h3>
                                <ul>
                                    <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                                    <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</li>
                                    <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                                    <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>
                                </ul>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان</p>

                            </div><!-- Entery content end -->

                            <div class="tags-area clearfix">
                                <div class="post-tags">
                                    <span>برچسب ها:</span>
                                    <a href="#"># غذا</a>
                                    <a href="#"># سبک زندگی</a>
                                    <a href="#"># مسافرت</a>
                                </div>
                            </div><!-- Tags end -->

                            <div class="share-items clearfix">
                                <ul class="post-social-icons unstyled">
                                    <li class="facebook">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i> <span class="ts-social-title">فیسبوک</span></a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <i class="fa fa-twitter"></i> <span class="ts-social-title">توییتر</span></a>
                                    </li>
                                    <li class="gplus">
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i> <span class="ts-social-title">گوگل پلاس</span></a>
                                    </li>
                                    <li class="pinterest">
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i> <span class="ts-social-title">Pinterest</span></a>
                                    </li>
                                </ul>
                            </div><!-- Share items end -->

                        </div><!-- post-content end -->
                    </div><!-- Single post end -->

                    <nav class="post-navigation clearfix">
                        <div class="post-previous">
                            <a href="#">
                                <span><i class="fa fa-angle-right"></i>مطلب قبلی</span>
                                <h3>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                </h3>
                            </a>
                        </div>
                        <div class="post-next">
                            <a href="#">
                                <span>مطلب بعدی <i class="fa fa-angle-left"></i></span>
                                <h3>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                                </h3>
                            </a>
                        </div>
                    </nav><!-- Post navigation end -->

                    <div class="author-box">
                        <div class="author-img pull-left">
                            <img src="{{ asset('home/images/news/author.png') }}" alt="">
                        </div>
                        <div class="author-info">
                            <h3>الهام طهماسبی</h3>
                            <p class="author-url"><a href="#">لورم ایپسوم متن ساختگی با تولید</a></p>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط</p>
                            <div class="authors-social">
                                <span>مرا دنبال کنید: </span>
                                <a href="#"><i class="fa fa-behance"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div> <!-- Author box end -->

                    <div class="related-posts block">
                        <h3 class="block-title"><span>مطالب مرتبط</span></h3>

                        <div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
                            <div class="item">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel5.jpg') }}" alt=""></a>
                                    </div>
                                    <a class="post-cat" href="#">سلامتی</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">30 فروردین 1396</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </div><!-- Item 1 end -->

                            <div class="item">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health5.jpg') }}" alt=""></a>
                                    </div>
                                    <a class="post-cat" href="#">سلامتی</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">30 فروردین 1396</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </div><!-- Item 2 end -->

                            <div class="item">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel3.jpg') }}" alt=""></a>
                                    </div>
                                    <a class="post-cat" href="#">مسافرت</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">30 فروردین 1396</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </div><!-- Item 3 end -->

                            <div class="item">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="single-post1.html"><img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel4.jpg') }}" alt=""></a>
                                    </div>
                                    <a class="post-cat" href="#">مسافرت</a>
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">جان اسنو</a></span>
                                            <span class="post-date">30 فروردین 1396</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </div><!-- Item 4 end -->
                        </div><!-- Carousel end -->

                    </div><!-- Related posts end -->

                    <!-- Post comment start -->
                    <div id="comments" class="comments-area block">
                        <h3 class="block-title"><span>3 دیدگاه</span></h3>

                        <ul class="comments-list">
                            <li>
                                <div class="comment">
                                    <img class="comment-avatar pull-left" alt="" src="{{ asset('home/images/news/user1.png') }}">
                                    <div class="comment-body">
                                        <div class="meta-data">
                                            <span class="comment-author">میلاد آقایی</span>
                                            <span class="comment-date pull-right">26 دی 1396 - 15:36</span>
                                        </div>
                                        <div class="comment-content">
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی</p></div>
                                        <div class="text-left">
                                            <a class="comment-reply" href="#">پاسخ</a>
                                        </div>
                                    </div>
                                </div><!-- Comments end -->

                                <ul class="comments-reply">
                                    <li>
                                        <div class="comment">
                                            <img class="comment-avatar pull-left" alt="" src="{{ asset('home/images/news/user2.png') }}">
                                            <div class="comment-body">
                                                <div class="meta-data">
                                                    <span class="comment-author">فرهاد عظیم پور</span>
                                                    <span class="comment-date pull-right">26 دی 1396 - 15:36</span>
                                                </div>
                                                <div class="comment-content">
                                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون</p></div>
                                                <div class="text-left">
                                                    <a class="comment-reply" href="#">پاسخ</a>
                                                </div>
                                            </div>
                                        </div><!-- Comments end -->
                                    </li>
                                </ul><!-- comments-reply end -->
                                <div class="comment last">
                                    <img class="comment-avatar pull-left" alt="" src="{{ asset('home/images/news/user1.png') }}">
                                    <div class="comment-body">
                                        <div class="meta-data">
                                            <span class="comment-author">میلاد آقایی</span>
                                            <span class="comment-date pull-right">26 دی 1396 - 15:36</span>
                                        </div>
                                        <div class="comment-content">
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی</p></div>
                                        <div class="text-left">
                                            <a class="comment-reply" href="#">پاسخ</a>
                                        </div>
                                    </div>
                                </div><!-- Comments end -->
                            </li><!-- Comments-list li end -->
                        </ul><!-- Comments-list ul end -->
                    </div><!-- Post comment end -->

                    <div class="comments-form">
                        <h3 class="title-normal">دیدگاه خود را بیان کنید</h3>

                        <form role="form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control required-field" id="message" placeholder="دیدگاه شما" required></textarea>
                                    </div>
                                </div><!-- Col end -->

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" placeholder="نام" type="text" required>
                                    </div>
                                </div><!-- Col end -->

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" placeholder="ایمیل" type="email" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="وب‌سایت" type="text" required>
                                    </div>
                                </div>
                            </div><!-- Form row end -->
                            <div class="clearfix">
                                <button class="comments-btn btn btn-primary" type="submit">ارسال دیدگاه</button>
                            </div>
                        </form><!-- Form end -->
                    </div><!-- Comments form end -->

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
                                    <a href="single-post1.html">
                                        <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health4.jpg') }}" alt="">
                                    </a>
                                </div>

                                <div class="post-content">
                                    <a class="post-cat" href="#">سلامتی</a>
                                    <h2 class="post-title title-small">
                                        <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a>
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
                                                <a href="single-post1.html">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/gadget3.jpg') }}" alt="">
                                                </a>
                                                <a class="post-cat" href="#">گجت ها</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a>
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
                                                <a href="single-post1.html">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/travel5.jpg') }}" alt="">
                                                </a>
                                                <a class="post-cat" href="#">مسافرت</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</a>
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
                                                <a href="single-post1.html">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/tech/robot5.jpg') }}" alt="">
                                                </a>
                                                <a class="post-cat" href="#">رباتیک</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با</a>
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
                                                <a href="single-post1.html">
                                                    <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/food1.jpg') }}" alt="">
                                                </a>
                                                <a class="post-cat" href="#">غذا</a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</a>
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

                        <div class="widget widget-tags">
                            <h3 class="block-title"><span>برچسب ها</span></h3>
                            <ul class="unstyled clearfix">
                                <li><a href="#">لورم</a></li>
                                <li><a href="#">لورم ایپسوم متن</a></li>
                                <li><a href="#">غذا</a></li>
                                <li><a href="#">گجت ها</a></li>
                                <li><a href="#">بازی ها</a></li>
                                <li><a href="#">سلامتی</a></li>
                                <li><a href="#">لورم ایپسوم</a></li>
                                <li><a href="#">رباتیک</a></li>
                                <li><a href="#">لورم ایپسوم</a></li>
                                <li><a href="#">لورم</a></li>
                                <li><a href="#">مسافرت</a></li>
                                <li><a href="#">ویدئو</a></li>
                            </ul>
                        </div><!-- Tags end -->

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
                                            <input type="email" name="email" id="newsletter-form-email" class="form-control form-control-lg" placeholder="ایمیل" autocomplete="off">
                                            <button class="btn btn-primary">عضویت</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- Newsletter end -->
                        </div><!-- Newsletter widget end -->

                    </div><!-- Sidebar right end -->
                </div><!-- Sidebar Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
