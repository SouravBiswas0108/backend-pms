<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'designation',
        'cadre',
        'grade_level',
        'org_code',
        'org_name',
        'date_of_current_posting',
        'date_of_MDA_posting',
        'date_of_last_promotion',
        'type',
        'lang',
        'job_title',
        'default_pipeline',
        'created_by',
        'is_active',
        'recovery_email',
        'messenger_color',
        'dark_mode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
