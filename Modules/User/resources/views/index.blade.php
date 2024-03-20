@extends('panel::layouts.master', ['title' => 'لیست کاربران'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>لیست کاربران</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-people"></i>
                            لیست کاربران
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
                           href="{{ route('user.create') }}"
                           aria-label="ایجاد کاربر جدید" data-bs-original-title="ایجاد کاربر جدید">
                            <i class="icon-user-follow d-flex justify-content-center align-items-center"></i>
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
                                <th>ایمیل</th>
                                <th>تاریخ عضویت</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="ltr text-right">{{ jalalian()->forge($user->created_at)->format(config('common.datetime_format')) }}</td>
                                        <td class="{{ status_class($user->email_verified_at) }}">{{ $user->verified_email_status }}</td>
                                        <td class="d-flex gap-2">
                                            <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                    rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('user.edit', $user->id) }}">
                                                <i class="icon-pencil fa-flip-horizontal"></i>
                                            </a>

                                            @can('delete', $user)
                                                <x-common-delete-button :route="route('user.destroy', $user->id)" />
                                            @endcan

                                        </td>
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

@push('styles')
    <style>
        .page-link{
            text-align: center;
        }
    </style>
@endpush
