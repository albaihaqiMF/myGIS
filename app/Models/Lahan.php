<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'created_by',
        'sw_latitude',
        'sw_longitude',
        'ne_latitude',
        'ne_longitude',
        'gambar_taksasi',
        'gambar_ndvi',
        'deleted_at',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
