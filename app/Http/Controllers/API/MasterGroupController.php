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
                'pg' => $item->pg,
                'area' => $item->area,
                'location' => $item->location,
                'section' => $item->section,
                'chief' => $item->getChief->name,
                'url' => env('APP_URL') . "/api/map/area?pg=" . $item->pg,
            ];
        });

        return $this->responseOK('Plantation Group Data', $data);
    }
    public function plantationGroupShow($id)
    {
        $data = MasterGroup::where('type', 'PG')->where('id', $id)->first();

        $data['chief'] = $data->getChief->name;

        if ($data === null) {
            return $this->responseError('Data doesn\'t exist');
        }
        return $this->responseOK('Data Plantation Group by id ' . $id . ' collected succesfully', $data);
    }

    public function area(Request $request)
    {
        $data = MasterGroup::where('type', 'AREA')->where('pg', $request->pg)->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'pg' => $item->pg,
                'area' => $item->area,
                'location' => $item->location,
                'section' => $item->section,
                'chief' => $item->getChief->name,
                'url' => env('APP_URL') . "/api/map/location?pg=" . $item->pg . "&area=" . $item->area,
            ];
        });

        return $this->responseOK('Area Data', $data);
    }
    public function areaShow($id)
    {
        $data = MasterGroup::where('type', 'AREA')->where('id', $id)->first();

        $data['chief'] = $data->getChief->name;

        if ($data === null) {
            return $this->responseError('Data doesn\'t exist');
        }
        return $this->responseOK('Data Area by id ' . $id . ' collected succesfully', $data);
    }

    public function location(Request $request)
    {
        if ($request->pg === null || $request->area === null) {
            return $this->responseError('PG id and Area id are required');
        }
        $data = $request ? MasterGroup::where('type', 'LOC')->get()
            :
            MasterGroup::where('type', 'LOC')->where('pg', $request->pg)->where('area', $request->area)->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'pg' => $item->pg,
                'area' => $item->area,
                'location' => $item->location,
                'section' => $item->section,
                'chief' => $item->getChief->name,
                'url' => env('APP_URL') . "/api/map/section?pg=" . $item->pg . "&area=" . $item->area . "&location=" . $item->location,
            ];
        });
        return $this->responseOK('Location Data', $data);
    }
    public function locationShow($id)
    {
        $data = MasterGroup::where('type', 'LOC')->where('id', $id)->first();

        $data['chief'] = $data->getChief->name;

        if ($data === null) {
            return $this->responseError('Data doesn\'t exist');
        }
        return $this->responseOK('Data Location by id ' . $id . ' collected succesfully', $data);
    }

    public function section(Request $request)
    {
        if ($request->pg === null || $request->area === null || $request->location === null) {
            return $this->responseError('PG id and Area id are required');
        }

        $data = $request ? MasterGroup::where('type', 'SEC')->get()
            :
            MasterGroup::where('type', 'SEC')->where('pg', $request->pg)->where('area', $request->area)->where('location', $request->area)->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'pg' => $item->pg,
                'area' => $item->area,
                'location' => $item->location,
                'section' => $item->section,
                'chief' => $item->getChief->name,
                'url' => env('APP_URL') . "/api/map/section?pg=" . $item->pg . "&area=" . $item->area . "&location=" . $item->location,
            ];
        });
        return $this->responseOK('Location Data', $data);
    }

    public function sectionShow($id)
    {
        $data = MasterGroup::where('type', 'SEC')->where('id', $id)->first();
        $data->getSection;

        $data['chief'] = $data->getChief->name;

        if ($data === null) {
            return $this->responseError('Data doesn\'t exist');
        }
        return $this->responseOK('Data Section by id ' . $id . ' collected succesfully', $data);
    }
}
