@extends('auth::layouts.master', ['title' => 'فراموشی رمزعبور'])

@section('content')
    <p class="text-center m-t-30 m-b-40">
        <i class="icon-lock-open border img-circle font-xxxlg p-20"></i>
    </p>
    <h2 class="text-center">بازیابی رمز عبور</h2>

    @if(session()->has('success'))
        <div class="alert alert-success m-t-10 m-b-20">
            <i class="icon-check"></i>
            {{ session()->get('success') }}
        </div>
    @else
        <div class="alert alert-info text-center m-t-10 m-b-20">
            <i class="icon-comments"></i>
            ایمیل خود را برای بازیابی رمز عبور وارد نمایید.
        </div>
    @endif

    <x-auth-error-messages />

    <hr>

    <form id="form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label class="sr-only control-label" for="email">ایمیل</label>
            <div class="input-group round">
                                    <span class="input-group-addon">
                                        <i class="icon-envelope"></i>
                                    </span>
                <input type="email" class="form-control round ltr text-left" id="email" name="email" placeholder="info@site.com" required>
            </div><!-- /.input-group-->
        </div><!-- /.form-group -->
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block m-t-20">
                <i class="icon-envelope-letter"></i>
                ارسال ایمیل بازیابی
            </button>
        </div><!-- /.form-group -->
    </form>

    <hr class="m-b-30">
    <a href="{{ route('login') }}" class="btn btn-default btn-block m-b-10">
        <i class="icon-user-following font-lg"></i>
        صفحه ورود
    </a>
@endsection

@push('scripts')
    <script>
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error').removeClass("has-success");
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass("has-success");
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $("#form").validate();
    </script>
@endpush
