<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;


use App\Libraries\DataManager;
use App\Libraries\area;


use App\Models\PetroleumWeeklyStocks;





class InsertDbFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:insert {area} {product} {process} {start_date?} {end_date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '外部サイトのAPIからデータを取得してDBへ格納する';

    static public $main_table = 'petroleum_weekly_stocks';

    public $db_arr;
    public $duoarea_arr;
    public $product_arr;
    public $process_arr;
    public $units_arr = array(
        "MBBL" => 1,
    );
/*
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
    );

    public $units_arr = array(
        "MBBL" => 1,
    );
*/
    private $apiroute1;
    private $apiroute2;
    private $apiroute3;
    private $facets = [];
    private $start_date;
    private $end_date;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiroute1 = 'petroleum';
        $this->apiroute2 = 'stoc';
        $this->apiroute3 = 'wstk';

        $this->dm = new DataManager();
        $this->dm->set_db(self::$main_table);

        $db_path = dirname(__FILE__, 3) . '/Libraries/db_ids.php';
        $this->db_arr = include($db_path);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $area = $this->argument('area');
        $product = $this->argument('product');
        $process = $this->argument('process');

        $area_arr = [];
        if ($area != 'null') {
            $area_arr['duoarea'] = $area;
        }


        $product_arr = [];
        if ($product != 'null') {
            $product_arr['product'] = $product;
        }

        $process_arr = [];
        if ($process != 'null') {
            $process_arr['process'] = $process;
        }

        $this->facets = array_merge($this->facets, $area_arr);
        $this->facets = array_merge($this->facets, $product_arr);
        $this->facets = array_merge($this->facets, $process_arr);

/*
        $this->facets = [
            'duoarea' => $area,
            'product' => $product,
            'process' => $process,
        ];
*/
        $this->start_date = $this->argument('start_date');
        $this->end_date = $this->argument('end_date');
        $this->dm->set_route($this->apiroute1, $this->apiroute2, $this->apiroute3);
        $this->dm->insert_data($this->facets, $this->start_date, $this->end_date);
        print('insert new data!' . "\n");
    }
}
