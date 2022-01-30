<?php

namespace App\Http\Livewire\PlantationGroup;

use App\Models\MasterGroup;
use Livewire\Component;

class PGList extends Component
{
    public $search;
    public $name;

    protected $rules = [
        'name' => 'required'
    ];

    public function createPG()
    {
        $number = MasterGroup::where('type', 'PG')->get()->count();
        $attr = $this->validate();


        $attr['id'] = date('ymd') . sprintf("%04d", $number);
        $attr['chief'] = auth()->user()->id;
        $attr['pg'] = 11 + $number;
        $attr['type'] = 'PG';

        MasterGroup::create($attr);
    }

    public function render()
    {
        $data = MasterGroup::where('type', 'PG')->where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.plantation-group.pg-list', [
            'data' => $data,
        ]);
    }
}
