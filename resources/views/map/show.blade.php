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
    <div class="h-96 lg:h-80vh rounded relative z-0" id="map"></div>
    <div class="mt-4 box p-4">
        <table class="table">
            <thead>
                <tr>
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Title</th>
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">{{ $data->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b dark:border-dark-5">Creator</td>
                    <td class="border-b dark:border-dark-5">{{ $data->creator->name }}</td>
                </tr>
                <tr>
                    <td class="border-b dark:border-dark-5">Created At</td>
                    <td class="border-b dark:border-dark-5">{{ date('d M Y, H:i:s', strtotime($data->created_at))
                        }}<span class="ml-3 text-gray-500">{{ $data->created_at->diffForHumans() }}</span></td>
                </tr>
                <tr>
                    <td class="border-b dark:border-dark-5">Updated At</td>
                    <td class="border-b dark:border-dark-5">{{ date('d M Y, H:i:s', strtotime($data->updated_at))
                        }}<span class="ml-3 text-gray-500">{{ $data->updated_at->diffForHumans() }}</span></td>
                </tr>
            </tbody>
        </table>
        <div class="flex mt-6 gap-3">
            <a href="{{ route('map.edit', [
                'lahan' => $data->id
            ]) }}" class="btn btn-primary w-32"><i data-feather="edit-2" class="h-4 w-4 mr-3"></i>EDIT</a>
            <a href="{{ route('map.progres', ['lahan'=> $data->id]) }}" class="btn w-32 bg-theme-20 text-white"><i
                    data-feather="clipboard" class="h-4 w-4 mr-3"></i>PROGRES</a>

            <!-- BEGIN: Modal Toggle -->
            @if (auth()->user()->role_id == 1)
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview"
                    class="btn btn-danger"><i data-feather="trash-2" class="w-4 h-4 mr-3"></i>DELETE</a> </div>
            @endif
            <!-- END: Modal Toggle -->
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

        const geometry = {!! $geojson !!};

        const myGeoJSON = {
            "type":"FeatureCollection",
            "features":geometry,
        }

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
                drawControl: true,
            }
        ).addTo(map);
        var overlay = L.tileLayer(weatherMap)

        var taksasi = L.imageOverlay("/storage/"+urlTaksasi, [ne, sw]).addTo(map);
        var ndvi = L.imageOverlay("/storage/"+urlNdvi, [ne, sw]);

        var progres = L.geoJSON(myGeoJSON,{
            onEachFeature: function (feature, layer) {
                layer.bindPopup(
                    `<div>
                        <table class='table table-hover'>
                            <tr>
                                <td>ID</td>
                                <td>: ${feature.properties.id}</td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td>: ${feature.properties.catatan}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td class="whitespace-nowrap">: ${feature.properties.created_at}</td>
                            </tr>
                        </table>
                    </div>`
                )
            },
        }).addTo(map);
        var baseMaps = {
            "Taksasi Overlay":taksasi,
            "NDVI Overlay" : ndvi,
        };

        var overlaysMaps = {
            "Weather" : overlay,
            "Progres" : progres,
        }

        L.control.layers(baseMaps, overlaysMaps).addTo(map);
        map.scrollWheelZoom.disable();
    </script>
</x-app-layout>
