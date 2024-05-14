@extends('front::layouts.master', ['title' => $author->full_name . ' | ' . config('app.name')])

@section('content')
    <x-front-breadcrumbs>
        <li>نویسندگان</li>
        <li>{{ $author->full_name }}</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @include('front::author.partials.author-box')

                    @include('front::author.partials.category-listing')

                    <x-front-listing-page-pagination :paginator="$articles" />
                </div><!-- Content Col end -->

                <div class="col-xs-4 row" style="padding: 0; margin: 0">
                    @include('front::partials.sidebar1', ['sidebarClasses' => 'col-xs-12'])

                    @include('front::partials.sidebar2', ['sidebarClasses' => 'col-xs-12', 'sidebarStyles' => 'margin-top: 5rem;'])
                </div>
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
