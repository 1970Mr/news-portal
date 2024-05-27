<!-- BEGIN HEADER -->
<div class="navbar navbar-fixed-top" id="main-navbar">
    <div class="header-right d-md-flex justify-content-center align-items-center">
        <a href="{{ route(config('app.panel_prefix', 'panel') . '.index') }}" class="logo-con my-0 d-none d-md-block">
            <img src="{{ $siteDetails->mainLogoLink() }}" class="img-responsive center-block"
                 alt="{{ config('app.name') }}">
        </a>
    </div><!-- /.header-right -->
    <div class="header-left">
        <div class="top-bar">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="btn" id="toggle-sidebar">
                        <span class="menu"></span>
                    </a>
                </li>
                <li>
                    <a class="btn open" id="toggle-sidebar-top">
                        <i class="icon-user-following"></i>
                    </a>
                </li>
                <li>
                    <a class="btn" id="toggle-dark-mode">
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
                @can(config('permissions_list.CONTACT_USER_MESSAGES', false))
                    <li class="dropdown dropdown-messages">
                        <a class="dropdown-toggle btn" data-bs-toggle="dropdown">
                            <i class="icon-earphones-alt"></i>
                            <span class="badge badge-primary">
                                {{ $unseenUserMessagesCount }}
                            </span>
                        </a>
                        <ul class="dropdown-menu custom-dropdown-menu has-scrollbar">
                            <li class="dropdown-header clearfix">
                                <span class="float-start">
                                    <form action="{{ $markAllAsSeenUserMessagesRoute }}" method="POST" style="display: inline;">
                                        @csrf
                                        @if($unseenUserMessagesCount > 0)
                                            <button type="submit" rel="tooltip" title="خواندن همه" data-placement="left" style="padding: 0; border: none; background: none;">
                                            <i class="icon-eye"></i>
                                        </button>
                                        @endif
                                    </form>
                                    شما {{ $unseenUserMessagesCount }} پیام تازه دارید.
                                </span>
                            </li>
                            <li class="dropdown-body">
                                <ul class="dropdown-menu-list">
                                    @foreach($unseenUserMessages as $unseenUserMessage)
                                        <li class="clearfix">
                                            <a href="{{ route(config('app.panel_prefix', 'panel') . '.contact-us.messages.show', $unseenUserMessage->id) }}">
                                                <p class="clearfix">
                                                    <small class="float-end text-muted d-flex align-items-center gap-1">
                                                        <i class="icon-clock"></i>
                                                        <span>{{ jalalian()->forge($unseenUserMessage->created_at)->ago() }}</span>
                                                    </small>
                                                </p>
                                                <p>{{ str($unseenUserMessage->message)->limit(30) }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @if($unseenUserMessagesCount > 0)
                                <li class="dropdown-footer clearfix">
                                    <a href="{{ $unseenUserMessagesRoute }}">
                                        <i class="icon-list fa-flip-horizontal"></i>
                                        مشاهده همه
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endcan

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
                                    <form action="{{ $approveAllCommentsRoute }}" method="POST" style="display: inline;">
                                        @csrf
                                        @if($pendingCommentsCount > 0)
                                            <button type="submit" rel="tooltip" title="تایید همه" data-placement="left" style="padding: 0; border: none; background: none;">
                                                <i class="icon-eye"></i>
                                            </button>
                                        @endif
                                    </form>
                                    شما {{ $pendingCommentsCount }} نظر تازه دارید.
                                </span>
                            </li>
                            <li class="dropdown-body">
                                <ul class="dropdown-menu-list">
                                    @foreach($pendingComments as $comment)
                                        <li class="clearfix">
                                            <a href="{{ route(config('app.panel_prefix', 'panel') . '.comments.show', $comment->id) }}">
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
                            @if($pendingCommentsCount > 0)
                                <li class="dropdown-footer clearfix">
                                    <a href="{{ $pendingCommentsRoute }}">
                                        <i class="icon-list fa-flip-horizontal"></i>
                                        مشاهده همه
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endcan

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle dropdown-hove cursor-pointer d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <img src="{{ asset('storage/' . $currentUser->image->file_path) }}" alt="{{ $currentUser->image->alt_text }}"
                             class="object-fit-cover img-circle" style="width: 45px; height: 45px">
                        <span>{{ $currentUser->full_name }}</span>
                        <i class="icon-arrow-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route(config('app.panel_prefix', 'panel') . '.profile.edit') }}">
                                <i class="icon-note"></i>
                                ویرایش پروفایل
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(config('app.panel_prefix', 'panel') . '.profile.password.change') }}">
                                <i class="icon-key"></i>
                                تغییر رمز عبور
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(config('app.panel_prefix', 'panel') . '.profile.email.change') }}">
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
