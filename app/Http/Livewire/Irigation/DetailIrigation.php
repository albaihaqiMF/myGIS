<?php

namespace App\Http\Livewire\Irigation;

use App\Models\Irigation;
use Livewire\Component;

class DetailIrigation extends Component
{
    public Irigation $data;

    public function render()
    {
        $data = $this->data;
        $geojson = $data->geometry;
        return view('livewire.irigation.detail-irigation', [
            'geojson' => $geojson,
        ]);
    }
}
