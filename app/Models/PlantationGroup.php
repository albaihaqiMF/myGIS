<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantationGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_id', 'detail', 'geometry'
    ];
}
