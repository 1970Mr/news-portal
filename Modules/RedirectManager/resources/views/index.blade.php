@extends('panel::layouts.master', ['title' => 'لیست ریدایرکت‌ها'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست ریدایرکت‌ها</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="fas fa-link"></i>
                            لیست ریدایرکت‌ها
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
                        @can(config('permissions_list.REDIRECT_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.redirects.create') }}"
                               aria-label="ایجاد ریدایرکت جدید" data-bs-original-title="ایجاد ریدایرکت جدید">
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
                                <th>URL مبدا</th>
                                <th>URL مقصد</th>
                                <th>کد وضعیت</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                @canany([
                                    config('permissions_list.REDIRECT_UPDATE', false),
                                    config('permissions_list.REDIRECT_DESTROY', false)
                                ])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($redirects as $redirect)
                                <tr>
                                    <td>{{ $redirect->id }}</td>
                                    <td>{{ $redirect->source_url }}</td>
                                    <td>{{ $redirect->destination_url }}</td>
                                    <td>{{ $redirect->status_code }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($redirect->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($redirect->status) }}">{{ status_message($redirect->status) }}</td>
                                    @canany([
                                        config('permissions_list.REDIRECT_UPDATE', false),
                                        config('permissions_list.REDIRECT_DESTROY', false)
                                    ])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.REDIRECT_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش"
                                                       href="{{ route(config('app.panel_prefix', 'panel') . '.redirects.edit', $redirect->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.REDIRECT_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.redirects.destroy', $redirect->id)"/>
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
                    {{ $redirects->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
