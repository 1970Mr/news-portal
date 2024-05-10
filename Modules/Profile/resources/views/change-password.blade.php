@extends('panel::layouts.master', ['title' => 'تغییر رمز عبور'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>تغییر رمز عبور</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="far fa-pen-to-square"></i>
                            تغییر رمز عبور
                        </h3>
                    </div><!-- /.portlet-title -->
                    <div class="buttons-box">
                        <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                           aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                            <i class="icon-size-fullscreen d-flex justify-content-center align-items-center"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success m-t-10 m-b-20">
                            <i class="icon-check"></i>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.profile.password.change') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="form-group col-lg-6">
                                    <label for="password">رمز عبور <small>(ضروری، حداقل 8 کاراکتر)</small></label>
                                    <input id="password" class="form-control" name="password" type="password" required minlength="8" value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="new_password">رمز عبور جدید <small>(ضروری، حداقل 8 کاراکتر)</small></label>
                                <input id="new_password" class="form-control" name="new_password" type="password" required minlength="8" value="{{ old('new_password') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="new_password_confirmation">تکرار رمز عبور جدید <small>(ضروری، حداقل 8 کاراکتر)</small></label>
                                <input id="new_password_confirmation" class="form-control" name="new_password_confirmation" type="password" required minlength="8" value="{{ old
                                ('new_password_confirmation') }}">
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        تغییر رمز عبور
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>
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
        $("#main-form").validate({
            rules: {
                new_password_confirmation: {
                    equalTo: "#new_password"
                }
            },
            messages: {
                new_password_confirmation: {
                    equalTo: "رمزهای عبور یکسان نیستند"
                }
            }
        });
    </script>
@endpush
