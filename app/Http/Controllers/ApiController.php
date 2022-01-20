<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Lahan;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function listMap(Request $request)
    {
        $area = $request->area ? $request->area : null;
        $data = Lahan::cget($area);

        return $this->responseOK('Data Collected Successfully', $data);
    }

    public function showMap($id)
    {
        try {
            $data = Lahan::find($id);

            if ($data == null) {
                return $this->responseError('Data Does\'nt exist');
            }

            return Lahan::mapData($data);
        } catch (\Throwable $th) {
            return $this->responseError('Failed to Load Data');
        }
    }

    public function areaList()
    {
        $data = Area::all();
        
        $data = $data->map(function($value){
            return [
                'name' => $value->name,
                'id' => (int)$value->id
            ]; 
        });

        return $this->responseOK('Data Collected Successfully', $data);
    }
}
