<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img alt="MyGIS Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg">
        <span class="hidden xl:block text-white text-lg ml-3"> {{ auth()->user()->area->name }} </span>
    </a>
    <div class="side-nav__devider my-6"></div>
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
                    <a href="{{ route('map.list') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="side-menu__title"> Data List </div>
                    </a>
                </li>
            </ul>
        </li>
        @if (auth()->user()->role_id == 1)
        <li>
            <a href="{{ route('user.list') }}"
                class="side-menu{{ request()->is('user.*') ? ' side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Users </div>
            </a>
        </li>
        @endif
    </ul>
</nav>
<!-- END: Side Menu -->
