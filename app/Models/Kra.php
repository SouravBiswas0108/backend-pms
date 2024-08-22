<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kra extends Model
{
    use HasFactory;
    protected $fillable = [
        'kra_title',
        'kra_weight',
        'mpms_id',
        'year',
    ];

    /**
     * Get the MPMS associated with the KRA.
     */
    public function mpms()
    {
        return $this->belongsTo(Mpms::class, 'mpms_id');
    }

    public function objs()
    {
        return $this->hasMany(Obj::class, 'kra_id');
    }
}
