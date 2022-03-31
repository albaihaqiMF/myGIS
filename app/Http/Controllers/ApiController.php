<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Section;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $data = $data->map(function ($value) {
            return [
                'id' => (int)$value->id,
                'name' => $value->name,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];
        });

        return $this->responseOK('Data Collected Successfully', $data);
    }

    public function storeNode(Request $request)
    {
        $header = $request->header('APP-KEY');

        if ($header !== env('API_KEY')) {
            return $this->responseError('Unauthorized key');
        }

        $validation = Validator::make($request->all(), [
            'node' => 'required',
            'soil_moisture' => 'required',
            'humidity' => 'required',
            'temp' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->responseError('Fields required', $validation->errors());
        }
        try {

            $data = Sensor::create([
                'node' => $request->node,
                'soil_moisture' => $request->soil_moisture,
                'humidity' => $request->humidity,
                'temp' => $request->temp,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);

            return $this->responseOK('Success', $data);

        } catch (\Throwable $th) {
            return $this->responseError('Something Wrong!');
        }

    }
}
