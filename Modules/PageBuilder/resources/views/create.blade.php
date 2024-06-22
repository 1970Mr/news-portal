@extends('panel::layouts.master', ['title' => 'ایجاد صفحه جدید'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.pages.index') }}">لیست صفحات</a></li>
        <li><a>ایجاد صفحه جدید</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="fas fa-laptop-file"></i>
                            ایجاد صفحه جدید
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
                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.pages.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="title">عنوان <small>(ضروری)</small></label>
                                <input id="title" class="form-control" name="title" type="text" required value="{{ old('title') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="slug">slug <small>(ضروری)</small> </label>
                                <input id="slug" class="form-control" name="slug" type="text" required value="{{ old('slug') }}">
                            </div>
                            <div class="form-group col-12">
                                <label>محتوا <small>(ضروری)</small></label>
                                <textarea id="editor" name="content">{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group relative col-lg-6">
                                <label>تصویر شاخص <small>(ضروری)</small></label>
                                <div class="input-group round">
                                    <input type="text" class="form-control file-input" placeholder="برای آپلود کلیک کنید">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            آپلود تصویر</button>
                                    </span>
                                </div><!-- /.input-group -->
                                <input type="file" class="form-control" name="image" required>
                                <div class="help-block"></div>
                            </div>
                            <div class="col-12 text-center form-group">
                                <div>
                                    <label for="status">وضعیت <small>(ضروری)</small></label>
                                    <input id="status" class="form-control" name="status" type="checkbox" @if(old('status')) checked @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ایجاد صفحه جدید
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
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/select2.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/tinymce7/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/TinymceImageUploader.js') }}"></script>
    <script>
        const uploader = new TinymceImageUploader('{{ route(config('app.panel_prefix', 'panel') . '.images.upload') }}', '{{ csrf_token() }}')

        tinymce.init({
            selector: '#editor',
            plugins: 'lists advlist autolink link image charmap preview anchor searchreplace visualblocks visualchars code fullscreen insertdatetime media table code help wordcount accordion ' +
                'emoticons directionality pagebreak',
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | ltr rtl | bullist numlist outdent indent | link image media | code preview',
            language: 'fa',
            license_key: 'gpl',
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            },
            font_family_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans ' +
                'MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; IranSans="IranSans",Arial,sans-serif; Symbol=symbol; Tahoma=tahoma,arial,' +
                'helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats',
            content_style: "body { font-family: 'IranSans', Arial, sans-serif; }",
            content_css: '{{ asset('admin/assets/css/custom-font-styles.css') . ',' . asset('admin/assets/plugins/bootstrap/bootstrap5/css/bootstrap.rtl.min.css') }}',
            images_upload_handler: (blobInfo, progress) => uploader.uploadHandler(blobInfo, progress),
        });

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
            },
        });
        $("#main-form").validate();
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}">

    <style>
        .tox-promotion, .tox-statusbar__branding {
            display: none !important;
        }

        .tox {
            font-family: 'IranSans', Arial, sans-serif !important;
        }

        .tox-textarea {
            text-align: left !important;
            direction: ltr !important;
        }

        .tox-edit-area__iframe {
            padding: 1rem !important;
        }
    </style>
@endpush
