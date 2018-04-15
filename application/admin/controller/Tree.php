<?php
namespace app\admin\controller;

class Tree extends Base
{
    
    public function all()
    {
        //include __DIR__.'/Site/admin_manage_tree.php';
        //$Tree = $admin_manage_tree;
        include ROOT_PATH.'extend'.DS.'Middleware'.DS.'/Site/admin_manage_tree.php';
        $Tree = $admin_manage_tree;
        return json(['data' => $Tree]);
    }
    
}
