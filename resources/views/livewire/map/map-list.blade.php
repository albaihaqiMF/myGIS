@slot('title')
MyGIS | List Data
@endslot
<div class="grid grid-cols-12 gap-3 w-full">
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center justify-between mt-2">
            <a href="{{ route('map.create') }}" class="btn btn-primary shadow-md mr-2">
                <span>
                    <i data-feather="plus" class="w-5 h-5 mr-3 font-bold"></i>
                </span>
                Add New Data
            </a>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" wire:model='search' class="form-control w-56 box pr-10 placeholder-theme-23" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 overflow-x-scroll lg:overflow-visible">
        <table class="table table-report">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NAMA</th>
                    <th class="text-center whitespace-nowrap">TAKSASI</th>
                    <th class="text-center whitespace-nowrap">NDVI
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="intro-x">
                    <td>
                        <a href="" class="font-medium whitespace-nowrap">{{ $item->name }}</a>
                        <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">Created by {{ $item->creator->name
                            }}</div>
                    </td>
                    <td>
                        <div class="w-20 flex justify-center">
                            <img src="{{ $item->getTaksasi() }}" class="w-12 h-12 rounded-full zoom-in object-cover"
                                alt="{{ $item->getTaksasi() }}">
                        </div>
                    </td>
                    <td>
                        <div class="w-20 flex justify-center">
                            <img src="{{ $item->getNdvi() }}" class="w-12 h-12 rounded-full zoom-in object-cover"
                                alt="{{ $item->getNdvi() }}">
                        </div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3 text-theme-1" href="{{ route('map.show', [
                                'lahan' => $item->id
                            ]) }}"> <i data-feather="eye"
                                    class="w-4 h-4 mr-1"></i> Detail </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
