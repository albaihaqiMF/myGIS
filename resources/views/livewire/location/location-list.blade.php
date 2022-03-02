@slot('title')
MyGIS | Location
@endslot
<div class="grid w-full grid-cols-12 gap-3">
    @if (session()->has('error'))
    <div class="flex items-center col-span-12 mb-6 text-white alert alert-dismissible show box bg-rose-500"
        role="alert">
        <span>
            {{ session()->get('error') }}.
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="w-4 h-4 feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    @endif
    <div class="col-span-12 overflow-auto intro-y lg:overflow-visible">
        <div class="flex flex-wrap items-center justify-between col-span-12 mt-2 intro-y sm:flex-nowrap">
            <a href="{{ route('map.location.create') }}" class="mr-2 shadow-md btn btn-primary">
                <span>
                    <i data-feather="plus" class="w-5 h-5 mr-3 font-bold"></i>
                </span>
                Add New Data
            </a>
            <div class="w-full mt-3 sm:w-auto sm:mt-0 sm:ml-auto md:ml-0">
                <div class="relative w-56 text-gray-700 dark:text-gray-300">
                    <input type="text" wire:model='search' class="w-56 pr-10 form-control box placeholder-theme-23"
                        placeholder="Search...">
                    <i class="absolute inset-y-0 right-0 w-4 h-4 my-auto mr-3" data-feather="search"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 overflow-x-scroll intro-y lg:overflow-visible">
        <div wire:loading>
            <x-loading />
        </div>
        <table class="table table-report">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NAMA</th>
                    <th class="text-center whitespace-nowrap">WILAYAH</th>
                    <th class="text-center whitespace-nowrap">LOKASI</th>
                    <th class="text-center whitespace-nowrap">SEKSI</th>
                    <th class="text-center whitespace-nowrap">TYPE</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <a href="{{ route('map.section.show', [
                    'section' => $item->id
                ]) }}">
                    <tr class="intro-x">
                        <td>
                            <a href="{{ route('map.section.show', [
                                'section' => $item->id
                            ]) }}" class="font-medium whitespace-nowrap">{{ $item->name }}</a>
                            <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">Created by {{
                                $item->getChief->name
                                }}</div>
                        </td>
                        <td class="w-32 text-center">
                            {{ $item->area }}
                        </td>
                        <td class="w-32 text-center">
                            {{ $item->location }}
                        </td>
                        <td class="w-32 text-center">
                            {{ $item->section }}
                        </td>
                        <td class="w-32 text-center">
                            {{ $item->type }}
                        </td>
                        <td class="w-56 table-report__action">
                            <div class="flex items-center justify-center">
                                <a class="flex items-center mr-3 text-theme-1" href="{{ route('map.section.show', [
                                    'section' => (string)$item->id
                                ]) }}"> <i data-feather="eye" class="w-4 h-4 mr-1"></i> Detail </a>
                            </div>
                        </td>
                    </tr>
                </a>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-span-12 intro-y">
        {{$data->links()}}
    </div>
</div>
