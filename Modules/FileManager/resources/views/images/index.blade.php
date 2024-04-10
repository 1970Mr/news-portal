@extends('panel::layouts.master', ['title' => 'لیست تصاویر'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست تصاویر</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-people"></i>
                            لیست تصاویر
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
                        @can('store', $imageClassName)
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route('image.create') }}"
                               aria-label="ایجاد تصویر‌ جدید" data-bs-original-title="ایجاد تصویر‌ جدید">
                                <i class="icon-plus d-flex justify-content-center align-items-center"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        @endcan

                        <!-- Filter box -->
                        <div class="btn-group" rel="tooltip"
                             aria-label="فیلتر تصاویر" data-bs-original-title="فیلتر تصاویر">
                            <button type="button" class="btn btn-sm btn-default btn-round btn-info text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class=" fas fa-filter d-flex justify-content-center align-items-center"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($filters as $key => $value)
                                    <li><a class="dropdown-item" href="{{ route('image.index', ['filter' => $key]) }}">{{ $value }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive" style="overflow-x: auto !important;">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>تصویر</th>
                                <th>مسیر تصویر</th>
                                <th>متن جایگزین</th>
                                <th>کاربر آپلود کننده</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>تاریخ ایجاد</th>
                                @can('operations', $imageClassName)
                                    <th>عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                @can('show', $image)
                                    <tr>
                                        <td>{{ $image->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" width="100px" style="max-height: 90px">
                                        </td>
                                        <td>{{ $image->file_path }}</td>
                                        <td>{{ $image->alt_text }}</td>
                                        <td>{{ $image->user_name }}</td>
                                        <td>{{ nullable_value($image->title) }}</td>
                                        <td>{{ nullable_value($image->description) }}</td>
                                        <td class="ltr text-right">{{ jalalian()->forge($image->created_at)->format(config('common.datetime_format')) }}</td>
                                        @can('operations', $imageClassName)
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can('update', $image)
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('image.edit', $image->id) }}">
                                                            <i class="icon-pencil fa-flip-horizontal"></i>
                                                        </a>
                                                    @endcan

                                                    @can('destroy', $image)
                                                        <x-common-delete-button :route="route('image.destroy', $image->id)"/>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @endcan
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $images->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

    <x-file-manager-image-selector :images="$images" />

@endsection

@push('styles')
    <style>
        .page-link {
            text-align: center;
        }
        .btn-info {
            background-color: #03a9f4 !important;
        }
        th {
            white-space: nowrap;
        }
    </style>
@endpush
