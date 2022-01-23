<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Section;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function listMap(Request $request)
    {
        $area = $request->area ? $request->area : null;
        $data = Section::cget($area);

        return $this->responseOK('Data Collected Successfully', $data);
    }

    public function showMap($id)
    {
        try {
            $data = Section::find($id);

            if ($data == null) {
                return $this->responseError('Data Does\'nt exist');
            }

            return Section::mapData($data);
        } catch (\Throwable $th) {
            return $this->responseError('Failed to Load Data');
        }
    }

    public function areaList()
    {
        $data = Area::all();

        $data = $data->map(function($value){
            return [
                'id' => (int)$value->id,
                'name' => $value->name,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];
        });

        return $this->responseOK('Data Collected Successfully', $data);
    }
}
