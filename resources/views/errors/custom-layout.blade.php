<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ $siteDetails->faviconLink() }}">

    <title>@yield('title')</title>

    @include('partials.errors.styles')

    @stack('styles')
</head>
<body class="active-ripple theme-darkpurple">
<!-- BEGIN LOEADING -->
<div id="loader">
    <div class="spinner"></div>
</div><!-- /loader -->
<!-- END LOEADING -->

<!-- BEGIN WRAPPER -->
<div class="fixed-modal-bg"></div>
<a href="#" class="btn btn-primary btn-icon btn-round btn-lg" id="toggle-dark-mode">
    <i class="icon-bulb"></i>
</a>
<div class="modal-page shadow">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="logo-con m-t-10 m-b-10">
                    <img src="{{ $siteDetails->mainLogoLink() }}" alt="{{ config('app.name') }}" class="dark-logo center-block img-responsive"
                         width="256px">
                    <img src="{{ $siteDetails->secondLogoLink() }}" alt="{{ config('app.name') }}" class="light-logo center-block img-responsive"
                         width="256px">
                </div><!-- /.logo-con -->

                <hr>

                <p class="text-center m-t-40">
                    <i class="@yield('pageIcon') border img-circle font-xxxlg p-20"></i>
                </p>
                <h1 class="page-error m-t-30">
                    <sup>خطای</sup>
                    @yield('code')
                </h1>
                <p class="text-center font-lg m-b-20">@yield('message')</p>

                <form role="form" class="m-t-30 m-b-30" action="{{ route('search.index') }}">
                    <div class="form-body">
                        <div class="input-group round">
                            <input name="text" type="text" class="form-control" placeholder="جستجو به شما کمک می کند...">
                            <span class="input-group-btn">
                                <button class="btn btn-success m-0" type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                            </span>
                        </div><!-- ./input-group -->
                    </div><!-- /.form-body -->
                </form>

                <hr class="m-b-30 m-t-30">
                <a href="{{ route('home.index') }}" class="btn btn-default btn-block">
                    بازگشت
                    <i class="icon-arrow-left font-lg"></i>
                </a>

            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.modal-page -->
<!-- END WRAPPER -->

@include('partials.errors.scripts')

@stack('scripts')

</body>

</html>
