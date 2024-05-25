@extends('front::layouts.master')

@section('content')
    <x-front-breadcrumbs>
        <li>تگ‌ها</li>
        <li>{{ $tag->name }}</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @include('front::tag.partials.category-listing')

                    <x-front-listing-page-pagination :paginator="$articles" />
                </div><!-- Content Col end -->

                @include('front::partials.pages-sidebars')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
