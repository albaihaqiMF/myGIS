<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'chief',
        'code',
        'pg',
        'area',
        'location',
        'section',
        'plot',
        'type',
    ];

    public static function mapSection($value)
    {
        $geografi = $value->getSection;
        return [
            'id'        => $value->id,
            'chief'     => $value->getChief->name,
            'name'      => $value->name,
            'pg'        => $value->pg,
            'area'      => $value->area,
            'location'  => $value->location,
            'section'   => $value->section,
            'geografi'  => Section::mapData($geografi)
        ];
    }

    public function plantationGroup()
    {
        return $this->hasOne(PlantationGroup::class, 'master_id');
    }

    public function getArea()
    {
        return $this->hasOne(Area::class, 'master_id');
    }

    public function getLocation()
    {
        return $this->hasOne(Location::class, 'master_id');
    }

    public function getSection()
    {
        return $this->hasOne(Section::class, 'master_id');
    }

    public function getPlot()
    {
        return $this->hasOne(Plot::class, 'master_id');
    }

    public function getChief()
    {
        return $this->belongsTo(User::class, 'chief');
    }
}
