<!DOCTYPE html>
<html lang="fa">

<head>

    <!-- Basic Page Needs
================================================== -->
    <meta charset="utf-8">
    <title>{{ !empty($title) ? $title : config('app.name') }}</title>

    <!-- Mobile Specific Metas
================================================== -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('home/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('home/images/favicon.ico') }}" type="image/x-icon">

    @include('home::partials.styles')

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="{{ asset('home/js/html5shiv.js') }}"></script>
    <script src="{{ asset('home/js/respond.min.js') }}"></script>
    <![endif]-->

</head>

<body>

<div class="body-inner">

    @include('home::partials.trending-bar')

    @include('home::partials.top-bar')

    @include('home::partials.header')

    @include('home::partials.main-nav')

    <div class="gap-40"></div>

    @yield('content')

    @include('home::partials.footer')

    @include('home::partials.copyright')

    @include('home::partials.scripts')

    @stack('scripts')

    @include('sweetalert::alert')
</div><!-- Body inner end -->
</body>

</html>
