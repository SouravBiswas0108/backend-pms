<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpms extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'point',
    ];

    /**
     * Get the KRAs associated with the MPMS.
     */
    public function kras()
    {
        return $this->hasMany(Kra::class, 'mpms_id');
    }

    public function objs()
    {
        return $this->hasMany(Obj::class, 'mpms_id');
    }
}
