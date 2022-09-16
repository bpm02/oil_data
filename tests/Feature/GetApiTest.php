<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public $apiurl = "";
    public $client;
    public $response;

    public function setUp(): void
    {
        parent::setUp();
        $apikey = 'VIUaL9u7clkQhKV5au3WxZqzUIOnATteAvgQxh3r';
        $apiroute = 'petroleum';
        $apiid = 'stoc';
        $this->apiurl = "https://api.eia.gov/v2/${apiroute}/${apiid}/data/?api_key=${apikey}";

        $this->client = new \GuzzleHttp\Client();

        $this->response = $this->client->request(
            'GET',
            $this->apiurl,
            [
            'http_errors' => false //404エラーも通す指定
            ]
        );        
    }

    public function test_connect_api()
    {
        $this->assertSame(200, $this->response->getStatusCode());
    }
    


    public function test_has_correct_json_from_api()
    {
        $json_data = $this->response->getBody();
        // print_r($json_data);
        $json_array = json_decode($json_data, true);
        print_r($json_array);
        //$result = $json_array["response"]["id"];

        // $this->assertSame('retail-sales', $result);
    }

    public function test_insert_data_to_database_from_api_json(){
        $json_data = $this->response->getBody();
        $json_array = json_decode($json_data, true);
        $result = $json_array["response"]["id"];
        // print_r($json_array["response"]);
    }

}
