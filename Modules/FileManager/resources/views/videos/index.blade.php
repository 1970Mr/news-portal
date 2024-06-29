@extends('panel::layouts.master', ['title' => 'لیست ویدئوها'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست ویدئوها</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-film"></i>
                            لیست ویدئوها
                        </h3>
                        <form class="d-inline-block search-form">
                            <div class="input-group">
                                <button class="btn btn-secondary d-flex align-items-center" type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                                <input name="query" type="text" class="form-control p-2" placeholder="جستجو..." value="{{ request()->get('query') }}">
                                @foreach(request()->except(['query', 'page']) as $key => $value)
                                    <input name="{{ $key }}" type="hidden" value="{{ $value }}">
                                @endforeach
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
                        {{--                        @can('store', $videoClassName)--}}
                        <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                           href="{{ route(config('app.panel_prefix', 'panel') . '.videos.create') }}"
                           aria-label="ایجاد ویدئو جدید" data-bs-original-title="ایجاد ویدئو جدید">
                            <i class="icon-plus d-flex justify-content-center align-items-center"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                        {{--                        @endcan--}}

                        <!-- Filter box -->
                        {{--                        <div class="btn-group" rel="tooltip"--}}
                        {{--                             aria-label="فیلتر ویدئوها" data-bs-original-title="فیلتر ویدئوها">--}}
                        {{--                            <button type="button" class="btn btn-sm btn-default btn-round btn-info text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">--}}
                        {{--                                <i class=" fas fa-filter d-flex justify-content-center align-items-center"></i>--}}
                        {{--                                <div class="paper-ripple">--}}
                        {{--                                    <div class="paper-ripple__background"></div>--}}
                        {{--                                    <div class="paper-ripple__waves"></div>--}}
                        {{--                                </div>--}}
                        {{--                            </button>--}}
                        {{--                            <ul class="dropdown-menu">--}}
                        {{--                                @foreach($filters as $key => $value)--}}
                        {{--                                    <li><a class="dropdown-item"--}}
                        {{--                                           href="{{ route(--}}
                        {{--                                                                config('app.panel_prefix', 'panel') . '.videos.index',--}}
                        {{--                                                                ['filter' => $key] + request()->all()--}}
                        {{--                                                       ) }}">{{ $value }}</a></li>--}}
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
                                <th>تصویر بندانگشتی</th>
                                <th>مدت زمان</th>
                                <th>سایز</th>
                                <th>فرمت</th>
                                <th>کاربر آپلود کننده</th>
                                <th>تاریخ ایجاد</th>
                                {{--                                @can('operations', $videoClassName)--}}
                                <th>عملیات</th>
                                {{--                                @endcan--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $video)
                                @can('show', $video)
                                    <tr>
                                        <td>{{ $video->id }}</td>
                                        <td>
                                            <img src="{{ $video->getThumbnailUrl() }}" alt="{{ $video->name }}" width="100px" style="max-height: 90px">
                                        </td>
                                        <td>{{ $video->duration }}</td>
                                        <td class="ltr">{{ $video->video_size }}</td>
                                        <td>{{ $video->video_type }}</td>
                                        <td>{{ $video->user_full_name }}</td>
                                        <td class="ltr text-right nowrap">{{ jalalian()->forge($video->created_at)->format(config('common.datetime_format')) }}</td>
                                        {{--                                        @can('operations', $videoClassName)--}}
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can('update', $video)
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش"
                                                       href="{{ route(config('app.panel_prefix', 'panel') . '.videos.edit', $video->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can('destroy', $video)
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.videos.destroy', $video->id)"/>
                                                @endcan

                                                <div>
                                                    <form action="{{ route(config('app.panel_prefix', 'panel') . '.videos.destroy-thumbnail', $video->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-secondary btn-icon round d-flex justify-content-center align-items-center"
                                                                rel="tooltip" aria-label="حذف تصویر بندانگشتی شخصی" data-bs-original-title="حذف تصویر بندانگشتی شخصی">
                                                            <i class="fas fa-trash-arrow-up fa-flip-horizontal"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        {{--                                        @endcan--}}
                                    </tr>
                                @endcan
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $videos->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
