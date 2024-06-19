@extends('panel::layouts.master', ['title' => 'لیست کاربران'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>لیست کاربران</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-people"></i>
                            لیست کاربران
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
                        @can(config('permissions_list.USER_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.users.create') }}"
                               aria-label="ایجاد کاربر جدید" data-bs-original-title="ایجاد کاربر جدید">
                                <i class="icon-user-follow d-flex justify-content-center align-items-center"></i>
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
                                <th>تصویر کاربر</th>
                                <th>نام کامل</th>
                                <th>نام کاربری</th>
                                <th>ایمیل</th>
                                <th>نقش</th>
                                <th>بیوگرافی</th>
                                <th>تاریخ عضویت</th>
                                <th>وضعیت ایمیل</th>
                                <th>وضعیت</th>
                                @canany([
                                    config('permissions_list.USER_UPDATE'),
                                    config('permissions_list.USER_DESTROY'),
                                    config('permissions_list.USER_ROLE_ASSIGNMENT'),
                                 ])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <img class="rounded-circle object-fit-cover" src="{{ asset('storage/' . $user->image?->file_path) }}" alt="{{ $user->image?->alt_text }}"
                                             width="70px" height="70px">
                                    </td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="nowrap">{{ $user->getRoleLocalNames()->implode(', ') }}</td>
                                    <td>{{ nullable_value(str($user->bio)->limit(30)->toString()) }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($user->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($user->email_verified_at) }}">{{ $user->verified_email_status }}</td>
                                    <td class="{{ status_class($user->status) }}">{{ status_message($user->status) }}</td>
                                    @canany([
                                        config('permissions_list.USER_UPDATE'),
                                        config('permissions_list.USER_DESTROY'),
                                        config('permissions_list.USER_ROLE_ASSIGNMENT'),
                                    ])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.USER_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route(config('app.panel_prefix', 'panel') . '.users.edit',
                                                       $user->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can('delete', $user)
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.users.destroy', $user->id)"/>
                                                @endcan

                                                @can(config('permissions_list.SEO_MANAGEMENT', false))
                                                    <x-seo-manager-seo-settings-button :route="route(config('app.panel_prefix', 'panel') . '.users.seo-settings', $user->id)"/>
                                                @endcan

                                                @can(config('permissions_list.USER_ROLE_ASSIGNMENT', false))
                                                    <a class="btn btn-sm btn-secondary btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="اختصاص نقش" data-bs-original-title="اختصاص نقش"
                                                       href="{{ route(config('app.panel_prefix', 'panel') . '.users.role-assignment', $user->id) }}">
                                                        <i class="fas fa-arrow-down-up-lock"></i>
                                                    </a>
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
                    {{ $users->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
