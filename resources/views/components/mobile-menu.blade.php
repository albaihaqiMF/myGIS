<div class="mobile-menu mobile-menu--dashboard md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="MyGIS Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                class="w-8 h-8 text-gray-600 dark:text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="mobile-menu-box py-5 hidden">
        <li>
            <a href="{{ route('dashboard') }}" class="menu">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="map"></i> </div>
                <div class="menu__title"> Map <i data-feather="chevron-down" class="menu__sub-icon "></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('map.pg.list') }}" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="list"></i> </div>
                        <div class="menu__title"> Plantation Group </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.area.list') }}" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="list"></i> </div>
                        <div class="menu__title"> Area </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.location.list') }}" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="list"></i> </div>
                        <div class="menu__title"> Location </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.section.list') }}" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="list"></i> </div>
                        <div class="menu__title"> Section </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('node.list') }}" class="menu">
                <div class="menu__icon"> <i data-feather="radio"></i> </div>
                <div class="menu__title"> Sensor </div>
            </a>
        </li>
        <li>
            <a href="{{ route('irigation.list') }}" class="menu">
                <div class="menu__icon"> <i data-feather="slack"></i> </div>
                <div class="menu__title"> Irigation </div>
            </a>
        </li>
        @if (auth()->user()->role_id == 1)
        <li>
            <a href="{{ route('user.list') }}" class="menu">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> Users </div>
            </a>
        </li>
        @endif
    </ul>
</div>
