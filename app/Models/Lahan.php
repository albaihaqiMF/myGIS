<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'created_by',
        'area_id',
        'sw_latitude',
        'sw_longitude',
        'ne_latitude',
        'ne_longitude',
        'gambar_taksasi',
        'gambar_ndvi',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function scopeCget($query, $area)
    {
        $query = $query->where('deleted_at', null)->orderBy('updated_at', 'desc');

        $query = $area != null ? $query->where('area_id', $area) : $query;

        $query = $query->get();

        return $query->map(function ($data) {
            return $this->mapData($data);
        });
    }

    public static function mapData($value)
    {
        return [
            'id' => $value->id,
            'name' => $value->name,
            'area' => $value->area->name,
            'created_by' => $value->creator->name,
            'sw_latitude' => $value->sw_latitude,
            'sw_longitude' => $value->sw_longitude,
            'ne_latitude' => $value->ne_latitude,
            'ne_longitude' => $value->ne_longitude,
            'gambar_taksasi' => $value->gambar_taksasi,
            'gambar_ndvi' => $value->gambar_ndvi,
            'created_at' => date('H:i:s, d M Y', strtotime($value->created_at)),
            'updated_at' => date('H:i:s, d M Y', strtotime($value->updated_at)),
        ];
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
