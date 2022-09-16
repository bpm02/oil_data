<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use Illuminate\Support\Facades\DB;
use App\Libraries\GetDataWithApi;
use App\Libraries\StoreDB;
use App\Libraries\DataManager;

use App\Models\PetroleumWeeklyStocks;



class CommandTest extends TestCase
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

    public function setUp(): void
    {
        parent::setUp();

        $apiroute1 = 'petroleum';
        $apiroute2 = 'stoc';
        $apiroute3 = 'wstk';


        $this->dm = new DataManager();
        $this->dm->set_db(self::$main_table);
        $this->dm->set_route($apiroute1, $apiroute2, $apiroute3);

        /*
        $area_data = [
            [
                "id" => 1,
                "duoarea" => "NUS",
                "area_name" => "U.S.",

            ],
            [
                "id" => 2,
                "duoarea" => "R10",
                "area_name" => "PADD 1",

            ],
            [
                "id" => 3,
                "duoarea" => "R1X",
                "area_name" => "PADD 1A",

            ],
            [
                "id" => 4,
                "duoarea" => "R1Y",
                "area_name" => "PADD 1B",

            ],
            [
                "id" => 5,
                "duoarea" => "R1Z",
                "area_name" => "PADD 1C",

            ],
            [
                "id" => 6,
                "duoarea" => "R20",
                "area_name" => "PADD 2",

            ],
            [
                "id" => 7,
                "duoarea" => "R30",
                "area_name" => "PADD 3",

            ],
            [
                "id" => 8,
                "duoarea" => "R40",
                "area_name" => "PADD 4",

            ],
            [
                "id" => 9,
                "duoarea" => "R4N5",
                "area_name" => "NA",

            ],
            [
                "id" => 10,
                "duoarea" => "R50",
                "area_name" => "PADD 5",

            ],
            [
                "id" => 11,
                "duoarea" => "YCUOK",
                "area_name" => "NA",

            ],
        ];


        $product_data = [
            [
                "id" => 1,
                "product" => "EP00",
                "product_name" => "Crude Oil and Petroleum Products",

            ],
            [
                "id" => 2,
                "product" => "EPC0",
                "product_name" => "Crude Oil",

            ],
            [
                "id" => 3,
                "product" => "EPD0",
                "product_name" => "Distillate Fuel Oil",
            ],
            [
                "id" => 4,
                "product" => "EPD00H",
                "product_name" => "DIstillage Fuel Oil, Greater than 500 ppm sulfur",

            ],
            [
                "id" => 5,
                "product" => "EPDM10",
                "product_name" => "DIstillage Fuel Oil, Greater than 15 to 500 ppm sulfur",

            ],
            [
                "id" => 6,
                "product" => "EPDXL0",
                "product_name" => "DIstillage Fuel Oil, 0 to 15 ppm Sulfur",
            ],
            [
                "id" => 7,
                "product" => "EPJK",
                "product_name" => "Kerosene-Type Jet Fuel",

            ],
            [
                "id" => 8,
                "product" => "EPL0XP",
                "product_name" => "NGPLs/LRGs (Excluding Propane/Propylene",

            ],
            [
                "id" => 9,
                "product" => "EPLLPYN",
                "product_name" => "Propylen NonFuel Use",
            ],
            [
                "id" => 10,
                "product" => "EPPLLPZ",
                "product_name" => "Propane and Propylene",

            ],
            [
                "id" => 11,
                "product" => "EPM0",
                "product_name" => "Total gasoline",

            ],
            [
                "id" => 12,
                "product" => "EPM0C",
                "product_name" => "Conventional Motor Gasoline",
            ],
            [
                "id" => 13,
                "product" => "EPM0CA",
                "product_name" => "Conventional Moter Gasoline with Alcohol",

            ],
            [
                "id" => 14,
                "product" => "EPM0CAG55",
                "product_name" => "Finished Motor Gasoline Conventional>55",

            ],
            [
                "id" => 15,
                "product" => "EPM0CO",
                "product_name" => "Other Conventional Motor Gasoline",
            ],
            [
                "id" => 16,
                "product" => "EPM0F",
                "product_name" => "Finished Motor Gasoline",

            ],
            [
                "id" => 17,
                "product" => "EPM0R",
                "product_name" => "Reformulated Motor Gasoline",

            ],
            [
                "id" => 18,
                "product" => "EPM0RA",
                "product_name" => "Reformulated Motor Gasoline with Alcohol",
            ],
            [
                "id" => 19,
                "product" => "EPOBG",
                "product_name" => "Gasoline Blending Components",

            ],
            [
                "id" => 20,
                "product" => "EPOBGCC",
                "product_name" => "Conventional CBOB Gasoline Blending Components",

            ],
            [
                "id" => 21,
                "product" => "EPOBGCG",
                "product_name" => "Conventional GTAB Gasoline Blending Components",
            ],
            [
                "id" => 22,
                "product" => "EPOGBCO",
                "product_name" => "Conventional Other Gasoine Blending Components",

            ],
            [
                "id" => 23,
                "product" => "EPOBGRG",
                "product_name" => "Reformulated GTAB Gasoline Blending Components",

            ],
            [
                "id" => 24,
                "product" => "EPOBGRR",
                "product_name" => "Motor Gasoline Blending Components Reformulated RBOB",
            ],
            [
                "id" => 25,
                "product" => "EPOBGRRA",
                "product_name" => "Reformulated RBOB with Alcohol Gasoline Blending Components",
            ],
            [
                "id" => 26,
                "product" => "EPOBGRRE",
                "product_name" => "Reformulated RBOB with Either Gasoline Blending Components",

            ],
            [
                "id" => 27,
                "product" => "EPOOXE",
                "product_name" => "Fuel Ethanol",

            ],
            [
                "id" => 28,
                "product" => "EPPA",
                "product_name" => "Asphalt and Road Oil",
            ],
            [
                "id" => 29,
                "product" => "EPPK",
                "product_name" => "Kerosene",
            ],
            [
                "id" => 30,
                "product" => "EPPO6",
                "product_name" => "Other Oils (Excluding Fuel Ethanol)",

            ],
            [
                "id" => 31,
                "product" => "EPPR",
                "product_name" => "Residual Fuel Oil",

            ],
            [
                "id" => 32,
                "product" => "EPPU",
                "product_name" => "Unfinished Oils",
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
                "process" => "SAS",
                "process_name" => "Ending Stocks SPR",
            ],
            [
                "id" => 3,
                "process" => "SAX",
                "process_name" => "Ending Stocks Excluding SPR",
            ],
            [
                "id" => 4,
                "process" => "SAXL",
                "process_name" => "Ending Stocks Excluding SPR and Lease",
            ],
            [
                "id" => 5,
                "process" => "SAXP",
                "process_name" => "Ending Stocks Excluding Propylene at Terminal",
            ],
            [
                "id" => 6,
                "process" => "SKA",
                "process_name" => "Stocks In Transit (on Ships) from Alaska)",
            ],
            [
                "id" => 7,
                "process" => "SKB",
                "process_name" => "Stocks at Bulk Terminal",
            ],
        ];

        DB::table(self::$area)->insert($area_data);
        DB::table(self::$product)->insert($product_data);
        DB::table(self::$process)->insert($process_data);
        // DB::table(self::$units)->insert($units_data);
        // end setup db
*/
    }

    public function test_console_command()
    {
        $this->artisan('api:insert R10 EPC0 SAE 2022-07-01 2022-07-15')->assertSuccessful();
    }

    public function test_insert_data()
    {
        $this->artisan('api:insert R10 EPM0 null 2000-01-01 2000-02-01');
        $stocks = DB::table('petroleum_weekly_stocks')->get();


        // print_r($stocks);
    }

    public function test_insert_new_data()
    {




        // insert mock data from api
        $facets = ['duoarea' => 'R30', 'product' => 'EPD0'];
        $start_date = '2022-06-15';
        $end_date = '2022-07-01';
        $this->dm->insert_data($facets, $start_date, $end_date);
        // end insert mock data from api

        // insert new data
        $data = $this->dm->insert_new_data('R30', 'EPD0');

        // test sections
        $result = $this->check_period($data, $end_date);
        $this->assertEquals($result, true);
        // end test sections
     
    }


    public function test_insert_new_multi_data()
    {

        // insert mock data from api
        $facets = ['duoarea' => 'R30', 'product' => 'EPM0'];
        $start_date = '2022-06-15';
        $end_date = '2022-07-01';
        $this->dm->insert_data($facets, $start_date, $end_date);


        $facets = ['duoarea' => 'R50', 'product' => 'EPC0'];
        $start_date = '2022-06-15';
        $end_date = '2022-07-01';
        $this->dm->insert_data($facets, $start_date, $end_date);

        $facets = [
            'duoarea' => 'R10', 'product' => 'EPD0'
        ];
        $start_date = '2022-06-15';
        $end_date = '2022-07-01';
        $this->dm->insert_data($facets, $start_date, $end_date);
        // end insert mock data from api

        // insert new data
        $data1 = $this->dm->insert_new_data('R30', 'EPM0');
        $data2 = $this->dm->insert_new_data('R50', 'EPC0');

        // test sections
        $result = $this->check_period($data1, $end_date);
        $result = $this->check_period($data2, $end_date);


        $result = $this->check_value(
            $data1,
            'area_id',
            7
        );
        if (!$result) {
            $this->assertEquals($result, true);
            return;
        }
        $result = $this->check_value($data2, 'area_id', 10);
        if (!$result) {
            $this->assertEquals($result, true);
            return;
        }

        $result = $this->check_value(
                $data1,
                'product_id',
                11
            );
        if (!$result) {
            $this->assertEquals($result, true);
            return;
        }
        $result = $this->check_value($data2, 'product_id', 2);
        if (!$result) {
            $this->assertEquals($result, true);
            return;
        }


        $this->assertEquals($result, true);
        // end test sections
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

    public function check_value($data, $name_id, $target_id)
    {

        foreach ($data as $item) {
            if ($item[$name_id] != $target_id) {
                return false;
            }
        }

        return true;
    }
}
