@extends('panel::layouts.master', ['title' => 'مشاهده نظر'])

@section('content')

    <x-common-breadcrumbs>
        <li><a href="{{ route('admin.comments.index') }}">لیست نظرات</a></li>
        <li><a>مشاهده نظر</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="far fa-comment"></i>
                            مشاهده نظر
                        </h3>
                    </div><!-- /.portlet-title -->
                    <div class="buttons-box ltr">
                        <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                           aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                            <i class="icon-size-fullscreen d-flex justify-content-center align-items-center"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="comment-box">
                        <div class="comment">
                            <a href="#">
                                <img src="{{ $comment->commenterImageLink() }}" class="img-circle" alt="{{ $comment->commenterName() }}">
                                <span class="user">
                                    {{ ($comment->isGuest() ? 'کاربر مهمان: ' : '') . $comment->commenterName() }}
                                </span>
                            </a>
                            <span class="float-end text-muted">
                                <i class="icon-clock"></i>
                                <span class="rtl" style="display: inline-block">{{ jalalian()->forge($comment->created_at)->ago() }}</span>
                            </span>
                            <p class="my-3 mx-5">
                                <x-markdown class="my-2 mx-5">
                                    {{ $comment->comment }}
                                </x-markdown>
                            </p>
                        </div>
                        <div class="actions d-flex justify-content-end gap-1">
                            @can(config('permissions_list.ARTICLE_UPDATE', false))
                                @if ($comment->status !== get_class($comment)::APPROVED)
                                    <form action="{{ route('admin.comments.approve', $comment->id) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-sm btn-success btn-icon round d-flex justify-content-center align-items-center"
                                                rel="tooltip" aria-label="تایید نظر" data-bs-original-title="تایید نظر">
                                            <i class="icon-check"></i>
                                        </button>
                                    </form>
                                @endif
                            @endcan
                            @can(config('permissions_list.ARTICLE_UPDATE', false))
                                @if ($comment->status !== get_class($comment)::REJECTED)
                                    <form action="{{ route('admin.comments.reject', $comment->id) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-sm btn-warning btn-icon round d-flex justify-content-center align-items-center"
                                                rel="tooltip" aria-label="رد نظر" data-bs-original-title="رد نظر">
                                            <i class="icon-close"></i>
                                        </button>
                                    </form>
                                @endif
                            @endcan
                            @can(config('permissions_list.ARTICLE_DESTROY', false))
                                <x-common-delete-button :route="route('admin.comments.destroy', $comment->id)"/>
                            @endcan
                        </div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
        </div>

        @endsection

        @push('styles')
            <style>
                .page-link {
                    text-align: center;
                }

                .btn-info {
                    background-color: #03a9f4 !important;
                }

                th, .created-at {
                    white-space: nowrap;
                }
            </style>
    @endpush
