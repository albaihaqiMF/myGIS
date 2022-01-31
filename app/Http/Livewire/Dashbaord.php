<?php

namespace App\Http\Livewire;

use App\Models\MasterGroup;
use App\Models\Section;
use App\Models\User;
use Livewire\Component;

class Dashbaord extends Component
{
    public function mount()
    {
        $this->user = [
            'data' => User::get()->count(),
            'rate' => User::whereDate('created_at', today())->get()->count()
        ];

        $this->pg = [
            'data' => MasterGroup::where('type', 'PG')->get()->count(),
            'rate' => MasterGroup::where('type', 'PG')->whereDate('created_at', today())->get()->count(),
        ];
        $this->area = [
            'data' => MasterGroup::where('type', 'AREA')->get()->count(),
            'rate' => MasterGroup::where('type', 'AREA')->whereDate('created_at', today())->get()->count(),
        ];
        $this->location = [
            'data' => MasterGroup::where('type', 'LOC')->get()->count(),
            'rate' => MasterGroup::where('type', 'LOC')->whereDate('created_at', today())->get()->count(),
        ];
        $this->section = [
            'data' => MasterGroup::where('type', 'SEC')->get()->count(),
            'rate' => MasterGroup::where('type', 'SEC')->whereDate('created_at', today())->get()->count(),
        ];
    }
    public function render()
    {
        return view('livewire.dashbaord');
    }
}
