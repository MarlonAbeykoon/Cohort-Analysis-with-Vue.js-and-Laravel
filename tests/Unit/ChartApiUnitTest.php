<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Consumer;

class ChartApiUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->json('GET',route('chart'));
        $response->assertStatus(200);
        $this->assertTrue(true);
    }
}
