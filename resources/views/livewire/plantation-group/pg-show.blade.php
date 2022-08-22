<div class="grid grid-cols-12 gap-4 mt-4">
    <div class="col-span-12">
        <div class="relative z-0 rounded h-[50vh] lg:h-80vh" id="map"></div>
    </div>
    <div class="col-span-12">
        <div class="grid grid-cols-12 gap-4 p-4 box">
            <div class="col-span-12 space-y-2 md:col-span-5">
                <div>
                    <span class="text-gray-500">Name :</span>
                    <h1>{{ $detail->name }}</h1>
                </div>
                <div>
                    <span class="text-gray-500">Chief :</span>
                    <h1>{{ $detail->getChief->name }}</h1>
                </div>
            </div>
            <div class="grid col-span-12 gap-3 space-y-2 md:grid-cols-3 md:col-span-7">
                <div>
                    <span class="text-gray-500">Code :</span>
                    <p>{{ $detail->type . '-' . $detail->pg }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Section :</span>
                    <p>{{ count($sections) }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Created At :</span>
                    <p>{{ $detail->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/styleFeatures.js')}}"></script>
<script>
    var geometry = {!! $data->geometry !!}
    var geojson = L.geoJSON({
            "type":"FeatureCollection",
            "features":geometry,
        }, {
            style: {
                fillOpacity: 0,
                weight: .2,
            }
        });

    var section = {!! $sections !!}
    var sectionGeoJson = L.geoJSON({
            "type":"FeatureCollection",
            "features":section,
        }, {
            style: {
                fillOpacity: 0,
                weight: 1,
            },
            onEachFeature:function(feature, layer){
                var properties = feature.properties;
                layer.setStyle({
                    fillColor: properties.color,
                    weight:0,
                    fillOpacity:.5
                });
            }
        });

    var irigation = {!! $irigations !!}
    var irigationGeoJson = L.geoJSON({
            "type":"FeatureCollection",
            "features":irigation,
        }, {
            style: {
                fillOpacity: 1,
                weight: 1,
            },
            onEachFeature: (feature, layer)=>{
                var properties = feature.properties;
                var attr = feature.geometry;
                attr.type !== 'Point' && layer.setStyle({
                    fillColor: properties.color,
                    weight:0,
                    fillOpacity:.5
                });
            }
        });

    var map = L.map('map').fitBounds(geojson.getBounds());
        var accessToken =
        "pk.eyJ1IjoiZmhtYWxiYSIsImEiOiJja3BlMnMxMmoxdG5tMm9ueDg2bGhkd25uIn0._R9TCI9p116Gvg1fdsc9GQ";

    sectionGeoJson.addTo(map);
    geojson.addTo(map);
    L.tileLayer("https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key=alBl9LqyJYaeNUXETEvW",{
        attribution:'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(map);

    map.scrollWheelZoom.disable();
    let overlays = {
        'Irigation' : irigationGeoJson
    }
    L.control.layers(null,overlays).addTo(map)
</script>
