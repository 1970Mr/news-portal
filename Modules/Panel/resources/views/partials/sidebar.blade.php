<!-- BEGIN SIDEBAR -->
<div id="sidebar">
    <div class="sidebar-top">
        <div class="user-box">
            <a href="{{ asset('admin/#') }}">
                <img src="{{ asset('admin/assets/images/user/128.png') }}" alt="عکس پروفایل"
                     class="img-circle img-responsive">
            </a>
            <div class="user-details">
                <h4>{{ $currentUser->name }}</h4>
                <p class="role">{{ __($currentUser->role()->name) }}</p>
            </div><!-- /.user-details -->
        </div><!-- /.user-box -->
    </div><!-- /.sidebar-top -->
    <div class="side-menu-container">
        <ul class="metismenu" id="side-menu">
            @foreach(config('panel.sidebar_menus') as $menu)
                @if( !array_key_exists('permissions', $menu) || auth()->user()->canany($menu['permissions']) )
                    @if(isset($menu['children']))
                        <li class="{{ active_menu($menu, 'active') }}">
                            <a class="dropdown-toggle">
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                            <ul>
                                @foreach($menu['children'] as $child_menu)
                                    @if( !array_key_exists('permissions', $child_menu) || auth()->user()->canany($child_menu['permissions']) )
                                        <li class="{{ $child_menu['class'] ?? '' }}">
                                            <a href="{{ $child_menu['url'] }}" class="{{ active_menu($child_menu) }} font-sm">
                                                <i class="{{ $child_menu['icon'] }}"></i>
                                                <span>{{ $child_menu['title'] }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="{{ $menu['class'] ?? '' }}">
                            <a href="{{ $menu['url'] }}" class="{{ active_menu($menu) }}">
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul><!-- /#side-menu -->
    </div><!-- /.side-menu-container -->
</div><!-- /#sidebar -->
<!-- END SIDEBAR -->
