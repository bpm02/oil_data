<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\PetroleumWeeklyStocks;
use App\Models\Area;
use App\Models\Product;
use App\Models\Process;
use App\Models\Series;
use App\Models\Units;

use function PHPUnit\Framework\assertCount;

class NewJsonToDBTest extends TestCase
{


    use DatabaseTransactions;
    /**
     * 
     * DBからデータを取ってAPIのページのボディにJSONデータを表示する
     * 
     * 
     */

    static public $main_table = 'petroleum_weekly_stocks';
    static public $area = 'area';
    static public $product = 'product';
    static public $process = 'process';
    static public $series = 'series';
    static public $units = 'units';
    static public $sample_json = [];

    public function setUp(): void
    {
        // 祖先クラスの setUp() を忘れずにコールする。
        parent::setUp();


        DB::table(self::$area)->insert([
            'id' => 1,
            'duoarea' => 'R1Y',
            'area_name' => 'PADD 1B',
        ]);

        DB::table(self::$area)->insert([
            'id' => 2,
            'duoarea' => 'R20',
            'area_name' => 'PADD 2',
        ]);

        DB::table(self::$product)->insert([
            'id' => 1,
            'product' => 'EPM0',
            'product_name' => 'Total Gasoline',
        ]);

        DB::table(self::$product)->insert([
            'id' => 2,
            'product' => 'SAE',
            'product_name' => 'Conventional Motor Gasoline',
        ]);

        DB::table(self::$process)->insert([
            'id' => 1,
            'process' => 'SAE',
            'process_name' => 'Ending Stocks',
        ]);


        DB::table(self::$series)->insert([
            'id' => 1,
            'series' => 'WGTST1B1',
            'series_description' => 'Central Atlantic (PADD 1B) Ending Stocks of Total Gasoline (Thousand Barrels)',
        ]);

        DB::table(self::$series)->insert([
            'id' => 2,
            'series' => 'WG4ST_R20_1',
            'series_description' => 'Midwest (PADD 2) Ending Stocks of Conventional Motor Gasoline (Thousand Barrels)',
        ]);

        DB::table(self::$units)->insert([
            'id' => 1,
            'units' => 'MBBL',
        ]);

        DB::table(self::$main_table)->insert([
            'id' => 1,
            'period' => '2022-05-01',
            'value' => 24525,
            'area_id' => 1,
            'product_id' => 1,
            'process_id' => 1,
            'series_id' => 1,
            'units_id' => 1,
        ]);


        DB::table(self::$main_table)->insert([
            'id' => 2,
            'period' => '2022-05-01',
            'value' => 4503,
            'area_id' => 2,
            'product_id' => 2,
            'process_id' => 1,
            'series_id' => 2,
            'units_id' => 1,
        ]);

        DB::table(self::$main_table)->insert([
            'id' => 3,
            'period' => '2022-06-01',
            'value' => 38274,
            'area_id' => 1,
            'product_id' => 1,
            'process_id' => 1,
            'series_id' => 1,
            'units_id' => 1,
        ]);

        DB::table(self::$main_table)->insert([
            'id' => 4,
            'period' => '2022-06-01',
            'value' => 2385,
            'area_id' => 2,
            'product_id' => 2,
            'process_id' => 1,
            'series_id' => 2,
            'units_id' => 1,
        ]);

        DB::table(self::$main_table)->insert([
            'id' => 5,
            'period' => '2022-07-01',
            'value' => 12058,
            'area_id' => 1,
            'product_id' => 1,
            'process_id' => 1,
            'series_id' => 1,
            'units_id' => 1,
        ]);

        DB::table(self::$main_table)->insert([
            'id' => 6,
            'period' => '2022-07-01',
            'value' => 5893,
            'area_id' => 2,
            'product_id' => 2,
            'process_id' => 1,
            'series_id' => 2,
            'units_id' => 1,
        ]);
    }

    public function test_get_area_count()
    {
        $count = Area::all()->count();
        $this->assertSame($count, 2);
    }

    public function test_get_product_count()
    {
        $count = Product::all()->count();
        $this->assertSame($count, 2);
    }
    public function test_get_process_count()
    {
        $count = Process::all()->count();
        $this->assertSame($count, 1);
    }
    public function test_get_series_count()
    {
        $count = Series::all()->count();
        $this->assertSame($count, 2);
    }
    public function test_get_units_count()
    {
        $count = Units::all()->count();
        $this->assertSame($count, 1);
    }

    public function test_get_count()
    {
        $count = PetroleumWeeklyStocks::all()->count();
        $this->assertSame($count, 6);
    }


    public function test_relation_area()
    {
        // get area
        $count = Area::find(1)->petroleum_weekly_stocks()->count();
        $this->assertSame($count, 3);
    }

    public function test_relation_stocks()
    {
        // get area
        $stocks = PetroleumWeeklyStocks::find(1)->area()->get();
        $this->assertSame($stocks[0]['area_name'], "PADD 1B");
    }

    // jsonから値を比較して、データベースに格納する

}
