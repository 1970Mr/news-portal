@extends('panel::layouts.master', ['title' => 'پنل کاربری'])

@section('content')
    <x-common-breadcrumbs :noprefix="true">
        <li><a>پیشخوان</a></li>
    </x-common-breadcrumbs>

    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="stat-box use-cyan shadow">
                    <a href="{{ route(config('app.panel_prefix', 'panel') . '.users.index') }}">
                        <div class="stat">
                            <div class="counter-down" data-value="{{ $dataCounts['users_count'] }}"></div>
                            <div class="h3">کاربران</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-people"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
            <div class="col-lg-3 col-6">
                <div class="stat-box use-blue shadow">
                    <a href="{{ route(config('app.panel_prefix', 'panel') . '.articles.index') }}">
                        <div class="stat">
                            <div class="counter-down" data-value="{{ $dataCounts['articles_count'] }}"></div>
                            <div class="h3">اخبار</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-globe"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
            <div class="col-lg-3 col-6">
                <div class="stat-box use-green shadow">
                    <a href="{{ route(config('app.panel_prefix', 'panel') . '.categories.index') }}">
                        <div class="stat">
                            <div class="counter-down" data-value="{{ $dataCounts['categories_count'] }}"></div>
                            <div class="h3">دسته‌بندی‌ها</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-grid"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
            <div class="col-lg-3 col-6">
                <div class="stat-box use-purple shadow">
                    <a>
                        <div class="stat">
                            <div class="counter-down" data-value="{{ $visitorsCount['all'] }}"></div>
                            <div class="h3">بازدیدکنندگان</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-eye"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
        </div><!-- /.row -->


    </div><!-- /.col-md-12 -->

    <div class="row m-0 p-0">
        {{-- Visitors --}}
        @can(config('permissions_list.VIEW_AVERAGE_VISITORS', false))
            <div class="col-12 col-md-6">
                <div class="portlet box shadow min-height-500">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-pie-chart"></i>
                                میانگین بازدیدکنندگان (سالانه)
                            </h3>
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                               aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                                <i class="icon-size-fullscreen"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                               aria-label="بستن" data-bs-original-title="بستن">
                                <i class="icon-trash"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        </div><!-- /.buttons-box -->
                    </div><!-- /.portlet-heading -->
                    <div class="portlet-body">
                        <div id="donut" class="morris-chart"></div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
            <div class="col-12 col-md-6">
                <div class="portlet box shadow min-height-500">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-pie-chart"></i>
                                میانگین بازدیدکنندگان (روزانه)
                            </h3>
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                               aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                                <i class="icon-size-fullscreen"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                               aria-label="بستن" data-bs-original-title="بستن">
                                <i class="icon-trash"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        </div><!-- /.buttons-box -->
                    </div><!-- /.portlet-heading -->
                    <div class="portlet-body">
                        <div id="donut2" class="morris-chart"></div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
        @endcan

        {{-- Articles --}}
        @can(config('permissions_list.ARTICLE_INDEX', false))
            <div class="col-12">
                <div class="portlet box shadow min-height-500">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-globe"></i>
                                اخبار
                            </h3>
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                               aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                                <i class="icon-size-fullscreen"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                               aria-label="بستن" data-bs-original-title="بستن">
                                <i class="icon-trash"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        </div><!-- /.buttons-box -->
                    </div><!-- /.portlet-heading -->
                    <div class="portlet-body">
                        <div class="table-responsive overflow-x-auto">
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
                                    <th>تگ(ها)</th>
                                    <th>تعداد لایک</th>
                                    <th>تاریخ انتشار</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>انتخاب سردبیر</th>
                                    <th>خبر داغ</th>
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
                                        <td class="min-w-10">{{ $article->keywords }}</td>
                                        <td>{{ $article->user->full_name }}</td>
                                        <td>{{ $article->category->name }}</td>
                                        <td class="min-w-10">{{ nullable_value($article->tagNames()) }}</td>
                                        <td>{{ $article->likeCount }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($article->published_at)->format(config('common.datetime_format')) }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($article->created_at)->format(config('common.datetime_format')) }}</td>
                                        <td class="{{ status_class($article->editor_choice) }}">{{ status_message($article->editor_choice) }}</td>
                                        <td class="{{ status_class($article->isHot()) }}">{{ status_message($article->isHot()) }}</td>
                                        <td class="{{ status_class($article->status) }}">{{ status_message($article->status) }}</td>
                                        @canany([config('permissions_list.ARTICLE_UPDATE'), config('permissions_list.ARTICLE_DESTROY')])
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can(config('permissions_list.ARTICLE_UPDATE', false))
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش"
                                                           href="{{ route(config('app.panel_prefix', 'panel') . '.articles.edit', $article->id) }}">
                                                            <i class="icon-pencil fa-flip-horizontal"></i>
                                                        </a>
                                                    @endcan

                                                    @can(config('permissions_list.ARTICLE_DESTROY', false))
                                                        <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.articles.destroy', $article->id)"/>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
        @endcan

        {{-- Categories --}}
        @can(config('permissions_list.CATEGORY_INDEX', false))
            <div class="col-12">
                <div class="portlet box shadow min-height-500">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-grid"></i>
                                دسته‌بندی‌ها
                            </h3>
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                               aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                                <i class="icon-size-fullscreen"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                               aria-label="بستن" data-bs-original-title="بستن">
                                <i class="icon-trash"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        </div><!-- /.buttons-box -->
                    </div><!-- /.portlet-heading -->
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تصویر شاخص</th>
                                    <th>نام</th>
                                    <th>slug</th>
                                    <th>توضیحات</th>
                                    <th>دسته‌بندی والد</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>وضعیت</th>
                                    @canany([config('permissions_list.CATEGORY_UPDATE'), config('permissions_list.CATEGORY_DESTROY')])
                                        <th>عملیات</th>
                                    @endcanany
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $category->image->file_path) }}" alt="{{ $category->image->alt_text }}" width="100px" style="max-height: 90px">
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->parentCategoryTitle() }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($category->created_at)->format(config('common.datetime_format')) }}</td>
                                        <td class="{{ status_class($category->status) }}">{{ status_message($category->status) }}</td>
                                        @canany([config('permissions_list.CATEGORY_UPDATE'), config('permissions_list.CATEGORY_DESTROY')])
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can(config('permissions_list.CATEGORY_UPDATE', false))
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش"
                                                           href="{{ route(config('app.panel_prefix', 'panel') . '.categories.edit', $category->id) }}">
                                                            <i class="icon-pencil fa-flip-horizontal"></i>
                                                        </a>
                                                    @endcan

                                                    @can(config('permissions_list.CATEGORY_DESTROY', false))
                                                        <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.categories.destroy', $category->id)"/>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
        @endcan

        {{-- Tags --}}
        @can(config('permissions_list.TAG_INDEX', false))
            <div class="col-12">
                <div class="portlet box shadow min-height-500">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-tag"></i>
                                تگ‌ها
                            </h3>
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                               aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                                <i class="icon-size-fullscreen"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                               aria-label="بستن" data-bs-original-title="بستن">
                                <i class="icon-trash"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        </div><!-- /.buttons-box -->
                    </div><!-- /.portlet-heading -->
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>slug</th>
                                    <th>توضیحات</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>موضوع داغ</th>
                                    <th>وضعیت</th>
                                    @canany([config('permissions_list.TAG_UPDATE'), config('permissions_list.TAG_DESTROY')])
                                        <th>عملیات</th>
                                    @endcanany
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->slug }}</td>
                                        <td>{{ $tag->description }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($tag->created_at)->format(config('common.datetime_format')) }}</td>
                                        <td class="{{ status_class($tag->isHot()) }}">{{ status_message($tag->isHot()) }}</td>
                                        <td class="{{ status_class($tag->status) }}">{{ status_message($tag->status) }}</td>
                                        @canany([config('permissions_list.TAG_UPDATE'), config('permissions_list.TAG_DESTROY')])
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can(config('permissions_list.TAG_UPDATE', false))
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش"
                                                           href="{{ route(config('app.panel_prefix', 'panel') . '.tags.edit', $tag->id) }}">
                                                            <i class="icon-pencil fa-flip-horizontal"></i>
                                                        </a>
                                                    @endcan

                                                    @can(config('permissions_list.TAG_DESTROY', false))
                                                        <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.tags.destroy', $tag->id)"/>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
        @endcan

        {{-- Images --}}
        @can(config('permissions_list.IMAGE_INDEX', false))
            <div class="col-12">
                <div class="portlet box shadow min-height-500">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-picture"></i>
                                تصاویر
                            </h3>
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                               aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                                <i class="icon-size-fullscreen"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                               aria-label="بستن" data-bs-original-title="بستن">
                                <i class="icon-trash"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        </div><!-- /.buttons-box -->
                    </div><!-- /.portlet-heading -->
                    <div class="portlet-body">
                        <div class="table-responsive" style="overflow-x: auto !important;">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تصویر</th>
                                    <th>مسیر تصویر</th>
                                    <th>متن جایگزین</th>
                                    <th>کاربر آپلود کننده</th>
                                    <th>تاریخ ایجاد</th>
                                    @can('operations', $imageClassName)
                                        <th>عملیات</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($images as $image)
                                    @can('show', $image)
                                        <tr>
                                            <td>{{ $image->id }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" width="100px" style="max-height: 90px">
                                            </td>
                                            <td>{{ $image->file_path }}</td>
                                            <td>{{ nullable_value($image->alt_text) }}</td>
                                            <td>{{ $image->user_full_name }}</td>
                                            <td class="ltr text-right created-at">{{ jalalian()->forge($image->created_at)->format(config('common.datetime_format')) }}</td>
                                            @can('operations', $imageClassName)
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        @can('update', $image)
                                                            <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                               rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش"
                                                               href="{{ route(config('app.panel_prefix', 'panel') . '.images.edit', $image->id) }}">
                                                                <i class="icon-pencil fa-flip-horizontal"></i>
                                                            </a>
                                                        @endcan

                                                        @can('destroy', $image)
                                                            <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.images.destroy', $image->id)"/>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endcan
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
        @endcan

        {{-- Comments --}}
        @can(config('permissions_list.COMMENT_INDEX', false))
            <div class="col-12">
                <div class="portlet box shadow min-height-500">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-bubbles"></i>
                                نظرات
                            </h3>
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                               aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                                <i class="icon-size-fullscreen"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                               aria-label="بستن" data-bs-original-title="بستن">
                                <i class="icon-trash"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
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
                                    @canany([
                                        config('permissions_list.COMMENT_APPROVE', false),
                                        config('permissions_list.COMMENT_REJECT', false),
                                        config('permissions_list.COMMENT_SHOW', false),
                                        config('permissions_list.COMMENT_DESTROY', false)
                                    ])
                                        <th>عملیات</th>
                                    @endcanany
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ str($comment->comment)->limit(20) }}</td>
                                        <td>{{ $comment->commenterName() }}</td>
                                        <td class="{{ status_class(!$comment->isGuest()) }}">{{ $comment->isGuest() ? 'هست' : 'نیست' }}</td>
                                        <td class="{{ $comment->setStatusClass() }} status">{{ $comment->getStatus() }}</td>
                                        <td class="reply">{{ $comment->parent ? "{$comment->parent->commenterName()} (id: {$comment->parent->id})" : 'نیست' }}</td>
                                        <td>{{ $comment->commentable_type }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($comment->created_at)->format(config('common.datetime_format')) }}</td>
                                        @canany([
                                            config('permissions_list.COMMENT_APPROVE', false),
                                            config('permissions_list.COMMENT_REJECT', false),
                                            config('permissions_list.COMMENT_SHOW', false),
                                            config('permissions_list.COMMENT_DESTROY', false)
                                        ])
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can(config('permissions_list.COMMENT_APPROVE', false))
                                                        @if ($comment->status !== get_class($comment)::APPROVED)
                                                            <form action="{{ route(config('app.panel_prefix', 'panel') . '.comments.approve', $comment->id) }}" method="post">
                                                                @csrf
                                                                @method('patch')
                                                                <button class="btn btn-sm btn-success btn-icon round d-flex justify-content-center align-items-center"
                                                                        rel="tooltip" aria-label="تایید نظر" data-bs-original-title="تایید نظر">
                                                                    <i class="icon-check"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan
                                                    @can(config('permissions_list.COMMENT_REJECT', false))
                                                        @if ($comment->status !== get_class($comment)::REJECTED)
                                                            <form action="{{ route(config('app.panel_prefix', 'panel') . '.comments.reject', $comment->id) }}" method="post">
                                                                @csrf
                                                                @method('patch')
                                                                <button class="btn btn-sm btn-warning btn-icon round d-flex justify-content-center align-items-center"
                                                                        rel="tooltip" aria-label="رد نظر" data-bs-original-title="رد نظر">
                                                                    <i class="icon-close"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan
                                                    @can(config('permissions_list.COMMENT_SHOW', false))
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="مشاهده نظر" data-bs-original-title="مشاهده نظر"
                                                           href="{{ route(config('app.panel_prefix', 'panel') . '.comments.show', $comment->id) }}">
                                                            <i class="icon-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can(config('permissions_list.COMMENT_DESTROY', false))
                                                        <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.comments.destroy', $comment->id)"/>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.portlet-body -->
                </div><!-- /.portlet -->
            </div>
        @endcan
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/jquery-incremental-counter/jquery.incremental-counter.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/morris.js/morris.min.js') }}"></script>
    <script>
        $(".counter-down").incrementalCounter({digits: 'auto'});
    </script>
    <script>
        Morris.Donut({
            element: 'donut',
            data: [
                {value: {{ $visitorsCount['year'] }}, label: 'سال', formatted: '{{ $visitorsCount['year'] }} نفر'},
                {value: {{ $visitorsCount['month'] }}, label: 'ماه', formatted: '{{ $visitorsCount['month'] }} نفر'},
                {value: {{ $visitorsCount['week'] }}, label: 'هفته', formatted: '{{ $visitorsCount['week'] }} نفر'},
            ],
            colors: [
                '#1e4572',
                '#597bbd',
                '#6da1f1',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });

        Morris.Donut({
            element: 'donut2',
            data: [
                {value: {{ $visitorsCount['day'] }}, label: 'روز', formatted: '{{ $visitorsCount['day'] }} نفر'},
                {value: {{ $visitorsCount['10hours'] }}, label: 'ده ساعت', formatted: '{{ $visitorsCount['10hours'] }} نفر'},
                {value: {{ $visitorsCount['hour'] }}, label: 'یک ساعت', formatted: '{{ $visitorsCount['hour'] }} نفر'},
            ],
            colors: [
                '#ffc107',
                '#e36100',
                '#d50000',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });
    </script>
@endpush

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

        .min-w-10 {
            min-width: 10rem;
        }
    </style>
@endpush
