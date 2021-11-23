<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $query;

    public function render()
    {
        return view('livewire.search');
    }
}
