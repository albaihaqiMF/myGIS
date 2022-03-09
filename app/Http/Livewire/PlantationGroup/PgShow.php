<?php

namespace App\Http\Livewire\PlantationGroup;

use App\Models\MasterGroup;
use App\Models\PlantationGroup;
use Livewire\Component;

class PgShow extends Component
{
    public $layer;

    public function mount($id)
    {
        $this->id = $id;
        $this->layer = 1;
    }
    public function getColor($value)
    {
        switch ($value) {
            case 'first':
                return '#22C55E';
                break;
            case 'second':
                return '#EAB308';
                break;
            case 'third':
                return '#EF4444';
                break;
            default:
                return '#64748B';
                break;
        }
    }
    public function render()
    {
        $data = PlantationGroup::where('master_id', $this->id)->first();
        $detail = MasterGroup::find($this->id);
        $sections = MasterGroup::where('type', 'SEC')
            ->where('pg', $detail->pg)
            ->get();
        $sections = $sections->map(function ($value) {
            $data = $value->getSection;
            $geometry = json_decode($data->geometry)[0];
            $geometry->properties = [
                'color' => $this->getColor($data->crop)
            ];
            return $geometry;
        });
        return view('livewire.plantation-group.pg-show', [
            'data' => $data,
            'detail' => $detail,
            'sections' => $sections,
        ]);
    }
}
