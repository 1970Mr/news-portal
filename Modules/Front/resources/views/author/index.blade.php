@extends('front::layouts.master', ['title' => "{$article->category->name}: {$article->title}"])

@section('content')
    <x-front-breadcrumbs>
        <li><a href="#">{{ $category->name }}</a></li>
        <li>{{ $article->title }}</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                </div><!-- Content Col end -->

                @include('front::partials.sidebar1')

                @include('front::partials.sidebar2')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
