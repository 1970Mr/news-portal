@extends('panel::layouts.master', ['title' => 'لیست اخبار'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>لیست اخبار</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-people"></i>
                            لیست اخبار
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
                        @can(config('permissions_list.ARTICLE_STORE'))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route('article.create') }}"
                               aria-label="ایجاد خبر‌ جدید" data-bs-original-title="ایجاد خبر‌ جدید">
                                <i class="icon-plus d-flex justify-content-center align-items-center"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        @endcan
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>تصویر شاخص</th>
                                <th>عنوان</th>
                                <th>slug</th>
                                <th>توضیحات</th>
                                <th>کلمات کلیدی</th>
                                <th>کاربر</th>
                                <th>دسته‌بندی</th>
                                <th>تاریخ انتشار</th>
                                <th>وضعیت</th>
                                @canany([config('permissions_list.ARTICLE_UPDATE'), config('permissions_list.ARTICLE_DESTROY')])
                                    <th>عملیات</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}" width="100px" style="max-height: 90px">
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->slug }}</td>
                                    <td>{{ $article->description }}</td>
                                    <td>{{ $article->keywords }}</td>
                                    <td>{{ $article->user->name }}</td>
                                    <td>{{ $article->category->title }}</td>
                                    <td>{{ $article->published_at }}</td>
                                    <td class="{{ status_class($article->status) }}">{{ status_message($article->status) }}</td>
                                    @canany([config('permissions_list.ARTICLE_UPDATE'), config('permissions_list.ARTICLE_DESTROY')])
                                        <td class="d-flex gap-2">
                                            @can(config('permissions_list.ARTICLE_UPDATE'))
                                                <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                   rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('article.edit', $article->id) }}">
                                                    <i class="icon-pencil fa-flip-horizontal"></i>
                                                </a>
                                            @endcan

                                            @can(config('permissions_list.ARTICLE_DESTROY'))
                                                <x-common-delete-button :route="route('article.destroy', $article->id)" />
                                            @endcan

                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $articles->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .page-link{
            text-align: center;
        }

        th {
            white-space: nowrap;
        }
    </style>
@endpush