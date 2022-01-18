<?php

namespace App\Http\Livewire\Map;

use App\Models\Lahan;
use Livewire\Component;

class MapList extends Component
{
    public $search;
    public function render()
    {
        $data = Lahan::where('area_id', auth()->user()->area_id)
            ->where('name', 'ilike', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.map.map-list', [
            'data' => $data,
        ]);
    }
}
