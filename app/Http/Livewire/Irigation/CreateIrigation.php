<?php

namespace App\Http\Livewire\Irigation;

use App\Models\MasterGroup;
use Livewire\Component;

class CreateIrigation extends Component
{

    public function mount($id)
    {
        $data = MasterGroup::findOrFail($id);
        $this->data = $data->plantationGroup;
    }

    public function render()
    {
        return view('livewire.irigation.create-irigation');
    }
}
