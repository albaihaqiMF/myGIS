<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Progres;
use App\Models\User;
use DateTime;
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
            'data' => User::get()->count(),
            'rate' => User::whereDate('created_at', today())->get()->count()
        ];

        $progres = [
            'data' => Progres::get()->count(),
            'rate' => Progres::whereDate('created_at', today())->get()->count()
        ];

        $section = [
            'data' => Section::get()->count(),
            'rate' => Section::whereDate('created_at', today())->get()->count(),
        ];

        return view('dashboard', [
            'user' => $user,
            'progres' => $progres,
            'section' => $section,
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

    public function diffTime($time2, $time1 = null)
    {
        $fdate = $time1 ?? today();
        $tdate = $time2;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $formatedInterval = ($interval->format('%a') * 24 * 60)
            + ($interval->format('%h') * 60)
            + $interval->format('%i');

        return $formatedInterval;
    }

    public function generatePassword($length)
    {
        $alphaCode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $alphaCode .= "abcdefghijklmnopqrstuvwxyz";
        $alphaCode .= "1234567890";

        $max = strlen($alphaCode);
        $token = "";

        for ($i = 0; $i < $length; $i++) {
            $token .= $alphaCode[rand(0, $max - 1)];
        }

        return $token;
    }
    public function getColor($value)
    {
        switch ($value) {
            case 'first':
                return '#22C55E';
                break;
            case 'second':
                return '#EAB308';
                break;
            case 'third':
                return '#EF4444';
                break;
            default:
                return '#64748B';
                break;
        }
    }
}
