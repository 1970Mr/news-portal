@extends('panel::layouts.master', ['title' => 'پنل کاربری'])

@section('content')
    <x-common-breadcrumbs :noprefix="true">
        <li><a>پیشخوان</a></li>
    </x-common-breadcrumbs>

    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="stat-box use-cyan shadow">
                    <a href="{{ route('user.index') }}">
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
                    <a href="{{ route('article.index') }}">
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
                    <a href="{{ route('category.index') }}">
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
                            <div class="counter-down" data-value="256"></div>
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
                                <th>تگ(ها)</th>
                                <th>تاریخ انتشار</th>
                                <th>تاریخ ایجاد</th>
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
                                        <img src="{{ asset('storage/' . $article->image->file_path) }}" alt="{{ $article->image->alt_text }}" width="100px"
                                             style="max-height: 90px">
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->slug }}</td>
                                    <td>{{ $article->description }}</td>
                                    <td>{{ $article->keywords }}</td>
                                    <td>{{ $article->user->name }}</td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>{{ nullable_value($article->tagNames()) }}</td>
                                    <td class="ltr text-right created-at">{{ jalalian()->forge($article->published_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="ltr text-right created-at">{{ jalalian()->forge($article->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($article->status) }}">{{ status_message($article->status) }}</td>
                                    @canany([config('permissions_list.ARTICLE_UPDATE'), config('permissions_list.ARTICLE_DESTROY')])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.ARTICLE_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('article.edit', $article->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.ARTICLE_DESTROY', false))
                                                    <x-common-delete-button :route="route('article.destroy', $article->id)"/>
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
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->parentCategoryTitle() }}</td>
                                    <td class="ltr text-right created-at">{{ jalalian()->forge($category->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($category->status) }}">{{ status_message($category->status) }}</td>
                                    @canany([config('permissions_list.CATEGORY_UPDATE'), config('permissions_list.CATEGORY_DESTROY')])
                                        <td class="d-flex gap-2">
                                            @can(config('permissions_list.CATEGORY_UPDATE', false))
                                                <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                   rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('category.edit', $category->id) }}">
                                                    <i class="icon-pencil fa-flip-horizontal"></i>
                                                </a>
                                            @endcan

                                            @can(config('permissions_list.CATEGORY_DESTROY', false))
                                                <x-common-delete-button :route="route('category.destroy', $category->id)"/>
                                            @endcan

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
                                    <td class="{{ status_class($tag->status) }}">{{ status_message($tag->status) }}</td>
                                    @canany([config('permissions_list.TAG_UPDATE'), config('permissions_list.TAG_DESTROY')])
                                        <td class="d-flex gap-2">
                                            @can(config('permissions_list.TAG_UPDATE', false))
                                                <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                   rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('tag.edit', $tag->id) }}">
                                                    <i class="icon-pencil fa-flip-horizontal"></i>
                                                </a>
                                            @endcan

                                            @can(config('permissions_list.TAG_DESTROY', false))
                                                <x-common-delete-button :route="route('tag.destroy', $tag->id)"/>
                                            @endcan

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
                                        <td>{{ $image->user_name }}</td>
                                        <td class="ltr text-right created-at">{{ jalalian()->forge($image->created_at)->format(config('common.datetime_format')) }}</td>
                                        @can('operations', $imageClassName)
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can('update', $image)
                                                        <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                           rel="tooltip" aria-label="ویرایش" data-bs-original-title="ویرایش" href="{{ route('image.edit', $image->id) }}">
                                                            <i class="icon-pencil fa-flip-horizontal"></i>
                                                        </a>
                                                    @endcan

                                                    @can('destroy', $image)
                                                        <x-common-delete-button :route="route('image.destroy', $image->id)"/>
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

        <div class="col-12 col-md-6">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-speech"></i>
                            دیدگاه ها
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
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab"
                               href="{{ asset('admin/#tab1') }}"
                               aria-selected="true"
                               role="tab">خوانده نشده</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="{{ asset('admin/#tab2') }}"
                               aria-selected="false"
                               tabindex="-1" role="tab">تائید شده</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="{{ asset('admin/#tab3') }}"
                               aria-selected="false"
                               tabindex="-1" role="tab">رد شده</a>
                        </li>
                        <li class="float-end">
                            <a class="float-end p-b-0" href="{{ asset('admin/#') }}">همه دیدگاه ها</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active fade show" role="tabpanel">
                            <div class="comments-box">
                                <div class="comment-box">
                                    <div class="comment">
                                        <a href="{{ asset('admin/#') }}">
                                            <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                 class="img-circle" alt="">
                                            <span class="user">
                                                                        حمید آفرینش فر
                                                                    </span>
                                        </a>
                                        <span class="float-end text-muted">
                                                                    15:50 ، 3 تیر
                                                                    <i class="icon-clock"></i>
                                                                </span>
                                        <p>
                                            قالب مدیران یک قالب کاملا ایرانی و بومی است که تمام پروسه طراحی
                                            و
                                            پیاده سازی آن توسط متخصصان داخلی انجام شده است.
                                        </p>
                                    </div><!-- /.comment -->
                                    <div class="actions">
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-primary"
                                           rel="tooltip" aria-label="مشاهده"
                                           data-bs-original-title="مشاهده">
                                            <i class="icon-eye"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-info" rel="tooltip"
                                           aria-label="پذیرش" data-bs-original-title="پذیرش">
                                            <i class="icon-check"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-warning"
                                           rel="tooltip" aria-label="عدم پذیرش"
                                           data-bs-original-title="عدم پذیرش">
                                            <i class="icon-close"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-danger"
                                           rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                            <i class="icon-trash"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                    </div><!-- /.actions -->
                                </div><!-- /.comment-box -->
                                <div class="comment-box">
                                    <div class="comment">
                                        <a href="{{ asset('admin/#') }}">
                                            <img src="{{ asset('admin/assets/images/user/customer.png') }}"
                                                 class="img-circle"
                                                 alt="">
                                            <span class="user">
                                                                        بهزاد
                                                                    </span>
                                        </a>
                                        <span class="float-end text-muted">
                                                                    15:55 ، 3 تیر
                                                                    <i class="icon-clock"></i>
                                                                </span>
                                        <p>
                                            با سلام. آیا پلاگین های انتخاب تاریخ، شمسی شده اند؟
                                        </p>
                                    </div><!-- /.comment -->
                                    <div class="actions">
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-primary"
                                           rel="tooltip" aria-label="مشاهده"
                                           data-bs-original-title="مشاهده">
                                            <i class="icon-eye"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-info" rel="tooltip"
                                           aria-label="پذیرش" data-bs-original-title="پذیرش">
                                            <i class="icon-check"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-warning"
                                           rel="tooltip" aria-label="عدم پذیرش"
                                           data-bs-original-title="عدم پذیرش">
                                            <i class="icon-close"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-danger"
                                           rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                            <i class="icon-trash"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                    </div><!-- /.actions -->
                                </div><!-- /.comment-box -->
                                <div class="comment-box">
                                    <div class="comment">
                                        <a href="{{ asset('admin/#') }}">
                                            <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                 class="img-circle" alt="">
                                            <span class="user">
                                                                        حمید آفرینش فر
                                                                    </span>
                                        </a>
                                        <span class="float-end text-muted">
                                                                    16:10 ، 3 تیر
                                                                    <i class="icon-clock"></i>
                                                                </span>
                                        <p>
                                            سلام. بله حتما. علاوه بر آن پلاگین ویرایش متن، نمایش نقشه ایران،
                                            نمودار ها و... هم فارسی و راستچین هستند.
                                        </p>
                                    </div><!-- /.comment -->
                                    <div class="actions">
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-primary"
                                           rel="tooltip" aria-label="مشاهده"
                                           data-bs-original-title="مشاهده">
                                            <i class="icon-eye"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-info" rel="tooltip"
                                           aria-label="پذیرش" data-bs-original-title="پذیرش">
                                            <i class="icon-check"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-warning"
                                           rel="tooltip" aria-label="عدم پذیرش"
                                           data-bs-original-title="عدم پذیرش">
                                            <i class="icon-close"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-danger"
                                           rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                            <i class="icon-trash"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                    </div><!-- /.actions -->
                                </div><!-- /.comment-box -->
                            </div><!-- /.comments-box -->
                        </div><!-- /.tab-pane -->
                        <div id="tab2" class="tab-pane fade" role="tabpanel">
                            <div class="comments-box">
                                <div class="comment-box">
                                    <div class="comment">
                                        <a href="{{ asset('admin/#') }}">
                                            <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                 class="img-circle" alt="">
                                            <span class="user">
                                                                        حمید آفرینش فر
                                                                    </span>
                                        </a>
                                        <span class="float-end text-muted">
                                                                    15:50 ، 3 تیر
                                                                    <i class="icon-clock"></i>
                                                                </span>
                                        <p>
                                            قالب مدیران یک قالب کاملا ایرانی و بومی است که تمام پروسه طراحی
                                            و
                                            پیاده سازی آن توسط متخصصان داخلی انجام شده است.
                                        </p>
                                    </div><!-- /.comment -->
                                    <div class="actions">
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-primary"
                                           rel="tooltip" aria-label="مشاهده"
                                           data-bs-original-title="مشاهده">
                                            <i class="icon-eye"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-warning"
                                           rel="tooltip" aria-label="عدم پذیرش"
                                           data-bs-original-title="عدم پذیرش">
                                            <i class="icon-close"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-danger"
                                           rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                            <i class="icon-trash"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                    </div><!-- /.actions -->
                                </div><!-- /.comment-box -->
                                <div class="comment-box">
                                    <div class="comment">
                                        <a href="{{ asset('admin/#') }}">
                                            <img src="{{ asset('admin/assets/images/user/customer.png') }}"
                                                 class="img-circle"
                                                 alt="">
                                            <span class="user">
                                                                        بهزاد
                                                                    </span>
                                        </a>
                                        <span class="float-end text-muted">
                                                                    15:55 ، 3 تیر
                                                                    <i class="icon-clock"></i>
                                                                </span>
                                        <p>
                                            با سلام. آیا پلاگین های انتخاب تاریخ، شمسی شده اند؟
                                        </p>
                                    </div><!-- /.comment -->
                                    <div class="actions">
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-primary"
                                           rel="tooltip" aria-label="مشاهده"
                                           data-bs-original-title="مشاهده">
                                            <i class="icon-eye"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-warning"
                                           rel="tooltip" aria-label="عدم پذیرش"
                                           data-bs-original-title="عدم پذیرش">
                                            <i class="icon-close"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-danger"
                                           rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                            <i class="icon-trash"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                    </div><!-- /.actions -->
                                </div><!-- /.comment-box -->
                                <div class="comment-box">
                                    <div class="comment">
                                        <a href="{{ asset('admin/#') }}">
                                            <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                 class="img-circle" alt="">
                                            <span class="user">
                                                                        حمید آفرینش فر
                                                                    </span>
                                        </a>
                                        <span class="float-end text-muted">
                                                                    16:10 ، 3 تیر
                                                                    <i class="icon-clock"></i>
                                                                </span>
                                        <p>
                                            سلام. بله حتما. علاوه بر آن پلاگین ویرایش متن، نمایش نقشه ایران،
                                            نمودار ها و... هم فارسی و راستچین هستند.
                                        </p>
                                    </div><!-- /.comment -->
                                    <div class="actions">
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-primary"
                                           rel="tooltip" aria-label="مشاهده"
                                           data-bs-original-title="مشاهده">
                                            <i class="icon-eye"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-warning"
                                           rel="tooltip" aria-label="عدم پذیرش"
                                           data-bs-original-title="عدم پذیرش">
                                            <i class="icon-close"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-danger"
                                           rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                            <i class="icon-trash"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                    </div><!-- /.actions -->
                                </div><!-- /.comment-box -->
                            </div><!-- /.comments-box -->
                        </div><!-- /.tab-pane -->
                        <div id="tab3" class="tab-pane fade" role="tabpanel">
                            <div class="comments-box">
                                <div class="comment-box">
                                    <div class="comment">
                                        <a href="{{ asset('admin/#') }}">
                                                                    <span class="user">
                                                                        کاربر ناشناس
                                                                    </span>
                                        </a>
                                        <span class="float-end text-muted">
                                                                    15:30 ، 3 تیر
                                                                    <i class="icon-clock"></i>
                                                                </span>
                                        <p>
                                            سلام. لطفا به سایت من هم سر بزنید...
                                        </p>
                                    </div><!-- /.comment -->
                                    <div class="actions">
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-primary"
                                           rel="tooltip" aria-label="مشاهده"
                                           data-bs-original-title="مشاهده">
                                            <i class="icon-eye"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-info" rel="tooltip"
                                           aria-label="پذیرش" data-bs-original-title="پذیرش">
                                            <i class="icon-check"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                        <a href="{{ asset('admin/#') }}"
                                           class="btn btn-round btn-icon btn-sm btn-danger"
                                           rel="tooltip" aria-label="حذف" data-bs-original-title="حذف">
                                            <i class="icon-trash"></i>
                                            <div class="paper-ripple">
                                                <div class="paper-ripple__background"></div>
                                                <div class="paper-ripple__waves"></div>
                                            </div>
                                        </a>
                                    </div><!-- /.actions -->
                                </div><!-- /.comment-box -->
                            </div><!-- /.comments-box -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection

@push('scripts')
    <script
        src="{{ asset('admin/assets/plugins/jquery-incremental-counter/jquery.incremental-counter.min.js') }}"></script>
    <script>
        $(".counter-down").incrementalCounter({digits: 'auto'});
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
    </style>
@endpush
