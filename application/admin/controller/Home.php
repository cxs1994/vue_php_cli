<?php
namespace app\admin\controller;

class Home extends Base
{
    public function index()
    {
        $Auth = new \Middleware\Auth();
        $Auth->init();
        //var_dump(\Lib\Middleware\Auth::$channel);exit();
        return view('index');
    }
}
