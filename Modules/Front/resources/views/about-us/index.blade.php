@extends('front::layouts.master', ['title' => 'درباره ما' . ' | ' . config('app.name')])

@section('content')
    <x-front-breadcrumbs>
        <li>درباره ما</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @include('front::about-us.partials.content')
                </div><!-- Content Col end -->

                <div class="col-xs-4 row" style="padding: 0; margin: 0">
                    @include('front::partials.sidebar1', ['sidebarClasses' => 'col-xs-12'])

                    @include('front::partials.sidebar2', ['sidebarClasses' => 'col-xs-12', 'sidebarStyles' => 'margin-top: 5rem;'])
                </div>
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection

@push('styles')
    <style>
        figure {
            max-width: 100%;
        }

        figure > img {
            max-width: 100%;
            max-height: 60rem;
            height: auto;
        }

        .about-us-content {
            padding: 0;
            margin: 0;
        }

        .about-us-content .secondary-font {
            padding: 0;
            margin: 0 0 3rem;

        }
    </style>
@endpush
