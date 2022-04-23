<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function sensors()
    {
         return $this->hasMany(Sensor::class)->limit(10)->latest();
    }
}
