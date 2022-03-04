<?php

namespace App\Http\Livewire\Location;

use App\Models\MasterGroup;
use Livewire\Component;
use Livewire\WithPagination;

class LocationList extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $data = MasterGroup::where('type', 'LOC')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.location.location-list', [
            'data' => $data,
        ]);
    }
}
