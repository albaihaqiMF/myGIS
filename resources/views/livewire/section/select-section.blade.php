<div class="intro-y box py-10 sm:py-20 mt-5">
    <div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full btn btn-primary">1</button>
            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Select Section</div>
        </div>
        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
            <button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">2</button>
            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">Detail Section
            </div>
        </div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5 intro-y">
            <div class="mb-3 col-span-12 xl:col-span-4">
                <label for="pg" class="form-label">Plantation Group</label>
                <select id="pg" name="pg" type="text" wire:model='pg' class="w-full bg-white form-control"
                    placeholder="Plantation Group">
                    <option value="">Pilih</option>
                    @foreach ($pgOption as $item)
                    <option value="{{ $item->pg }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-span-12 xl:col-span-4">
                <label for="area" class="form-label">Area</label>
                <select id="area" name="area" type="text" wire:model='area' class="w-full bg-white form-control"
                    placeholder="Area">
                    <option value="">Pilih</option>
                    @foreach ($areaOption as $item)
                    <option value="{{ $item->area }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-span-12 xl:col-span-4">
                <label for="location" class="form-label">Location</label>
                <select id="location" wire:model='location' name="location" type="text"
                    class="w-full bg-white form-control" placeholder="Location">
                    <option value="">Pilih</option>
                    @foreach ($locationOption as $item)
                    <option value="{{ $item->location }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                {{-- <button class="btn btn-secondary w-24">Previous</button> --}}
                @if ($pg == null || $area == null || $location == null)
                <button class="btn btn-primary w-24 ml-2" disabled>Next</button>
                @else
                <a href="{{route('map.section.create', [
                        'pg' => $pg,
                        'area' => $area,
                        'location' => $location,
                    ])}}" class="btn btn-primary w-24 ml-2">Next</a>
                @endif
            </div>
        </div>
    </div>
</div>
