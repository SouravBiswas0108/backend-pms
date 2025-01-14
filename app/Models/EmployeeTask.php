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
        'quater',
        'kra_id',
        'kra_weight',
    ];

    public function savedemployeetask()
    {
        return $this->hasMany(EmployeeSubTask::class, 'employee_tasks_id', 'id');
    }
    
    public function kraDetails()
   {
        return $this->belongsTo(kra::class, 'kra_id', 'id');
   }



}
