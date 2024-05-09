@extends('panel::layouts.master', ['title' => 'لیست دسته‌بندی‌ها'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست دسته‌بندی‌ها</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-people"></i>
                            لیست دسته‌بندی‌ها
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
                        @can(config('permissions_list.CATEGORY_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.categories.create') }}"
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
                                <th>تصویر شاخص</th>
                                <th>نام</th>
                                <th>slug</th>
                                <th>توضیحات</th>
                                <th>دسته‌بندی والد</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                @canany([config('permissions_list.CATEGORY_UPDATE'), config('permissions_list.CATEGORY_DESTROY')])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $category->image->file_path) }}" alt="{{ $category->image->alt_text }}" width="100px" style="max-height: 90px">
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->parentCategoryTitle() }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($category->created_at)->format(config('common.datetime_format')) }}</td>
                                        <td class="{{ status_class($category->status) }}">{{ status_message($category->status) }}</td>
                                        @canany([config('permissions_list.CATEGORY_UPDATE'), config('permissions_list.CATEGORY_DESTROY')])
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can(config('permissions_list.CATEGORY_UPDATE', false))
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route(config('app.panel_prefix', 'panel') . '.categories.edit', $category->id) }}">
                                                            <i class="icon-pencil fa-flip-horizontal"></i>
                                                        </a>
                                                    @endcan

                                                    @can(config('permissions_list.CATEGORY_DESTROY', false))
                                                        <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.categories.destroy', $category->id)" />
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
                    {{ $categories->links() }}

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
