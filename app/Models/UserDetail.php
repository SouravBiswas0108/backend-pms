<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    
        protected $fillable = [
            'staff_id',
            'gender',
            'designation',
            'cadre',
            'org_code',
            'org_name',
            'date_of_current_posting',
            'date_of_MDA_posting',
            'date_of_last_promotion',
            'job_title',
            'grade_level',
            'recovery_email',
            'created_by',
            'type',
        ];
        public function user()
        {
            return $this->belongsTo(User::class, 'staff_id', 'staff_id');
        }

}
