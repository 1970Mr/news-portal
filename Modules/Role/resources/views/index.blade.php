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
                        @can(config('permissions_list.ROLE_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.roles.create') }}"
                               aria-label="ایجاد نقش جدید" data-bs-original-title="ایجاد نقش جدید">
                                <i class="icon-plus d-flex justify-content-center align-items-center"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        @endcan
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
                                @canany([config('permissions_list.ROLE_UPDATE'), config('permissions_list.ROLE_DESTROY')])
                                    <th>عملیات</th>
                                @endcanany
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
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($role->created_at)->format(config('common.datetime_format')) }}</td>
                                        @canany([config('permissions_list.ROLE_UPDATE'), config('permissions_list.ROLE_DESTROY')])
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can(config('permissions_list.ROLE_UPDATE', false))
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route(config('app.panel_prefix', 'panel') . '.roles.edit', $role->id) }}">
                                                            <i class="icon-pencil fa-flip-horizontal"></i>
                                                        </a>
                                                    @endcan

                                                    @can(config('permissions_list.ROLE_DESTROY', false))
                                                        <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.roles.destroy', $role->id)" />
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
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
        .page-link {
            text-align: center;
        }

        th, .created-at {
            white-space: nowrap;
        }
    </style>
@endpush
