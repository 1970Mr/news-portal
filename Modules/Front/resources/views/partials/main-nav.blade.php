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
                            {{-- All categories --}}
                            @if($main_nav['categories']->count() >= 1)
                                <li class="dropdown mega-dropdown {{ front_active_menu(route('categories.index')) }} hidden-xs hidden-sm">
                                    <a href="{{ route('categories.index') }}" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list"></i>
                                        دسته‌بندی‌ها
                                        <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu mega-menu-content hidden-xs hidden-sm clearfix">
                                        <div class="mega-menu-content-inner">
                                            <div class="row">
                                                @foreach($main_nav['categories']->chunk(4) as $categoryChunk)
                                                    <div class="col-md-3">
                                                        <ul class="mega-menu-category-list">
                                                            @foreach($categoryChunk as $category)
                                                                @if($category->categories()->active()->count() >= 1)
                                                                    <li class="dropdown-submenu">
                                                                        <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                                                                        <ul class="dropdown-menu">
                                                                            @foreach($category->categories()->active()->get() as $childCategory)
                                                                                <li><a href="{{ route('categories.show', $childCategory->slug) }}">{{ $childCategory->name }}</a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div><!-- Col end -->
                                                @endforeach
                                            </div><!-- Row end -->
                                        </div><!-- Mega menu content inner end -->
                                    </div><!-- Mega menu content end -->
                                </li><!-- Mega menu end -->
                            @endif

                            <li class="{{ front_active_menu(route('home.index')) }}">
                                <a href="{{ route('home.index') }}">خانه</a>
                            </li>

                            @foreach($main_nav['menus'] as $menu)
                                {{-- Main menus --}}
                                @if($menu->isMainMenu())
                                    <li class="{{ front_active_menu($menu->getUrl()) }}">
                                        <a href="{{ $menu->getUrl() }}">{{ $menu->getName() }}</a>
                                    </li>

                                    {{-- Main menus with chidlren --}}
                                @elseif($menu->isMainMenuWithChildren())
                                    <li class="dropdown {{ front_active_menu($menu->getUrl()) }}">
                                        <a href="{{ $menu->getUrl() }}" class="dropdown-toggle" data-toggle="dropdown">
                                            {{ $menu->getName() }}
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach($menu->children as $childMenu)
                                                <li>
                                                    <a href="{{ $childMenu->getUrl() }}">{{ $childMenu->getName() }}</a>
                                                </li>
                                            @endforeach
                                        </ul><!-- End dropdown -->
                                    </li><!-- Features menu end -->

                                    {{-- Category menus --}}
                                @elseif($menu->isCategoryMenu())
                                    <li class="dropdown mega-dropdown {{ front_active_menu($menu->getUrl()) }}">
                                        <a href="{{ $menu->getUrl() }}" class="dropdown-toggle" data-toggle="dropdown">
                                            {{ $menu->getName() }}
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu mega-menu-content hidden-xs hidden-sm clearfix">
                                            <div class="mega-menu-content-inner">
                                                <div class="row">
                                                    {{-- Note: the right value is set on the backend, but we will enter it here for a more accurate understanding --}}
                                                    @foreach($menu->category->articles->take(4) as $article)
                                                        <div class="col-md-3">
                                                            <div class="post-block-style clearfix">
                                                                <div class="post-thumb">
                                                                    <img class="img-responsive nav-cat-post-img" src="{{ asset('storage/' . $article->image->file_path) }}"
                                                                         alt="{{ $article->image->alt_text }}">
                                                                </div><!-- Post thumb end -->
                                                                <div class="post-content">
                                                                    <h2 class="post-title title-small">
                                                                        <a href="{{ $article->getUrl() }}">{{ $article->title }}</a>
                                                                    </h2>
                                                                </div><!-- Post content end -->
                                                            </div><!-- Post Block style end -->
                                                        </div><!-- Col 1 end -->
                                                    @endforeach
                                                </div><!-- Post block row end -->
                                            </div>
                                        </div><!-- Mega menu content end -->
                                    </li>

                                    {{-- Parent category menus --}}
                                @elseif($menu->isParentCategoryMenu())
                                    <li class="dropdown mega-dropdown">
                                        <a href="{{ $menu->getUrl() }}" class="dropdown-toggle">
                                            {{ $menu->getName() }}
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu mega-menu-content hidden-xs hidden-sm clearfix">
                                            <div class="menu-tab">
                                                <ul class="nav nav-tabs nav-stacked col-md-2" data-toggle="tab-hover">
                                                    @foreach($menu->category->categories->take(5) as $category)
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
                                                    @foreach($menu->category->categories->take(5) as $category)
                                                        <div class="tab-pane @if($loop->first) active @endif animated fadeIn" id="tab-{{ $category->id }}">
                                                            <div class="row">
                                                                @foreach($category->articles->take(4) as $article)
                                                                    <div class="col-md-3">
                                                                        <div class="post-block-style clearfix">
                                                                            <div class="post-thumb">
                                                                                <a href="{{ $article->getUrl() }}l">
                                                                                    <img class="img-responsive nav-parent-cat-post-img"
                                                                                         src="{{ asset('storage/' . $article->image->file_path) }}"
                                                                                         alt="{{ $article->image->alt_text }}">
                                                                                </a>
                                                                            </div>
                                                                            <a class="post-cat" href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                                                                            <div class="post-content">
                                                                                <h2 class="post-title title-small">
                                                                                    <a href="{{ $article->getUrl() }}">{{ $article->title }}</a>
                                                                                </h2>
                                                                            </div><!-- Post content end -->
                                                                        </div><!-- Post Block style end -->
                                                                    </div><!-- Col 1 end -->
                                                                @endforeach
                                                            </div><!-- Post block row end -->
                                                        </div><!-- Tab pane 1 end -->
                                                    @endforeach
                                                </div><!-- tab content -->
                                            </div><!-- MenuBuilder tab end -->
                                        </div><!-- Mega menu end -->
                                    </li><!-- Tab menu end -->
                                @endif
                            @endforeach

                            {{-- Link to categories for mobile view --}}
                            <li class="visible-xs visible-sm {{ front_active_menu(route('categories.index')) }}">
                                <a href="{{ route('categories.index') }}">دسته‌بندی‌ها</a>
                            </li>
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
                    <a href="{{ route(config('app.panel_prefix', 'panel') . '.index') }}"><i class="fa fa-user" title="پنل کاربری"></i></a>
                </div>
            @endauth

            <div class="nav-search">
                <span id="search"><i class="fa fa-search" title="جستجو"></i></span>
            </div><!-- Search end -->

            <form class="search-block" style="display: none;" action="{{ route('search.index') }}">
                <input name="text" type="text" class="form-control" placeholder="عبارتی را وارد نموده و اینتر بزنید">
                <span class="search-close">×</span>
            </form><!-- Site search end -->

        </div><!--/ Row end -->
    </div><!--/ Container end -->

</div><!-- MenuBuilder wrapper end -->
