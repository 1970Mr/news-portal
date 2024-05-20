@extends('panel::layouts.master', ['title' => 'درباره ما'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>تنظیمات</a></li>
        <li><a>درباره ما</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-question"></i>
                            درباره ما
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

                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.settings.about-us.edit') }}" method="post">
                        @csrf
                        @method('PUT')
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="title">عنوان <small>(ضروری)</small></label>
                                <input id="title" class="form-control" name="title" value="{{ old('title', $about?->title) }}" required>
                            </div>

                            <div class="form-group col-12">
                                <label>محتوا <small>(ضروری)</small></label>
                                <div id="toolbar-container"></div>
                                <div id="editor"></div>
                                <input type="hidden" id="content" name="content" value="{{ old('content', $about?->content) }}" required>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ثبت اطلاعات درباره ما
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
    <script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/translations/fa.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/UploadAdapter.js') }}"></script>
    <script>
        function CustomUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new UploadAdapter(
                    loader,
                    '{{ route(config('app.panel_prefix', 'panel') . '.images.upload', ['alt_text' => 'About Us']) }}',
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
                    editor.setData('{!! old('content', $about?->content) !!}');
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
        $("#main-form").validate();
    </script>
@endpush

@push('styles')
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
