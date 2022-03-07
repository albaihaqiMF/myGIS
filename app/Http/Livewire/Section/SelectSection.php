<?php

namespace App\Http\Livewire\Section;

use App\Models\MasterGroup;
use Livewire\Component;

class SelectSection extends Component
{
    public $pg;
    public $area;
    public $location;

    public function render()
    {

        $pgs = MasterGroup::where('type', 'PG')->get();
        $areas = MasterGroup::where('type', 'AREA')->where('pg', $this->pg)->get();
        $locations = MasterGroup::where('type', 'LOC')->where('pg', $this->pg)->where('area', $this->area)->get();
        return view('livewire.section.select-section', [
            'pgOption' => $pgs,
            'areaOption' => $areas,
            'locationOption' => $locations,
        ]);
    }
}
