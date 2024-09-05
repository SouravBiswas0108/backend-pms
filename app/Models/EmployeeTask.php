<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'dept_id',
        'year',
        'kra_id',
        'kra_weight',
    ];
}
