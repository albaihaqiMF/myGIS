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

    public function plantationGroup()
    {
        return $this->hasOne(PlantationGroup::class);
    }

    public function area()
    {
        return $this->hasOne(Area::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function section()
    {
        return $this->hasOne(Section::class);
    }

    public function plot()
    {
        return $this->hasOne(Plot::class);
    }

    public function chief()
    {
        return $this->belongsTo(User::class);
    }
}
