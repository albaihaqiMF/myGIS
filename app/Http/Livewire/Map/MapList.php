<?php

namespace App\Http\Livewire\Map;

use App\Models\MasterGroup;
use App\Models\Section;
use Livewire\Component;

class MapList extends Component
{
    public $search;
    public function render()
    {
        $data = MasterGroup::where('type', 'SEC')->get();

        return view('livewire.map.map-list', [
            'data' => $data,
        ]);
    }
}
