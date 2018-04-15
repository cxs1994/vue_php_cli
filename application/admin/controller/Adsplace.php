<?php
namespace app\admin\controller;

class ControllerName extends Base
{
    public $model = '{{table_name}}';
    public $key = '{{table_key}}';
    
    public function index()
    {
        return view(str_replace('_','',$this->model));
    }
    
    public function get(){
        $req = input();
        $map = [];
        $model = db($this->model);
        $count_model = db($this->model);
        foreach ($req as $key => $val){
            if($key == 'page'){ 
                $page = $val;
            }else{
                $exp = explode('_', $val);
                
                if(isset($exp[0]) && isset($exp[1]) && $exp[1] != ''){
                    switch ($exp[0]){
                        case 'input': $count_model->where($key,'like',"%{$exp[1]}%");$model->where($key,'like',"%{$exp[1]}%");break;
                        case 'left': $count_model->where($key,$exp[1]);$model->where($key,$exp[1]);break;
                        case 'option': $count_model->where($key,$exp[1]);$model->where($key,$exp[1]);break;
                        case 'starttime': $exp[1] = strtotime($exp[1]);$count_model->where(str_replace('StartTime','',$key),'>',$exp[1]);$model->where(str_replace('StartTime','',$key),'>',$exp[1]);break;
                        case 'endtime': $exp[1] = strtotime($exp[1]);$count_model->where(str_replace('EndTime','',$key),'<',$exp[1]);$model->where(str_replace('EndTime','',$key),'<',$exp[1]);break;
                        default:break;
                    }
                }
            }
        }
        $limit = 10;
        $count = $count_model->count();
        $Models = $model->page($page,$limit)->select();
        return json(['Success'=> true,
            'Models' => $Models,
            'TotalPage' => ceil($count/$limit),
            'Totalmodels' => $count
        ]);
    }
    
    public function add(){
        $data = input('');
        db($this->model)->insert($data);
        return json(['Success'=>true,'msg'=>'添加成功']);
    }
    
    public function edit(){
        $data = input('');
        $model = db($this->model)->where($this->key,$data[$this->key])->find();
        if(!$model) die(json_encode(['msg'=>'网络繁忙']));
        db($this->model)->where($this->key,$data[$this->key])->update($data);
        return json(['Success'=>true,'msg'=>'修改成功']);
    }
    
    public function del(){
        $data = $this->request->instance()->except('id/a');
        db($this->model)->delete($data['id']);
        return json(['Success'=>true,'msg'=>'删除成功']);
    }
    
    public function all(){
        $data = db($this->model)->select();
        die(json_encode([
            'data' => $data,
        ]));
    }
	
}
