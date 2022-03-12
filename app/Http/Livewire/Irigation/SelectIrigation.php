<?php

namespace App\Http\Livewire\Irigation;

use App\Models\MasterGroup;
use Livewire\Component;

class SelectIrigation extends Component
{
    public $pg;

    public function mount()
    {
        $this->pgOptions = MasterGroup::where('type', 'PG')->get();
    }
    public function render()
    {
        return view('livewire.irigation.select-irigation');
    }
}
