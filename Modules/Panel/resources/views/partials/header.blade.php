<!-- BEGIN HEADER -->
<div class="navbar navbar-fixed-top" id="main-navbar">
    <div class="header-right">
        <a href="{{ route('panel.index') }}" class="logo-con">
            <img src="{{ asset('admin/assets/images/logo.png') }}" class="img-responsive center-block"
                 alt="لوگو سایت خبری">
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
                @can(config('permissions_list.COMMENT_SHOW', false))
                    <li class="dropdown dropdown-messages">
                        <a class="dropdown-toggle btn" data-bs-toggle="dropdown">
                            <i class="icon-bubbles"></i>
                            <span class="badge badge-primary">
                                {{ $pendingCommentsCount }}
                            </span>
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu has-scrollbar">
                            <li class="dropdown-header clearfix">
                                <span class="float-start">
                                    <a href="{{ $pendingCommentsRoute }}" rel="tooltip" title="خواندن همه"
                                       data-placement="left">
                                        <i class="icon-eye"></i>
                                    </a>
                                    شما {{ $pendingCommentsCount }} پیام تازه دارید.
                                </span>
                            </li>
                            <li class="dropdown-body">
                                <ul class="dropdown-menu-list">
                                    @foreach($pendingComments as $comment)
                                        <li class="clearfix">
                                            <a href="{{ route('admin.comments.show', $comment->id) }}">
                                                <p class="clearfix">
                                                    <strong class="float-start">
                                                        <img src="{{ $comment->commenterImageLink() }}"
                                                             class="img-circle" alt="{{ $comment->commenterName() }}" height="33rem" width="33rem">
                                                        {{ $comment->commenterName() }}
                                                    </strong>
                                                    <small class="float-end text-muted d-flex align-items-center gap-1">
                                                        <i class="icon-clock"></i>
                                                        <span>{{ jalalian()->forge($comment->created_at)->ago() }}</span>
                                                    </small>
                                                </p>
                                                <p>{{ str($comment->comment)->limit(30) }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown-footer clearfix">
                                <a href="{{ $pendingCommentsRoute }}">
                                    <i class="icon-list fa-flip-horizontal"></i>
                                    مشاهده همه پیام ها
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle dropdown-hove cursor-pointer d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <img src="{{ asset('storage/' . $currentUser->image->file_path) }}" alt="{{ $currentUser->image->alt_text }}"
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
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); $('#headerLogout').submit()">
                                <i class="icon-power"></i>
                                <span>خروج</span>
                                <form id="headerLogout" action="{{ route('logout') }}" method="post">@csrf</form>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.navbar-left -->
        </div><!-- /.top-bar -->
    </div><!-- /.header-left -->
</div><!-- /.navbar -->
<!-- END HEADER -->
