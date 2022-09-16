<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\ApiController;

use Tests\TestCase;

class ControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void {
        parent::setUp();
    }

    public function test_correct_api_count()
    {
        // $response = ApiController::getOilStocks();
        $apiController = new ApiController;
        $response = $apiController->getOilStocks('EPM0C');
        $body = json_decode($response->getData(), true);

        $this->assertEquals(count($body), 3);
    }

    public function test_correct_api_content()
    {
        $apiController = new ApiController;
        $response = $apiController->getOilStocks('EPM0C');
        $body = json_decode($response->getData(), true);

        $this->assertEquals($body[0]['value'], 4503);
    }
}
