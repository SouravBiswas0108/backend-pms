<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obj extends Model
{
    use HasFactory;
    protected $fillable = [
        'obj_title',
        'obj_weight',
        'Initiative',
        'kpi',
        'target',
        'Responsible',
        'kra_id',
        'mpms_id'
    ];

    // Relationship with Kra
    public function kra()
    {
        return $this->belongsTo(Kra::class, 'kra_id');
    }

    public function mpms()
    {
        return $this->belongsTo(Mpms::class, 'mpms_id');
    }
}
