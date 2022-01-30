<?php

namespace App\Http\Livewire\Location;

use App\Models\MasterGroup;
use Livewire\Component;

class LocationList extends Component
{

    public $search;


    public function render()
    {
        $data = MasterGroup::where('type', 'LOC')->get();
        return view('livewire.location.location-list', [
            'data' => $data,
        ]);
    }
}
