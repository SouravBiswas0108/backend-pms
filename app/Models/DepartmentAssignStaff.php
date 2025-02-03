<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentAssignStaff extends Model
{
    use HasFactory;

    protected $table = 'department_staff';
    protected $fillable = [
        'department_id',
        'team_id',
        'org_code',
        'staff_id',
        'staff_name',
        'assign_role_name',
        'assign_role_id',
        'year',
        'created_by',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id'); // Make sure 'department_id' is correct
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id', 'staff_id');
    }

    public function supervisor(){
        return $this->belongsTo(User::class, 'supervisor_id','staff_id');
    }

}
