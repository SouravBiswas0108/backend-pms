<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class Competencies extends Model
{
    use HasFactory;

    protected $table = "competencies";

    protected $fillable = [
        'staff_id',
        'dept_id',
        'year',
        'competencies',
        'quarter',
        'aggregate',
    ];

    public function scopeAllCheck($query,$staff_id=null,$dept_id=null,$year=null,$quarter=null){

        // $staffIdToFind = JWTAuth::user()->staff_id;
        if($staff_id){
            $query->where('staff_id', $staff_id);
        }

        if($dept_id){
            $query->where('dept_id',$dept_id);
        }

        if($year){
            $query->where('year',$year);
        }

        if($quarter){
            $query->where('quarter',$quarter);
        }

        return $query->get()->map(function ($items) {
            return [
                "name" => $items["competencies"],
                "details" => $items->competenciesDetails->map(function ($item) {
                    return [
                        "title" => $item['title'],
                        "describe_expectations" => $item['describe_expectations'],
                        "min_score" => $item['min_score'],
                        "max_score" => $item['max_score'],
                        "quarter_marks" => $item['quarter_marks']
                    ];
                })
            ];
        });

    }

    //foren key relation 
    public function competenciesDetails(){
         return $this->hasMany(CompetenciesDetails::class ,'competencies_id','id');
    }
}
