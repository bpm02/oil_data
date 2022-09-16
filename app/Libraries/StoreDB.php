<?php

namespace App\Libraries;

use DateTime;
use Illuminate\Support\Facades\DB;

class StoreDB
{

    static private $table = '';
    public $db_arr;


    function __construct($table_name)
    {
        self::$table = $table_name;
        $db_path = dirname(__FILE__) . '/db_ids.php';
        $this->db_arr = include($db_path);
    }

    function set($data)
    {
        return DB::table(self::$table)->insert($data);
    }

    function get()
    {
        return DB::table(self::$table)->get();
    }

    //ある一つのデータの最新のデータだけ取り出す
    function get_latest($key1, $value1, $key2 = '', $value2 = '', $key3 = '', $value3 = '')
    {
        if ($key3 !== '' || $key3 > 0) {
            return DB::table(self::$table)->where($key1, '=', $value1)->where($key2, '=', $value2)->where($key3, '=', $value3)->orderBy('period', 'desc')->first();
        } else if ($key2 !== '') {
            return DB::table(self::$table)->where($key1, '=', $value1)->where($key2, '=', $value2)->orderBy('period', 'desc')->first();
        } else {
            return DB::table(self::$table)->where($key1, '=', $value1)->orderBy('period', 'desc')->first();
        }
    }

    // 特定の日付以降のデータ全て
    function get_after_period($_period)
    {
        return DB::table(self::$table)->where($_period, '>', 'period')->get();
    }

    // APIのデータをデータベースに格納する形に格納
    function reform_data($data)
    {

        $insert_data = [];
        $tmp = [
            'period' => '',
            'value' => 0,
            'area_id' => 0,
            'product_id' => 0,
            'process_id' => 0,
            'units_id' => 1,
        ];

        foreach ($data as $item) {
            $result = $tmp;
            $result['period'] = $item['period'];
            $result['value'] = $item['value'];
            // アレイの中から該当するIDを探す


            foreach ($this->db_arr['area'] as $key => $value) {
                if ($key == $item['duoarea']) {
                    $result['area_id'] = $value;
                    break;
                }
            }

            foreach ($this->db_arr['product'] as $key => $value) {
                if ($key == $item['product']) {
                    $result['product_id'] = $value;
                    break;
                }
            }

            foreach ($this->db_arr['process'] as $key => $value) {
                if ($key == $item['process']) {
                    $result['process_id'] = $value;
                    break;
                }
            }

            array_push($insert_data, $result);
        }

        return $insert_data;
    }

    // tag kara id wo dasu
    public function get_id_from_arr($target, $arr)
    {
        foreach ($arr as $key => $value) {
            if ($key == $target) {
                return $value;
            }
        }
    }

    public function get_area_id_from_duoarea($duoarea)
    {
        foreach ($this->duoarea_arr as $key => $value) {
            if ($key == $duoarea) {
                return $value;
            }
        }
    }

    public function get_product_id_from_product($product)
    {
        foreach ($this->product_arr as $key => $value) {
            if ($key == $product) {
                return $value;
            }
        }
    }

}
