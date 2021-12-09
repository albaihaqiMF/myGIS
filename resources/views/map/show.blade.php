<x-app-layout>
    @if (session()->has('success'))
    <div class="alert alert-dismissible show box bg-green-500 text-white flex items-center mb-6" role="alert">
        <span>
            {{ session()->get('success') }}.
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
    <div class="h-80vh rounded relative z-0" id="map"></div>
    <div class="grid grid-col-12 gap-4 py-4">
        <div class="col-span-full md:col-span-8">
            <form action="{{ route('map.update', [
                'lahan' => $data->id,
            ]) }}" enctype="multipart/form-data" method="POST" class="box px-4 py-6">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" name="name" type="text" class="form-control w-full" placeholder="Name"
                        value="{{ old('name') ?? $data->name }}">
                </div>
                <div class="mb-3">
                    <label for="gambar_taksasi" class="form-label">Taksasi</label>
                    <input id="gambar_taksasi" name="gambar_taksasi" type="file" accept="image/*"
                        class="form-control w-full" placeholder="Taksasi">
                </div>
                <div class="mb-3">
                    <label for="gambar_ndvi" class="form-label">NDVI</label>
                    <input id="gambar_ndvi" name="gambar_ndvi" type="file" accept="image/*" class="form-control w-full"
                        placeholder="NDVI">
                </div>
                <div class="mb-3 grid grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <label for="sw_latitude" class="form-label">Southwest Latitude</label>
                            <input id="sw_latitude" name="sw_latitude" type="text" class="form-control w-full"
                                placeholder="Southwest Latitude" value="{{ old('sw_latitude') ?? $data->sw_latitude }}">
                        </div>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <label for="sw_longitude" class="form-label">Southwest Longitude</label>
                            <input id="sw_longitude" name="sw_longitude" type="text" class="form-control w-full"
                                placeholder="Southwest Longitude"
                                value="{{ old('sw_longitude') ?? $data->sw_longitude }}">
                        </div>
                    </div>
                </div>
                <div class="mb-3 grid grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <label for="ne_latitude" class="form-label">Northeast Latitude</label>
                            <input id="ne_latitude" name="ne_latitude" type="text" class="form-control w-full"
                                placeholder="Northeast Latitude" value="{{ old('ne_latitude') ?? $data->ne_latitude }}">
                        </div>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <label for="ne_longitude" class="form-label">Northeast Longitude</label>
                            <input id="ne_longitude" name="ne_longitude" type="text" class="form-control w-full"
                                placeholder="Northeast Longitude"
                                value="{{ old('ne_longitude') ?? $data->ne_longitude }}">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-end pt-3 gap-4">
                    <button class="btn bg-green-500 w-full md:w-24 text-white font-semibold">
                        UPDATE
                    </button>
                    <!-- BEGIN: Modal Toggle -->
                    <div class="text-center"> <a href="javascript:;" data-toggle="modal"
                            data-target="#delete-modal-preview" class="btn btn-danger">DELETE</a> </div>
                    <!-- END: Modal Toggle -->
                </div>
            </form>

            <!-- BEGIN: Modal Content -->
            <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center"> <i data-feather="x-circle"
                                    class="w-16 h-16 text-theme-21 mx-auto mt-3"></i>
                                <div class="text-3xl mt-5">Are you sure?</div>
                                <div class="text-gray-600 mt-2">Do you really want to delete these records?
                                    <br>This process cannot be undone.
                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center flex justify-center">
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                                <form action="{{ route('map.delete', [
                                                'lahan' => $data->id
                                            ]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-24">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- END: Modal Content -->
        </div>
    </div>

    <script>
        var urlTaksasi = "{!! $data->gambar_taksasi !!}";
        var urlNdvi = "{!! $data->gambar_ndvi !!}";
        var sw_lat = {!! $data->sw_latitude !!};
        var sw_long = {!! $data->sw_longitude !!};
        var ne_lat = {!! $data->ne_latitude !!};
        var ne_long = {!! $data->ne_longitude !!};
        const sw = [sw_lat, sw_long];
        const ne = [ne_lat, ne_long];

        var map = L.map('map').fitBounds([
            sw, ne
        ]);
        var accessToken =
        "pk.eyJ1IjoiZmhtYWxiYSIsImEiOiJja3BlMnMxMmoxdG5tMm9ueDg2bGhkd25uIn0._R9TCI9p116Gvg1fdsc9GQ";

        var weatherMapKey = "b1b15e88fa797225412429c1c50c122a1"
        var weatherMap = `http://maps.openweathermap.org/maps/2.0/weather/TA2/{z}/{x}/{y}?appid=${weatherMapKey}&fill_bound=true&opacity=0.6&palette=-65:821692;-55:821692;-45:821692;-40:821692;-30:8257db;-20:208cec;-10:20c4e8;0:23dddd;10:c2ff28;20:fff028;25:ffc228;30:fc8014`

        L.tileLayer(
            "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
            {
                attribution:
                    'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: "mapbox/streets-v11",
                tileSize: 512,
                zoomOffset: -1,
                accessToken: accessToken,
            }
        ).addTo(map);
        var overlay = L.tileLayer(weatherMap)

        var taksasi = L.imageOverlay("http://localhost:8000/storage/"+urlTaksasi, [ne, sw]).addTo(map);
        var ndvi = L.imageOverlay("http://localhost:8000/storage/"+urlNdvi, [ne, sw]);
        var baseMaps = {
            "Taksasi Overlay":taksasi,
            "NDVI Overlay" : ndvi,
        };

        var overlaysMaps = {
            "Weather" : overlay,
        }

        L.control.layers(baseMaps, overlaysMaps).addTo(map);


    </script>
</x-app-layout>
