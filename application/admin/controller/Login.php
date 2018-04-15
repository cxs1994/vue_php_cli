<?php
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        if(session('admin') != null) return redirect('/admin/home/index',302);
        return view('index',[]);
    }
    
    public function handle(){
        $data = input('');
        $validate = $this->validate($data,[
            'UserName|用户名'=>'require',
            'Phone|手机号'=>'require|number|regex:(1[3-8])[0-9]{9}|length:11',
            'PassWord|密码'=>'require',
            //'captcha|验证码'=>'require|captcha'
        ]);
        if($validate != 'true') return json(['msg'=>$validate,'status'=>false]);
        //$admin = db('admin')->where('Phone',$data['Phone'])->where('UserName',$data['UserName'])->where('PassWord',md5($data['PassWord']))->find();
        $admin = db('admin')->where('AdminID', 1)->find();
        if(!$admin) return json(['msg'=>'手机号码或密码错误!','status'=>false]);
        session('admin', $admin['AdminID'] . '|' . md5(APP_KEY . $admin['PassWord']));
        return json(['Success'=>true, 'msg' => '/admin/home/index']);
    }
    
}
