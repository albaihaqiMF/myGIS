<?php

namespace App\Http\Livewire\Area;

use App\Models\MasterGroup;
use Livewire\Component;

class AreaList extends Component
{
    public $name;
    public $pg;

    public $search;

    protected $rules = [
        'name' => 'required',
        'pg' => 'required'
    ];

    public function mount()
    {
        $this->pgOption  = MasterGroup::where('type', 'PG')->get();
    }

    public function createArea()
    {
        $number = MasterGroup::where('type', 'AREA')->get()->count();
        $attr = $this->validate();


        $attr['id'] = date('ymd') . '2' . sprintf("%03d", $number);
        $attr['chief'] = auth()->user()->id;
        $attr['area'] = 1 + $number;
        $attr['type'] = 'AREA';

        MasterGroup::create($attr);
    }
    public function render()
    {
        $data = MasterGroup::where('type', 'AREA')->where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.area.area-list', [
            'data' => $data,
        ]);
    }
}
