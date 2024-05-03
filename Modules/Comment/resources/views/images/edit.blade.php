@extends('panel::layouts.master', ['title' => 'ویرایش تصویر'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route('image.index') }}">لیست تصویر‌ها</a></li>
        <li><a>ویرایش تصویر</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ویرایش تصویر
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
                    <form id="image-create-form" role="form" action="{{ route('image.update', $image->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-12 text-center">
                                <img class="mb-2" src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" style="max-width: 300px; max-height: 300px">
                                <div>
                                    {{ asset('storage/' . $image->file_path) }}
                                </div>
                            </div>
                            <div class="form-group relative col-lg-6">
                                <input type="file" class="form-control" name="image">
                                <label>تصویر <small>(ضروری)</small></label>
                                <div class="input-group round">
                                    <input type="text" class="form-control file-input" placeholder="برای آپلود کلیک کنید">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            آپلود عکس</button>
                                    </span>
                                </div><!-- /.input-group -->
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="altText">متن جاگزین <small>(ضروری)</small></label>
                                <input id="altText" class="form-control" name="altText" type="text" value="{{ old('altText') ?? $image->alt_text }}">
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ویرایش تصویر
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
        $("#image-create-form").validate();
    </script>
@endpush