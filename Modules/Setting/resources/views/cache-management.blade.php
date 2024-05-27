@extends('panel::layouts.master', ['title' => 'مدیریت حافظه پنهان'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>تنظیمات</a></li>
        <li><a>مدیریت حافظه پنهان</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-layers"></i>
                            مدیریت حافظه پنهان
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
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success m-t-10 m-b-20">
                            <i class="icon-check"></i>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div>
                        <div class="row justify-content-center">
                            @can(config('permissions_list.CACHE_CLEAR_ALL', false))
                                <div class="mt-3 col-12 row justify-content-center p-0">
                                    <div class="col-lg-6">
                                        <form action="{{ route(config('app.panel_prefix', 'panel') . '.settings.cache-management.clear-all') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block">
                                                <i class="icon-close"></i>
                                                پاک کردن تمام حافظه‌های پنهان
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endcan
                            @can(config('permissions_list.CACHE_CLEAR_APPLICATION', false))
                                <div class="mt-3 col-lg-6">
                                    <form action="{{ route(config('app.panel_prefix', 'panel') . '.settings.cache-management.clear-application') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i class="icon-trash"></i>
                                            پاک کردن حافظه پنهان داده‌های برنامه
                                        </button>
                                    </form>
                                </div>
                            @endcan
                            @can(config('permissions_list.CACHE_CLEAR_VIEW', false))
                                <div class="mt-3 col-lg-6">
                                    <form action="{{ route(config('app.panel_prefix', 'panel') . '.settings.cache-management.clear-view') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i class="icon-eye"></i>
                                            پاک کردن حافظه پنهان قالب‌ها
                                        </button>
                                    </form>
                                </div>
                            @endcan
                            @can(config('permissions_list.CACHE_CLEAR_CONFIG', false))
                                <div class="mt-3 col-lg-6">
                                    <form action="{{ route(config('app.panel_prefix', 'panel') . '.settings.cache-management.clear-config') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i class="icon-settings"></i>
                                            پاک کردن حافظه پنهان کانفیگ‌ها
                                        </button>
                                    </form>
                                </div>
                            @endcan
                            @can(config('permissions_list.CACHE_CLEAR_ROUTE', false))
                                <div class="mt-3 col-lg-6">
                                    <form action="{{ route(config('app.panel_prefix', 'panel') . '.settings.cache-management.clear-route') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i class="icon-map"></i>
                                            پاک کردن حافظه پنهان مسیرها
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>
@endsection

