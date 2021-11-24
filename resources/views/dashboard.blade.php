<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session()->has('success'))
    <div class="alert alert-dismissible show box bg-theme-25 text-white flex items-center mb-6" role="alert">
        <span>
            {{ session()->get('success') }} <a
                href="https://themeforest.net/item/midone-jquery-tailwindcss-html-admin-template/26366820"
                class="underline ml-1" target="blank">Hai, {{ auth()->user()->name }}</a>.
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
</x-app-layout>
