<?php

namespace App\Http\Livewire\Area;

use App\Models\MasterGroup;
use Livewire\Component;

class AreaList extends Component
{
    public function render()
    {
        $data = MasterGroup::where('type', 'AREA')->get();
        return view('livewire.area.area-list', [
            'data' => $data,
        ]);
    }
}
