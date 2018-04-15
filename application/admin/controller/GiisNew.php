<?php
namespace app\admin\controller;

use Gii\Controller\Build as CBuild;
use Gii\View\Build as VBuild;
use Gii\Help;

class GiisNew extends Base
{
    public $table = '';//public $table = 'notice';subject_type
    public $key;
    public $model;
    public $fields;
    public $showlist;
    public $editlist;
    public $edit_content;
    public $view_content;
    public $html;
    public $js;
    public $allow;
    public $left = [/*'SubjectTypeID' => 'subject_type|SubjectTypeName'*/];
    
    public function build($req){
        $this->table = $req['table'];
        $this->showlist = $req['showlist'];
        $this->editlist = $req['editlist'];
        $this->allowlist = isset($req['allowlist'])?$req['allowlist']:'';
        $this->searchlist = isset($req['searchlist'])?$req['searchlist']:'';
        try{
            Help::setModelFieldsKey($this);
            $controllerBuild = new CBuild($this);
            $viewBuild = new VBuild($this);
            return [
                'controller_content' => $controllerBuild->Result(),
                'view_content' => $viewBuild->Result()
            ];
        } catch (\Exception $e){
            print_r($e->getMessage());
        }

    }
    
    public function save($req){
        $this->table = $req['params']['table'];
        Help::setModelFieldsKey($this);
        $controller_content = $req['params']['controller_content'];
        $view_content = $req['params']['view_content'];
        file_put_contents(ROOT_PATH.'application'.DS.'admin'.DS.'controller'.DS.$this->model.'.php',$controller_content);
        file_put_contents(ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.str_replace('_', '', $this->table).DS.str_replace('_', '', $this->table).'.php',$view_content);
        Help::updateTree($this);
    }
    
}