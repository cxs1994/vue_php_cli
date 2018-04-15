<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller{
    protected $admin;//admin的信息
    
    public function _initialize(){
        if(session('admin') == null){
            $this->redirect('admin/login/index');
        }else{
            $this->setAdmin();
            
        }
    }
    
    public function setAdmin(){
        $admin_info = session('admin');
        $temp = explode("|",$admin_info);
        if(intval($temp[0]) > 0) {
            $this->admin = db('admin')->where('AdminID',$temp[0])->find();
        }
    }
    
    public function getAdmin($key = null){
        if(is_null($key))
            return $this->admin;
        else
            return isset($this->admin[$key]) ? $this->admin[$key]: '';
    }
    
}
