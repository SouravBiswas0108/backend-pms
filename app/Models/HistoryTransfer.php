<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTransfer extends Model
{
    use HasFactory;

    protected $table = 'history_transfer';

    protected $fillable = [
        'staff_id',
        'reason',
        'remarks',
        'ministry_id'
    ];

    // Define relationship with User Model (Assuming staff_id is linked to users)
    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
