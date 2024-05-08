@extends('front::layouts.master', ['title' => "{$article->category->name}: {$article->title}"])

@section('content')
    @include('article::front.single-article.partials.breadcrumb')

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="single-post">
                        @include('article::front.single-article.partials.page-title-area')

                        @include('article::front.single-article.partials.post-content-area')
                    </div><!-- Single post end -->

                    @include('article::front.single-article.partials.post-navigation')

                    @include('article::front.single-article.partials.author-box')

                    @include('article::front.single-article.partials.related-posts')

                    <!-- Post comment start -->
                    @include('article::front.single-article.partials.comments-area')

                    @include('article::front.single-article.partials.comment-form')
                </div><!-- Content Col end -->

                @include('front::partials.sidebar1')

                @include('front::partials.sidebar2')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection

@push('styles')
    @include('article::front.single-article.partials.custom-show-styles')
@endpush
