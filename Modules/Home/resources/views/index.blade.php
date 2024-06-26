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

    @include('home::partials.ads-content1')

    @include('home::partials.content2')

    @include('home::partials.ads-content2')

    @include('home::partials.content3')

    @include('home::partials.ads-content3')

    <section class="block-wrapper pb-3">
        <div class="container">
            <div class="row">
                @include('home::partials.content4')

                @include('front::partials.sidebar2', ['sidebar_classes' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12', 'sidebar_style' => 'margin-top', 0])
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Fourth block end -->

    @include('home::partials.ads-content4')
@endsection
