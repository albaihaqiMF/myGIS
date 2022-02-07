<div class="grid w-full grid-cols-12 gap-4 pt-4">
    <div class="gap-4 col-span-full 2xl:col-span-8 intro-y">
        <form action="{{ route('map.section.store') }}" enctype="multipart/form-data" method="POST"
            class="px-4 py-6 box">
            @csrf
            <div class="mb-3">
                <label for="name" class="flex flex-col w-full form-label sm:flex-row">Name
                    @error('name')
                    <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message }}</span>
                    @enderror
                </label>
                <input id="name" name="name" type="text" class="w-full form-control" placeholder="Name"
                    value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="variaty" class="flex flex-col w-full form-label sm:flex-row">Variaty
                    @error('variaty')
                    <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message }}</span>
                    @enderror
                </label>
                <input id="variaty" name="variaty" type="text" class="w-full form-control" placeholder="Variaty"
                    value="{{ old('variaty') }}">
            </div>
            <div class="mb-3">
                <label for="age" class="flex flex-col w-full form-label sm:flex-row">Planting Date
                    @error('age')
                    <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message }}</span>
                    @enderror
                </label>
                <input id="age" name="age" type="date" class="w-full form-control" placeholder="Planting Date"
                    value="{{ old('age') }}">
            </div>
            <div class="mb-3">
                <label for="pg" class="form-label">Plantation Group</label>
                <select id="pg" name="pg" type="text" wire:model='pg' class="w-full bg-white form-control"
                    placeholder="Plantation Group">
                    <option value="">Pilih</option>
                    @foreach ($pgOption as $item)
                    <option value="{{ $item->pg }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="area" class="form-label">Area</label>
                <select id="area" name="area" type="text" wire:model='area' class="w-full bg-white form-control"
                    placeholder="Area">
                    <option value="">Pilih</option>
                    @foreach ($areaOption as $item)
                    <option value="{{ $item->area }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <select id="location" name="location" type="text" class="w-full bg-white form-control"
                    placeholder="Location">
                    <option value="">Pilih</option>
                    @foreach ($locationOption as $item)
                    <option value="{{ $item->location }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="gambar_taksasi" class="flex flex-col w-full form-label sm:flex-row">Taksasi
                    @error('gambar_taksasi')
                    <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message }}</span>
                    @enderror
                </label>
                <input id="gambar_taksasi" name="gambar_taksasi" type="file" accept="image/*"
                    class="w-full transition cursor-pointer form-control file:bg-indigo-50 file:hover:bg-indigo-100 file:rounded-full file:px-3 file:py-1 file:border-none file:text-indigo-800 file:duration-300"
                    placeholder="Taksasi">
            </div>
            <div class="mb-3">
                <label for="gambar_ndvi" class="flex flex-col w-full form-label sm:flex-row">NDVI
                    @error('gambar_ndvi')
                    <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message }}</span>
                    @enderror
                </label>
                <input id="gambar_ndvi" name="gambar_ndvi" type="file" accept="image/*"
                    class="w-full transition cursor-pointer form-control file:bg-indigo-50 file:hover:bg-indigo-100 file:rounded-full file:px-3 file:py-1 file:border-none file:text-indigo-800 file:duration-300"
                    placeholder="NDVI">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-2 md:col-span-1">
                    <label for="sw_latitude" class="flex flex-col w-full form-label sm:flex-row">Southwest
                        Latitude
                        @error('sw_latitude')
                        <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message
                            }}</span>
                        @enderror
                    </label>
                    <input id="sw_latitude" name="sw_latitude" type="text" class="w-full form-control"
                        placeholder="Southwest Latitude" value="{{ old('sw_latitude') }}">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="sw_longitude" class="flex flex-col w-full form-label sm:flex-row">Southwest
                        Longitude
                        @error('sw_longitude')
                        <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message
                            }}</span>
                        @enderror
                    </label>
                    <input id="sw_longitude" name="sw_longitude" type="text" class="w-full form-control"
                        placeholder="Southwest Longitude" value="{{ old('sw_longitude') }}">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-2 md:col-span-1">
                    <label for="ne_latitude" class="flex flex-col w-full form-label sm:flex-row">Northeast
                        Latitude
                        @error('ne_latitude')
                        <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message
                            }}</span>
                        @enderror
                    </label>
                    <input id="ne_latitude" name="ne_latitude" type="text" class="w-full form-control"
                        placeholder="Northeast Latitude" value="{{ old('ne_latitude') }}">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label for="ne_longitude" class="flex flex-col w-full form-label sm:flex-row">Northeast
                        Longitude
                        @error('ne_longitude')
                        <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message
                            }}</span>
                        @enderror
                    </label>
                    <input id="ne_longitude" name="ne_longitude" type="text" class="w-full form-control"
                        placeholder="Northeast Longitude" value="{{ old('ne_longitude') }}">
                </div>
            </div>
            <div class="flex flex-col justify-end gap-4 pt-3 md:flex-row">
                <button class="w-full font-semibold text-white btn bg-primary-1 md:w-24">
                    SAVE
                </button>
                <a href="{{ route('map.section.list') }}"
                    class="w-full font-semibold btn btn-outline-secondary md:w-24">CANCEL</a>
            </div>
        </form>
    </div>
</div>
