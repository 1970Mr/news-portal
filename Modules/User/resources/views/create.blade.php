@extends('panel::layouts.master', ['title' => 'ایجاد کاربر جدید'])

@section('content')
    <!-- BEGIN BREADCRUMB -->
    <div class="col-md-12">
        <div class="breadcrumb-box shadow">
            <ul class="breadcrumb">
                <li><a href="{{ route('panel.index') }}">پیشخوان</a></li>
                <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                <li><a>ایجاد کاربر جدید</a></li>
            </ul>
            <div class="breadcrumb-left">
                {{ jalalian()->now()->format('l، Y/m/d') }}
                <i class="icon-calendar"></i>
            </div><!-- /.breadcrumb-left -->
        </div><!-- /.breadcrumb-box -->
    </div><!-- /.col-md-12 -->
    <!-- END BREADCRUMB -->

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ایجاد کاربر جدید
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
                    <form id="user-create-form" role="form" action="{{ route('users.store') }}" method="post">
                        @csrf
                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="name">نام <small>(ضروری و حداقل)</small></label>
                                <input id="name" class="form-control" name="name" type="text" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">ایمیل <small>(ضروری)</small> </label>
                                <input id="email" class="form-control" name="email" type="email" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="password">رمز عبور <small>(ضروری، حداقل 8 کاراکتر)</small></label>
                                <input id="password" class="form-control" name="password" minlength="8" type="password" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="password_confirmation">تکرار رمز عبور <small>(ضروری، حداقل 8 کاراکتر)</small></label>
                                <input id="password_confirmation" class="form-control" name="password_confirmation" minlength="8" type="password" required>
                            </div>
                            <div class="form-group text-center">
                                <input id="email_verification" class="form-control" name="email_verification" type="checkbox">
                                <label for="email_verification">تایید ایمیل</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ایجاد کاربر جدید
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
        $("#user-create-form").validate({
            rules: {
                password_confirmation: {
                    equalTo: "#password"
                }
            },
            messages: {
                password_confirmation: {
                    equalTo: "رمزهای عبور یکسان نیستند"
                }
            }
        });
    </script>
@endpush
