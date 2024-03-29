@extends('panel::layouts.master', ['title' => 'لیست نقش‌ها'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست نقش‌ها</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-people"></i>
                            لیست نقش‌ها
                        </h3>
                    </div><!-- /.portlet-title -->
                    <div class="buttons-box ltr">
                        <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                           aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                            <i class="icon-size-fullscreen d-flex justify-content-center align-items-center"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                        <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                           href="{{ route('role.create') }}"
                           aria-label="ایجاد نقش جدید" data-bs-original-title="ایجاد نقش جدید">
                            <i class="icon-plus d-flex justify-content-center align-items-center"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>نام نمایشی</th>
                                <th>دسترسی‌های نقش</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->local_name }}</td>
                                        <td>
                                            {{ $role->getPermissionLocalNames()->implode(', ') }}
                                        </td>
                                        <td class="ltr text-right">{{ jalalian()->forge($role->created_at)->format(config('common.datetime_format')) }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                   rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('role.edit', $role->id) }}">
                                                    <i class="icon-pencil fa-flip-horizontal"></i>
                                                </a>

                                                <x-common-delete-button :route="route('role.destroy', $role->id)" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $roles->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .page-link{
            text-align: center;
        }
    </style>
@endpush
