<?php

namespace App\Http\Controllers;

use App\CohortAnalyzer;
use App\Repositories\consumerRepository;
use App\Repositories\JsonOutput;

class consumerController extends Controller
{
    public function generateConsumerCohortAnalysis()
    {
        $cohortAnalysis = new CohortAnalyzer(new consumerRepository);

        $data =  $cohortAnalysis->cohortAnalysis(new JsonOutput);

        return $data;
    }
}
