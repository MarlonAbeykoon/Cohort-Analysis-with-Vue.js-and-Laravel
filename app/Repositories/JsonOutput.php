<?php


namespace App\Repositories;

use App\Repositories\CohortAnalysisOutputInterface;

class JsonOutput implements CohortAnalysisOutputInterface
{
    public function output($consumer)
    {

        return response()->json($consumer)->setEncodingOptions(JSON_NUMERIC_CHECK);

    }
}