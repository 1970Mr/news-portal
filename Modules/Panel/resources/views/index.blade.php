@extends('panel::layouts.master', ['title' => 'پنل کاربری'])

@section('content')

    <!-- BEGIN BREADCRUMB -->
    <div class="col-md-12">
        <div class="breadcrumb-box shadow">
            <ul class="breadcrumb">
                <li><a href="{{ asset('admin/dashboard.html') }}">پیشخوان</a></li>
            </ul>
            <div class="breadcrumb-left">
                شنبه، 1402/05/14
                <i class="icon-calendar"></i>
            </div><!-- /.breadcrumb-left -->
        </div><!-- /.breadcrumb-box -->
    </div><!-- /.col-md-12 -->
    <!-- END BREADCRUMB -->

    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="stat-box use-cyan shadow">
                    <a href="{{ asset('admin/#') }}">
                        <div class="stat">
                            <div class="counter-down" data-value="2048"></div>
                            <div class="h3">کاربر</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-people"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
            <div class="col-lg-3 col-6">
                <div class="stat-box use-blue shadow">
                    <a href="{{ asset('admin/#') }}">
                        <div class="stat">
                            <div class="counter-down" data-value="1024"></div>
                            <div class="h3">محصول</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-present"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
            <div class="col-lg-3 col-6">
                <div class="stat-box use-green shadow">
                    <a href="{{ asset('admin/#') }}">
                        <div class="stat">
                            <div class="counter-down" data-value="512"></div>
                            <div class="h3">سفارش ثبت شده</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-diamond"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
            <div class="col-lg-3 col-6">
                <div class="stat-box use-purple shadow">
                    <a href="{{ asset('admin/#') }}">
                        <div class="stat">
                            <div class="counter-down" data-value="256"></div>
                            <div class="h3">پیام</div>
                        </div><!-- /.stat -->
                        <div class="visual">
                            <i class="icon-bubbles"></i>
                        </div><!-- /.visual -->
                    </a>
                </div><!-- /.stat-box -->
            </div><!-- /.col-lg-3 -->
        </div><!-- /.row -->


    </div><!-- /.col-md-12 -->

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="portlet box shadow min-height-600">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-speech"></i>
                            دیدگاه ها
                        </h3>
                    </div><!-- /.portlet-title -->
                    <div class="buttons-box">
                        <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                           href="{{ asset('admin/#') }}"
                           aria-label="تمام صفحه" data-bs-original-title="تمام صفحه">
                            <i class="icon-size-fullscreen"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                        <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                           href="{{ asset('admin/#') }}"
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
