<x-app-layout title="User List">
    <h2 class="mt-10 text-lg font-medium intro-y">
        Users Control
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="flex flex-wrap items-center col-span-12 mt-2 intro-y sm:flex-nowrap">
            <a href="{{ route('user.create') }}" class="mr-2 shadow-md btn btn-primary"><i data-feather="user-plus" class="w-5 h-5 mr-3"></i>Add
                User</a>
        </div>
        <!-- BEGIN: Users Layout -->
        @foreach ($data as $item)
        <div class="col-span-12 intro-y md:col-span-6">
            <div class="box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 lg:flex-row dark:border-dark-5">
                    <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                        <img alt="Tinker Tailwind HTML Admin Template" class="rounded-full"
                            src="https://ui-avatars.com/api/?name={{$item->name}}">
                    </div>
                    <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:text-left lg:mt-0">
                        <a href="" class="font-medium">{{ $item->name }}</a>
                        <div class="text-gray-600 text-xs mt-0.5">{{ $item->roles->title }}</div>
                    </div>
                    <div class="flex mt-3 -ml-2 lg:ml-0 lg:justify-end lg:mt-0">
                        <a href=""
                            class="flex items-center justify-center w-8 h-8 ml-2 text-gray-500 border rounded-full dark:border-dark-5 zoom-in tooltip"
                            title="Facebook"> <i class="w-3 h-3 fill-current" data-feather="facebook"></i> </a>
                        <a href=""
                            class="flex items-center justify-center w-8 h-8 ml-2 text-gray-500 border rounded-full dark:border-dark-5 zoom-in tooltip"
                            title="Twitter"> <i class="w-3 h-3 fill-current" data-feather="twitter"></i> </a>
                        <a href=""
                            class="flex items-center justify-center w-8 h-8 ml-2 text-gray-500 border rounded-full dark:border-dark-5 zoom-in tooltip"
                            title="Linked In"> <i class="w-3 h-3 fill-current" data-feather="linkedin"></i> </a>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-center p-5 lg:flex-nowrap">
                    <div class="w-full mb-4 mr-auto lg:w-1/2 lg:mb-0">
                        <div class="flex text-xs text-gray-600">
                            <div class="mr-auto">section</div>
                            <div>{{ count($item->section) }}</div>
                        </div>
                    </div>
                    <button class="px-2 py-1 mr-2 btn btn-primary">Message</button>
                    <button class="px-2 py-1 btn btn-outline-secondary">Profile</button>
                </div>
            </div>
        </div>
        @endforeach
        <div class="flex flex-wrap items-center col-span-12 mt-2 intro-y sm:flex-nowrap">
            {{ $data->links() }}
        </div>
</x-app-layout>
