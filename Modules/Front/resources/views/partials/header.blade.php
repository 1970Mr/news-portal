<!-- SiteDetail start -->
<header id="header" class="header text-center">
    <div class="container">
        <div class="row">
            @if(!$ads['header'])
                <div class="col-12">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ $site_details->mainLogoLink() }}" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                </div><!-- logo col end -->

            @else
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ $site_details->mainLogoLink() }}" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                </div><!-- logo col end -->

                <div class="col-xs-12 col-sm-9 col-md-9 header-right">
                    <div class="ad-banner pull-right">
                        <a href="{{ $ads['header']->link }}"><img src="{{ asset('storage/' . $ads['header']->image->file_path) }}" class="img-responsive"
                                                                  alt="{{ $ads['header']->image->alt_text }}"></a>
                    </div>
                </div><!-- header right end -->
            @endif
        </div><!-- Row end -->
    </div><!-- Logo and banner area end -->
</header><!--/ SiteDetail end -->
