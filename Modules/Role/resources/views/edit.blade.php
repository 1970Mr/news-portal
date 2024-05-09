@extends('panel::layouts.master', ['title' => 'ویرایش نقش'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.roles.index') }}">لیست نقش‌ها</a></li>
        <li><a>ویرایش نقش</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ویرایش نقش
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
                    <form id="role-edit-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.roles.update', $role->id) }}" method="post">
                        @csrf
                        @method('put')
                        <x-common-error-messages />

                        <fieldset class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">نام <small>(ضروری)</small> </label>
                                    <input id="name" class="form-control" name="name" type="text" required value="{{ old('name') ?? $role->name }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="localName">نام نمایشی</label>
                                    <input id="localName" class="form-control" name="localName" type="text" value="{{ old('localName') ?? $role->local_name }}">
                                </div>
                            </div>

                            <div class="m-3">
                                <h2 class="mb-3 px-0">تعیین دسترسی‌های نقش</h2>
                                <div class="row mx-4">
                                    @foreach($groupedPermissions as $key => $permissions)
                                        <h3 class="mb-2 px-0">@lang('role::permissions.' . $key)</h3>
                                        <div class="permissions-layout">
                                            @foreach($permissions as $permission)
                                                <div class="form-group px-0 w-auto">
                                                    <label for="{{ $permission->id }}" class="cursor-pointer">
                                                        <input id="{{ $permission->id }}" class="form-control" name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                                            {{ $permissionService->selectedItems($role->permissions, $permission->name, old('permissions')) }}>
                                                        {{ $permission->local_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ویرایش نقش
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
        $("#role-edit-form").validate();
    </script>
@endpush

@push('styles')
    <style>
        .permissions-layout {
            display: grid;
            grid-template-columns: repeat(4, auto);
            justify-content: space-between;
        }

        @media screen and (max-width: 767px) {
            .permissions-layout {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media screen and (max-width: 575px) {
            .permissions-layout {
                grid-template-columns: repeat(2, auto);
            }
        }
    </style>
@endpush
