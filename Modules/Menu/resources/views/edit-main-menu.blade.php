@extends('panel::layouts.master', ['title' => 'ویرایش منوی اصلی'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.menus.index') }}">لیست منوها</a></li>
        <li><a>ویرایش منوی اصلی</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-menu"></i>
                            ویرایش منوی اصلی
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
                    <form id="main-form" role="form"
                          action="{{ route(config('app.panel_prefix', 'panel') . '.menus.update', $menu->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="name">نام <small>(ضروری)</small></label>
                                <input id="name" class="form-control" name="name" type="text" required value="{{ old('name', $menu->name) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="url">آدرس <small>(ضروری)</small></label>
                                <input id="url" class="form-control" name="url" type="text" value="{{ old('url', $menu->url) }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="position">ترتیب قرارگیری <small>(ضروری)</small></label>
                                <input id="position" class="form-control" name="position" type="number" required value="{{ old('position', $menu->position) }}">
                                <p class="small">{{ 'بزرگ‌ترین ترتیب ثبت شده: ' . $latestPosition}}</p>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="parent_id">منوی والد</label>
                                <select id="parent_id" class="form-control select2" name="parent_id">
                                    <option value="">انتخاب منوی والد</option>
                                    @foreach($parentMenus as $parentMenu)
                                        <option value="{{ $parentMenu->id }}"
                                                @if((int) old('parent_id', $menu->parent_id) === $parentMenu->id) selected @endif>{{ $parentMenu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center col-lg-12">
                                <input id="status" class="form-control" name="status" type="checkbox" @if(old('status', $menu->status)) checked @endif>
                                <label for="status">وضعیت</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <button class="btn btn-success btn-block">
                                    <i class="icon-check"></i>
                                    ویرایش منوی اصلی
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>
@endsection

@push('scripts')
    <!-- BEGIN PAGE JAVASCRIPT -->
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/select2.js') }}"></script>
    <!-- END PAGE JAVASCRIPT -->

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
                } else if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('span.select2'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $("#main-form").validate();

        $(".select2").select2({
            rtl: true
        });
    </script>
@endpush

@push('styles')
    <!-- BEGIN PAGE CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}">
    <!-- END PAGE CSS -->
@endpush
