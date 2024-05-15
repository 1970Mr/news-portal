@extends('panel::layouts.master', ['title' => 'لیست پیام‌های کاربران'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست پیام‌های کاربران</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-envelope"></i>
                            لیست پیام‌های کاربران
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

                        <!-- Filter box -->
{{--                        <div class="btn-group" rel="tooltip"--}}
{{--                             aria-label="فیلتر نظرات" data-bs-original-title="فیلتر نظرات">--}}
{{--                            <button type="button" class="btn btn-sm btn-default btn-round btn-info text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">--}}
{{--                                <i class=" fas fa-filter d-flex justify-content-center align-items-center"></i>--}}
{{--                                <div class="paper-ripple">--}}
{{--                                    <div class="paper-ripple__background"></div>--}}
{{--                                    <div class="paper-ripple__waves"></div>--}}
{{--                                </div>--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                @foreach($filters as $value)--}}
{{--                                    <li><a class="dropdown-item" href="{{ route(config('app.panel_prefix', 'panel') . '.comments.index', ['filter' => $value]) }}">{{ __($value) }}</a></li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive" style="overflow-x: auto !important;">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>موضوع</th>
                                <th>نام</th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>پیام</th>
{{--                                <th>وضعیت خواندن</th>--}}
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userMessages as $userMessage)
                                <tr>
                                    <td>{{ $userMessage->id }}</td>
                                    <td>{{ $userMessage->subject }}</td>
                                    <td>{{ $userMessage->name }}</td>
                                    <td>{{ $userMessage->email }}</td>
                                    <td>{{ nullable_value($userMessage->phone) }}</td>
                                    <td>{{ str($userMessage->message)->limit(30) }}</td>
{{--                                    <td class="{{ $userMessage->setStatusClass() }} status">{{ $userMessage->getStatus() }}</td>--}}
                                    <td class="ltr text-right created-at">{{ jalalian()->forge($userMessage->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                               rel="tooltip" aria-label="مشاهده پیام" data-bs-original-title="مشاهده پیام"
                                               href="{{ route(config('app.panel_prefix', 'panel') . '.contact-us.show', $userMessage->id) }}">
                                                <i class="icon-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $userMessages->links() }}

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

        .btn-info {
            background-color: #03a9f4 !important;
        }

        th, .created-at, .reply, .status {
            white-space: nowrap;
        }
    </style>
@endpush
