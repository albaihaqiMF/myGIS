<?php

namespace App\Http\Livewire\Irigation;

use App\Models\Irigation;
use Livewire\Component;

class ListIrigation extends Component
{
    public function getVolume($state)
    {
        switch ($state) {
            case 'empty':
                return '3%';
                break;
            case 'quarter':
                return '25%';
                break;
            case 'half':
                return '50%';
                break;
            case 'full':
                return '100%';
                break;
            default:
                return false;
                break;
        }
    }

    public function render()
    {
        $data = Irigation::all();

        $data = $data->map(function ($value) {
            $value->volume = $this->getVolume($value->state);

            return $value;
        });
        return view('livewire.irigation.list-irigation', [
            'data' => $data
        ]);
    }
}
