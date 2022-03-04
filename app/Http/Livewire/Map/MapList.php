<?php

namespace App\Http\Livewire\Map;

use App\Models\MasterGroup;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class MapList extends Component
{
    use WithPagination;

    public $search;
    public function render()
    {
        $data = MasterGroup::where('type', 'SEC')->paginate(10);

        return view('livewire.map.map-list', [
            'data' => $data,
        ]);
    }
}
