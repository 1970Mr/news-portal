@extends('front::layouts.master')

@section('content')
    <x-front-breadcrumbs>
        <li><a href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a></li>
        <li>{{ $article->title }}</li>
    </x-front-breadcrumbs>

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="single-post">
                        @include('front::single-article.partials.page-title-area')

                        @include('front::single-article.partials.post-content-area')
                    </div><!-- Single post end -->

                    @include('front::single-article.partials.post-navigation')

                    @include('front::single-article.partials.author-box')

                    @include('front::single-article.partials.related-posts')

                    <!-- Post comment start -->
                    @include('front::single-article.partials.comments-area')

                    @include('front::single-article.partials.comment-form')
                </div><!-- Content Col end -->

                @include('front::partials.pages-sidebars')
            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('home/css/custom-single-article-style.css') }}">
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if($article->liked())
                submitLikeRequest('.post-unlike', '.unlike-form')
            @else
                submitLikeRequest('.post-like', '.like-form')
            @endif

            function submitLikeRequest(clickableClass, formClass) {
                const clickable = document.querySelector(clickableClass);
                const form = document.querySelector(formClass);
                clickable.addEventListener('click', function(event) {
                    event.preventDefault();
                    form.submit()
                })
            }
        });
    </script>
@endpush
