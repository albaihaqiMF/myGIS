<?php

namespace App\Http\Livewire\PlantationGroup;

use App\Models\MasterGroup;
use App\Models\PlantationGroup;
use Livewire\Component;

class PgShow extends Component
{
    public function mount($id)
    {
        $this->data = PlantationGroup::where('master_id', $id)->first();
        $this->detail = MasterGroup::find($id);
    }
    public function render()
    {
        return view('livewire.plantation-group.pg-show');
    }
}
