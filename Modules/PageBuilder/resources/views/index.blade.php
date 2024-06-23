@extends('panel::layouts.master', ['title' => 'لیست صفحات'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>لیست صفحات</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="fas fa-laptop-file"></i>
                            لیست صفحات
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
                        @can(config('permissions_list.PAGE_CREATE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.pages.create') }}"
                               aria-label="ایجاد صفحه جدید" data-bs-original-title="ایجاد صفحه جدید">
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
                    <div class="table-responsive overflow-x-auto">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>تصویر شاخص</th>
                                <th>عنوان</th>
                                <th>slug</th>
                                <th>کاربر</th>
                                <th>وضعیت</th>
                                <th>تاریخ ایجاد</th>
                                @canany([config('permissions_list.PAGE_UPDATE'), config('permissions_list.PAGE_DESTROY')])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $page->featured_image?->file_path) }}" alt="{{ $page->featured_image?->alt_text }}" width="100px"
                                             style="max-height: 90px;">
                                    </td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>{{ $page->user?->full_name }}</td>
                                    <td class="{{ status_class($page->status) }}">{{ status_message($page->status) }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($page->created_at)->format(config('common.datetime_format')) }}</td>
                                    @canany([
                                        config('permissions_list.PAGE_UPDATE'),
                                        config('permissions_list.PAGE_DESTROY')
                                    ])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.PAGE_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route(config('app.panel_prefix', 'panel') . '.pages.edit',
                                                        $page->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.PAGE_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.pages.destroy', $page->id)"/>
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
                    {{ $pages->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>
@endsection
