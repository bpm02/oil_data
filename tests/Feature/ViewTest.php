<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Modes\Petroleum;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // https://laravel.com/api/8.x/Illuminate/Testing/TestView.html#method_assertSee
    use DatabaseTransactions;

    public function setUp(): void
    {
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

/*
    public function test_give_data_to_view_of_home()
    {
        $stocks = DB::table('oildatas')->get();
        $view = $this->view('home', ['data' => $stocks]);
        // print_r($stocks);
        $view->assertSeeText('EPM0');
        
    }
    */

        public function test_give_data_to_view_of_home()
    {
        $stocks = Petroleum::table('oildatas')->get();
        $view = $this->view('home', ['data' => $stocks]);
        // print_r($stocks);
        $view->assertSeeText('EPM0');
        
    }
    
}
