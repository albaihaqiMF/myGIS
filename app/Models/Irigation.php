<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'master_id',
        'plantation_group_id',
        'created_by',
        'geometry',
        'state'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function plantationGroup()
    {
        return $this->belongsTo(MasterGroup::class, 'plantation_group_id');
    }
    public function isMe()
    {
        return auth()->user()->id == $this->created_by;
    }
}
