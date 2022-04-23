<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Node;
use App\Models\Section;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function digitDecimal($number, $digits = 2)
    {
        return number_format((float)$number, $digits, '.', '');
    }

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
        $node = Node::where('name', $request->node)->first();

        if ($node == null) {
            Node::insert([
                'name' => $request->node,
            ]);

            $node = Node::where('name', $request->node)->first();
        }
        try {

            $data = Sensor::create([
                'node_id' => $node->id,
                'soil_moisture' => $this->digitDecimal($request->soil_moisture),
                'humidity' => $this->digitDecimal($request->humidity),
                'temp' => $this->digitDecimal($request->temp),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);

            return $this->responseOK('Success', $data);
        } catch (\Throwable $th) {
            return $this->responseError('Something Wrong!');
        }
    }
    public function storeNodeNoToken(Request $request)
    {
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
        $node = Node::where('name', $request->node)->first();

        if ($node == null) {
            Node::insert([
                'name' => $request->node,
            ]);

            $node = Node::where('name', $request->node)->first();
        }
        try {

            $data = Sensor::create([
                'node_id' => $node->id,
                'soil_moisture' => $this->digitDecimal($request->soil_moisture),
                'humidity' => $this->digitDecimal($request->humidity),
                'temp' => $this->digitDecimal($request->temp),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);

            return $this->responseOK('Success', $data);
        } catch (\Throwable $th) {
            return $this->responseError('Something Wrong!');
        }
    }
    public function getData()
    {
        $format = [];

        $nodes = Node::all();

        foreach ($nodes as $value) {
            $node = $value->sensors;
            $format['soil_moisture'][] = [
                'name' => $value->name,
                'data' => $node->map(function ($val) {
                    return $val->soil_moisture;
                })
            ];
            $format['humidity'][] = [
                'name' => $value->name,
                'data' => $node->map(function ($val) {
                    return $val->humidity;
                })
            ];
            $format['temp'][] = [
                'name' => $value->name,
                'data' => $node->map(function ($val) {
                    return $val->temp;
                })
            ];
        }

        return $format;
    }

    public function generateRandomData()
    {
        $nodes = $this->getNodeId();

        $number = rand(40, 50) * (rand(0, 1) - .78);

        Sensor::create([
            'node_id' => $nodes[rand(0, count($nodes) - 1)],
            'soil_moisture' => number_format((float)$number, 2, '.', ''),
            'humidity' => number_format((float)$number, 2, '.', ''),
            'temp' => number_format((float)rand(20, 40) - (rand(1, 3) * .79), 2, '.', ''),
            'latitude' => -5.23472651,
            'longitude' => 105.23058694
        ]);
    }

    public function getNodeName()
    {
        $nodes = Node::get('name');

        $data = $nodes->map(function ($val) {
            return $val->name;
        });

        return $data;
    }
    public function getNodeId()
    {
        $nodes = Node::all();

        $data = $nodes->map(function ($val) {
            return $val->id;
        });

        return $data;
    }
}
