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
        'org_code',
    ];

    public function departmentAssignStaff()
    {
        return $this->hasOne(DepartmentAssignStaff::class);
    }
}
