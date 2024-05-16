@extends('panel::layouts.master', ['title' => 'تماس با ما'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>تماس با ما</a></li>
        <li><a>ثبت اطلاعات</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-call-in"></i>
                            تماس با ما
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

                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.contact-us.info.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="title">عنوان <small>(ضروری)</small></label>
                                <input id="title" class="form-control" name="title" value="{{ old('title', $contact?->title) }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="address">آدرس</label>
                                <input id="address" class="form-control" name="address" value="{{ old('address', $contact?->address) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">ایمیل</label>
                                <input id="email" class="form-control" name="email" value="{{ old('email', $contact?->email) }}" >
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="phone">شماره تماس</label>
                                <input id="phone" class="form-control" name="phone" value="{{ old('phone', $contact?->phone) }}">
                            </div>
                            <div class="form-group col-12">
                                <label>محتوا <small>(ضروری)</small></label>
                                <div id="toolbar-container"></div>
                                <div id="editor"></div>
                                <input type="hidden" id="content" name="content" value="{{ old('content', $contact?->content) }}" required>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ثبت اطلاعات تماس با ما
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
    <script src="{{ asset('admin/assets/plugins/mdsPersianDatetimepicker/dist/js/mds.bs.datetimepicker.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/translations/fa.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/UploadAdapter.js') }}"></script>
    <script>
        function CustomUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new UploadAdapter(
                    loader,
                    '{{ route(config('app.panel_prefix', 'panel') . '.images.upload', ['alt_text' => 'Contact Us']) }}',
                    '{{ csrf_token() }}'
                );
            };
        }

        $(document).ready(function () {
            DecoupledEditor
                .create( document.querySelector( '#editor' ), {
                    extraPlugins: [ CustomUploadAdapterPlugin ],
                    language: 'fa',
                    direction: 'rtl',
                    fontFamily: {
                        'default': 'IranSans, Arial, sans-serif',
                    },
                })
                .then( editor => {
                    editor.setData('{!! old('content', $contact?->content) !!}');
                    editor.model.document.on('change:data', () => {
                        document.querySelector('input[name="content"]').value = editor.getData();
                    });
                    const toolbarContainer = document.querySelector( '#toolbar-container' );
                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                } )
                .catch( error => {
                    console.error( error );
                } );
        });

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
                email: {
                    required: true,
                    email: true
                },
            }
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/mdsPersianDatetimepicker/dist/css/mds.bs.datetimepicker.style.css') }}">

    <style>
        .ck-powered-by-balloon {
            display: none !important;
        }

        #toolbar-container * {
            font-family: 'IranSans';
        }

        #editor {
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            border: #dee2e6 solid 1px;
            border-top: none;
        }

        #editor:focus {
            border-radius: 5px;
            border: gray solid 1px;
            box-shadow: 1px 1px #dee2e6;
        }
    </style>
@endpush
