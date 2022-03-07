<?php

namespace App\Http\Controllers;

use App\Models\MasterGroup;
use App\Models\PlantationGroup;
use App\Models\Section;
use App\Models\Progres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LahanController extends Controller
{
    public function index()
    {
        $data = Section::all();

        return view('map.index', compact('data'));
    }
    public function show(Section $section)
    {

        // return $section;
        $data = $section;
        $progres = $section->progress;
        return view('map.show', [
            'data' => $data,
            'detail' => $section->masterGroup,
            'geojson' => $progres->map(function ($value) {
                return Progres::mapData($value);
            }),
        ]);
    }
    public function create()
    {
        return view('map.create');
    }
    public function store(Request $request, $pg, $area, $location)
    {
        // return $request;

        $counter = MasterGroup::where('type', 'SEC')->whereDate('created_at', today())->get()->count();
        $sectionCounter = MasterGroup::where('type', 'SEC')->get()->count();

        $number = $counter + 1;
        $attr = $this->validate($request, [
            'name' => 'required|min:4',
            'variaty' => 'required',
            'geometry' => 'required|json',
            'age' => 'required|date'
        ]);

        $attrMaster['id'] = date('ymd') . '4' . sprintf('%03d', $number);
        $attrMaster['name'] = $attr['name'];
        $attrMaster['chief'] = auth()->user()->id;
        $attrMaster['type'] = 'SEC';
        $attrMaster['pg'] = $pg;
        $attrMaster['area'] = $area;
        $attrMaster['location'] = $location;
        $attrMaster['section'] = $sectionCounter + 1;

        MasterGroup::create($attrMaster);

        $attrSection['master_id'] = $attrMaster['id'];
        $attrSection['master_id'] = $attrMaster['id'];
        // $attrSection['sw_latitude'] = $attr['sw_latitude'];
        // $attrSection['sw_longitude'] = $attr['sw_longitude'];
        // $attrSection['ne_latitude'] = $attr['ne_latitude'];
        // $attrSection['ne_longitude'] = $attr['ne_longitude'];
        $attrSection['variaty'] = $attr['variaty'];
        $attrSection['age'] = $attr['age'];
        $attrSection['geometry'] = $attr['geometry'];
        $attrSection['crop'] = 'first';
        $attrSection['forcing_time'] = 10;
        // $attrSection['gambar_taksasi'] = $this->storeImage($request->file('gambar_taksasi'), 'taksasi');
        // $attrSection['gambar_ndvi'] = $this->storeImage($request->file('gambar_ndvi'), 'ndvi');

        Section::create($attrSection);

        return redirect(
            route('map.section.list')
        )->with('success', 'Created Map Data Successfully');
    }
    public function edit(Section $section)
    {
        return view('map.edit', [
            'data' => $section
        ]);
    }
    public function update(Section $section, Request $request)
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
            Storage::delete($section->gambar_taksasi);
            $attr['gambar_taksasi'] = $this->storeImage($request->file('gambar_taksasi'), 'taksasi');
        } else {
            $attr['gambar_taksasi'] = $section->gambar_taksasi;
        }
        //Replace old pict for taksasi
        if ($request->file('gambar_ndvi')) {
            Storage::delete($section->gambar_ndvi);
            $attr['gambar_ndvi'] = $request->file('gambar_ndvi') ?
                $this->storeImage($request->file('gambar_ndvi'), 'ndvi')
                : null;
        } else {
            $attr['gambar_ndvi'] = $section->gambar_taksasi;
        }
        $section->masterGroup->update([
            'name' => $attr['name'],
        ]);
        $section->update([
            'sw_latitude' => $attr['sw_latitude'],
            'sw_longitude' => $attr['sw_longitude'],
            'ne_latitude' => $attr['ne_latitude'],
            'ne_longitude' => $attr['ne_longitude'],
            'gambar_taksasi' => $attr['gambar_taksasi'],
            'gambar_ndvi' => $attr['gambar_ndvi'],
        ]);

        return redirect(route('map.section.show', ['section' => $section->master_id]))->with('success', 'Berhasil memperbarui data');
    }

    public function delete(Section $section)
    {
        $section->update([
            'deleted_at' => now()
        ]);

        return redirect(route('section.list'))->with('success', 'Berhasil Menghapus data ' . $section->name);
    }

    public function progres(Section $section)
    {
        $data = $section;
        $progres = $section->progress;
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

    public function progresUpload(Request $request, Section $section)
    {
        $this->validate($request, [
            'data' => 'required'
        ]);
        Progres::create([
            'progres_by' => auth()->user()->id,
            'section_id' => $section->id,
            'geometry' => $request->data,
            'catatan' => $request->catatan
        ]);

        return redirect(route(
            'map.section.show',
            [
                'section' => $section->master_id
            ]
        ))
            ->with('success', 'Berhasil membuat progres baru');
    }


    // DATA URL FOR //
    public function list()
    {
        $data = Section::where('deleted_at', null)->where('area_id', auth()->user()->area_id)->get();

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
                'url' => route('section.show', [
                    'section' => $map->id,
                ]),

            ];
        });

        $format = [
            'data' => $mapData
        ];

        return $format;
    }

    public function geojson(Section $section)
    {
        $data = $section->progress;
        $data = $data->map(function ($value) {
            return Progres::mapData($value);
        });
        return [
            "type" => "FeatureCollection",
            "features" => $data,
        ];
    }
    public function pgCreate(Request $request)
    {
        $number = MasterGroup::where('type', 'PG')->whereDate('created_at', today())->get()->count();

        $attr = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'geometry' => 'required',
        ]);

        $attrMaster['id'] = date('ymd') . '1' . sprintf("%03d", $number + 1);
        $attrMaster['name'] = $attr['name'];
        $attrMaster['chief'] = auth()->user()->id;
        $attrMaster['pg'] = 11 + $number;
        $attrMaster['type'] = 'PG';

        MasterGroup::create($attrMaster);

        $attrPG['master_id'] = $attrMaster['id'];
        $attrPG['detail'] = $attr['detail'];
        $attrPG['geometry'] = $attr['geometry'];

        PlantationGroup::create($attrPG);

        return redirect(route('map.pg.list'))->with('success', 'Created Plantation Group successfully');
    }
}
