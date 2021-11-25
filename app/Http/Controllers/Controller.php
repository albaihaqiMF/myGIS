<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
    {
        return view('dashboard');
    }

    public function formatJSON($message = null, $data = null, $status = false)
    {
        return [
            'success' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

    public function responseOK($message = null, $data = null)
    {
        $attr = $this->formatJSON($message, $data, true);
        return response()->json($attr, 200);
    }

    public function responseError($message = null, $data = null)
    {
        $attr = $this->formatJSON($message, $data);

        return response()->json($attr, 400);
    }

    public function storeImage($attr, $folder = null)
    {
        $folder = $folder !== null ? "images/" . $folder : "images";
        $path = $attr ? $attr->store($folder) : 'null image';

        return $path;
    }
}
