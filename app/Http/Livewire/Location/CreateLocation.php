<?php

namespace App\Http\Livewire\Location;

use App\Models\MasterGroup;
use Livewire\Component;

class CreateLocation extends Component
{
    public $name;
    public $pg;
    public $area;

    protected $rules = [
        'name' => 'required',
        'pg' => 'required',
        'area' => 'required'
    ];

    public function save()
    {
        $number = MasterGroup::where('type', 'LOC')->get()->count();
        $attr = $this->validate();


        $attr['id'] = date('ymd') . '3' . sprintf("%03d", $number);
        $attr['chief'] = auth()->user()->id;
        $attr['location'] = 1 + $number;
        $attr['type'] = 'LOC';

        MasterGroup::create($attr);

        return redirect(route('map.location.list'));
    }
    public function render()
    {
        $pgOption = MasterGroup::where('type', 'PG')->get();
        $areaOption = MasterGroup::where('type', 'AREA')->where('pg', $this->pg)->get();
        return view('livewire.location.create-location', [
            'pgOption' => $pgOption,
            'areaOption' => $areaOption,
        ]);
    }
}
