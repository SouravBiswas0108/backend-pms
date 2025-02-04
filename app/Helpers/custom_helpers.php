<?php

use App\Models\OverallAssessment;

if (!function_exists('return_123')) {

    function transferCheck($staff_id)
    {

        $quarter = (int) ceil(date('n') / 3);
        $currentYear = (int) date('Y');

        $response = OverallAssessment::where('staff_id',$staff_id)
        ->where('year',$currentYear)->where('quater',$quarter)
        ->whereNotNull('sub_total_rating_expectations')
        ->whereNotNull('sub_total_rating_competencies')
        ->whereNotNull('sub_total_rating_operations')->exists();

        if ($response) {
            return 1;
        } else {
            return 0;
        }
       
    }
}
