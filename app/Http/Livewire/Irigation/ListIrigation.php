<?php

namespace App\Http\Livewire\Irigation;

use App\Models\Irigation;
use Livewire\Component;

class ListIrigation extends Component
{
    public function mount()
    {
         $this->data = Irigation::all();
    }
    public function render()
    {
        return view('livewire.irigation.list-irigation');
    }
}
