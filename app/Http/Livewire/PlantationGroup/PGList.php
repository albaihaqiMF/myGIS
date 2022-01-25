<?php

namespace App\Http\Livewire\PlantationGroup;

use App\Models\MasterGroup;
use Livewire\Component;

class PGList extends Component
{

    public function render()
    {
        $data = MasterGroup::where('type', 'PG')->get();

        return view('livewire.plantation-group.pg-list', [
            'data' => $data,
        ]);
    }
}
