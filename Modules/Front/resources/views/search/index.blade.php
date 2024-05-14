@extends('front::layouts.master', ['title' => $searchText . ' | ' . config('app.name')])

@section('content')
    <x-front-breadcrumbs>
        <li>جستجو</li>
        <li>{{ $searchText }}</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @include('front::search.partials.category-listing')

                    <x-front-listing-page-pagination :paginator="$articles" />
                </div><!-- Content Col end -->

                <div class="col-xs-4 row">
                    @include('front::partials.sidebar1')

                    @include('front::partials.sidebar2')
                </div>
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
