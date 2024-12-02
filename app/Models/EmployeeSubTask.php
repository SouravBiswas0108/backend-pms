<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSubTask extends Model
{
    use HasFactory;
      
    protected $table = 'employee_sub_tasks';
    protected $fillable = [
        'employee_tasks_id',    // Assuming this is the primary key or a specific attribute
        'objectives',           // Corresponds to obj_title
        'objective_weight',    // Corresponds to obj_weight
        'gradeed_weight',      // Corresponds to gradeed_weight
        'target',              // Corresponds to target
        'kpi',                 // Corresponds to kpi
        'unit',                // Corresponds to unit
        'quater',              // Corresponds to quater
    ];

     
        public function employeetask()
{
    return $this->belongsTo(EmployeeTask::class, 'employee_tasks_id', 'id');
}


}
