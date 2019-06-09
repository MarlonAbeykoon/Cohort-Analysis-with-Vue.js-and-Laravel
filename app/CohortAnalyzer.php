<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\consumerRepository;
use App\Repositories\CohortAnalysisOutputInterface;

class CohortAnalyzer extends Model
{

    private $repo;

    public function __construct(ConsumerRepository $repo)
    {

        $this->repo = $repo;

    }

    public function cohortAnalysis(CohortAnalysisOutputInterface $formatter){

        $dbData = $this->repo->cohortAnalysis();

        $chartArray = $this->formDataArr($dbData);

        return $formatter->output($chartArray);
    }

    private function formDataArr($data){

        foreach ($data as $week){
            $dataArray = array();

            for($i = 1; $i <= 8; $i++){

                if($i == 1){
                    $dataArray[] = 100;
                }else{
                    $dataArray[] = round(($week->{"Step".$i}/$week->Step1) * 100);
                }

            }

            $chartArray ["series"] [] = $this->formChartArr($week, $dataArray);


        }

        return $chartArray;
    }

    private function formChartArr($week, $dataArray){

        $chartArray = array (
            "name" => $week->week_start,
            "data" => $dataArray
        );
        return $chartArray;
    }

}
