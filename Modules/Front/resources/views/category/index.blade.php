@extends('front::layouts.master', ['title' => $category->name . ' | ' . config('app.name')])

@section('content')
    <x-front-breadcrumbs>
        <li>دسته‌بندی‌ها</li>
        <li>{{ $category->name }}</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @include('front::category.partials.category-listing')

                    <x-front-listing-page-pagination :paginator="$articles" />
                </div><!-- Content Col end -->

                <div class="col-xs-12 col-md-4 row" style="padding: 0; margin: 0">
                    @include('front::partials.sidebar1', ['sidebarClasses' => 'col-xs-12'])

                    @include('front::partials.ads-sidebar1', ['sidebarClasses' => 'col-xs-12', 'sidebarStyles' => 'margin-top: 5rem;'])

                    @include('front::partials.sidebar2', ['sidebarClasses' => 'col-xs-12', 'sidebarStyles' => 'margin-top: 3rem;'])
                </div>
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
