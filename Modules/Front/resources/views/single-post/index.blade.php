@extends('front::layouts.master', ['title' => "{$article->category->name}: {$article->title}"])

@section('content')
    @include('front::single-post.partials.breadcrumb')

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="single-post">
                        @include('front::single-post.partials.page-title-area')

                        @include('front::single-post.partials.post-content-area')
                    </div><!-- Single post end -->

                    @include('front::single-post.partials.post-navigation')

                    @include('front::single-post.partials.author-box')

                    @include('front::single-post.partials.related-posts')

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

                @include('front::partials.sidebar1')

                @include('front::partials.sidebar2')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection

@push('styles')
    <style>
        .breadcrumb > li {
            display: inline-flex;
        }

        .second-sidebar {
            margin: 5.5rem 0 0;
        }

        li.linkedin {
            background: #0077B5;
        }

        li.telegram {
            background: #0088cc;
        }

        li.whatsapp {
            background: #25D366;
        }

        .post-navigation {
            width: 100%;
        }

        .related-posts img {
            height: 16rem;
        }
    </style>
@endpush
