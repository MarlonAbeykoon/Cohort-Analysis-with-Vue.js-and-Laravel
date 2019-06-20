<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CohortAnalyzerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCohortAnalysis()
    {
        $response = $this->get('/cohortAnalysis');

        $response->assertStatus(200);
        $response->assertSee('Cohort Analysis');
    }
}
