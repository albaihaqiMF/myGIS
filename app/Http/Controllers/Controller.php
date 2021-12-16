<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Progres;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
    {
        $user = [
            'data' => User::where('area_id', auth()->user()->area_id)->get()->count(),
            'rate' => User::where('area_id', auth()->user()->area_id)->whereDate('created_at', today())->get()->count()
        ];

        $progres = [
            'data' => Progres::where('progres_by', auth()->user()->id)->get()->count(),
            'rate' => Progres::where('progres_by', auth()->user()->id)->whereDate('created_at', today())->get()->count()
        ];

        $lahan = [
            'data' => Lahan::where('area_id', auth()->user()->area_id)->get()->count(),
            'rate' => Lahan::where('area_id', auth()->user()->area_id)->whereDate('created_at', today())->get()->count(),
        ];

        return view('dashboard', [
            'user' => $user,
            'progres' => $progres,
            'lahan' => $lahan,
        ]);
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

    public function intTo3Digits($value)
    {
        $newValue = "";
        switch ($value) {
            case $value >= 100:
                $newValue = strval($value);
                break;
            case $value >= 10:
                $newValue = "0" . strval($value);
                break;
            case $value < 10:
                $newValue = "00" . strval($value);
                break;

            default:
                $newValue = "999";
                break;
        }


        return $newValue;
    }

    public function todayString()
    {
        $date = date('ymd', strtotime(now()));

        return $date;
    }
}
