@extends('home::layouts.master', ['title' => 'News Site | سایت خبری'])

@section('content')
    @include('home::partials.trending-post')

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                @include('home::partials.content1')

                @include('home::partials.sidebar1')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->

    @include('home::partials.content2')

    @include('home::partials.content3')

    <section class="block-wrapper pb-3">
        <div class="container">
            <div class="row">
                @include('home::partials.content4')

                @include('home::partials.sidebar2')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Fourth block end -->
@endsection

