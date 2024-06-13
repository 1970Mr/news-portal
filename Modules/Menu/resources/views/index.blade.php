@extends('panel::layouts.master', ['title' => 'لیست منوها'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست منوها</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-menu"></i>
                            لیست منوها
                        </h3>
                        <form class="d-inline-block search-form">
                            <div class="input-group">
                                <button class="btn btn-secondary d-flex align-items-center" type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                                <input name="query" type="text" class="form-control p-2" placeholder="جستجو..." value="{{ request()->get('query') }}">
                            </div>
                        </form>
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
                        @can(config('permissions_list.MENU_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.menus.create') }}"
                               aria-label="ایجاد دسته‌بندی‌ جدید" data-bs-original-title="ایجاد دسته‌بندی‌ جدید">
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
                                <th>آدرس</th>
                                <th>ترتیب قرارگیری</th>
                                <th>منوی والد</th>
                                <th>دسته‌بندی</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                @canany([
                                    config('permissions_list.MENU_UPDATE', false),
                                    config('permissions_list.MENU_DESTROY', false),
                                ])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ nullable_value($menu->url) }}</td>
                                    <td>{{ $menu->position }}</td>
                                    <td>{{ $menu->parentMenuTitle() }}</td>
                                    <td>{{ nullable_value($menu->category?->name) }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($menu->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($menu->status) }}">{{ status_message($menu->status) }}</td>
                                    @canany([
                                        config('permissions_list.MENU_UPDATE', false),
                                        config('permissions_list.MENU_DESTROY', false),
                                    ])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.MENU_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش"
                                                       href="{{ route(config('app.panel_prefix', 'panel') . '.menus.edit', $menu->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.MENU_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.menus.destroy', $menu->id)"/>
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
                    {{ $menus->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
