@extends('panel::layouts.master', ['title' => 'لیست تبلیغات'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>لیست تبلیغات</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="fas fa-bullhorn"></i>
                            لیست تبلیغات
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
                        @can(config('permissions_list.AD_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.ads.create') }}"
                               aria-label="ایجاد تبلیغ جدید" data-bs-original-title="ایجاد تبلیغ جدید">
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
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>لینک</th>
                                <th>مکان قرارگیری</th>
                                <th>تاریخ انتشار</th>
                                <th>تاریخ انقضا</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                @canany([config('permissions_list.AD_UPDATE'), config('permissions_list.AD_DESTROY')])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ads as $ad)
                                <tr>
                                    <td>{{ $ad->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $ad->image->file_path) }}" alt="{{ $ad->image->alt_text }}" width="100px" style="max-height: 90px">
                                    </td>
                                    <td>{{ $ad->title }}</td>
                                    <td>{{ $ad->link }}</td>
                                    <td>{{ nullable_value($ad->getSection()) }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($ad->published_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="ltr text-right nowrap">
                                        @if($ad->expired_at)
                                            {{ jalalian()->forge($ad->expired_at)->format(config('common.datetime_format')) }}
                                        @else
                                            {{ nullable_value($ad->expired_at) }}
                                        @endif
                                    </td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($ad->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($ad->status) }}">{{ status_message($ad->status) }}</td>
                                    @canany([config('permissions_list.AD_UPDATE'), config('permissions_list.AD_DESTROY')])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.AD_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route(config('app.panel_prefix', 'panel') . '.ads.edit',
                                                        $ad->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.AD_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.ads.destroy', $ad->id)" />
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
                    {{ $ads->links() }}

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

        th, .nowrap {
            white-space: nowrap;
        }

        .min-w-10 {
            min-width: 10rem;
        }
    </style>
@endpush
