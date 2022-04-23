<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'soil_moisture',
        'humidity',
        'temp',
        'latitude',
        'longitude'
    ];
}
