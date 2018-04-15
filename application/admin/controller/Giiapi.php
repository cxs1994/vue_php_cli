<?php
namespace app\admin\controller;

use Couchbase\Exception;
use think\Config;
use think\Db;
use think\queue\connector\Database;

class Giiapi extends Base
{
    public function table()
    {
        $data = Db::query("SHOW TABLES");
        return json([
            'data' => $data
        ]);
    }
    
    public function fields()
    {
        $req = input('');
        try{
            $req['table'] = str_replace('vpc-xs_','',$req['table']);
            $data = db($req['table'])->getTableFields();
        } catch (\Exception $e){
            print_r($e->getMessage());exit();
        }
        return json([
            'data' => $data
        ]);
    }
    
    public function build(){
        $req = input('');

        //var_dump($req);exit();
        $result = action('GiisNew/build', ['req' => $req], 'controller');
        return json([
            'status' => 1,
            'data' => $result
            
        ]);
    }
    
    public function save(){
        $req = input('');
        action('GiisNew/save', ['req' => $req], 'controller');
        return json([
            'status' => 1
        ]);
    }
    
}