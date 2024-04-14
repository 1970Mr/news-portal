@extends('panel::layouts.master', ['title' => 'ایجاد خبر جدید'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route('article.index') }}">لیست اخبار</a></li>
        <li><a>ایجاد خبر جدید</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ایجاد خبر جدید
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
                    <form id="article-create-form" role="form" action="{{ route('article.store') }}" method="post">
                        @csrf
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="title">عنوان <small>(ضروری)</small></label>
                                <input id="title" class="form-control" name="title" type="text" required value="{{ old('title') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="slug">slug <small>(ضروری)</small> </label>
                                <input id="slug" class="form-control" name="slug" type="text" required value="{{ old('slug') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="description">توضیحات <small>(ضروری)</small></label>
                                <input id="description" class="form-control" name="description" type="text" value="{{ old('description') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="published_at">تاریخ انتشار <small>(ضروری)</small></label>
                                <div class="input-group" id="dtp1">
                                    <input id="published_at" type="text" class="form-control cursor-pointer" data-name="dtp1-text" value="{{ old('published_at') }}" dir="ltr" readonly>
                                    <i class="icon-clock fs-5 input-group-text cursor-pointer"></i>
                                </div>
                                <input name="published_at" type="hidden" data-name="dtp1-date">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="category">دسته‌بندی <small>(ضروری)</small></label>
                                <select id="category" class="form-control select2" name="category">
                                    <option value="">انتخاب دسته‌بندی</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if(old('category') === $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 d-flex justify-content-center">
                                <div class="col-6">
                                    <label for="tag">تگ</label>
                                    <select id="tag" class="form-control select2" name="tags[]" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" @if(in_array($tag->id, old('tags'))) selected @endif>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label>متن خبر <small>(ضروری)</small></label>
                                <div id="toolbar-container"></div>
                                <div id="editor"></div>
                                <input type="hidden" id="body" name="body" value="{{ old('body') }}">
                            </div>
                            <div class="form-group text-center">
                                <input id="status" class="form-control" name="status" type="checkbox" @if(old('status')) checked @endif>
                                <label for="status">وضعیت</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ایجاد خبر جدید
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

    <script src="{{ asset('admin/assets/plugins/mdsPersianDatetimepicker/dist/js/mds.bs.datetimepicker.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/translations/fa.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/UploadAdapter.js') }}"></script>
    <script>
        function CustomUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new UploadAdapter( loader, '{{ route('image.upload') }}', '{{ csrf_token() }}' );
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
                    editor.setData('{!! old('body') !!}');
                    editor.model.document.on('change:data', () => {
                        document.querySelector('input[name="body"]').value = editor.getData();
                    });
                    const toolbarContainer = document.querySelector( '#toolbar-container' );
                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                } )
                .catch( error => {
                    console.error( error );
                } );
        });

        const dtp1Instance = new mds.MdsPersianDateTimePicker(document.getElementById('dtp1'), {
            targetTextSelector: '[data-name="dtp1-text"]',
            targetDateSelector: '[data-name="dtp1-date"]',
            enableTimePicker: true,
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
        $("#article-create-form").validate();
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
