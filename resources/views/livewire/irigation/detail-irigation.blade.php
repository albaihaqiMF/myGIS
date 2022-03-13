@if (session()->has('success'))
<div class="flex items-center mb-6 text-white bg-green-500 alert alert-dismissible show box" role="alert">
    <span>
        {{ session()->get('success') }}.
    </span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <svg
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="w-4 h-4 feather feather-x">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg> </button>
</div>
@endif
<div class="relative z-0 rounded h-30vh lg:h-80vh" id="map"></div>
<div class="p-4 mt-4 box">
    <table class="table">
        <thead>
            <tr>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Title</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">{{ $data->name }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border-b dark:border-dark-5">State</td>
                <td class="border-b dark:border-dark-5">{{ $data->state }}</td>
            </tr>
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
    <div class="flex gap-3 mt-6">
        @if (auth()->user()->role_id == 1 || $data->isMe())
        <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#edit"><i data-feather="edit-2"
                class="w-4 h-4 mr-3"></i>EDIT</a>
        <div id="edit" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-10">
                        <form action="{{route('irigation.update', ['id'=> $data->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Title</label>
                                <input id="name" name="name" type="text" class="form-control w-full" placeholder="Title"
                                    value="{{$data->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <select data-placeholder="Pilih State" class="tom-select w-full tomselected" id="state"
                                    tabindex="-1" hidden="hidden" name="state" value="{{$data->state}}">
                                    <option value="">Pilih</option>
                                    <option value="empty">empty</option>
                                    <option value="quarter">quarter</option>
                                    <option value="half">half</option>
                                    <option value="full">full</option>
                                </select>
                            </div>
                            <div class="mb-3 w-full">
                                <button type="submit" class="btn bg-green-500 text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN: Modal Toggle -->
        <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview"
                class="btn btn-danger"><i data-feather="trash-2" class="w-4 h-4 mr-3"></i>DELETE</a> </div>
        @endif
        <!-- END: Modal Toggle -->
    </div>
</div>
<script>
    var geometry = {!! $geojson !!}
    var geojson = L.geoJSON({
        'type' : 'FeatureCollection',
        'features': geometry
    }, {
            style: {
                fillColor: 'blue',
                weight: 1,
            }
        });
    var map = L.map('map').fitBounds(geojson.getBounds());
        var accessToken =
        "pk.eyJ1IjoiZmhtYWxiYSIsImEiOiJja3BlMnMxMmoxdG5tMm9ueDg2bGhkd25uIn0._R9TCI9p116Gvg1fdsc9GQ";
        map.scrollWheelZoom.disable();
    geojson.addTo(map);
    L.tileLayer("https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key=alBl9LqyJYaeNUXETEvW",{
        attribution:'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(map);
</script>
