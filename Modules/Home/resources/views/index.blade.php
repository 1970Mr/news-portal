@extends('front::layouts.master')

@section('content')
    @include('home::partials.trending-post')

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                @include('home::partials.content1')

                @include('front::partials.sidebar1', ['sidebar_classes' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12'])
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->

    @include('home::partials.content2')

    @include('home::partials.content3')

    <section class="block-wrapper pb-3">
        <div class="container">
            <div class="row">
                @include('home::partials.content4')

                @include('front::partials.sidebar2')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Fourth block end -->
@endsection

@push('styles')
    <style>
        .third-img-category {
            height: 25rem;
            object-fit: cover;
        }

        .post-thumb img {
            max-height: 30rem;
        }
    </style>
@endpush
