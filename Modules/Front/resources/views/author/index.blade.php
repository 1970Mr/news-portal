@extends('front::layouts.master')

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

                @include('front::partials.pages-sidebars')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
