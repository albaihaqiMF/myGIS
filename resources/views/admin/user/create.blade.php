<x-app-layout title="Create User">
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
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" value="{{ old('name') }}" type="text" class="form-control"
                            placeholder="Your Name">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" value="{{ old('email') }}" type="text" class="form-control"
                            placeholder="example@gmail.com">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" name="username" type="text" class="form-control"
                            placeholder="Important Meeting">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="role_id" class="form-label">Size</label>
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
