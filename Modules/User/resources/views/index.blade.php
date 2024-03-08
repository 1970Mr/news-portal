@extends('panel::layouts.master', ['title' => 'لیست کاربران'])

@section('content')

    <!-- BEGIN BREADCRUMB -->
    <div class="col-md-12">
        <div class="breadcrumb-box shadow">
            <ul class="breadcrumb">
                <li><a href="{{ route('panel.index') }}">پیشخوان</a></li>
                <li><a>لیست کاربران</a></li>
            </ul>
            <div class="breadcrumb-left">
                {{ jalalian()->now()->format('l، Y/m/d') }}
                <i class="icon-calendar"></i>
            </div><!-- /.breadcrumb-left -->
        </div><!-- /.breadcrumb-box -->
    </div><!-- /.col-md-12 -->
    <!-- END BREADCRUMB -->

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
                    <div class="buttons-box">
                        <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                           aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                            <i class="icon-size-fullscreen d-flex justify-content-center align-items-center"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                        <a class="btn btn-sm btn-default btn-round" rel="tooltip"
                           href="{{ route('users.create') }}"
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
                                        <td class="ltr text-right">{{ jalalian()->forge($user->created_at)->format('Y/m/d H:i:s') }}</td>
                                        <td class="{{ ($user->email_verified_at) ? 'text-success' : 'text-danger' }}">{{ ($user->email_verified_at) ? 'تایید شده' : 'تایید نشده' }}</td>
                                        <td class="d-flex gap-2">
                                            <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                    rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('users.edit', $user->id) }}">
                                                <i class="icon-pencil fa-flip-horizontal"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger btn-icon round d-flex justify-content-center align-items-center"
                                                        rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                                    <i class="icon-trash fa-flip-horizontal"></i>
                                                </button>
                                            </form>
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
