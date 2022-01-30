@slot('title')
MyGIS | Area
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
        <div wire:ignore class="flex flex-wrap items-center justify-between col-span-12 mt-2 intro-y sm:flex-nowrap">
            <a href="javascript:;" data-toggle="modal" data-target="#create-area" class="btn btn-primary">
                <span>
                    <i data-feather="plus" class="w-5 h-5 mr-3 font-bold"></i>
                </span>
                Add New Data
            </a>
            <!-- BEGIN: Modal Content -->
            <div id="create-area" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form wire:submit.prevent='createArea'>
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                                <h2 class="font-medium text-base mr-auto">Create Plantation Group</h2>
                                <div class="dropdown sm:hidden"> <a class="dropdown-toggle w-5 h-5 block"
                                        href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal"
                                            class="w-5 h-5 text-gray-600 dark:text-gray-600"></i> </a>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2"> <a
                                                href="javascript:;"
                                                class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                <div class="box col-span-12">
                                    <div class="text-gray-700 p-2 mb-4">
                                        <label class="block mb-1 text-lg" for="name">Name</label>
                                        <input class="form-control" type="text" name="name" wire:model='name'
                                            placeholder="Name" id="name" value="" autocomplete="off" />
                                    </div>
                                    <div class="text-gray-700 p-2 mb-4">
                                        <label class="block mb-1 text-lg" for="pg">Plantation Group</label>
                                        <select class="tom-select" type="text" wire:model='pg' name="pg"
                                            data-placeholder="Plantation Group" id="pg">
                                            <option value="">Pilih Plantation Group</option>
                                            @foreach ($pgOption as $item)
                                            <option value="{{ $item->pg }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- END: Modal Body -->
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer text-right">
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                <button type="submit" data-dismiss="modal" class="btn btn-primary w-20">Create</button>
                            </div> <!-- END: Modal Footer -->
                        </form>
                    </div>
                </div>
            </div> <!-- END: Modal Content -->
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
</div>
