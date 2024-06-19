@extends('panel::layouts.master', ['title' => 'لیست ردیابی بازدیدها'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست بازدیدها</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="fas fa-arrows-to-eye"></i>
                            لیست بازدیدها
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
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>کاربر</th>
                                <th>URL</th>
                                <th>ارجاع‌دهنده</th>
                                <th>برچسب</th>
                                <th>تاریخ بازدید</th>
                                @can('permissions_list.REQUEST_TRACKS_DESTROY')
                                    <th>عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requestsTrack as $requestTrack)
                                <tr>
                                    <td>{{ $requestTrack->id }}</td>
                                    <td>{{ $requestTrack->userTrack->user->full_name ?? 'مهمان' }}</td>
                                    <td>{{ $requestTrack->url }}</td>
                                    <td>{{ nullable_value($requestTrack->referer) }}</td>
                                    <td>{{ nullable_value($requestTrack->tag) }}</td>
                                    <td class="ltr text-right">{{ jalalian()->forge($requestTrack->created_at)->format(config('common.datetime_format')) }}</td>
                                    @can('permissions_list.REQUEST_TRACKS_DESTROY')
                                        <td>
                                            <div class="d-flex gap-2">
                                                <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.requests-track.destroy', $requestTrack->id)"/>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $requestsTrack->links() }}
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
