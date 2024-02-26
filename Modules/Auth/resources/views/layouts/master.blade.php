<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>{{ !empty($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}">

    @include('auth::partials.styles')
    @stack('styles')

</head>
<body class="fix-header active-ripple theme-darkpurple">
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

                @yield('content')

            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.modal-page -->
<!-- END WRAPPER -->

@include('auth::partials.scripts')
@stack('scripts')

<x-sweetalert />

</body>

</html>
