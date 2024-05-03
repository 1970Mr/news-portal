<footer id="footer" class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-row">
                <div class="footer-widget widget-editor-choices">
                    <h3 class="widget-title">انتخاب سردبیر</h3>
                    <div class="list-post-block">
                        <ul class="list-post">
                            @foreach($footer['editor_choices'] as $editor_choice)
                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="single-post1.html">
                                                <img class="img-responsive" src="{{ asset('storage/' . $editor_choice->image->file_path) }}" alt="{{ $editor_choice->image->alt_text }}">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="single-post1.html">{{ $editor_choice->title }}</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">{{ jalalian()->forge($editor_choice->created_at)->format(config('common.front_date_format')) }}</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 1 end -->
                            @endforeach
                        </ul><!-- List post end -->
                    </div><!-- List post block end -->
                </div><!-- Col end -->

                <div>
                    <div class="footer-widget widget-categories">
                        <h3 class="widget-title">موضوعات داغ</h3>
                        <ul>
                            @foreach($footer['hot_topics'] as $tag)
                                <li>
                                    <a href="#">
                                        <span class="catTitle">{{ $tag->name }}</span>
                                        <span class="catCounter">{{ $tag->articles_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="footer-widget">
                        <h3 class="widget-title">خبرهای پربحث ماه</h3>
                        <div class="list-post-block">
                            <ul class="list-post">
                                <li class="clearfix">
                                    <div class="post-block-style post-float clearfix">
                                        <div class="post-thumb">
                                            <a href="single-post1.html">
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health2.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>
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
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health3.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</a>
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
                                                <img class="img-responsive" src="{{ asset('home/images/news/lifestyle/health4.jpg') }}" alt="">
                                            </a>
                                        </div><!-- Post thumb end -->

                                        <div class="post-content">
                                            <h2 class="post-title title-small">
                                                <a href="single-post1.html">لورم ایپسوم متن ساختگی با تولید سادگی</a>
                                            </h2>
                                            <div class="post-meta">
                                                <span class="post-date">30 فروردین 1396</span>
                                            </div>
                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 3 end -->
                            </ul><!-- List post end -->
                        </div><!-- List post block end -->

                    </div><!-- Col end -->
                </div>
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer main end -->

    <div class="footer-info text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-info-content">
                        <div class="footer-logo">
                            <img class="img-responsive" src="{{ asset('home/images/logos/footer-logo.png') }}" alt="">
                        </div>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی</p>
                        <p class="footer-info-phone"><i class="fa fa-phone"></i> <span class="ltr_text">+(785) 238-4131</span></p>
                        <p class="footer-info-email"><i class="fa fa-envelope-o"></i> <span class="ltr_text">info@example.com</span></p>
                        <ul class="unstyled footer-social">
                            <li>
                                <a title="Rss" href="#">
                                    <span class="social-icon"><i class="fa fa-rss"></i></span>
                                </a>
                                <a title="Facebook" href="#">
                                    <span class="social-icon"><i class="fa fa-facebook"></i></span>
                                </a>
                                <a title="Twitter" href="#">
                                    <span class="social-icon"><i class="fa fa-twitter"></i></span>
                                </a>
                                <a title="Google+" href="#">
                                    <span class="social-icon"><i class="fa fa-google-plus"></i></span>
                                </a>
                                <a title="Linkdin" href="#">
                                    <span class="social-icon"><i class="fa fa-linkedin"></i></span>
                                </a>
                                <a title="Skype" href="#">
                                    <span class="social-icon"><i class="fa fa-skype"></i></span>
                                </a>
                                <a title="Skype" href="#">
                                    <span class="social-icon"><i class="fa fa-dribbble"></i></span>
                                </a>
                                <a title="Skype" href="#">
                                    <span class="social-icon"><i class="fa fa-pinterest"></i></span>
                                </a>
                                <a title="Skype" href="#">
                                    <span class="social-icon"><i class="fa fa-instagram"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div><!-- Footer info content end -->
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer info end -->

</footer><!-- Footer end -->
