@extends('panel::layouts.master', ['title' => 'ویرایش خبر جدید'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route('article.index') }}">لیست اخبار</a></li>
        <li><a>ویرایش خبر جدید</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ویرایش خبر جدید
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
                    <form id="article-create-form" role="form" action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="title">عنوان <small>(ضروری)</small></label>
                                <input id="title" class="form-control" name="title" type="text" required value="{{ old('title', $article->title) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="slug">slug <small>(ضروری)</small> </label>
                                <input id="slug" class="form-control" name="slug" type="text" required value="{{ old('slug', $article->slug) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="description">توضیحات <small>(ضروری)</small></label>
                                <input id="description" class="form-control" name="description" required type="text" value="{{ old('description', $article->description) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="keywords">کلمات کلیدی <small>(ضروری)</small></label>
                                <input id="keywords" class="form-control" name="keywords" required type="text" value="{{ old('keywords', $article->keywords) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="published_at">تاریخ انتشار <small>(ضروری)</small></label>
                                <div class="input-group" id="dtp1">
                                    <input id="published_at" type="text" class="form-control cursor-pointer" required readonly data-name="dtp1-text" dir="ltr">
                                    <i class="icon-clock fs-5 input-group-text cursor-pointer"></i>
                                </div>
                                <input name="published_at" type="hidden" data-name="dtp1-date">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="category_id">دسته‌بندی <small>(ضروری)</small></label>
                                <select id="category_id" class="form-control select2" name="category_id">
                                    <option value="">انتخاب دسته‌بندی</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if( (int) old('category_id', $article->category_id) === $category->id ) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-12 d-flex justify-content-center">
                                <div class="col-12 col-md-6">
                                    <label for="tag_ids">تگ</label>
                                    <select id="tag_ids" class="form-control select2" name="tag_ids[]" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" @if(in_array($tag->id, old('tag_ids', $article->tags->pluck('id')->toArray()))) selected @endif>{{ $tag->name
                                            }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-column align-items-center">
                                <div class="form-group relative col-lg-6">
                                    <label>تصویر شاخص <small>(ضروری)</small></label>
                                    <div class="input-group round">
                                        <input type="text" class="form-control file-input" placeholder="برای آپلود کلیک کنید">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            آپلود تصویر</button>
                                    </span>
                                    </div>
                                    <input type="file" class="form-control" name="image">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-12 text-center">
                                    <img class="mb-2" src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}" style="max-width: 300px;
                                    max-height:
                                    300px">
                                    <div>
                                        {{ asset('storage/' . $article->image->file_path) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label>متن خبر <small>(ضروری)</small></label>
                                <div id="toolbar-container"></div>
                                <div id="editor"></div>
                                <input type="hidden" id="body" name="body" value="{{ old('body', $article->body) }}">
                            </div>
                            <div class="col-12 col-md-6 row form-group">
                                <div class="text-center col-4">
                                    {{-- Using title because status is not always --}}
                                    <input id="editor_choice" class="form-control" name="editor_choice" type="checkbox" @if(old('editor_choice') || (!old('title') && $article->editor_choice) ) checked @endif>
                                    <label for="editor_choice">انتخاب سردبیر</label>
                                </div>
                                <div class="text-center col-4">
                                    <input id="hotness" class="form-control" name="hotness" type="checkbox" @if(old('hotness') || (!old('title') && $article->isHot()) ) checked @endif>
                                    <label for="hotness">خبر داغ</label>
                                </div>
                                <div class="text-center col-4">
                                    <input id="status" class="form-control" name="status" type="checkbox" @if(old('status') || (!old('title') && $article->status) ) checked @endif>
                                    <label for="status">وضعیت</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ویرایش خبر جدید
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
                    editor.setData('{!! old('body', $article->body) !!}');
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
        dtp1Instance.setDate(new Date('{{ old('published_at', $article->published_at) }}'));

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
