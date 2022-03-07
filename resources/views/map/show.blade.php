<x-app-layout>
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
                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">{{ $detail->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b dark:border-dark-5">Creator</td>
                    <td class="border-b dark:border-dark-5">{{ $data->isMe() ? 'Saya' : $detail->getChief->name }}</td>
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
            <a href="{{ route('map.section.edit', [
                'section' => $data->id
            ]) }}" class="w-32 btn btn-primary"><i data-feather="edit-2" class="w-4 h-4 mr-3"></i>EDIT</a>
            <a href="{{ route('map.section.progres', ['section'=> $data->id]) }}"
                class="w-32 text-white btn bg-theme-20"><i data-feather="clipboard" class="w-4 h-4 mr-3"></i>PROGRES</a>

            <!-- BEGIN: Modal Toggle -->
            @if (auth()->user()->role_id == 1 || $data->isMe())
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview"
                    class="btn btn-danger"><i data-feather="trash-2" class="w-4 h-4 mr-3"></i>DELETE</a> </div>
            @endif
            <!-- END: Modal Toggle -->
            <!-- BEGIN: Modal Content -->
            <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="p-0 modal-body">
                            <div class="p-5 text-center"> <i data-feather="x-circle"
                                    class="w-16 h-16 mx-auto mt-3 text-theme-21"></i>
                                <div class="mt-5 text-3xl">Are you sure?</div>
                                <div class="mt-2 text-gray-600">Do you really want to delete these records?
                                    <br>This process cannot be undone.
                                </div>
                            </div>
                            <div class="flex justify-center px-5 pb-8 text-center">
                                <button type="button" data-dismiss="modal"
                                    class="w-24 mr-1 btn btn-outline-secondary dark:border-dark-5 dark:text-gray-300">Cancel</button>
                                <form action="{{ route('map.section.delete', [
                                            'section' => $data->id
                                        ]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-24 btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- END: Modal Content -->
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
        map.scrollWheelZoom.disable();
    geojson.addTo(map);
    L.tileLayer("https://api.maptiler.com/maps/hybrid/{z}/{x}/{y}.jpg?key=alBl9LqyJYaeNUXETEvW",{
        attribution:'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(map);
    </script>
</x-app-layout>
