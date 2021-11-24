<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;

class LahanController extends Controller
{
    public function index()
    {
        $data = Lahan::all();

        return view('map.index', compact('data'));
    }
    public function show(Lahan $lahan)
    {
        $data = $lahan;
        return view('map.show', compact('data'));
    }
}
