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

                                @foreach($footer['articles_with_most_comments'] as $article)
                                    <li class="clearfix">
                                        <div class="post-block-style post-float clearfix">
                                            <div class="post-thumb">
                                                <a href="{{ route('news.show', [$article->category->slug, $article->slug]) }}">
                                                    <img class="img-responsive" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}">
                                                </a>
                                            </div><!-- Post thumb end -->

                                            <div class="post-content">
                                                <h2 class="post-title title-small">
                                                    <a href="{{ route('news.show', [$article->category->slug, $article->slug]) }}">{{ $article->title }}</a>
                                                </h2>
                                                <div class="post-meta">
                                                    <span class="post-date">{{ front_date_format($article->created_at) }}</span>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li>
                                @endforeach
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
                                @foreach($social_networks as $name => $url)
                                    <a title="{{ ucfirst($name) }}" href="{{ $url }}" target="_blank">
                                        <span class="social-icon"><i class="fa fa-{{ $name }}"></i></span>
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    </div><!-- Footer info content end -->
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer info end -->

</footer><!-- Footer end -->
