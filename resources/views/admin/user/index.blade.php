<x-app-layout title="User List">
    <h2 class="intro-y text-lg font-medium mt-10">
        Users Layout
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('user.create') }}" class="btn btn-primary shadow-md mr-2"><i data-feather="user-plus" class="w-5 h-5 mr-3"></i>Add
                User</a>
        </div>
        <!-- BEGIN: Users Layout -->
        @foreach ($data as $item)
        <div class="intro-y col-span-12 md:col-span-6">
            <div class="box">
                <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                        <img alt="Tinker Tailwind HTML Admin Template" class="rounded-full"
                            src="/images/profile-10.jpg">
                    </div>
                    <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                        <a href="" class="font-medium">{{ $item->name }}</a>
                        <div class="text-gray-600 text-xs mt-0.5">{{ $item->roles->title }}</div>
                    </div>
                    <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                        <a href=""
                            class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip"
                            title="Facebook"> <i class="w-3 h-3 fill-current" data-feather="facebook"></i> </a>
                        <a href=""
                            class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip"
                            title="Twitter"> <i class="w-3 h-3 fill-current" data-feather="twitter"></i> </a>
                        <a href=""
                            class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip"
                            title="Linked In"> <i class="w-3 h-3 fill-current" data-feather="linkedin"></i> </a>
                    </div>
                </div>
                <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                    <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                        <div class="flex text-gray-600 text-xs">
                            <div class="mr-auto">section</div>
                            <div>{{ count($item->section) }}</div>
                        </div>
                    </div>
                    <button class="btn btn-primary py-1 px-2 mr-2">Message</button>
                    <button class="btn btn-outline-secondary py-1 px-2">Profile</button>
                </div>
            </div>
        </div>
        @endforeach
        {{ $data->links() }}
</x-app-layout>
