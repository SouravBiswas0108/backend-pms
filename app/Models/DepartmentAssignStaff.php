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
        return $this->belongsTo(Department::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
