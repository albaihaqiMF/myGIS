<div class="grid grid-cols-12 gap-4 mt-4">
    <div class="col-span-12 lg:col-span-8">
        <div class="relative z-0 rounded h-[50vh] lg:h-80vh" id="map"></div>
    </div>
    <div class="col-span-12 lg:col-span-4">
        <table class="table table-report">
            <tr>
                <td>Name</td>
                <td>: {{ $detail->name }}</td>
            </tr>
            <tr>
                <td>Chief</td>
                <td>: {{ $detail->getChief->name }}</td>
            </tr>
            <tr>
                <td>ID</td>
                <td>: {{ $detail->type . $detail->pg }}</td>
            </tr>
        </table>
    </div>
</div>

<script>
    var geometry = {!! $data->geometry !!}
    var geojson = L.geoJSON({
            "type":"FeatureCollection",
            "features":geometry,
        }, {
            style: {
                fillOpacity: 0,
                weight: 1,
            }
        });
    var map = L.map('map').fitBounds(geojson.getBounds());
        var accessToken =
        "pk.eyJ1IjoiZmhtYWxiYSIsImEiOiJja3BlMnMxMmoxdG5tMm9ueDg2bGhkd25uIn0._R9TCI9p116Gvg1fdsc9GQ";

    geojson.addTo(map);
    L.tileLayer("https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key=alBl9LqyJYaeNUXETEvW",{
        attribution:'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(map);
</script>