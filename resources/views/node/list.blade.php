<x-app-layout>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 intro-x">
            <div class="alert alert-success alert-dismissible show flex items-center mb-2" role="alert"> <i
                    data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> 10 latest data of sensor <button
                    type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x"
                        class="w-4 h-4"></i> </button> </div>


        </div>
        @foreach ($data as $node)
        <div class="col-span-12 xl:col-span-4">
            <h1 class="text-lg font-semibold w-full text-center text-blue-900">{{$node['name']}}</h1>
            <table class="table table-report">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap text-center">Soil Moisture</th>
                        <th class="whitespace-nowrap text-center">Humidity</th>
                        <th class="whitespace-nowrap text-center">Temperature</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($node['data'] as $item)

                    <tr>
                        <td class="whitespace-nowrap text-center">{{$item->soil_moisture ?? "-"}}</td>
                        <td class="whitespace-nowrap border-x text-center">{{$item->humidity ?? "-"}}</td>
                        <td class="whitespace-nowrap text-center">{{$item->temp ?? "-"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</x-app-layout>
