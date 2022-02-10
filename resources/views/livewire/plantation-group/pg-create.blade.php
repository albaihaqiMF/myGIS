<div class="relative z-0 rounded h-[50vh]" id="map"></div>
@error('geometry')
<span class="text-red-500">{{ $message }}</span>
@enderror
<div class="p-4 mt-4 box">
    <form action="{{ route('map.pg.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text" class="w-full form-control" value="{{ old('name') }}"
                placeholder="name">
            @error('name')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Detail</label>
            <input id="detail" name="detail" type="text" class="w-full form-control" placeholder="Detail">
            @error('detail')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="hidden mb-3">
            <label for="geometry" class="form-label">Data</label>
            <input id="geometry" name="geometry" type="text" class="w-full form-control" value="{{ old('geometry') }}"
                placeholder="Data">
        </div>
        <div class="w-full">
            <button type="submit" class="w-24 text-white btn bg-theme-20">Create</button>
        </div>
    </form>
</div>
<script>
    var map = L.map('map', {
        center: [-5.085472657670731,105.0567626953125],
        zoom:8,
    });
    var accessToken =
    "pk.eyJ1IjoiZmhtYWxiYSIsImEiOiJja3BlMnMxMmoxdG5tMm9ueDg2bGhkd25uIn0._R9TCI9p116Gvg1fdsc9GQ";

    var weatherMapKey = "b1b15e88fa797225412429c1c50c122a1"
    var weatherMap = `http://maps.openweathermap.org/maps/2.0/weather/TA2/{z}/{x}/{y}?appid=${weatherMapKey}&fill_bound=true&opacity=0.6&palette=-65:821692;-55:821692;-45:821692;-40:821692;-30:8257db;-20:208cec;-10:20c4e8;0:23dddd;10:c2ff28;20:fff028;25:ffc228;30:fc8014`

    L.tileLayer(
        "https://api.maptiler.com/maps/hybrid/?key=alBl9LqyJYaeNUXETEvW#",
        {
            attribution:
                'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: "mapbox/streets-v11",
            tileSize: 512,
            zoomOffset: -1,
            drawControl: true,
        }
    ).addTo(map);
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
