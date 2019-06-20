<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CohortAnalyzerTest extends TestCase
{

//    public function testCohortDataInsertion(){ // This database insertion requirement is not given and no endpoint is written, the same csv data is used for testing
//
//
//    }

    public function testCohortAnalysisResponse()
    {

        $response = $this->json('GET', route('chart'));
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                "series" => [
                    '*' => [
                        "name",
                        "data"
                    ]
                ]
            ]
        );
        $response->assertJsonCount(4,
            "series"
        );
    }

    public function testAnalysisWithoutMiddleware()
    {
        $response = $this->json('GET', route('chart'));
        $response->assertStatus(200); // this should be tested for 401 when authentication is implemented
    }

    public function testExistenceWeeklyLines() // this verifies weekly lines are present
    {
        $response = $this->json('GET', route('chart'));
        $response->assertJsonFragment([
            'name' => '2016-07-18',
        ]);
        $response->assertJsonFragment([
            'name' => '2016-07-25',
        ]);
        $response->assertJsonFragment([
            'name' => '2016-08-01',
        ]);
        $response->assertJsonFragment([
            'name' => '2016-08-08',
        ]);
    }

    public function testYAxis() // this verifies the calculation is correct and the line starts at 100
    {
        $response = $this->json('GET', route('chart'));
        $response->assertJsonFragment([
            'data' => [100, 100, 100, 40, 36, 36, 36, 28]
        ]);
    }


}

