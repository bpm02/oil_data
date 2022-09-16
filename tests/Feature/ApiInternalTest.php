<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\ApiController;

use Tests\TestCase;

class ApiInternalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_count_json()
    {

        $response = $this->get('api/stocks/EPM0C');

        $response->assertStatus(201)->assertJsonCount(3);
    }


    public function test_correct_jsontype()
    {

        $response = $this->get('api/stocks/EPM0C');

        $response->assertStatus(201)->assertJsonCount(3);
    }
}
