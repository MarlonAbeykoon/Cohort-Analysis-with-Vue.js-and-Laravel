<?php

namespace App\Http\Controllers;

use App\Consumer;
use Illuminate\Support\Facades\DB;

class consumerController extends Controller
{
    public function generateCohortAnalysis()
    {
        $weeklyData = Consumer::select([
            DB::raw('DATE_ADD(created_at, INTERVAL(2-DAYOFWEEK(created_at)) DAY) AS week_start'),
            DB::raw('CONCAT(YEAR(created_at), "/", WEEK(created_at)) AS week_name'),
            DB::raw('SUM(CASE WHEN onboarding_perentage <= 100 THEN 1 ELSE 0 END) AS Step1'),
            DB::raw('SUM(CASE WHEN onboarding_perentage > 0 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Step2'),
            DB::raw('SUM(CASE WHEN onboarding_perentage > 20 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Step3'),
            DB::raw('SUM(CASE WHEN onboarding_perentage > 40 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Step4'),
            DB::raw('SUM(CASE WHEN onboarding_perentage > 50 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Step5'),
            DB::raw('SUM(CASE WHEN onboarding_perentage > 70 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Step6'),
            DB::raw('SUM(CASE WHEN onboarding_perentage > 90 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Step7'),
            DB::raw('SUM(CASE WHEN onboarding_perentage = 100 THEN 1 ELSE 0 END) Step8')
        ])
            ->groupBy('week_name')
            ->groupBy('week_start')
            ->get();


        foreach ($weeklyData as $week){
            $dataArray = array();

            for($i = 1; $i <= 8; $i++){

                if($i == 1){
                    $dataArray[] = 100;
                }else{
                    $dataArray[] = round(($week->{"Step".$i}/$week->Step1) * 100);
                }

            }


            $chartArray ["series"] [] = array (
                "name" => $week->week_start,
                "data" => $dataArray
            );
        }

        return response()->json($chartArray)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
}
