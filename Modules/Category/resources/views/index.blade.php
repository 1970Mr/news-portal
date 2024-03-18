@extends('panel::layouts.master', ['title' => 'لیست دسته‌بندی‌ها'])

@section('content')

    <x-share-breadcrumbs>
        <li><a>لیست دسته‌بندی‌ها</a></li>
    </x-share-breadcrumbs>

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
                        <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                           href="{{ route('category.create') }}"
                           aria-label="ایجاد دسته‌بندی‌ جدید" data-bs-original-title="ایجاد دسته‌بندی‌ جدید">
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
                                <th>slug</th>
                                <th>توضیحات</th>
                                <th>دسته‌بندی والد</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->parentCategoryTitle() }}</td>
                                        <td class="ltr text-right">{{ jalalian()->forge($category->created_at)->format(config('share.datetime_format')) }}</td>
                                        <td class="{{ status_class($category->status) }}">{{ status_message($category->status) }}</td>
                                        <td class="d-flex gap-2">
                                            <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                    rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('category.edit', $category->id) }}">
                                                <i class="icon-pencil fa-flip-horizontal"></i>
                                            </a>

                                            <x-share-delete-button :route="route('category.destroy', $category->id)" />

                                        </td>
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
        .page-link{
            text-align: center;
        }
    </style>
@endpush
