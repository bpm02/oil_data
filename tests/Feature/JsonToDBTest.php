<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class JsonToDBTest extends TestCase
{


    use DatabaseTransactions;
/**
 * 
 * DBからデータを取ってAPIのページのボディにJSONデータを表示する
 * 
 * 
 */
/*
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
*/
    public function test_get_the_product_fix_data_db()
    {
        $stocks = DB::table('oildatas')
            ->where('product', '=', 'EPM0C')
            ->get();
        // print_r($stocks);
        $this->assertEquals($stocks->count(), 3);
    }


        public function test_json_to_db()
    {

        $json = [];

        $stocks = DB::table('oildatas')
            ->where('product', '=', 'EPM0C')
            ->get();
        // $stocks[];
        foreach($stocks as $item){
            
            $data = [
                "id" => $item->id,
                "period" => $item->period,
                "duoarea" => $item->duoarea,
                "product" => $item->product,
                "value" => $item->value,
            ];

            array_push($json, $data);
        }
        // to json
        json_encode($json);
        print_r($json);
        // ジェーソン型か判定する
        $this->assertEquals(count($json), 3);
    }

}