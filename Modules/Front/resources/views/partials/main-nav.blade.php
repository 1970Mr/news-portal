<div class="main-nav clearfix">
    <div class="container">
        <div class="row">
            <nav class="site-navigation navigation">
                <div class="site-nav-inner pull-left">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">تغییر وضعیت ناوبری</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse navbar-responsive-collapse">
                        <ul class="nav navbar-nav">
                            <li class="{{ request()->url() === route('home.index') ? 'active' : '' }}">
                                <a href="{{ route('home.index') }}">خانه</a>
                            </li>

                            <!-- All Parent Categories -->
                            @foreach($main_nav['parent_categories'] as $parent_category)
                                <li class="dropdown mega-dropdown">
                                    <a href="category-style1.html" class="dropdown-toggle">{{ $parent_category->name }} <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu mega-menu-content hidden-xs hidden-sm clearfix">
                                        <div class="menu-tab">
                                            <ul class="nav nav-tabs nav-stacked col-md-2" data-toggle="tab-hover">
                                                @foreach($parent_category->categories as $category)
                                                    <li class="@if($loop->first) active @endif">
                                                        <a class="animated fadeIn" href="#tab-{{ $category->id }}" data-toggle="tab">
															<span class="tab-head">
																<span class="tab-text-title">{{ $category->name }}</span>
															</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <div class="tab-content col-md-10">
                                                @foreach($parent_category->categories as $category)
                                                    <div class="tab-pane @if($loop->first) active @endif animated fadeIn" id="tab-{{ $category->id }}">
                                                        <div class="row">
                                                            @foreach($category->articles as $article)
                                                                <div class="col-md-3">
                                                                    <div class="post-block-style clearfix">
                                                                        <div class="post-thumb">
                                                                            <a href="single-post1.html">
                                                                                <img class="img-responsive nav-parent-cat-post-img" src="{{ asset('storage/' . $article->image->file_path) }}"
                                                                                     alt="{{ $article->image->alt_text }}">
                                                                            </a>
                                                                        </div>
                                                                        <a class="post-cat" href="#">{{ $category->name }}</a>
                                                                        <div class="post-content">
                                                                            <h2 class="post-title title-small">
                                                                                <a href="single-post1.html">{{ $article->title }}</a>
                                                                            </h2>
                                                                        </div><!-- Post content end -->
                                                                    </div><!-- Post Block style end -->
                                                                </div><!-- Col 1 end -->
                                                            @endforeach
                                                        </div><!-- Post block row end -->
                                                    </div><!-- Tab pane 1 end -->
                                                @endforeach
                                            </div><!-- tab content -->
                                        </div><!-- Menu tab end -->
                                    </div><!-- Mega menu end -->
                                </li><!-- Tab menu end -->
                            @endforeach

                            <!-- All Categories Without Parent -->
                            @foreach($main_nav['categories_without_parent'] as $category)
                                <li class="dropdown mega-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $category->name }} <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu mega-menu-content hidden-xs hidden-sm clearfix">
                                        <div class="mega-menu-content-inner">
                                            <div class="row">
                                                @foreach($category->articles as $article)
                                                    <div class="col-md-3">
                                                        <div class="post-block-style clearfix">
                                                            <div class="post-thumb">
                                                                <img class="img-responsive nav-cat-post-img" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}">
                                                            </div><!-- Post thumb end -->
                                                            <div class="post-content">
                                                                <h2 class="post-title title-small">
                                                                    <a href="single-post1.html">{{ $article->title }}</a>
                                                                </h2>
                                                            </div><!-- Post content end -->
                                                        </div><!-- Post Block style end -->
                                                    </div><!-- Col 1 end -->
                                                @endforeach
                                            </div><!-- Post block row end -->
                                        </div>

                                    </div><!-- Mega menu content end -->
                                </li>
                            @endforeach

                            @if($main_nav['other_categories']['categories_without_parent']->count() >= 1 || $main_nav['other_categories']['parent_categories']->count() >= 1)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">سایر دسته‌بندی‌ها <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <!-- All Categories Without Parent -->
                                        @foreach($main_nav['other_categories']['parent_categories'] as $parent_category)
                                            <li class="dropdown-submenu">
                                                <a href="#.">{{ $parent_category->name }}</a>
                                                <ul class="dropdown-menu">
                                                    @foreach($parent_category->categories as $category)
                                                        <li><a href="category-style1.html">{{ $category->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach

                                        <!-- All Categories Without Parent -->
                                        @foreach($main_nav['other_categories']['categories_without_parent'] as $category)
                                            <li>
                                                <a href="#">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul><!-- End dropdown -->

                                </li><!-- Features menu end -->
                            @endif


                        </ul><!--/ Nav ul end -->
                    </div><!--/ Collapse end -->

                </div><!-- Site Navbar inner end -->
            </nav><!--/ Navigation end -->

            @guest
                <div class="nav-login">
                    <a href="{{ route('login') }}" id="login"><i class="fa fa-sign-in" title="ورود به حساب کاربری"></i></a>
                </div>
                <div class="nav-register">
                    <a href="{{ route('register') }}" id="register"><i class="fa fa-user-plus" title="ثبت نام"></i></a>
                </div>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="post" id="logout-form">@csrf</form>
                <div class="nav-logout">
                    <a onclick="document.getElementById('logout-form').submit()" title="خروج از حساب کاربری"><i
                            class="fa
                    fa-sign-out"></i></a>
                </div>
                <div class="nav-user-panel">
                    <a href="{{ route('panel.index') }}"><i class="fa fa-user" title="پنل کاربری"></i></a>
                </div>
            @endauth

            <div class="nav-search">
                <span id="search"><i class="fa fa-search" title="جستجو"></i></span>
            </div><!-- Search end -->

            <div class="search-block" style="display: none;">
                <input type="text" class="form-control" placeholder="عبارتی را وارد نموده و اینتر بزنید">
                <span class="search-close">×</span>
            </div><!-- Site search end -->

        </div><!--/ Row end -->
    </div><!--/ Container end -->

</div><!-- Menu wrapper end -->
