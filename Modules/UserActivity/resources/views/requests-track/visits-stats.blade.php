@extends('panel::layouts.master', ['title' => 'آمار بازدیدها'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>آمار بازدیدها</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-eye"></i>
                            آمار بازدیدها
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
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <!-- Visit counts table -->
                    <div class="visit-counts">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>بازه زمانی</th>
                                <th>تعداد بازدید</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>یک ساعت گذشته</td>
                                <td>{{ $visitCounts['hourly'] }}</td>
                            </tr>
                            <tr>
                                <td>ده ساعت گذشته</td>
                                <td>{{ $visitCounts['ten_hours'] }}</td>
                            </tr>
                            <tr>
                                <td>یک روز گذشته</td>
                                <td>{{ $visitCounts['daily'] }}</td>
                            </tr>
                            <tr>
                                <td>یک هفته گذشته</td>
                                <td>{{ $visitCounts['weekly'] }}</td>
                            </tr>
                            <tr>
                                <td>یک ماه گذشته</td>
                                <td>{{ $visitCounts['monthly'] }}</td>
                            </tr>
                            <tr>
                                <td>یک سال گذشته</td>
                                <td>{{ $visitCounts['yearly'] }}</td>
                            </tr>
                            <tr>
                                <td>کل بازدیدها</td>
                                <td>{{ $visitCounts['all'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
