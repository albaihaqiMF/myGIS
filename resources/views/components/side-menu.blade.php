<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="flex items-center pt-4 pl-5 mt-3 intro-x">
        <img alt="MyGIS Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg">
        <span class="hidden ml-3 text-lg text-white xl:block"> {{ __('GGF') }} </span>
    </a>
    <div class="my-6 side-nav__devider"></div>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}"
                class="side-menu{{ request()->is('dashboard') ? ' side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu{{ request()->routeIs('map.*') ? ' side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="map"></i> </div>
                <div class="side-menu__title"> Map
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('map.pg.list') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="side-menu__title"> Plantation Group </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.area.list') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="side-menu__title"> Area </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.location.list') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="side-menu__title"> Location </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.section.list') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="side-menu__title"> Section </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('node.list') }}"
                class="side-menu{{ request()->is('node') ? ' side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="radio"></i> </div>
                <div class="side-menu__title"> Sensor </div>
            </a>
        </li>
        <li>
            <a href="{{ route('irigation.list') }}"
                class="side-menu{{ request()->routeIs('irigation.*') ? ' side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="slack"></i> </div>
                <div class="side-menu__title"> Irigation </div>
            </a>
        </li>
        @if (auth()->user()->role_id == 1)
        <li>
            <a href="{{ route('user.list') }}"
                class="side-menu{{ request()->routeIs('user.*') ? ' side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Users </div>
            </a>
        </li>
        @endif
    </ul>
</nav>
<!-- END: Side Menu -->
