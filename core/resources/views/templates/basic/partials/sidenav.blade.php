<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
     data-background="{{getImage('assets/admin/images/sidebar/2.jpg','400x800')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('home')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('home')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">

                <li class="sidebar-menu-item {{menuActive('user.home')}}">
                    <a href="{{route('user.home')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('user.services')}}">
                    <a href="{{route('user.services')}}" class="nav-link ">
                        <i class="menu-icon las la-list-ol"></i>
                        <span class="menu-title">@lang('Services')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('user.mass.order')}}">
                    <a href="{{route('user.mass.order')}}" class="nav-link ">
                        <i class="menu-icon la la-cart-plus"></i>
                        <span class="menu-title">@lang('Mass Order')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('user.order*')}}">
                    <a href="{{route('user.order.history')}}" class="nav-link ">
                        <i class="menu-icon la la-clock"></i>
                        <span class="menu-title">@lang('Order History')</span>
                    </a>
                </li>

{{--                Deposit--}}
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('user.deposit*',3)}}">
                        <i class="menu-icon la la-bank"></i>
                        <span class="menu-title">@lang('Deposit')</span>

                    </a>
                    <div class="sidebar-submenu {{menuActive('user.deposit*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('user.deposit')}} ">
                                <a href="{{route('user.deposit')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Deposit Money')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('user.deposit.history')}} ">
                                <a href="{{route('user.deposit.history')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Deposit Log')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

{{--                Transactions--}}
                <li class="sidebar-menu-item {{menuActive('user.transaction.history')}}">
                    <a href="{{route('user.transaction.history')}}" class="nav-link ">
                        <i class="menu-icon la la-exchange-alt"></i>
                        <span class="menu-title">@lang('Transactions')</span>
                    </a>
                </li>

{{--                Ticket--}}
                <li class="sidebar-menu-item {{menuActive('ticket*')}}">
                    <a href="{{route('ticket')}}" class="nav-link ">
                        <i class="menu-icon la la-life-ring"></i>
                        <span class="menu-title">@lang('Support Ticket')</span>
                    </a>
                </li>

{{--                API--}}
                <li class="sidebar-menu-item {{menuActive('user.api')}}">
                    <a href="{{route('user.api')}}" class="nav-link ">
                        <i class="menu-icon la la-globe"></i>
                        <span class="menu-title">@lang('API')</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- sidebar end -->
