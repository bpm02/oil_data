<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class DBTest extends TestCase
{

    use DatabaseTransactions;
    // 特定の日付だけデータをとってくる
    // stockのデータだけとってくる
    // 特定の製品だけとってくる

    public function setUp(): void 
    {
        // 祖先クラスの setUp() を忘れずにコールする。
        parent::setUp();

        DB::table('oildatas')->insert([
            'period' => '2022-07-01',
            'duoarea' => 'R1Y',
            'area-name' => 'PADD 1B',
            'product' => 'EPM0',
            'product-name' => 'Total Gasoline',
            'process' => 'SAE',
            'process-name' => 'Ending Stocks',
            'series' => 'WGTST1B1',
            'series-description' => 'Central Atlantic (PADD 1B) Ending Stocks of Total Gasoline (Thousand Barrels)',
            'value' => 24525,
            'units' => 'MBBL'
        ]);

        DB::table('oildatas')->insert([
            'period' => '2022-07-01',
            'duoarea' => 'R20',
            'area-name' => 'PADD 2',
            'product' => 'EPM0C',
            'product-name' => 'Conventional Motor Gasoline',
            'process' => 'SAE',
            'process-name' => 'Ending Stocks',
            'series' => 'WG4ST_R20_1',
            'series-description' => 'Midwest (PADD 2) Ending Stocks of Conventional Motor Gasoline (Thousand Barrels)',
            'value' => 4503,
            'units' => 'MBBL'
        ]);

        DB::table('oildatas')->insert([
            'period' => '2022-06-01',
            'duoarea' => 'R1Y',
            'area-name' => 'PADD 1B',
            'product' => 'EPM0',
            'product-name' => 'Total Gasoline',
            'process' => 'SAE',
            'process-name' => 'Ending Stocks',
            'series' => 'WGTST1B1',
            'series-description' => 'Central Atlantic (PADD 1B) Ending Stocks of Total Gasoline (Thousand Barrels)',
            'value' => 27180,
            'units' => 'MBBL'
        ]);

        DB::table('oildatas')->insert([
            'period' => '2022-06-01',
            'duoarea' => 'R20',
            'area-name' => 'PADD 2',
            'product' => 'EPM0C',
            'product-name' => 'Conventional Motor Gasoline',
            'process' => 'SAE',
            'process-name' => 'Ending Stocks',
            'series' => 'WG4ST_R20_1',
            'series-description' => 'Midwest (PADD 2) Ending Stocks of Conventional Motor Gasoline (Thousand Barrels)',
            'value' => 5644,
            'units' => 'MBBL'
        ]);

        DB::table('oildatas')->insert([
            'period' => '2022-05-01',
            'duoarea' => 'R1Y',
            'area-name' => 'PADD 1B',
            'product' => 'EPM0',
            'product-name' => 'Total Gasoline',
            'process' => 'SAE',
            'process-name' => 'Ending Stocks',
            'series' => 'WGTST1B1',
            'series-description' => 'Central Atlantic (PADD 1B) Ending Stocks of Total Gasoline (Thousand Barrels)',
            'value' => 23135,
            'units' => 'MBBL'
        ]);

        DB::table('oildatas')->insert([
            'period' => '2022-05-01',
            'duoarea' => 'R20',
            'area-name' => 'PADD 2',
            'product' => 'EPM0C',
            'product-name' => 'Conventional Motor Gasoline',
            'process' => 'SAE',
            'process-name' => 'Ending Stocks',
            'series' => 'WG4ST_R20_1',
            'series-description' => 'Midwest (PADD 2) Ending Stocks of Conventional Motor Gasoline (Thousand Barrels)',
            'value' => 5203,
            'units' => 'MBBL'
        ]);

    }


    public function test_count_data_db()
    {

        $stocks = DB::table('oildatas')->get();
        $this->assertEquals($stocks->count(), 6);
    }

    public function test_get_a_product_data_db()
    {
        $stocks = DB::table('oildatas')
            ->where('product', '=', 'EPM0')
            ->value('product');

        $this->assertEquals($stocks, 'EPM0');
    }

    public function test_get_the_product_data_db()
    {
        $stocks = DB::table('oildatas')
            ->where('product', '=', 'EPM0C')
            ->get();
        // print_r($stocks);
        $this->assertEquals($stocks->count(), 3);
    }

}
