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
                        @can(config('permissions_list.TAG_STORE'))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route('tag.create') }}"
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
                                <th>slug</th>
                                <th>توضیحات</th>
                                <th>دسته‌بندی والد</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                @canany([config('permissions_list.TAG_UPDATE'), config('permissions_list.TAG_DESTROY')])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->slug }}</td>
                                        <td>{{ $tag->description }}</td>
                                        <td class="ltr text-right">{{ jalalian()->forge($tag->created_at)->format(config('common.datetime_format')) }}</td>
                                        <td class="{{ status_class($tag->status) }}">{{ status_message($tag->status) }}</td>
                                        @canany([config('permissions_list.TAG_UPDATE'), config('permissions_list.TAG_DESTROY')])
                                            <td class="d-flex gap-2">
                                                @can(config('permissions_list.TAG_UPDATE'))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('tag.edit', $tag->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.TAG_DESTROY'))
                                                    <x-common-delete-button :route="route('tag.destroy', $tag->id)" />
                                                @endcan

                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $tags->links() }}

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
