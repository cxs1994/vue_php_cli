<?php
namespace app\admin\controller;
use think\Config;
use think\Db;
class Giiview extends Base
{
    public function index()
    {
        $tables = Db::query("SHOW TABLES");
        foreach ($tables as $key => $table){
            $table['Tables_in_vpc-xs'] = str_replace(config('database.prefix'), '', $table['Tables_in_vpc-xs']);
            $tables[$key] = $table;
        }
        
        return view('giiview',['tables'=>$tables]);
    }
}