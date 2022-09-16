<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class ApiController extends Controller
{

    protected $apiurl;
    protected $client;
    private $table_name = 'petroleum_weekly_stocks';
/*
facets 場所とセクターの選択オプション
client -> request option
https://docs.guzzlephp.org/en/stable/request-options.html#query
*/

    function __construct(){

    }

    // データベースからのデータをJSONデータにする
    public function jsonInsertFromDB($db_data){
        // insert data to array. 
        // use bindValue
        $result = [];
        foreach($db_data as $item){
            $data = [
                "id" => $item->id,
                "period" => $item->period,
                "value" => $item->value,

            ];
            array_push($result, $data);
        }

        return $result;
    }

    public function get_oil_stocks($area, $product, $period)
    {
        // area product name から idへ変換する
        $area_id = 0;
        if ($area == "R10") {
            $area_id = 2;
        } else if ($area == "R20") {
            $area_id = 6;
        } else if ($area == "R30") {
            $area_id = 7;
        } else if ($area == "R40") {
            $area_id = 8;
        } else if ($area == "R50") {
            $area_id = 10;
        }

        $product_id = 0;
        if (
            $product == "EPC0"
        ) {
            $product_id = 2;
        } else if ($product == "EPD0") {
            $product_id = 3;
        } else if ($product == "EPM0") {
            $product_id = 11;
        }
        /*
        print_r($area_id);
        print_r($product_id);
        print_r($period);
*/

        // get the data to DB. 
        $is_data = DB::table($this->table_name)
            ->where('area_id', '=', $area_id)
            ->where('product_id', '=', $product_id)
            ->where('period', '>', $period)
            ->orderBy('period', 'asc')
            ->exists();

        if ($is_data) {
            $stocks = DB::table($this->table_name)
                ->where('area_id', '=', $area_id)
                ->where('product_id', '=', $product_id)
                ->where('period', '>', $period)
                ->orderBy('period', 'asc')
                ->get();
        } else {
            $stocks = DB::table($this->table_name)
                ->where('area_id', '=', $area_id)
                ->where('product_id', '=', $product_id)
                ->orderBy('period', 'asc')
                ->get();
        }



        $json = self::jsonInsertFromDB($stocks);

        return response() -> json($json, 201);   
    }

    
}

