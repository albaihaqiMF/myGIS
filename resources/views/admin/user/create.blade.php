<x-app-layout title="Create User">
    @if (session()->has('success'))
    <div class="alert alert-dismissible show box bg-theme-20 text-white flex items-center mb-6" role="alert">
        <span>
            {{ session()->get('success') }} <span class="underline ml-1">{{ session()->get('success') }}</span>.
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
    <div class="intro-y box py-5 mt-5">
        <div class="px-5 mt-10">
            <div class="font-medium text-center text-lg">Create New User</div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="font-medium text-base">Profile Settings</div>
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="name" class="w-full flex flex-col sm:flex-row from-label">Name @error('name')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-theme-16">{{ $message }}</span>
                            @enderror</label>
                        <input id="name" name="name" value="{{ old('name') }}" type="text" class="form-control"
                            placeholder="Name">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="email" class="w-full flex flex-col sm:flex-row from-label">Email @error('email')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-theme-16">{{ $message }}</span>
                            @enderror</label>
                        <input id="email" name="email" value="{{ old('email') }}" type="text" class="form-control"
                            placeholder="example@gmail.com">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="username" class="w-full flex flex-col sm:flex-row from-label">Username @error('username')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-theme-16">{{ $message }}</span>
                            @enderror</label>
                        <input id="username" name="username" type="text" value="{{ old('username') }}"
                            class="form-control" placeholder="Username">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="role_id" class="w-full flex flex-col sm:flex-row from-label">Role @error('role_id')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-theme-16">{{ $message }}</span>
                            @enderror</label>
                        <select id="role_id" name="role_id" class="form-select">
                            <option value="2">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <button class="btn btn-primary w-24 ml-2">CREATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
