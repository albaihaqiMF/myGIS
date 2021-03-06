<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MasterGroup;
use App\Models\Progres;
use App\Models\Section;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class MasterGroupController extends Controller
{
    public function index()
    {
        return [
            [
                'title' => 'Plantation Group',
                'total' => MasterGroup::where('type', 'PG')->get()->count(),
                'url' => env('APP_URL') . "/api/map/plantation-group"
            ],
            [
                'title' => 'Area',
                'total' => MasterGroup::where('type', 'AREA')->get()->count(),
                'url' => env('APP_URL') . "/api/map/area"
            ],
            [
                'title' => 'Location',
                'total' => MasterGroup::where('type', 'LOC')->get()->count(),
                'url' => env('APP_URL') . "/api/map/location"
            ],
            [
                'title' => 'Section',
                'total' => MasterGroup::where('type', 'SEC')->get()->count(),
                'url' => env('APP_URL') . "/api/map/section"
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
                'created_at' => date('l, d F Y', strtotime($item->created_at)),
                'updated_at' => date('l, d F Y', strtotime($item->updated_at)),
                'url' => env('APP_URL') . "/api/map/area?pg=" . $item->pg,
            ];
        });

        return $this->responseOK('Plantation Group Data', $data);
    }
    public function plantationGroupShow($id)
    {
        $attr = MasterGroup::where('type', 'PG')->where('id', $id)->first();

        if ($attr === null) {
            return $this->responseError('Data doesn\'t exist');
        }

        $sections = MasterGroup::where('type', 'SEC')->where('pg', $attr->pg)->get();

        $sections = $sections->map(function ($value) {
            $data = $value->getSection;
            $geometry = json_decode($data->geometry)[0];
            $geometry->properties = [
                'color' => $this->getColor($data->crop)
            ];
            return $geometry;
        });

        $data = [
            'id' => $attr->id,
            'name' => $attr->name,
            'chief' => $attr->getChief->name,
            'pg' => $attr->pg,
            'area' => $attr->area,
            'location' => $attr->location,
            'section' => $attr->section,
            'created_at' => $attr->created_at,
            'updated_at' => $attr->updated_at,
            'geometry' => [
                "type" => "FeatureCollection",
                "features" => $sections,
            ],
        ];
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
                'created_at' => date('l, d F Y', strtotime($item->created_at)),
                'updated_at' => date('l, d F Y', strtotime($item->updated_at)),
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
        $data = MasterGroup::where('type', 'LOC')->where('pg', $request->pg)
            ->where('area', $request->area)->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'pg' => $item->pg,
                'area' => $item->area,
                'location' => $item->location,
                'section' => $item->section,
                'chief' => $item->getChief->name,
                'created_at' => date('l, d F Y', strtotime($item->created_at)),
                'updated_at' => date('l, d F Y', strtotime($item->updated_at)),
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

        $data = MasterGroup::where('type', 'SEC')->where('pg', $request->pg)->where('area', $request->area)->where('location', $request->location)->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'pg' => $item->pg,
                'area' => $item->area,
                'location' => $item->location,
                'section' => $item->section,
                'chief' => $item->getChief->name,
                'created_at' => date('l, d F Y', strtotime($item->created_at)),
                'updated_at' => date('l, d F Y', strtotime($item->updated_at)),
                'url' => env('APP_URL') . "/api/map/section/" . $item->id,
            ];
        });
        return $this->responseOK('Location Data', $data);
    }

    public function sectionShow($id)
    {
        $masterSection = MasterGroup::where('type', 'SEC')->where('id', $id)->first();

        $section = Section::where('master_id', $id)->first();
        if ($masterSection === null || $section === null) {
            return $this->responseError('Data doesn\'t exist');
        }

        $geojsonValue = $masterSection->getSection->progress;
        $geojsonValue = $geojsonValue->map(function ($value) {
            return Progres::mapData($value);
        });
        $geojson = $geojsonValue->count() !== 0 ? [
            "type" => "FeatureCollection",
            "features" => $geojsonValue,
        ] : null;

        $irigations = $section->irigations;

        $irigation = $irigations->count() !== 0 ? $irigations[0] : null;


        $attr = MasterGroup::mapSection($masterSection);
        $attr['progres'] = $geojson;
        if ($irigation !== null) {
            $irigationGeojson = json_decode($irigation['geometry'])[0];
            $irigation['geometry'] = [
                'type' => 'FeatureCollection',
                'features' => array($irigationGeojson)
            ];
        } else {
            $irigation = null;
        }
        $attr['irigation'] = $irigation;
        return $this->responseOK('Data Section by id ' . $id . ' collected succesfully', $attr);
    }
}
