<?php

namespace App\Http\Livewire\Section;

use App\Models\MasterGroup;
use Livewire\Component;

class CreateSection extends Component
{
    public $pg, $area, $location;

    public function mount($pg, $area, $location)
    {
        $this->pg = $pg;
        $this->area = $area;
        $this->location = $location;
    }

    public function render()
    {
        $pg = MasterGroup::where('type', 'PG')->where('pg', $this->pg)->first();

        $data = $pg->plantationGroup;
        return view('livewire.section.create-section', [
            'data' => $data,
        ]);
    }
}
