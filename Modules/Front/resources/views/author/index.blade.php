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

                    <div class="paging">
                        <ul class="pagination">
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">بعدی</a></li>
                            <li>
                                <span class="page-numbers">صفحه 1 از 2</span>
                            </li>
                        </ul>
                    </div><!-- Paging end -->
                </div><!-- Content Col end -->

                @include('front::partials.sidebar1')

                @include('front::partials.sidebar2')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection
