@extends('panel::layouts.master', ['title' => 'لیست نظرات'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست نظرات</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-people"></i>
                            لیست نظرات
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

                        <!-- Filter box -->
                        <div class="btn-group" rel="tooltip"
                             aria-label="فیلتر نظرات" data-bs-original-title="فیلتر نظرات">
                            <button type="button" class="btn btn-sm btn-default btn-round btn-info text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class=" fas fa-filter d-flex justify-content-center align-items-center"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($filters as $value)
                                    <li><a class="dropdown-item" href="{{ route('admin.comments.index', ['filter' => $value]) }}">{{ __($value) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive" style="overflow-x: auto !important;">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>متن کامنت</th>
                                <th>کامنت دهنده</th>
                                <th>مهمان</th>
                                <th>وضعیت نظر</th>
                                <th>پاسخ</th>
                                <th>مدل</th>
                                <th>تاریخ ایجاد</th>
                                @canany([config('permissions_list.ARTICLE_UPDATE', false), config('permissions_list.ARTICLE_DESTROY', false)])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                @can('show', $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ str($comment->comment)->limit(20) }}</td>
                                        <td>{{ $comment->commenterName() }}</td>
                                        <td class="{{ status_class(!$comment->isGuest()) }}">{{ $comment->isGuest() ? 'هست' : 'نیست' }}</td>
                                        <td class="{{ $commentService->setStatusClass($comment->status) }} status">{{ $comment->getStatus() }}</td>
                                        <td class="reply">{{ $comment->parent ? "{$comment->parent->commenterName()} (id: {$comment->parent->id})" : 'نیست' }}</td>
                                        <td>{{ $comment->commentable_type }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($comment->created_at)->format(config('common.datetime_format')) }}</td>
                                        @canany([config('permissions_list.ARTICLE_UPDATE', false), config('permissions_list.ARTICLE_DESTROY', false)])
                                            <td>
                                                <div class="d-flex gap-2">
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
                                                    @can(config('permissions_list.ARTICLE_UPDATE', false))
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="مشاهده نظر" data-bs-original-title="مشاهده نظر" href="{{ route('admin.comments.show', $comment->id) }}">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can(config('permissions_list.ARTICLE_DESTROY', false))
                                                        <x-common-delete-button :route="route('admin.comments.destroy', $comment->id)"/>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endcan
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $comments->links() }}

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

        th, .created-at, .reply, .status {
            white-space: nowrap;
        }
    </style>
@endpush
