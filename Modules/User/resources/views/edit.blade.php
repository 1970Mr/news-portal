@extends('panel::layouts.master', ['title' => "ویرایش کاربر"])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route('user.index') }}">لیست کاربران</a></li>
        <li><a>ویرایش کاربر</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ویرایش کاربر {{ $user->name }}
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
                    <form id="user-create-form" role="form" action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <x-common-error-messages />
                        <input type="hidden" name="id" value="{{ $id }}">

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="name">نام <small>(ضروری)</small></label>
                                <input id="name" class="form-control" name="name" type="text" required value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">ایمیل <small>(ضروری)</small> </label>
                                <input id="email" class="form-control" name="email" type="email" required value="{{ $user->email }}">
                            </div>

                            <div class="accordion mb-3" id="accordionEditPassword">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed h4 p-2 mt-0 mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEditPassword"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">
                                            ویرایش رمزعبور
                                        </button>
                                    </h2>
                                    <div id="collapseEditPassword" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body row">
                                            <div class="form-group col-lg-6">
                                                <label for="password">رمز عبور <small>(ضروری، حداقل 8 کاراکتر)</small></label>
                                                <input id="password" class="form-control" name="password" minlength="8" type="password">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="password_confirmation">تکرار رمز عبور <small>(ضروری، حداقل 8 کاراکتر)</small></label>
                                                <input id="password_confirmation" class="form-control" name="password_confirmation" minlength="8" type="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <input id="email_verification" class="form-control" name="email_verification" type="checkbox" {{ $user->email_verified_at ? 'checked' : '' }}>
                                <label for="email_verification">تایید ایمیل</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ویرایش کاربر
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
