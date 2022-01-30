<?php

namespace App\Http\Livewire\Area;

use App\Models\MasterGroup;
use Livewire\Component;

class AreaList extends Component
{
    public $name;
    public $pg;

    protected $rules = [
        'name' => 'required',
        'pg' => 'required'
    ];
    public function createArea()
    {
        $number = MasterGroup::where('type', 'AREA')->get()->count();
        $attr = $this->validate();


        $attr['id'] = date('ymd') . sprintf("%04d", $number);
        $attr['chief'] = auth()->user()->id;
        $attr['area'] = 1 + $number;
        $attr['type'] = 'AREA';

        MasterGroup::create($attr);
    }
    public function render()
    {
        $data = MasterGroup::where('type', 'AREA')->get();
        return view('livewire.area.area-list', [
            'data' => $data,
        ]);
    }
}
