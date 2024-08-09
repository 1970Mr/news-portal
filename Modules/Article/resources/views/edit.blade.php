@extends('panel::layouts.master', ['title' => 'ویرایش خبر'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.articles.index') }}">لیست اخبار</a></li>
        <li><a>ویرایش خبر</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ویرایش خبر
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
                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.articles.update', $article->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <x-common-error-messages/>

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
                                    <label>تصویر شاخص </label>
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
                                <label for="tinymce-editor">متن خبر <small>(ضروری)</small></label>
                                <textarea id="tinymce-editor" name="body" required>{{ old('body', $article->body) }}</textarea>
                            </div>
                            <div class="col-12 col-md-6 row form-group justify-content-center">
                                @can(config('permissions_list.ARTICLE_EDITOR_CHOICE', false))
                                    <div class="text-center col-4">
                                        {{-- Using title because editor_choice is not always --}}
                                        <input id="editor_choice" class="form-control" name="editor_choice" type="checkbox"
                                               @if(old('editor_choice') || (!old('title') && $article->editor_choice) ) checked @endif>
                                        <label for="editor_choice">انتخاب سردبیر</label>
                                    </div>
                                @endcan
                                @can(config('permissions_list.ARTICLE_HOTNESS', false))
                                    <div class="text-center col-4">
                                        <input id="hotness" class="form-control" name="hotness" type="checkbox" @if(old('hotness') || (!old('title') && $article->isHot()) ) checked @endif>
                                        <label for="hotness">خبر داغ</label>
                                    </div>
                                @endcan
                                <div class="text-center col-4">
                                    <input id="status" class="form-control" name="status" type="checkbox" @if(old('status') || (!old('title') && $article->status) ) checked @endif>
                                    <label for="status">وضعیت</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ویرایش خبر
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

    @include('common::partials.tinymce-scripts')
    <script>
        const dtp1Instance = new mds.MdsPersianDateTimePicker(document.getElementById('dtp1'), {
            targetTextSelector: '[data-name="dtp1-text"]',
            targetDateSelector: '[data-name="dtp1-date"]',
            enableTimePicker: true,
        });
        dtp1Instance.setDate(new Date('{{ old('published_at', $article->published_at) }}'));

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

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/mdsPersianDatetimepicker/dist/css/mds.bs.datetimepicker.style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/tinymce.css') }}">
@endpush
