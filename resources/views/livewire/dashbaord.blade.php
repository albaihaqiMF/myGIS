@if (session()->has('success'))
<div class="alert alert-dismissible show box bg-primary-1 text-white flex items-center mb-6" role="alert">
    <span>
        {{ session()->get('success') }} <span class="underline ml-1">Hai, {{ auth()->user()->name }}</span>.
    </span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <svg
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-x w-4 h-4">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg> </button>
</div>
@endif
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            General Report
        </h2>
        <a href="" class="ml-auto flex items-center text-theme-30 dark:text-theme-25"> <i data-feather="refresh-ccw"
                class="w-4 h-4 mr-3"></i> Reload Data </a>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <a href="{{ route('map.pg.list') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="cloud" class="report-box__icon text-theme-24 dark:text-theme-25"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator tooltip cursor-pointer {{ $pg['rate'] != 0 ? 'bg-theme-20' : 'bg-theme-16' }}"
                                title="{{ $pg['rate'] != 0 ? 'Registered fields increase by '. $pg['rate'].' field' : 'Fields are not increasing' }}">
                                {{ $pg['rate'] }} <i data-feather="{{ $pg['rate'] != 0 ? 'plus' : 'minus' }}"
                                    class="w-4 h-4 ml-0.5"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $pg['data'] }}</div>
                    <div class="text-base text-gray-600 mt-1">PLANTATION GROUP</div>
                </div>
            </div>
        </a>
        <a href="{{ route('map.area.list') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div href class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="map" class="report-box__icon text-theme-29"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator tooltip cursor-pointer {{ $area['rate'] != 0 ? 'bg-theme-20' : 'bg-theme-16' }}"
                                title="{{ $area['rate'] != 0 ? 'Registered fields increase by '. $area['rate'].' field' : 'Fields are not increasing' }}">
                                {{ $area['rate'] }} <i data-feather="{{ $area['rate'] != 0 ? 'plus' : 'minus' }}"
                                    class="w-4 h-4 ml-0.5"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $area['data'] }}</div>
                    <div class="text-base text-gray-600 mt-1">WILAYAH</div>
                </div>
            </div>
        </a>
        <a href="{{ route('map.location.list') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="flag" class="report-box__icon text-theme-15"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator tooltip cursor-pointer {{ $location['rate'] != 0 ? 'bg-theme-20' : 'bg-theme-16' }}"
                                title="{{ $location['rate'] != 0 ? 'Registered Locations increase by '. $location['rate'].' Location' : 'Locations are not increasing' }}">
                                {{ $location['rate'] }} <i
                                    data-feather="{{ $location['rate'] != 0 ? 'plus' : 'minus' }}"
                                    class="w-4 h-4 ml-0.5"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $location['data'] }}</div>
                    <div class="text-base text-gray-600 mt-1">LOKASI</div>
                </div>
            </div>
        </a>
        <a href="{{ route('map.section.list') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="map-pin" class="report-box__icon text-theme-20"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator tooltip cursor-pointer {{ $section['rate'] != 0 ? 'bg-theme-20' : 'bg-theme-16' }}"
                                title="{{ $section['rate'] != 0 ? 'Registered sections increase by '. $section['rate'].' section' : 'Sections are not increasing' }}">
                                {{ $section['rate'] }} <i data-feather="{{ $section['rate'] != 0 ? 'plus' : 'minus' }}"
                                    class="w-4 h-4 ml-0.5"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $section['data'] }}</div>
                    <div class="text-base text-gray-600 mt-1">SEKSI</div>
                </div>
            </div>
        </a>
        @if (auth()->user()->role_id !== 2)
        <a href="{{route('user.list')}}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="user" class="report-box__icon text-cyan-500"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator tooltip cursor-pointer {{ $user['rate'] != 0 ? 'bg-cyan-500' : 'bg-theme-16' }}"
                                title="{{ $user['rate'] != 0 ? 'Registered Users increase by '. $user['rate'].' User' : 'Users are not increasing' }}">
                                {{ $user['rate'] }} <i data-feather="{{ $user['rate'] != 0 ? 'plus' : 'minus' }}"
                                    class="w-4 h-4 ml-0.5"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $user['data'] }}</div>
                    <div class="text-base text-gray-600 mt-1">USER</div>
                </div>
            </div>
        </a>
        @endif
    </div>
</div>
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Graphics
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 lg:col-span-4 intro-y">
            <h2 class="mb-1 font-semibold">Soil Moisture</h2>
            <div class="box">
                <div id="soil_moisture"></div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4 intro-y">
            <h2 class="mb-1 font-semibold">Soil Moisture</h2>
            <div class="box">
                <div id="chart"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/charts/sensor.js')}}"></script>
