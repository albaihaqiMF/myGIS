<x-app-layout title="Input Map Data">
    <div class="grid grid-cols-12 w-full pt-4 gap-4">
        <div class="col-span-full 2xl:col-span-8 gap-4 intro-y">
            <form action="{{ route('map.store') }}" enctype="multipart/form-data" method="POST" class="box px-4 py-6">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label w-full flex flex-col sm:flex-row">Name
                        @error('name')
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="name" name="name" type="text" class="form-control w-full" placeholder="Name"
                        value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="gambar_taksasi" class="form-label w-full flex flex-col sm:flex-row">Taksasi
                        @error('gambar_taksasi')
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="gambar_taksasi" name="gambar_taksasi" type="file" accept="image/*"
                        class="form-control w-full" placeholder="Taksasi">
                </div>
                <div class="mb-3">
                    <label for="gambar_ndvi" class="form-label w-full flex flex-col sm:flex-row">NDVI
                        @error('gambar_ndvi')
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="gambar_ndvi" name="gambar_ndvi" type="file" accept="image/*" class="form-control w-full"
                        placeholder="NDVI">
                </div>
                <div class="mb-3 grid grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <label for="sw_latitude" class="form-label w-full flex flex-col sm:flex-row">Southwest
                            Latitude
                            @error('sw_latitude')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">{{ $message
                                }}</span>
                            @enderror
                        </label>
                        <input id="sw_latitude" name="sw_latitude" type="text" class="form-control w-full"
                            placeholder="Southwest Latitude" value="{{ old('sw_latitude') }}">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label for="sw_longitude" class="form-label w-full flex flex-col sm:flex-row">Southwest
                            Longitude
                            @error('sw_longitude')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">{{ $message
                                }}</span>
                            @enderror
                        </label>
                        <input id="sw_longitude" name="sw_longitude" type="text" class="form-control w-full"
                            placeholder="Southwest Longitude" value="{{ old('sw_longitude') }}">
                    </div>
                </div>
                <div class="mb-3 grid grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <label for="ne_latitude" class="form-label w-full flex flex-col sm:flex-row">Northeast
                            Latitude
                            @error('ne_latitude')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">{{ $message
                                }}</span>
                            @enderror
                        </label>
                        <input id="ne_latitude" name="ne_latitude" type="text" class="form-control w-full"
                            placeholder="Northeast Latitude" value="{{ old('ne_latitude') }}">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label for="ne_longitude" class="form-label w-full flex flex-col sm:flex-row">Northeast
                            Longitude
                            @error('ne_longitude')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">{{ $message
                                }}</span>
                            @enderror
                        </label>
                        <input id="ne_longitude" name="ne_longitude" type="text" class="form-control w-full"
                            placeholder="Northeast Longitude" value="{{ old('ne_longitude') }}">
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-end pt-3 gap-4">
                    <button class="btn bg-theme-11 w-full md:w-24 text-white font-semibold">
                        SAVE
                    </button>
                    <a href="{{ route('map.list') }}"
                        class="btn btn-outline-secondary w-full md:w-24 font-semibold">CANCEL</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
