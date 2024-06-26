@extends('panel::layouts.master', ['title' => 'پنل کاربری'])

@section('content')
    <x-common-breadcrumbs :noprefix="true">
        <li><a>پیشخوان</a></li>
    </x-common-breadcrumbs>

    {{-- Header Stats --}}
    @include('panel::content-sections/header-stats')

    <div class="row m-0 p-0">
        {{-- Site Visitors --}}
        @include('panel::content-sections.site-visitors')

        {{-- Articles Visits --}}
        @include('panel::content-sections.articles-visits')

        {{-- Articles --}}
        @include('panel::content-sections/articles')

        {{-- Categories --}}
        @include('panel::content-sections/categories')

        {{-- Tags --}}
        @include('panel::content-sections/tags')

        {{-- Images --}}
        @include('panel::content-sections/images')

        {{-- Comments --}}
        @include('panel::content-sections/comments')
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/jquery-incremental-counter/jquery.incremental-counter.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/morris.js/morris.min.js') }}"></script>
    <script>
        $(".counter-down").incrementalCounter({digits: 'auto'});
    </script>
    <script>
        Morris.Donut({
            element: 'site-visits-yearly',
            data: [
                {value: {{ $visitsCount['yearly'] }}, label: 'سال', formatted: '{{ $visitsCount['yearly'] }} نفر'},
                {value: {{ $visitsCount['monthly'] }}, label: 'ماه', formatted: '{{ $visitsCount['monthly'] }} نفر'},
                {value: {{ $visitsCount['weekly'] }}, label: 'هفته', formatted: '{{ $visitsCount['weekly'] }} نفر'},
            ],
            colors: [
                '#1e4572',
                '#597bbd',
                '#6da1f1',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });

        Morris.Donut({
            element: 'site-visits-daily',
            data: [
                {value: {{ $visitsCount['daily'] }}, label: 'روز', formatted: '{{ $visitsCount['daily'] }} نفر'},
                {value: {{ $visitsCount['ten_hours'] }}, label: 'ده ساعت', formatted: '{{ $visitsCount['ten_hours'] }} نفر'},
                {value: {{ $visitsCount['hourly'] }}, label: 'یک ساعت', formatted: '{{ $visitsCount['hourly'] }} نفر'},
            ],
            colors: [
                '#ffc107',
                '#e36100',
                '#d50000',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });
    </script>
    <script>
        Morris.Donut({
            element: 'articles-visits-yearly',
            data: [
                {value: {{ $articlesVisitsCount['year'] }}, label: 'سال', formatted: '{{ $articlesVisitsCount['year'] }} نفر'},
                {value: {{ $articlesVisitsCount['month'] }}, label: 'ماه', formatted: '{{ $articlesVisitsCount['month'] }} نفر'},
                {value: {{ $articlesVisitsCount['week'] }}, label: 'هفته', formatted: '{{ $articlesVisitsCount['week'] }} نفر'},
            ],
            colors: [
                '#1e4572',
                '#597bbd',
                '#6da1f1',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });

        Morris.Donut({
            element: 'articles-visits-daily',
            data: [
                {value: {{ $articlesVisitsCount['day'] }}, label: 'روز', formatted: '{{ $articlesVisitsCount['day'] }} نفر'},
                {value: {{ $articlesVisitsCount['10hours'] }}, label: 'ده ساعت', formatted: '{{ $articlesVisitsCount['10hours'] }} نفر'},
                {value: {{ $articlesVisitsCount['hour'] }}, label: 'یک ساعت', formatted: '{{ $articlesVisitsCount['hour'] }} نفر'},
            ],
            colors: [
                '#ffc107',
                '#e36100',
                '#d50000',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });
    </script>
@endpush

