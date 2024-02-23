@extends('auth::layouts.master', ['title' => 'صفحه ورود'])

@section('content')
    <div class="logo-con m-t-10 m-b-10">
        <img src="{{ asset('home/images/logos/logo.png') }}" class="dark-logo center-block img-responsive"
             alt="logo" width="256px">
        <img src="{{ asset('home/images/logos/logo_dark.png') }}" class="light-logo center-block img-responsive"
             alt="logo" width="256px">
    </div><!-- /.logo-con -->
    <h2 class="text-center m-b-20">وارد شوید</h2>

    @if(session()->has('status') && session()->get('status') === 'success')
        <div class="alert alert-success m-t-10 m-b-20">
            <i class="icon-check"></i>
            {{ session()->get('message') }}
        </div>
    @endif

    <x-auth-error-messages />
    <hr>

    <form id="form" class="m-t-30 m-b-30" action="{{ route('login') }}" method="POST" role="form">
        @csrf

        <div class="form-group">
            <label for="email" class="sr-only">ایمیل</label>
            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon-envelope"></i>
                                    </span>
                <input id="email" class="form-control ltr text-left" type="email" name="email"
                       placeholder="مثال:info@site.com" required value="{{ old('email') }}">
            </div><!-- /.input-group -->
        </div><!-- /.form-group -->
        <div class="form-group">
            <label for="password" class="sr-only">رمز عبور</label>
            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon-key"></i>
                                    </span>
                <input id="password" class="form-control ltr text-left" type="password" name="password" minlength="8"
                       required>
            </div><!-- /.input-group -->
        </div><!-- /.form-group -->
        <div class="form-group mt-2">
            <div class="input-group round">
                <div class="checkbox">
                    <label class="cursor-pointer" id="remember-me-label">
                        <input type="checkbox" id="remember-me" name="remember-me" @if(old('remember-me')) checked @endif>
                        مرا به خاطر بسپار
                    </label>
                </div><!-- /.checkbox -->
            </div><!-- /.input-group-->
        </div><!-- /.form-group -->

        <p>
            <button class="btn btn-success btn-block" type="submit">
                <i class="icon-login font-lg"></i>
                ورود
            </button>
        </p>
    </form>
    <hr class="m-b-30">
    <a href="{{ route('password.request') }}" class="btn btn-default btn-block m-b-10">
        <i class="icon-refresh font-lg"></i>
        بازیابی رمز  عبور
    </a>
    <a href="{{ route('register') }}" class="btn btn-default btn-block">
        <i class="icon-user-follow font-lg"></i>
        حساب ندارید؟ ثبت نام کنید!
    </a>
@endsection

@push('scripts')
    <!-- PAGE JAVASCRIPT -->
    <script src="{{ asset('admin/assets/js/pages/login.js') }}"></script>
    <!-- END PAGE JAVASCRIPT -->
@endpush
