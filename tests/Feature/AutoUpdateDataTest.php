<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Libraries\GetDataWithApi;
use App\Libraries\StoreDB;
use App\Libraries\DataManager;

use App\Models\PetroleumWeeklyStocks;


class AutoUpdateDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;

    public $apiurl = "";
    public $client;
    public $response;
    public $api;
    public $db;
    public $dm;

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
        "EPC0" => 1,
        "EPD0" => 2,
        "EPM0" => 3,
    );

    public $process_arr = array(
        "SAE" => 1,
        "SAX" => 2,
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

        $this->dm = new DataManager();
        $this->dm->set_db(self::$main_table);
        $this->dm->set_api($apiroute1, $apiroute2, $apiroute3, $facets, $start_date, $end_date);
        // set up api
        /*
        $this->api = new GetDataWithApi($apiroute1, $apiroute2, $apiroute3, $facets, $start_date, $end_date);
        $this->api->set_data();
        // end set up api
        // setup original db class
        */
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
            [
                "id" => 2,
                "process" => "SAX",
                "process_name" => "Like Ending Stocks",
            ],
        ];

        $units_data = [
            'id' => 1,
            'units' => 'MBBL',
        ];

        // DB::table(self::$area)->insert($area_data);
        // DB::table(self::$product)->insert($product_data);
        // DB::table(self::$process)->insert($process_data);
        // DB::table(self::$units)->insert($units_data);
        // end setup db

    }


    public function test_insert_new_data()
    {
        // insert data from api
        $apiroute1 = 'petroleum';
        $apiroute2 = 'stoc';
        $apiroute3 = 'wstk';
        $facets = ['duoarea' => 'R30', 'product' => 'EPM0'];
        $start_date = '2022-06-15';
        $end_date = '2022-07-01';
        // insert old data
        $this->dm->insert_data($apiroute1, $apiroute2, $apiroute3, $facets, $start_date, $end_date);
        // insert new data
        $data = $this->dm->insert_new_data('R30', 'EPM0', 'SAE');

        $result = $this->check_period($data, $end_date);

        $this->assertEquals($result, true);
        
    }



    public function check_period($data, $_recent_db_date)
    {
        $result_date = [];
        $recent_db_date = new DateTime($_recent_db_date);
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

        return $result;
    }

}
