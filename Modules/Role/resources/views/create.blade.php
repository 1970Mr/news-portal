@extends('panel::layouts.master', ['title' => 'ایجاد نقش جدید'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route('role.index') }}">لیست نقش‌ها</a></li>
        <li><a>ایجاد نقش جدید</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ایجاد نقش جدید
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
                    <form id="role-create-form" role="form" action="{{ route('role.store') }}" method="post">
                        @csrf
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">نام <small>(ضروری)</small> </label>
                                    <input id="name" class="form-control" name="name" type="text" required value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="localName">نام نمایشی</label>
                                    <input id="localName" class="form-control" name="localName" type="text" value="{{ old('localName') }}">
                                </div>
                            </div>

                            <div class="col-lg-10 d-flex row my-3">
                                <h2 class="mb-3 px-0">تعیین دسترسی‌های نقش</h2>
                                @foreach($groupedPermissions as $key => $permissions)
                                    <h3 class="mb-2 px-0">@lang('role::permissions.' . $key)</h3>
                                    @foreach($permissions as $permission)
                                        <div class="form-group col-lg-3 px-0">
                                            <label for="{{ $permission->id }}" class="cursor-pointer">
                                                <input id="{{ $permission->id }}" class="form-control" name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                                       @if(old('permissions') && in_array($permission->name, old('permissions'))) checked @endif>
                                                {{ $permission->local_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ایجاد نقش جدید
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
        $("#role-create-form").validate();
    </script>
@endpush
