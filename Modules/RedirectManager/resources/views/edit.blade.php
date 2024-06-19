@extends('panel::layouts.master', ['title' => 'ویرایش ریدایرکت'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.redirects.index') }}">لیست ریدایرکت‌ها</a></li>
        <li><a>ویرایش ریدایرکت</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="fas fa-link"></i>
                            ویرایش ریدایرکت
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
                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.redirects.update', $redirect->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="source_url">URL مبدا <small>(ضروری)</small></label>
                                <input id="source_url" class="form-control" name="source_url" type="text" required value="{{ old('source_url', $redirect->source_url) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="destination_url">URL مقصد <small>(ضروری)</small> </label>
                                <input id="destination_url" class="form-control" name="destination_url" type="text" required value="{{ old('destination_url', $redirect->destination_url) }}">
                            </div>
                            <div class="col-12 row form-group justify-content-center">
                                <div class="col-md-6 row justify-content-center">
                                    <div class="col-6">
                                        <label for="status_code">کد وضعیت</label>
                                        <input id="status_code" class="form-control" name="status_code" type="text" value="{{ old('status_code', $redirect->status_code) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row form-group justify-content-center">
                                <div class="text-center col-6">
                                    <input id="status" class="form-control" name="status" type="checkbox" @if(old('status') || (!old('source_url') && $redirect->status) ) checked @endif>
                                    <label for="status">وضعیت</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ویرایش ریدایرکت
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
        $("#main-form").validate();
    </script>
@endpush
