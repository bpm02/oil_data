<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Petroleum;




class GetDataDBController extends Controller
{
    /**
     * アプリケーションの全ユーザーレコード一覧を表示
     *
     * @return Response
     */

    public function __construct(){
        $file = dirname(__FILE__, 4) . "/variables.json";
        $json = file_get_contents($file);
        $json_arr = json_decode($json, true);
    }

     // https://qiita.com/grohiro/items/4efc6c569be26e36aef2
    public function index()
    {
        
        $stocks = DB::select('SELECT * FROM oildatas');
        $data = ['datas' => $stocks];
        
        return view('home', $data);
    }
}