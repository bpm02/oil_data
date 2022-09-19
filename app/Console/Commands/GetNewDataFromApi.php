<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use App\Libraries\DataManager;


use App\Models\PetroleumWeeklyStocks;


use DateTime;
// https://readouble.com/laravel/8.x/ja/artisan.html

class GetNewDataFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string area 取得するエリア
     * @var string product 取得する商品
     */


    protected $signature = 'api:new_data {area} {product} {process}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'apiから最新のデータだけとってくる';


    static public $main_table = 'petroleum_weekly_stocks';



    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $apiroute1 = 'petroleum';
        $apiroute2 = 'stoc';
        $apiroute3 = 'wstk';

        $this->dm = new DataManager();
        $this->dm->set_db(self::$main_table);
        $this->dm->set_route($apiroute1, $apiroute2, $apiroute3);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 実行プログラム

        $result = $this->dm->insert_new_data($this->argument('area'), $this->argument('product'), $this->argument('process'));
        // print_r($result);

/*
        $this->dm->insert_new_data('R10', 'EPC0', 'SAX');
        $this->dm->insert_new_data('R20', 'EPC0', 'SAX');
        $this->dm->insert_new_data('R30', 'EPC0', 'SAX');
        $this->dm->insert_new_data('R40', 'EPC0', 'SAX');
        $this->dm->insert_new_data('R50', 'EPC0', 'SAX');

        $this->dm->insert_new_data('R10', 'EPD0', 'SAE');
        $this->dm->insert_new_data('R20', 'EPD0', 'SAE');
        $this->dm->insert_new_data('R30', 'EPD0', 'SAE');
        $this->dm->insert_new_data('R40', 'EPD0', 'SAE');
        $this->dm->insert_new_data('R50', 'EPD0', 'SAE');

        $this->dm->insert_new_data('R10', 'EPM0', 'SAE');
        $this->dm->insert_new_data('R20', 'EPM0', 'SAE');
        $this->dm->insert_new_data('R30', 'EPM0', 'SAE');
        $this->dm->insert_new_data('R40', 'EPM0', 'SAE');
        $this->dm->insert_new_data('R50', 'EPM0', 'SAE');
*/
        return 0;
    }
}
