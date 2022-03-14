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
    public function irigationColor($value)
    {
        switch ($value) {
            case 'empty':
                return '#E0F2FE';
                break;
            case 'quarter':
                return '#7DD3FC';
                break;
            case 'half':
                return '#7DD3FC';
                break;
            case 'full':
                return '#075985';
                break;
            default:
                return '#F0F9FF';
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

        $irigations = $detail->irigations;

        $irigations = $irigations->map(function ($value) {
            $geometry = json_decode($value->geometry)[0];
            $geometry->properties = [
                'color' => $this->irigationColor($value->state)
            ];
            return $geometry;
        });
        return view('livewire.plantation-group.pg-show', [
            'data' => $data,
            'detail' => $detail,
            'sections' => $sections,
            'irigations' => $irigations,
        ]);
    }
}
