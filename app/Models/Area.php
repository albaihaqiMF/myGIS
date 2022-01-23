<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function getLahans()
    {
        return $this->hasMany(Section::class, 'area_id', 'id');
    }
}
