<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverallAssessment extends Model
{
    use HasFactory;

    protected $table = 'overall_assessments';

    protected $fillable = [
        'staff_id',
        'department_id',
        'year',
        'quater',
        'sub_total_rating_expectations',
        'sub_total_rating_competencies',
        'sub_total_rating_operations',
        'overall_rating'
    ];

}
