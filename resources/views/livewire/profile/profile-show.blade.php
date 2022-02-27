<div x-data="{ openTab: 1 }">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Profile {{auth()->user()->name}}
        </h2>
    </div>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                    <img alt="{{auth()->user()->name}}" class="rounded-full"
                        src="https://ui-avatars.com/api/?name={{auth()->user()->name}}">
                    {{-- <div
                        class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-25 rounded-full p-2">
                        <i class="w-4 h-4 text-white" data-feather="camera"></i>
                    </div> --}}
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{auth()->user()->name}}
                    </div>
                </div>
            </div>
            <div
                class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
                <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                    <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="mail"
                            class="w-4 h-4 mr-2"></i> {{auth()->user()->email}}</div>
                </div>
            </div>
        </div>
        <div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start" role="tablist">
            <a @click="openTab = 1" id="dashboard-tab" data-toggle="tab" data-target="#dashboard" href="javascript:;"
                class="py-4 sm:mr-8 active" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
            <a @click="openTab = 2" id="profile-tab" data-toggle="tab" data-target="#profile" href="javascript:;"
                class="py-4 sm:mr-8" role="tab" aria-selected="false">Account & Profile</a>
            <a @click="openTab = 3" id="activities-tab" data-toggle="tab" data-target="#activities" href="javascript:;"
                class="py-4 sm:mr-8" role="tab" aria-selected="false">Change Password</a>
        </div>
    </div>
    <!-- END: Profile Info -->
    <div class="intro-y tab-content mt-5">
        <div x-show="openTab === 1" id="dashboard" class="tab-pane active" role="tabpanel"
            aria-labelledby="dashboard-tab">
            <div class="grid grid-cols-12 gap-6">
                <div class="intro-y box col-span-12 lg:col-span-6">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Lahan saya
                        </h2>
                    </div>
                    <div class="p-3">
                        @if ($more !== 0)
                        @foreach ($masterGroup as $item)
                        <div class="flex flex-col sm:flex-row mb-2 hover:bg-slate-100 rounded p-2">
                            <div class="mr-auto">
                                <p class="font-medium">{{$item->name}}</p>
                                <div class="text-gray-600 mt-1">{{$item->type}}</div>
                            </div>
                            <div class="flex">
                                <div class="text-center">
                                    <div class="bg-theme-17 text-theme-20 rounded px-2 mt-1.5">{{ date('Y-m-d',
                                        strtotime($item->created_at)) }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="w-full p-2">
                            <a href="" class="btn border-slate-500 w-full hover:shadow" disabled>Dan {{$more}}+
                                lainnya</a>
                        </div>
                        @else
                        <div class="w-full p-2 flex justify-center items-center h-40">
                            <span class="btn border-slate-500 w-full hover:shadow" disabled>KOSONG</span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="intro-y box col-span-12 lg:col-span-6">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Dashboard Saya
                        </h2>
                    </div>
                    <div class="w-full grid lg:grid-cols-2 gap-3 p-5">
                        <div class="text-sky-500 box p-3 flex flex-col justify-center items-center">
                            <i data-feather="cloud" class="h-10 w-10 mb-3"></i>
                            <div id="title" class="text-center text-black">
                                <p id="count" class="font-semibold text-2xl">{{$pg}}</p>
                                <p class="text-lg text-slate-500">Plantation Group</p>
                            </div>
                        </div>
                        <div class="text-orange-500 box p-3 flex flex-col justify-center items-center">
                            <i data-feather="map" class="h-10 w-10 mb-3"></i>
                            <div id="title" class="text-center text-black">
                                <p id="count" class="font-semibold text-2xl">{{$area}}</p>
                                <p class="text-lg text-slate-500">Area</p>
                            </div>
                        </div>
                        <div class="text-amber-500 box p-3 flex flex-col justify-center items-center">
                            <i data-feather="flag" class="h-10 w-10 mb-3"></i>
                            <div id="title" class="text-center text-black">
                                <p id="count" class="font-semibold text-2xl">{{$loc}}</p>
                                <p class="text-lg text-slate-500">Lokasi</p>
                            </div>
                        </div>
                        <div class="text-emerald-500 box p-3 flex flex-col justify-center items-center">
                            <i data-feather="map-pin" class="h-10 w-10 mb-3"></i>
                            <div id="title" class="text-center text-black">
                                <p id="count" class="font-semibold text-2xl">{{$section}}</p>
                                <p class="text-lg text-slate-500">Seksi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="openTab === 2" id="profile" class="tab-pane" aria-labelledby="profile-tab" role="tabpanel">
            <div class="grid grid-cols-12 gap-6">
                <div class="intro-y box col-span-12 lg:col-span-6">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Profil Anda
                        </h2>
                    </div>
                    <div class="p-5">
                        <form wire:submit='updateProfile'>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" name="name" wire:model='name' type="text" class="form-control w-full"
                                    placeholder="Name">
                            </div>
                            <div class="w-full flex justify-end">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="openTab === 3">
            <div class="grid grid-cols-12 gap-6">
                <div class="intro-y box col-span-12 lg:col-span-6">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto justify-between">
                            Ganti Password
                        </h2>
                        @if (session()->has('fail'))
                        <div class="text-red-600">
                            <p class="font-light">
                                {{session('fail')}} !!!
                            </p>
                        </div>
                        @endif
                        @if (session()->has('success'))
                        <div class="text-emerald-600">
                            <p class="font-light">
                                {{session('success')}}
                            </p>
                        </div>
                        @endif
                    </div>
                    <!-- BEGIN: Notification Content -->

                    <div class="p-5">
                        <form wire:submit.prevent='updatePassword'>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Lama</label>
                                <input id="password" name="password" wire:model='password' type="password"
                                    class="form-control w-full" placeholder="Password Lama" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password Baru</label>
                                <input id="newPassword" name="newPassword" wire:model='newPassword' type="password"
                                    class="form-control w-full" placeholder="Password Baru" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                                <input id="confirmPassword" name="confirmPassword" type="password"
                                    wire:model='confirmPassword' class="form-control w-full"
                                    placeholder="Konfirmasi Password Baru" required>
                            </div>
                            <div class="w-full flex justify-end">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
