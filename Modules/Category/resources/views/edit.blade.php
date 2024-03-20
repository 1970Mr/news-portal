@extends('panel::layouts.master', ['title' => 'ویرایش دسته‌بندی'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route('category.index') }}">لیست دسته‌بندی‌ها</a></li>
        <li><a>ویرایش دسته‌بندی</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ویرایش دسته‌بندی
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
                    <form id="user-create-form" role="form" action="{{ route('category.update', $category->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="name">نام <small>(ضروری)</small></label>
                                <input id="name" class="form-control" name="name" type="text" required value="{{ $category->name }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="slug">slug <small>(ضروری)</small> </label>
                                <input id="slug" class="form-control" name="slug" type="text" required value="{{ $category->slug }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="description">توضیحات </label>
                                <input id="description" class="form-control" name="description" type="text" value="{{ $category->description }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="parent_id">دسته‌بندی والد</label>
                                <select id="parent_id" class="form-control" name="parent_id">
                                    <option value="">انتخاب دسته‌بندی والد</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $category->parent_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <input id="status" class="form-control" name="status" type="checkbox" @if($category->status) checked @endif>
                                <label for="status">وضعیت</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ویرایش دسته‌بندی
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
        $("#user-create-form").validate();
    </script>
@endpush
