<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function create()
    {
        return view('map.create');
    }
    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'name' => 'required|min:4',
            'gambar_taksasi' => 'required',
            'gambar_ndvi' => 'required',
            'sw_latitude' => 'required',
            'sw_longitude' => 'required',
            'ne_latitude' => 'required',
            'ne_longitude' => 'required',
        ]);
        $attr['created_by'] = auth()->user()->id;
        $attr['gambar_taksasi'] = $this->storeImage($request->file('gambar_taksasi'), 'taksasi');
        $attr['gambar_ndvi'] = $this->storeImage($request->file('gambar_ndvi'), 'ndvi');

        Lahan::create($attr);

        return redirect(
            route('map.list')
        )->with('success', 'Created Map Data Successfully');
    }

    public function update(Lahan $lahan, Request $request)
    {
        $attr = $this->validate($request, [
            'name' => 'required',
            'sw_latitude' => 'required',
            'sw_longitude' => 'required',
            'ne_latitude' => 'required',
            'ne_longitude' => 'required',
        ]);
        //Replace old pict for taksasi
        if ($request->file('gambar_taksasi')) {
            Storage::delete($lahan->gambar_taksasi);
            $attr['gambar_taksasi'] = $this->storeImage($request->file('gambar_taksasi'), 'taksasi');
        } else {
            $attr['gambar_taksasi'] = $lahan->gambar_taksasi;
        }
        //Replace old pict for taksasi
        if ($request->file('gambar_ndvi')) {
            Storage::delete($lahan->gambar_ndvi);
            $attr['gambar_ndvi'] = $request->file('gambar_ndvi') ?
                $this->storeImage($request->file('gambar_ndvi'), 'ndvi')
                : null;
        } else {
            $attr['gambar_ndvi'] = $lahan->gambar_taksasi;
        }

        $lahan->update($attr);

        return redirect(route('map.show', ['lahan' => $lahan->id]))->with('success', 'Berhasil memperbarui data');
    }

    public function delete(Lahan $lahan)
    {
        $lahan->update([
            'deleted_at' => now()
        ]);

        return redirect(route('map.list'))->with('success', 'Berhasil Menghapus data ' . $lahan->name);
    }


    // DATA URL FOR //
    public function list()
    {
        $data = Lahan::where('deleted_at', null)->get();

        $mapData = $data->map(function ($map) {
            return [
                'name' => $map->name,
                'created_by' => $map->created_by ? $map->creator->name : null,
                'taksasi' => $map->id !== 1 ?
                    env('APP_URL') . "/storage/" . $map->gambar_taksasi
                    :
                    env('APP_URL') . "/" . $map->gambar_taksasi,
                'ndvi' => $map->id !== 1 ?
                    env('APP_URL') . "/storage/" . $map->gambar_ndvi
                    :
                    env('APP_URL') . "/" . $map->gambar_ndvi,

                'date' => date('d-m-y H:i:s', strtotime($map->updated_at)),
                'url' => env('APP_URL') . "/map/show/" . $map->id,

            ];
        });

        $format = [
            'data' => $mapData
        ];

        return $format;
    }
}
