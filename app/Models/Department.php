<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'department_name',
        'year',
        'description',
        'organization',
        'org_code',
    ];

    public function departmentAssignStaffs()
    {
        return $this->hasMany(DepartmentAssignStaff::class, 'department_id', 'department_id');
    }
}
