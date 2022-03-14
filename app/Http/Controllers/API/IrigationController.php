<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Irigation;
use Illuminate\Http\Request;

class IrigationController extends Controller
{
    public function list()
    {
        $data = Irigation::all();
        $data = $data->map(function($value){
            return [
                'id' => $value->id,
                'name' => $value->name,
                'state' => $value->state,
                'plantation_group' => $value->plantationGroup,
                'geometry' => json_decode($value->geometry),
                'created_at' => date('l, d M Y H:i:s',strtotime($value->created_at)),
                'updated_at' => date('l, d M Y H:i:s',strtotime($value->updated_at)),
            ];
        });

        return $this->responseOK('Collected Data Irigation Successfully', $data);
    }
}
