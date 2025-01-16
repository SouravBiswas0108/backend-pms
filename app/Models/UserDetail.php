<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

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

        public function scopeUpdateUserDetails($query, $id, $validatedData, $request)
    {
        return $query->where('staff_id', $id)->update([
            'gender' => $validatedData['gender'],
            'designation' => $validatedData['Designation'],
            'cadre' => $validatedData['cadre'],
            'date_of_current_posting' => $request->input('date_of_current_posting'),
            'date_of_MDA_posting' => $request->input('date_of_MDA_posting'),
            'date_of_last_promotion' => $request->input('date_of_last_promotion'),
            'job_title' => $validatedData['job_Title'],
            'grade_level' => $validatedData['grade_level'],
            'recovery_email' => $validatedData['recovery_email'],
            'created_by' => JWTAuth::user()->id, // Ensure JWTAuth is properly imported
            'type' => $validatedData['role'],
        ]);
    }

        public function user()
        {
            return $this->belongsTo(User::class, 'staff_id', 'staff_id');
        }

}
