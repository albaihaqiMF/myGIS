<x-app-layout>
    @if (session()->has('success'))
    <div class="alert alert-dismissible show box bg-theme-25 text-white flex items-center mb-6" role="alert">
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
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="shopping-cart"
                                class="report-box__icon text-theme-24 dark:text-theme-25"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-theme-20 tooltip cursor-pointer"
                                    title="33% Higher than last month"> 33% <i data-feather="chevron-up"
                                        class="w-4 h-4 ml-0.5"></i> </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">4.710</div>
                        <div class="text-base text-gray-600 mt-1">Item Sales</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('map.list') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div href class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="map" class="report-box__icon text-theme-29"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator tooltip cursor-pointer {{ $lahan['rate'] != 0 ? 'bg-theme-20' : 'bg-theme-16' }}"
                                    title="{{ $lahan['rate'] != 0 ? 'Registered fields increase by '. $lahan['rate'].' field' : 'Fields are not increasing' }}">
                                    {{ $lahan['rate'] }} <i data-feather="{{ $lahan['rate'] != 0 ? 'plus' : 'minus' }}"
                                        class="w-4 h-4 ml-0.5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $lahan['data'] }}</div>
                        <div class="text-base text-gray-600 mt-1">Lahan</div>
                    </div>
                </div>
            </a>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="monitor" class="report-box__icon text-theme-15"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator tooltip cursor-pointer {{ $progres['rate'] != 0 ? 'bg-theme-20' : 'bg-theme-16' }}"
                                    title="{{ $progres['rate'] != 0 ? 'Registered progress increase by '. $progres['rate'].' progres' : 'Progress are not increasing' }}">
                                    {{ $progres['rate'] }} <i
                                        data-feather="{{ $progres['rate'] != 0 ? 'plus' : 'minus' }}"
                                        class="w-4 h-4 ml-0.5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $progres['data'] }}</div>
                        <div class="text-base text-gray-600 mt-1">My Progress</div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->role_id == 1)
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="user" class="report-box__icon text-theme-20"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator tooltip cursor-pointer {{ $user['rate'] != 0 ? 'bg-theme-20' : 'bg-theme-16' }}"
                                    title="{{ $user['rate'] != 0 ? 'Registered users increase by '. $user['rate'].' user' : 'Users are not increasing' }}">
                                    {{ $user['rate'] }} <i data-feather="{{ $user['rate'] != 0 ? 'plus' : 'minus' }}"
                                        class="w-4 h-4 ml-0.5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $user['data'] }}</div>
                        <div class="text-base text-gray-600 mt-1">User</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
