<?php

namespace App\Http\Livewire\Map;

use App\Models\Section;
use Livewire\Component;

class MapList extends Component
{
    public $search;
    public function render()
    {
        $data = Section::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.map.map-list', [
            'data' => $data,
        ]);
    }
}
