<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciesDetails extends Model
{
    use HasFactory;

    protected $table = "competencies_details";

    protected $fillable = [
        'competencies_id',
        'title',
        'describe_expectations',
        'min_score',
        'max_score',
        'quarter_marks',
    ];

    public function competencies(){
        return $this->belongsTo(Department::class ,'competencies_id','id');
   }
}
