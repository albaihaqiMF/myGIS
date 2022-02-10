<?php

namespace App\Http\Livewire\PlantationGroup;

use App\Models\MasterGroup;
use App\Models\PlantationGroup;
use Livewire\Component;

class PgCreate extends Component
{
    public   $name;
    public   $geometry;
    public   $detail;

    protected $rules = [
        'name' => 'required',
        'geometry' => 'required'
    ];

    public function save()
    {
        $number = MasterGroup::where('type', 'PG')->whereDate('created_at', today())->get()->count();

        $attr = $this->validate();

        $attrMaster['id'] = date('ymd') . '1' . sprintf("%03d", $number + 1);
        $attrMaster['name'] = $attr['name'];
        $attrMaster['chief'] = auth()->user()->id;
        $attrMaster['pg'] = 11 + $number;
        $attrMaster['type'] = 'PG';

        $masterGroup = MasterGroup::create($attrMaster)->id;

        $attrPG['master_id'] = $attrMaster['id'];
        $attrPG['detail'] = $attr['detail'];
        $attrPG['geometry'] = $attr['geometry'];

        PlantationGroup::create($attrPG);

        return redirect(route('map.pg.list'));
    }
    public function render()
    {
        return view('livewire.plantation-group.pg-create');
    }
}
