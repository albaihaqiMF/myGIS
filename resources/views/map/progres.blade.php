<x-app-layout title="Progres {{ $data->name }}">
    <div class="h-80vh rounded relative z-0" id="map"></div>
    <div class="box mt-4 p-4">
        <form action="{{ route('section.progres.upload', ['section'=> $data->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <input id="catatan" name="catatan" type="text" class="form-control w-full" value="{{ old('catatan') }}"
                    placeholder="Catatan">
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input id="data" name="data" type="text" class="form-control w-full hidden" value="{{ old('data') }}"
                    placeholder="Data">
            </div>
            <div class="w-full">
                <button type="submit" class="btn bg-theme-20 text-white w-24">UPLOAD</button>
            </div>
        </form>
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
        var progres = L.geoJSON(myGeoJSON,{
            onEachFeature: function (feature, layer) {
                layer.bindPopup(
                    `<div class="p-4">
                        <table class='table table-hover'>
                            <tr>
                                <td>Catatan</td>
                                <td>: ${feature.properties.catatan}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>: ${feature.properties.created_at}</td>
                            </tr>
                        </table>
                    </div>`
                )
            },
        }).addTo(map);

        var taksasi = L.imageOverlay("/storage/"+urlTaksasi, [ne, sw]).addTo(map);
        var ndvi = L.imageOverlay("/storage/"+urlNdvi, [ne, sw]);
        var baseMaps = {
            "Taksasi Overlay":taksasi,
            "NDVI Overlay" : ndvi,
        };

        var overlaysMaps = {
            "Weather" : overlay,
            "Progres" : progres
        }

        L.control.layers(baseMaps, overlaysMaps).addTo(map);
        map.scrollWheelZoom.disable();

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: drawnItems
            }
        });
        map.addControl(drawControl);

        var formInput = document.getElementById('data');

        var geojson;

        map.on('draw:created', function(e){
            var layer = e.layer,
            feature = layer.feature = layer.feature || {};

            feature.type = feature.type || "Feature";
            var props = feature.properties = feature.properties || {};

            drawnItems.addLayer(layer);

            geojson = drawnItems.toGeoJSON();

            formInput.value = JSON.stringify(geojson.features)
        })


    </script>
</x-app-layout>
