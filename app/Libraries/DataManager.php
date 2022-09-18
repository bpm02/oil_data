<?php

namespace App\Libraries;

use App\Libraries\StoreDB;
use App\Libraries\GetDataWithApi;
use App\Models\PetroleumWeeklyStocks;

class DataManager
{

    static public $main_table = 'petroleum_weekly_stocks';
    static public $area = 'area';
    static public $product = 'product';
    static public $process = 'process';
    static public $series = 'series';
    static public $units = 'units';

    private $apiroute1;
    private $apiroute2;
    private $apiroute3;

    private $db;
    private $api;
    public $db_arr;
    
    public function __construct()
    {
        $db_path = dirname(__FILE__) . '/db_ids.php';
        $this->db_arr = include($db_path);
    }

    public function set_db($table_name)
    {
        $this->db = new StoreDB($table_name);
    }

    public function set_route($_apiroute1, $_apiroute2, $_apiroute3)
    {
        $this->apiroute1 = $_apiroute1;
        $this->apiroute2 = $_apiroute2;
        $this->apiroute3 = $_apiroute3;
    }

    public function set_api($facets = [], $start_date = '', $end_date = '')
    {
        $this->api = new GetDataWithApi($this->apiroute1, $this->apiroute2, $this->apiroute3, $facets, $start_date, $end_date);
    }


    public function insert_new_data($area, $product, $process = '', $is_db = true)
    {
        /**
         * 
         * 値を取得できなかった場合エラーを出してログに書き出す
         */

        // get latest data from db
        $new_data = $this->get_latest_data($area, $product, $process);
        // 値を取得できなかったらエラー

        // print_r($new_data);
        // reform insert data in db
        $result = $this->db->reform_data($new_data);
        // データベースに格納
        if (!empty($result) && $is_db) {
            PetroleumWeeklyStocks::insert($result);
        }
        return $result;
    }

    // insert data db from api
    public function insert_data($facets = [], $start_date = '', $end_date = '')
    {

        $this->api = new GetDataWithApi(
            $this->apiroute1,
            $this->apiroute2,
            $this->apiroute3,
            $facets,
            $start_date,
            $end_date,
        );

        $this->api->set_data();
        $new_data = $this->api->get_arr_data();
        // print_r($new_data);
        $result = $this->db->reform_data($new_data);
        //print_r($result);
        // データベースに格納
        if (!empty($result)) {
            PetroleumWeeklyStocks::insert($result);
            // print_r($result);
        }
    }

    public function get_latest_data($area, $product, $process = '')
    {
        $apiroute1 = 'petroleum';
        $apiroute2 = 'stoc';
        $apiroute3 = 'wstk';
        // DBデータの最新日付を出す

        // area to procuet no id wo mitukeru
        $area_id = $this->db->get_id_from_arr($area, $this->db_arr['area']);
        $product_id = $this->db->get_id_from_arr($product, $this->db_arr['product']);
        $process_name = '';
        $process_id = 0;
        if ($process != '') {
            $process_id = $this->db->get_id_from_arr($process, $this->db_arr['process']);
            $process_name = 'process_id';
        }
        // get latest date from db
        $latest_obj = $this->db->get_latest('area_id', $area_id, 'product_id', $product_id, $process_name, $process_id);
        // print_r($latest_obj);
        $recent_db_period = $latest_obj->period;

        // Hit latest api data
        $facets = ['duoarea' => $area, 'product' => $product];
        $start_date = $recent_db_period;

        $api = new GetDataWithApi(
            $apiroute1,
            $apiroute2,
            $apiroute3,
            $facets,
            $start_date,
        );

        $api->set_data();

        //return $api->get_arr_data();
        $new_data = $api->get_arr_data();
        // 新しいデータがあるか判別

        if (count($new_data) > 1) {
            array_shift($new_data);
            return $new_data;
        }

        return [];
    }
}
