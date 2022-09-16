<?php

namespace App\Libraries;

use DateTime;

class GetDataWithApi
{

    public $apiurl;
    public $client;
    public $response;
    public $json_data;
    public $arr_data;
    public $status_coed = 0;

    static public $main_table = 'crude_oil_weekly_stocks_padd1';
    static public $area = 'area';
    static public $product = 'product';
    static public $process = 'process';
    static public $series = 'series';
    static public $units = 'units';

    function __construct($apiroute1, $apiroute2, $apiroute3, $facets = [], $start_date = '', $end_date = '')
    {

        // set up api
        $apikey = 'VIUaL9u7clkQhKV5au3WxZqzUIOnATteAvgQxh3r';
        /*
        $apiroute = 'petroleum';
        $apiv1 = 'stoc';
        $apiv2 = 'wstk';
        $start_date = '2022-07-01';
        facets[duoarea][]=NUSなどで値のフィルターをかけられる
        $fecets [$key => $value] 例）['duoarea' => 'YCUOK', 'product' => 'OIL']
        */

        $this->apiurl = "https://api.eia.gov/v2/${apiroute1}/${apiroute2}/${apiroute3}/data/?api_key=${apikey}&data[]=value";
        if (!empty($facets)) {
            foreach ($facets as $key => $value) {
                $this->apiurl = $this->apiurl . $this->extend_filter_api_url($key, $value);
            }
        }

        if (!empty($start_date)) {
            $this->apiurl = $this->apiurl . "&start=${start_date}";
        }

        if (!empty($end_date)) {
            $this->apiurl = $this->apiurl . "&end=${end_date}";
        }
        // end set up api
    }


    // Apiからデータを取ってきて、格納
    public function set_data()
    {
        $this->client = new \GuzzleHttp\Client();
       
        $this->response = $this->client->request(
            'GET',
            $this->apiurl,
            [
                'http_errors' => false //404エラーも通す指定
            ]
        );

        // json data
        $this->json_data = $this->response->getBody();

        // php array data
        $json_array = json_decode($this->json_data, true);

        $this->arr_data = $json_array["response"]["data"];
        // print_r($this->arr_data);
        $this->status_coed = $this->response->getStatusCode();

        return $this->status_coed;
    }

    public function get_status_coed()
    {
        return $this->status_coed;
    }

    public function get_json_data()
    {
        return $this->json_data;
    }

    // 指定したデータをAPIからとってくる
    public function get_arr_data($area = '', $product = '', $process = '', $series = '', $period_sort_asc = true)
    {
        
        $result = $this->arr_data;
        $result = $this->sort_data($result, "duoarea", $area);
        $result = $this->sort_data($result, "product", $product);
        $result = $this->sort_data($result, "process", $process);
        $result = $this->sort_data($result, "series", $series);

        // 配列を日付順に並べる
        if ($period_sort_asc) {
            array_multisort(array_map("strtotime", array_column($result, "period")), SORT_ASC, $result);
        } else {
            array_multisort(array_map("strtotime", array_column($result, "period")), SORT_DESC, $result);
        }

        return $result;
    }

    // 取得してきたデータを選別して配列ヲ返す
    private function sort_data($data, $sector_name, $sector)
    {
        if (!empty($sector)) {
            $pre_result = [];

            foreach ($data as $item) {
                if ($item[$sector_name] == $sector) {
                    array_push($pre_result, $item);
                }
            }

            return $pre_result;
        }

        return $data;
    }

    // 最新のデータを取得する
    private function get_recent_data($latest_date)
    {
    }

    private function extend_filter_api_url($sectorid, $sector)
    {
        return "&facets[${sectorid}][]=${sector}";
    }

}
