<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Progres;
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
        if ($lahan->area_id !== auth()->user()->area_id) {
            return redirect(route('map.list'))->with('error', 'You don\'t have permission');
        }
        $data = $lahan;
        $progres = $lahan->progress;
        return view('map.show', [
            'data' => $data,
            'geojson' => $progres->map(function ($value) {
                return Progres::mapData($value);
            }),
        ]);
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

        $countData = Lahan::whereDate('created_at', date('Y-m-d'))->get()->count();
        $id = $this->todayString() . "2" . $this->intTo3Digits($countData + 1);

        $attr['id'] = $id;
        $attr['area_id'] = auth()->user()->area_id;
        $attr['created_by'] = auth()->user()->id;
        $attr['gambar_taksasi'] = $this->storeImage($request->file('gambar_taksasi'), 'taksasi');
        $attr['gambar_ndvi'] = $this->storeImage($request->file('gambar_ndvi'), 'ndvi');

        Lahan::create($attr);

        return redirect(
            route('map.list')
        )->with('success', 'Created Map Data Successfully');
    }
    public function edit(Lahan $lahan)
    {
        return view('map.edit', [
            'data' => $lahan
        ]);
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

    public function progres(Lahan $lahan)
    {
        $data = $lahan;
        $progres = $lahan->progress;
        return view('map.progres', [
            'data' => $data,
            'geojson' => $progres->map(function ($value) {
                return Progres::mapData($value);
            }),
        ]);
    }

    public function deleteProgres(Progres $progres)
    {
        $progres->delete();

        return back();
    }

    public function progresUpload(Request $request, Lahan $lahan)
    {
        $this->validate($request, [
            'data' => 'required'
        ]);
        Progres::create([
            'progres_by' => auth()->user()->id,
            'lahan_id' => $lahan->id,
            'geometry' => $request->data,
            'catatan' => $request->catatan
        ]);

        return redirect(route(
            'map.show',
            [
                'lahan' => $lahan->id
            ]
        ))
            ->with('success', 'Berhasil membuat progres baru');
    }


    // DATA URL FOR //
    public function list()
    {
        $data = Lahan::where('deleted_at', null)->where('area_id', auth()->user()->area_id)->get();

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
                'url' => route('map.show', [
                    'lahan' => $map->id,
                ]),

            ];
        });

        $format = [
            'data' => $mapData
        ];

        return $format;
    }

    public function geojson(Lahan $lahan)
    {
        $data = $lahan->progress;
        $data = $data->map(function ($value) {
            return Progres::mapData($value);
        });
        return [
            "type" => "FeatureCollection",
            "features" => $data,
        ];
    }
}
