<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MasterGroup;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class MasterGroupController extends Controller
{
    public function index()
    {
        return [
            [
                'total' => MasterGroup::where('type', 'PG')->get()->count(),
                'url' => env('APP_URL') . "/api/map/plantation-group"
            ],
            [
                'total' => MasterGroup::where('type', 'AREA')->get()->count(),
                'url' => env('APP_URL') . "/api/map/area"
            ],
            [
                'total' => MasterGroup::where('type', 'LOC')->get()->count(),
                'url' => env('APP_URL') . "/api/map/location"
            ],
            [
                'total' => MasterGroup::where('type', 'SEC')->get()->count(),
                'url' => env('APP_URL') . "/api/map/seksi"
            ]
        ];
    }

    public function plantationGroup()
    {
        $data = MasterGroup::where('type', 'PG')->get();

        $data =  $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'chief' => $item->getChief->name,
                'url' => env('APP_URL') . "/api/map/area?pg=" . $item->pg,
            ];
        });

        return $this->responseOK('Plantation Group Data', $data);
    }

    public function area(Request $request)
    {
        $data = $request ? MasterGroup::where('type', 'AREA')->get()
            :
            MasterGroup::where('type', 'AREA')->where('pg', $request->pg)->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'chief' => $item->getChief->name,
                'url' => env('APP_URL') . "/api/map/location?pg=" . $item->pg . "&area=" . $item->area,
            ];
        });

        return $this->responseOK('Area Data', $data);
    }

    public function location(Request $request)
    {
        if ($request->pg === null || $request->area === null) {
            return $this->responseError('PG id and Area id are required');
        }
        $data = $request ? MasterGroup::where('type', 'LOC')->get()
            :
            MasterGroup::where('type', 'AREA')->where('pg', $request->pg)->where('area', $request->area)->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'chief' => $item->getChief->name,
                'url' => env('APP_URL') . "/api/map/section?pg=" . $item->pg . "&area=" . $item->area. "&location=" . $item->location,
            ];
        });
        return $this->responseOK('Location Data', $data);
    }
}
