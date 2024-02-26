<!-- BEGIN SIDEBAR -->
<div id="sidebar">
    <div class="sidebar-top">
        <div class="user-box">
            <a href="{{ asset('admin/#') }}">
                <img src="{{ asset('admin/assets/images/user/128.png') }}" alt="عکس پروفایل"
                     class="img-circle img-responsive">
            </a>
            <div class="user-details">
                <h4>حمید آفرینش فر</h4>
                <p class="role">مدیر فنی</p>
            </div><!-- /.user-details -->
        </div><!-- /.user-box -->
    </div><!-- /.sidebar-top -->
    <div class="side-menu-container">
        <ul class="metismenu" id="side-menu">
            @foreach(config('panel.sidebar_menus') as $menu)
                @if(isset($menu['children']))
                    <li class="{{ menu_has_active_child($menu) }}">
                        <a class="dropdown-toggle">
                            <i class="{{ $menu['icon'] }}"></i>
                            <span>{{ $menu['title'] }}</span>
                        </a>
                        <ul>
                            @foreach($menu['children'] as $child_menu)
                                <li class="{{ $child_menu['class'] ?? '' }}">
                                    <a href="{{ $child_menu['url'] }}" class="{{ url()->current() === $child_menu['url'] ? 'current' : '' }}">
                                        <i class="{{ $child_menu['icon'] }}"></i>
                                        <span>{{ $child_menu['title'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="{{ $menu['class'] ?? '' }}">
                        <a href="{{ $menu['url'] }}" class="{{ url()->current() === $menu['url'] ? 'current' : '' }}">
                            <i class="{{ $menu['icon'] }}"></i>
                            <span>{{ $menu['title'] }}</span>
                        </a>
                    </li>
                @endif

            @endforeach

        </ul><!-- /#side-menu -->
    </div><!-- /.side-menu-container -->
</div><!-- /#sidebar -->
<!-- END SIDEBAR -->