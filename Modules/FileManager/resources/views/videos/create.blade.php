@extends('panel::layouts.master', ['title' => 'ایجاد ویدئو جدید'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.videos.index') }}">لیست ویدئوها</a></li>
        <li><a>ایجاد ویدئو جدید</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-film"></i>
                            ایجاد ویدئو جدید
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
                    <form id="video-create-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.videos.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group relative col-lg-6">
                                <input type="file" class="form-control" name="video" accept="video/*" required>
                                <label>ویدئو <small>(ضروری)</small></label>
                                <div class="input-group round">
                                    <input type="text" class="form-control file-input" placeholder="برای آپلود کلیک کنید" readonly>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-film"></i>
                                            آپلود ویدئو</button>
                                    </span>
                                </div><!-- /.input-group -->
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="name">نام ویدئو <small>(ضروری)</small></label>
                                <input id="name" class="form-control" name="name" type="text" required value="{{ old('name') }}">
                            </div>
{{--                            <div class="form-group col-lg-6">--}}
{{--                                <label for="format">فرمت</label>--}}
{{--                                <input id="format" class="form-control" name="format" type="text" value="{{ old('format') }}">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-lg-6">--}}
{{--                                <label for="thumbnail">تصویر بندانگشتی</label>--}}
{{--                                <input type="file" class="form-control" name="thumbnail" accept="image/*">--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ایجاد ویدئو جدید
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
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error').removeClass("has-success");
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass("has-success");
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $("#video-create-form").validate();
    </script>
@endpush
