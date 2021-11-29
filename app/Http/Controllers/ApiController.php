<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function listMap()
    {
        $data = Lahan::cget();

        return $this->responseOK('Collected Data Successfully', $data);
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
}
