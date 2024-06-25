@extends('front::layouts.master')

@section('content')
    <x-front-breadcrumbs>
        <li>{{ $page->title }}</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="block category-listing">
                        <h3 class="block-title"><span>{{ $page->title }}</span></h3>

                        {!! $page->content !!}
                    </div>
                </div><!-- Content Col end -->

                @include('front::partials.pages-sidebars')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('home/css/custom-single-article-style.css') }}">
@endpush
