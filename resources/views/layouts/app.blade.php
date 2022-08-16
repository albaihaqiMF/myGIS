<!DOCTYPE html>
<!--
Template Name: MyGIS - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="./images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="MyGIS admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, MyGIS Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>{{ $title ?? "MyGIS" }}</title>
    <!-- BEGIN: CSS Assets-->
    @livewireStyles
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- END: CSS Assets-->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
</head>
<!-- END: Head -->

<body class="main">
    <x-mobile-menu />
    <div class="flex overflow-hidden">
        <x-side-menu />
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar -mx-4 px-4 md:mx-0 md:px-0">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                    <a href="{{ route('dashboard') }}">Application</a>
                    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                    <a href="" class="breadcrumb--active">Dashboard</a>
                </div>
                <!-- END: Breadcrumb -->
                {{-- @livewire('search') --}}

                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in"
                        role="button" aria-expanded="false">
                        <img alt="MyGIS Tailwind HTML Admin Template" src="/images/profile-4.jpg">
                    </div>
                    <div class="dropdown-menu w-56">
                        <div class="dropdown-menu__content box dark:bg-dark-6">
                            <div class="p-4 border-b border-black border-opacity-5 dark:border-dark-3">
                                <div class="font-medium">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-600 mt-0.5 dark:text-gray-600">{{ auth()->user()->email }}
                                </div>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('profile.show') }}"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                @if (auth()->user()->role_id == 1)
                                <a href="{{ route('user.create') }}"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> Add User </a>
                                @endif
                                <a href=""
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                            </div>
                            <div class="p-2 border-t border-black border-opacity-5 dark:border-dark-3 w-full">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full block p-2 transition duration-300 ease-in-out hover:bg-gray-200 dark:hover:bg-dark-3 rounded-md">
                                        <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
            <!-- END: Top Bar -->
            {{ $slot }}
        </div>
        <!-- END: Content -->
    </div>
    <!-- BEGIN: JS Assets-->

    @livewireScripts
    <script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.7.0/cdn.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- END: JS Assets-->
</body>

</html>
