<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Libraries\GetDataWithApi;
use App\Libraries\StoreDB;

use App\Models\PetroleumWeeklyStocks;
use App\Models\Area;
use App\Models\Product;
use App\Models\Process;
use App\Models\Series;
use App\Models\Units;
use Facade\FlareClient\Api;

class ApiExternalTest extends TestCase
{
    /**
     * 
     * 
     * Start Date
     * 
     */

    use DatabaseTransactions;

    public $apiurl = "";
    public $client;
    public $response;
    public $api;
    public $db;

    static public $main_table = 'petroleum_weekly_stocks';
    static public $area = 'area';
    static public $product = 'product';
    static public $process = 'process';
    static public $series = 'series';
    static public $units = 'units';

    public $duoarea_arr = array(
        "R10" => 1,
        "R20" => 2,
        "R30" => 3,
        "R40" => 4,
        "R50" => 5,
    );

    public $product_arr = array(
        "SAE" => 1,
        "EPD0" => 2,
        "EPM0" => 3,
    );

    public $process_arr = array(
        "SAE" => 1,
    );

    public $units_arr = array(
        "MBBL" => 1,
    );

    public function setUp(): void
    {
        parent::setUp();

        $apiroute1 = 'petroleum';
        $apiroute2 = 'stoc';
        $apiroute3 = 'wstk';
        $facets = [];
        $start_date = '2022-06-15';
        $end_date = '2022-07-08';

        // set up api
        $this->api = new GetDataWithApi($apiroute1, $apiroute2, $apiroute3, $facets, $start_date, $end_date);
        $this->api->set_data();
        // end set up api
        // setup original db class
        $this->db = new StoreDB(self::$main_table);

        // end setup original db class

        // setup db

        $area_data = [
            [
                "id" => 1,
                "duoarea" => "R10",
                "area_name" => "PADD 1",
            ],
            [
                "id" => 2,
                "duoarea" => "R20",
                "area_name" => "PADD 2",
            ],
            [
                "id" => 3,
                "duoarea" => "R30",
                "area_name" => "PADD 3",
            ],
            [
                "id" => 4,
                "duoarea" => "R40",
                "area_name" => "PADD 4",
            ],
            [
                "id" => 5,
                "duoarea" => "R50",
                "area_name" => "PADD 5",
            ],
        ];

        $product_data = [
            [
                "id" => 1,
                "product" => "SAE",
                "product_name" => "Crude Oil",

            ],
            [
                "id" => 2,
                "product" => "EPD0",
                "product_name" => "Distillate Fuel Oil",

            ],
            [
                "id" => 3,
                "product" => "EPM0",
                "product_name" => "Total gasoline",
            ],
        ];

        $process_data = [
            [
                "id" => 1,
                "process" => "SAE",
                "process_name" => "Ending Stocks",
            ],
        ];

        $units_data = [
            'id' => 1,
            'units' => 'MBBL',
        ];

        DB::table(self::$area)->insert($area_data);
        DB::table(self::$product)->insert($product_data);
        DB::table(self::$process)->insert($process_data);
        DB::table(self::$units)->insert($units_data);



        // end setup db
    }

    public function test_connect_api()
    {
        $this->assertSame(200, $this->api->get_status_coed());
    }

    // APIからデータを取得して、データベースへ格納
    public function test_insert_db_from_api()
    {
        $area = "R20";
        $product = "EPM0";
        // get data from api
        $data = $this->api->get_arr_data($area, $product);
        $insert_data = $this->db->reform_data($data);
        DB::table(self::$main_table)->insert($insert_data);
        $stocks = PetroleumWeeklyStocks::first();
        $this->assertSame($stocks->area_id, 2);
    }


    // 最新のAPIデータを取得
    public function test_extract_only_the_latest_data()
    {
        // insert db
        $area = "R20";
        $product = "EPM0";
        // get data from api
        $data = $this->api->get_arr_data($area, $product);
        $insert_data = $this->db->reform_data($data);
        DB::table(self::$main_table)->insert($insert_data);


        // DBデータの最新日付を出す
        $latest_obj = $this->db->get_latest('area_id', 2, 'product_id', 3);


        $recent_db_period = $latest_obj->period;
        $recent_db_date = new DateTime($recent_db_period);

        $apiroute1 = 'petroleum';
        $apiroute2 = 'stoc';
        $apiroute3 = 'wstk';
        $facets = ['duoarea' => 'R20', 'product' => 'EPM0'];
        $start_date = $recent_db_period;
        // 最新のデータのAPIを取得
        $api = new GetDataWithApi(
            $apiroute1,
            $apiroute2,
            $apiroute3,
            $facets,
            $start_date
        );
        $api->set_data();
        $data = $api->get_arr_data();
        // 0番目を削除　2つ以上データがあれば最新のデータがあるということ
        if (count($data) <= 1) {
            // 最新のデータはない
            $data = [];
        } else {
            // 0番目を消す
            array_shift($data);
        }
        //print_r($data);
        $result_date = [];

        foreach ($data as $item) {
            $item_date = new DateTime($item['period']);
            if ($item_date > $recent_db_date) {
                array_push($result_date, $item_date);
            }
        }

        $result = false;

        foreach ($result_date as $item) {

            if ($item > $recent_db_date) {
                $result = true;
            } else {
                $result = false;
                break;
            }
        }

        $this->assertSame($result, true);
        
    }



    // 特定のエリアのデータだけ抽出
    public function test_only_specify_area_data_from_db()
    {
        // 一つのセクターの最新のデータのみを取得
        $stocks = PetroleumWeeklyStocks::all()->where('area_id', '=', 1);

        $result = false;
        foreach ($stocks as $stock) {
            if ($stock['area_id'] == 1) {
                $result = true;
            } else {
                $result = false;
                break;
            }
        }
        //print_r($stocks);
        $this->assertSame($result, true);
    }



    // DBに希望する値があるか？
    public function hasExistValue($db_value, $api_value)
    {
        $result = 0;
        try {

            foreach ($db_value as $key => $value) {
                if ($key == $api_value) {
                    $result = $value;
                    break;
                }
            }

            if ($result <= 0) {
                throw new \Exception("値が見つかりません");
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return -1;
        }

        return $result;
    }



}


