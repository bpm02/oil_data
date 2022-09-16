<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetDataWithApiController extends Controller
{


    protected $apiurl;
    protected $client;
    public $response;

    static public $main_table = 'petroleum_weekly_stocks';
    static public $area = 'area';
    static public $product = 'product';
    static public $process = 'process';
    static public $series = 'series';
    static public $units = 'units';



    function __construct()
    {
        // set up api
        $apikey = 'VIUaL9u7clkQhKV5au3WxZqzUIOnATteAvgQxh3r';
        $apiroute = 'petroleum';
        $apiv1 = 'stoc';
        $apiv2 = 'wstk';
        $start_date = '2022-07-01';
        $this->apiurl = "https://api.eia.gov/v2/${apiroute}/${apiv1}/${apiv2}/data/?api_key=${apikey}&data[]=value&start=${start_date}";

        $this->client = new \GuzzleHttp\Client();

        $this->response = $this->client->request(
            'GET',
            $this->apiurl,
            [
                'http_errors' => false //404エラーも通す指定
            ]
        );
    }
}
