<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    use HasFactory;

    protected $fillable = [
        'geometry',
        'lahan_id',
        'progres_by',
        'catatan'
    ];

    public static function mapData($value)
    {
        $data = json_decode($value->geometry)[0];

        $data->properties = [
            'id'            => $value->id,
            'pj'            => $value->userProgres->name,
            'catatan'       => $value->catatan ?? "Tidak Ada Catatan",
            'created_at'    => date('d F Y H:i', strtotime($value->created_at)),
            'updated_at'    => date('D, d F Y', strtotime($value->updated_at)),
        ];

        return $data;
    }

    public function userProgres()
    {
         return $this->belongsTo(User::class, 'progres_by', 'id');
    }
}
