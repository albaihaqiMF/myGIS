<div class="intro-y box py-10 sm:py-20 mt-5">
    <div class="px-5 sm:px-20 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="grid grid-cols-12 gap-4 gap-y-3 mt-3 intro-y">
            <form action="{{route('irigation.store',[
                'id' => $data->master_id
            ])}}" enctype="multipart/form-data" method="POST"
                class="grid w-full col-span-12 grid-cols-12 gap-4 pt-4">
                @csrf
                <div class="gap-4 col-span-full 2xl:col-span-7 intro-y" wire:ignore>
                    <div class="relative z-0 rounded h-[60vh] xl:h-[75vh]" id="map"></div>
                    <div>
                        <div class="hidden mb-3">
                            <label for="geometry" class="form-label">Data</label>
                            <input id="geometry" name="geometry" type="text" class="w-full form-control"
                                value="{{ old('geometry') }}" placeholder="Data">
                        </div>
                    </div>
                </div>
                <div class="gap-4 col-span-full 2xl:col-span-5 intro-y">
                    <div class="px-4 py-6 box">
                        <div class="mb-3">
                            <label for="name" class="flex flex-col w-full form-label sm:flex-row">Name
                                @error('name')
                                <span class="mt-1 text-xs text-gray-600 sm:ml-auto sm:mt-0">{{ $message }}</span>
                                @enderror
                            </label>
                            <input id="name" name="name" type="text" class="w-full form-control" placeholder="Name"
                                value="{{ old('name') }}">
                        </div>
                    </div>
                </div>
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button class="btn btn-primary w-24 ml-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var geometry = {!! $data->geometry !!}
    var geojsonData = L.geoJSON({
            "type":"FeatureCollection",
            "features":geometry,
        }, {
            style: {
                fillOpacity: 0,
                weight: 1,
            }
        });

    var weatherMapKey = "b1b15e88fa797225412429c1c50c122a1"
    var weatherMap = `http://maps.openweathermap.org/maps/2.0/weather/TA2/{z}/{x}/{y}?appid=${weatherMapKey}&fill_bound=true&opacity=0.6&palette=-65:821692;-55:821692;-45:821692;-40:821692;-30:8257db;-20:208cec;-10:20c4e8;0:23dddd;10:c2ff28;20:fff028;25:ffc228;30:fc8014`

    var map = L.map('map').fitBounds(geojsonData.getBounds());
        var accessToken =
        "pk.eyJ1IjoiZmhtYWxiYSIsImEiOiJja3BlMnMxMmoxdG5tMm9ueDg2bGhkd25uIn0._R9TCI9p116Gvg1fdsc9GQ";

    geojsonData.addTo(map);
    L.tileLayer("https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key=alBl9LqyJYaeNUXETEvW",{
        attribution:'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(map);
    map.scrollWheelZoom.disable();
    var overlay = L.tileLayer(weatherMap)

    var overlaysMaps = {
        "Weather" : overlay,
    }

    L.control.layers(null,overlaysMaps).addTo(map);
    // map.scrollWheelZoom.disable();

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    var formInput = document.getElementById('geometry');

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
