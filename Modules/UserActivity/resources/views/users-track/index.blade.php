@extends('panel::layouts.master', ['title' => 'لیست ردیابی کاربران'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست ردیابی کاربران</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="fas fa-users-viewfinder"></i>
                            لیست ردیابی کاربران
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
                                <th>IP</th>
                                <th>کشور</th>
                                <th>شهر</th>
                                <th>دستگاه</th>
                                <th>سیستم عامل</th>
                                <th>مرورگر</th>
                                <th>تعداد بازدید صفحات</th>
                                <th>آخرین فعالیت</th>
                                <th>آنلاین/آفلاین</th>
                                @can('permissions_list.USER_TRACKS_DESTROY')
                                    <th>عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usersTrack as $userTrack)
                                <tr>
                                    <td>{{ $userTrack->id }}</td>
                                    <td>{{ $userTrack->user->full_name ?? 'مهمان' }}</td>
                                    <td>{{ $userTrack->ip }}</td>
                                    <td>{{ $userTrack->country }}</td>
                                    <td>{{ $userTrack->city }}</td>
                                    <td>{{ $userTrack->device }}</td>
                                    <td>{{ $userTrack->os }}</td>
                                    <td>{{ $userTrack->browser }}</td>
                                    <td>{{ $userTrack->pages_visit_count > 0 ? $userTrack->pages_visit_count : __('unknown') }}</td>
                                    <td class="rtl text-right">{{ $userTrack->getLastActivity() }}</td>
                                    <td>{{ $userTrack->isOnline() ? __('online') : __('offline') }}</td>
                                    @can('permissions_list.USER_TRACKS_DESTROY')
                                    <td>
                                            <div class="d-flex gap-2">
                                                <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.users-track.destroy', $userTrack->id)" />
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $usersTrack->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
