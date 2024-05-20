@extends('panel::layouts.master', ['title' => 'ثبت جزئیات سایت'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>تنظیمات</a></li>
        <li><a>ثبت جزئیات سایت</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-question"></i>
                            ثبت جزئیات سایت
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

                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.settings.site-details.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="description">توضیحات فوتر <small>(ضروری)</small></label>
                                <textarea id="description" class="form-control" name="description" required>{{ old('description', $siteDetail?->description) }}</textarea>
                            </div>

                            <div class="col-12 d-flex flex-column align-items-center">
                                <div class="form-group relative col-lg-6">
                                    <label>لوگوی هدر <small>(ضروری)</small></label>
                                    <div class="input-group round">
                                        <input type="text" class="form-control file-input" placeholder="برای آپلود کلیک کنید">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            آپلود تصویر</button>
                                    </span>
                                    </div>
                                    <input type="file" class="form-control" name="header_image">
                                    <div class="help-block"></div>
                                </div>
                                @if($siteDetail?->headerLogo)
                                    <div class="form-group col-12 text-center">
                                        <img class="mb-2" src="{{ asset('storage/' . $siteDetail?->headerLogo->file_path) }}" alt="{{ $siteDetail?->headerLogo->alt_text }}" style="max-width:
                                        300px;
                                        max-height:
                                        300px">
                                            <div>
                                                {{ asset('storage/' . $siteDetail?->headerLogo->file_path) }}
                                            </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 d-flex flex-column align-items-center">
                                <div class="form-group relative col-lg-6">
                                    <label>لوگوی فوتر <small>(ضروری)</small></label>
                                    <div class="input-group round">
                                        <input type="text" class="form-control file-input" placeholder="برای آپلود کلیک کنید">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            آپلود تصویر</button>
                                    </span>
                                    </div>
                                    <input type="file" class="form-control" name="footer_image">
                                    <div class="help-block"></div>
                                </div>
                                @if($siteDetail?->footerLogo)
                                    <div class="form-group col-12 text-center">
                                        <img class="mb-2" src="{{ asset('storage/' . $siteDetail?->footerLogo->file_path) }}" alt="{{ $siteDetail?->footerLogo->alt_text }}" style="max-width:
                                        300px;
                                        max-height:
                                        300px">
                                            <div>
                                                {{ asset('storage/' . $siteDetail?->footerLogo->file_path) }}
                                            </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mt-3">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ثبت جزئیات سایت
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
