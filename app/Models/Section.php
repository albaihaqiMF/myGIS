<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'master_id',
        'sw_latitude',
        'sw_longitude',
        'ne_latitude',
        'ne_longitude',
        'gambar_taksasi',
        'gambar_ndvi',
        'age',
        'variaty',
        'crop',
        'forcing_time',
        'geometry',
        'detail',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
        'pivot'
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
            'sw_latitude' => $value->sw_latitude,
            'sw_longitude' => $value->sw_longitude,
            'ne_latitude' => $value->ne_latitude,
            'ne_longitude' => $value->ne_longitude,
            'gambar_taksasi' => $value->gambar_taksasi,
            'gambar_ndvi' => $value->gambar_ndvi,
            'age' => Helper::getAge($value->age),
            'variaty' => $value->variaty,
            'crop' => $value->crop,
            'forcing_time' => $value->forcing_time . ' Bulan',
            'created_at' => date('H:i:s, d M Y', strtotime($value->created_at)),
            'updated_at' => date('H:i:s, d M Y', strtotime($value->updated_at)),
        ];
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function masterGroup()
    {
        return $this->belongsTo(MasterGroup::class, 'master_id');
    }

    public function progress()
    {
        return $this->hasMany(Progres::class);
    }

    public function getTaksasi()
    {
        $url = $this->gambar_taksasi;

        return "./storage/" . $url;
    }
    public function getNdvi()
    {
        $url = $this->gambar_ndvi;

        return "./storage/" . $url;
    }

    public function isMe()
    {
        return $this->created_by == auth()->user()->id;
    }

    public function irigations()
    {
        return $this->belongsToMany(Irigation::class, 'irigations_sections');
    }
}
