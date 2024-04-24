<!-- BEGIN HEADER -->
<div class="navbar navbar-fixed-top" id="main-navbar">
    <div class="header-right">
        <a href="{{ route('panel.index') }}" class="logo-con">
            <img src="{{ asset('admin/assets/images/logo.png') }}" class="img-responsive center-block"
                 alt="لوگو قالب مدیران">
        </a>
    </div><!-- /.header-right -->
    <div class="header-left">
        <div class="top-bar">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ asset('admin/#') }}" class="btn" id="toggle-sidebar">
                        <span class="menu"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('admin/#') }}" class="btn open" id="toggle-sidebar-top">
                        <i class="icon-user-following"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('admin/#') }}" class="btn" id="toggle-dark-mode">
                        <i class="icon-bulb"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a class="btn" id="toggle-fullscreen">
                        <i class="icon-size-fullscreen"></i>
                    </a>
                </li>
                <li class="dropdown dropdown-messages">
                    <a href="{{ asset('admin/#') }}" class="dropdown-toggle btn" data-bs-toggle="dropdown">
                        <i class="icon-envelope"></i>
                        <span class="badge badge-primary">
                                    4
                                </span>
                    </a>
                    <ul class="dropdown-menu custom-dropdown-menu has-scrollbar">
                        <li class="dropdown-header clearfix">
                                    <span class="float-start">
                                        <a href="{{ asset('admin/#') }}" rel="tooltip" title="خواندن همه"
                                           data-placement="left">
                                            <i class="icon-eye"></i>
                                        </a>
                                        شما 4 پیام تازه دارید.
                                    </span>
                        </li>
                        <li class="dropdown-body">
                            <ul class="dropdown-menu-list">
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">
                                                <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                     class="img-circle" alt="">
                                                سهراب سپهری
                                            </strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                ده دقیقه پیش
                                            </small>
                                        </p>
                                        <p>پیام پرمهرتان دریافت شد!</p>
                                    </a>
                                </li>
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">
                                                <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                     class="img-circle" alt="">
                                                شفیعی کدکنی
                                            </strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                سی دقیقه پیش
                                            </small>
                                        </p>
                                        <p>بسته ارسالی شما به دستم رسید.</p>
                                    </a>
                                </li>
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">
                                                <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                     class="img-circle" alt="">
                                                قیصر امین پور
                                            </strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                یک ساعت پیش
                                            </small>
                                        </p>
                                        <p>مجموعه آثار بنده را ببینید.</p>
                                    </a>
                                </li>
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">
                                                <img src="{{ asset('admin/assets/images/user/32.png') }}"
                                                     class="img-circle" alt="">
                                                مهدی اخوان ثالث
                                            </strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                دو ساعت پیش
                                            </small>
                                        </p>
                                        <p>با تشکر...</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer clearfix">
                            <a href="{{ asset('admin/#') }}">
                                <i class="icon-list fa-flip-horizontal"></i>
                                مشاهده همه پیام ها
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-announces">
                    <a href="{{ asset('admin/#') }}" class="dropdown-toggle btn" data-bs-toggle="dropdown">
                        <i class="icon-bell"></i>
                        <span class="badge badge-success">
                                    5
                        </span>
                    </a>
                    <ul class="dropdown-menu custom-dropdown-menu has-scrollbar">
                        <li class="dropdown-header clearfix">
                                    <span class="float-start">
                                        <a href="{{ asset('admin/#') }}" rel="tooltip" title="خواندن همه"
                                           data-placement="left">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <span>
                                            شما 8 اعلان تازه دارید.
                                        </span>
                                    </span>

                        </li>
                        <li class="dropdown-body">
                            <ul class="dropdown-menu-list">
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">عباس دوران</strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                21:30
                                            </small>
                                        </p>
                                        <p>بسته ارسالی شما به دستم رسید.</p>
                                    </a>
                                </li>
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">حسن باقری</strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                20:20
                                            </small>
                                        </p>
                                        <p>از محبت شما ممنونم.</p>
                                    </a>
                                </li>
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">مدیر کل</strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                19:20
                                            </small>
                                        </p>
                                        <p>سفارش شما ارسال گردید..</p>
                                    </a>
                                </li>
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">مدیر مالی</strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                17:40
                                            </small>
                                        </p>
                                        <p>درخواست فیش حقوقی</p>
                                    </a>
                                </li>
                                <li class="clearfix">
                                    <a href="{{ asset('admin/#') }}">
                                        <p class="clearfix">
                                            <strong class="float-start">ابراهیم همت</strong>
                                            <small class="float-end text-muted">
                                                <i class="icon-clock"></i>
                                                15:45
                                            </small>
                                        </p>
                                        <p>پیام های مرا دنبال کنید.</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-footer clearfix">
                            <a href="{{ asset('admin/#') }}">
                                <i class="icon-list fa-flip-horizontal"></i>
                                مشاهده همه اعلانات
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle dropdown-hove cursor-pointer d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <img src="{{ asset('storage/' . $currentUser->picture->file_path) }}" alt="{{ $currentUser->picture->alt_text }}"
                             class="object-fit-cover img-circle" style="width: 45px; height: 45px">
                        <span>{{ $currentUser->name }}</span>
                        <i class="icon-arrow-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                <i class="icon-note"></i>
                                ویرایش پروفایل
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.password.change') }}">
                                <i class="icon-key"></i>
                                تغییر رمز عبور
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.email.change') }}">
                                <i class="icon-envelope-letter"></i>
                                تغییر ایمیل
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ asset('admin/chat.html') }}">
                                <span class="badge badge-primary float-end"> 14 </span>
                                <i class="icon-envelope"></i>
                                تیکت های جدید
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="icon-power"></i>
                                خروج
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.navbar-left -->
        </div><!-- /.top-bar -->
    </div><!-- /.header-left -->
</div><!-- /.navbar -->
<!-- END HEADER -->
