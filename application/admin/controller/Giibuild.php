<?php
namespace app\admin\controller;

use think\Db;
use Gii;

class Giibuild extends Base
{
    public function index(){
        
        $ignore_build_model = ['admin'];
        $need_build_model = ['activity','ads','note'];
        
        //$tables = $QB->query("show tables")->toArray();
        $tables = Db::query("show table status");
        //var_dump($tables);exit();

        $admin_manage_tree = [];
        
        foreach ($tables as $key => $table){
            $table['Name'] = str_replace(config('database.prefix'), '', $table['Name']);
            $admin_manage_array[$table['Name']] = $table['Comment']?$table['Comment']:$table['Name'];
            
            $table_exp = explode('_', $table['Name']);
            if(count($table_exp)){
                if(in_array($table_exp[0],$need_build_model)){
                //if(!in_array($table_exp[0],$ignore_build_model)){
                    $table['minName'] = str_replace('_', '', $table['Name']);
                    if(!isset($admin_manage_tree[$table_exp[0]]['Name'])){
                        $admin_manage_tree[$table_exp[0]]['Name'] = $admin_manage_array[$table['Name']];
                    }
                    
                    //$admin_manage_tree[$table_exp[0]][$table['Name']] = $admin_manage_array[$table['Name']];
                    $admin_manage_tree[$table_exp[0]]['Son'][$table['minName']]['Name'] = $admin_manage_array[$table['Name']];
                    $admin_manage_tree[$table_exp[0]]['Son'][$table['minName']]['Allow'] = [
                        "get" => "查看",
                        "add" => "添加",
                        "edit" => "编辑",
                        "del" => "删除",
                    ];
                }
            }else{
                if(in_array($table['Name'],$need_build_model)){
                //if(!in_array($table['Name'],$ignore_build_model)){
                    
                    $admin_manage_tree[$admin_manage_array]['Name'] = $admin_manage_array[$table['Name']];
                    
                    //$admin_manage_tree[$admin_manage_array][$table['Name']] = $admin_manage_array[$table['Name']];
                    $admin_manage_tree[$admin_manage_array]['Son'][$table['Name']]['Name'] = $admin_manage_array[$table['Name']];
                    $admin_manage_tree[$table_exp[0]]['Son'][$table['Name']]['Allow'] = [
                        "get" => "查看",
                        "add" => "添加",
                        "edit" => "编辑",
                        "del" => "删除",
                    ];
                }
            }
        }
        
        //$admin_manage_tree_clone = $admin_manage_tree;
        
        //include ROOT_PATH.'extend'.DS.'Middleware'.DS.'/Site/admin_manage_tree.php';
        //var_dump($admin_manage_tree);
        
        //var_dump($admin_manage_tree['ads']['Son']);exit();
        $str = Gii\File::createContent($admin_manage_tree, 'admin_manage_tree');
        file_put_contents(ROOT_PATH.'extend'.DS.'Middleware'.DS.'/Site/admin_manage_tree.php',$str);
        include ROOT_PATH.'extend'.DS.'Middleware'.DS.'/Site/admin_manage_tree.php';
        var_dump($admin_manage_tree);
        
        exit();
    }
    
}