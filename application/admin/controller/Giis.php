<?php
namespace app\admin\controller;

use Gii;
use think\Db;
class Giis extends Base
{
    public $table = '';//public $table = 'notice';subject_type
    public $key;
    public $model;
    public $fields;
    public $showlist;
    public $editlist;
    
    public $edit_content;
    public $view_content;
    
    public $left = [
        //'SubjectTypeID' => 'subject_type|SubjectTypeName'
    ];
    
    public $html = [
        'thead_content' => "\r\n",
        'tbody_content' => "\r\n",
        'edit_content' => "\r\n"
    ];
    
    public $js = [
        'data' => '',
        'query' => '',
        'more' => '',
        'ue_editor' => '',
        'get_left' => '',
        'do_create' => '',
        'do_update' => '',
        'show_create' => '',
        'show_update' => ''
    ];
    
    public function build($req){
        $this->table = $req['table'];
        $this->showlist = $req['showlist'];
        $this->editlist = $req['editlist'];
        $this->main();
        return [
            'controller_content' => $this->controller_content,
            'view_content' => $this->view_content
        ];
    }
    
    public function save($req){
        $this->table = $req['params']['table'];
        $this->setModelFieldsKey();
        $controller_content = $req['params']['controller_content'];
        $view_content = $req['params']['view_content'];
        file_put_contents(ROOT_PATH.'application'.DS.'admin'.DS.'controller'.DS.$this->model.'.php',$controller_content);
        file_put_contents(ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.str_replace('_', '', $this->table).DS.str_replace('_', '', $this->table).'.php',$view_content);
        $this->tree();
    }
    
    public function tree(){
        Gii\Help::updateTree($this);
    }
    
    public function main()
    {
        //设置控制器名，获取主键和字段
        $this->setModelFieldsKey();
        //生成控制器
        $this->buildController();
        //生成视图
        $this->buildView();
    }
    
    /**
     * 设置控制器名，获取主键和字段
     */
    public function setModelFieldsKey(){
        //设置控制器名
        $this->model = ucfirst(str_replace('_','',$this->table));
        //查询表字段
        $this->fields = Db::query("show full columns from ".config('database.prefix')."{$this->table}");
        $this->key = $this->fields[0]['Field'];
        $fields = [];
        foreach ($this->fields as $key => $field){
            $fields[$field['Field']] = $field;
        }
        $this->fields = $fields;
    }
    
    /**
     * 生成控制器
     */
    public function buildController(){
        $this->controller_content = Gii\Controller\Build::Replace($this);
    }
    
    /**
     * 生成视图
     */
    public function buildView(){
        $this->view_content = Gii\View\Build::Replace($this);
    }
        
    public function setHtmlJS(){
        //处理列表，编辑视图
        $this->setShowField();
        $this->setEditField();
        //拼接尾部，空处理
        $this->setJSEnd();
    }
    
    public function setShowField(){
        foreach ($this->showlist as $key => $fields){
            $fields_exp = explode('_', $fields);
            $field = count($fields_exp)>0?$fields_exp[0]:$fields;
            $type = count($fields_exp)>0?$fields_exp[1]:'';
            if($this->key == $field) continue;
            if(array_key_exists($field, $this->left)){
                $this->setLeftFieldShow($field);
            }elseif(strstr($field,'Content')){
                $this->setContentFieldShow($field);
            }elseif(strstr($field,'File')||strstr($field,'Cover')||strstr($field,'Thumb')){
                if($type == 'text'){
                    $this->setFieldShow($field);
                }else{
                    $this->setPicFieldShow($field);
                }
            }else{
                if($type == 'pic'){
                    $this->setPicFieldShow($field);
                }else{
                    $this->setFieldShow($field);
                }
            }
        }
    }
    
    public function setEditField(){
        foreach ($this->editlist as $key => $fields){
            $fields_exp = explode('_', $fields);
            $field = count($fields_exp)>0?$fields_exp[0]:$fields;
            $type = count($fields_exp)>0?$fields_exp[1]:'';
            if($this->key == $field) continue;
            if(array_key_exists($field, $this->left)){
                $this->setLeftFieldEdit($field);
            }elseif(strstr($field,'Content')){
                $this->setContentFieldEdit($field);
            }elseif(strstr($field,'File')||strstr($field,'Cover')||strstr($field,'Thumb')){
                if($type == 'option'){
                    $this->setLeftOptionFieldEdit($field);
                }else{
                    if($type == 'text'){
                        $this->setFieldEdit($field);
                    }else{
                        $this->setPicFieldEdit($field);
                    }
                }
            }else{
                if($type == 'option'){
                    $this->setLeftOptionFieldEdit($field);
                }else{
                    if($type == 'pic'){
                        $this->setPicFieldEdit($field);
                    }else{
                        $this->setFieldEdit($field);
                    }
                }
            }
        }
    }
    
    public function setLeftOptionFieldEdit($field){
        $field_exp = explode('|', $this->fields[$field]['Comment']);
        if(count($field_exp)>0){
            if(count($field_exp)==3){
                $this->setLeftFieldEdit($field,[0=>$field_exp[1],1=>$field_exp[2]]);
            }elseif(count($field_exp)==2){
                $option = [];
                $option_exps = explode(',',$field_exp[1]);
                foreach ($option_exps as $option_exp){
                    $option_exp2 = explode(':',$option_exp);
                    $option[$option_exp2[0]] = $option_exp2[1];
                }
                $this->setOptionFieldEdit($field,$option);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function setLeftFieldEdit($field,$left){
        //$left = explode('|', $this->left[$field]);
        $left[2] = str_replace(' ','',ucwords(str_replace('_',' ',$left[0])));
        $this->html['edit_content'] = '                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">'.$field.'分类:<span class="require">*</span></label>
                                                <select name="NoteTypeID" class="form-control"  v-model="item.'.$field.'">
                                                    <option value="0">请选择</option>
                                                    <template v-for="entry in '.$left[2].'">
                                                        <option :value="entry.'.$field.'" v-if="entry.'.$field.' == item.'.$field.'" selected>
                                                            {{ entry.'.$left[1].' }}
                                                        </option>
                                                        <option :value="entry.'.$field.'" v-else>
                                                            {{ entry.'.$left[1].' }}
                                                        </option>
                                                    </template>
                                                </select>
                                            </div>
                                        </div>
                                    </div>';
        $this->js['get_left'] .= "this.getSelect('".$left[2]."')";
        $this->js['more'] = $this->js['more']=='' ? $left[2].':[]' : ','.$left[2].':[],';
    }
   
    public function setOptionFieldEdit($field,$options){
        $this->html['edit_content'] .= '                                   <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">特殊:<span class="require">*</span></label>
                                                        <select name="'.$field.'" v-model="item.'.$field.'"  class="form-control">';
        
        foreach ($options as $key => $option){
            $this->html['edit_content'] .= '<option value="'.$key.'">'.$option.'</option>';
        }
        
       $this->html['edit_content'] .=   '</select>
                                                    </div>
                                                </div>
                                            </div>'."\r\n";
    }
    
    public function setFieldShow($field){
        $this->html['thead_content'] .= '                           <th class="text-center">'.$field.'</th>'."\r\n";
        $this->html['tbody_content'] .= '                           <td class="text-center">{{ item.'.$field.' }}</td>'."\r\n";
    }
    
    public function setFieldEdit($field){
        $this->html['edit_content']  .= '                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">'.$field.':<span class="require">*</span></label>
                                                <input type="text" name="Name" v-model="item.'.$field.'" maxlength="50" class="form-control" />
                                                <em class="invalid">必填字段!</em>
                                            </div>
                                        </div>
                                    </div>'."\r\n";
    }
    
    public function setContentFieldShow($field){
        
    }
    
    public function setContentFieldEdit($field){
        $this->html['edit_content']  .= '                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">'.$field.'描述:<span class="require">*</span></label>
                                                <script id="'.$field.'id" type="text/plain"></script>
                                            </div>
                                        </div>
                                    </div>'."\r\n";
        if($this->js['ue_editor'] == ''){
            $this->js['ue_editor'] .= 'UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;'."\r\n";
            $this->js['ue_editor'] .= 'UE.Editor.prototype.getActionUrl = function(action) {   return this._bkGetActionUrl.call(this, action);}'."\r\n";
        }
        $this->js['ue_editor'] .= 'var ue'.$field.' = UE.getEditor(\''.$field.'id\',{initialFrameHeight : 500})'."\r\n";
        
        if($this->js['show_update'] == ''){
            $this->js['show_update'] .= 'var Req = {process: function(vm){'."\r\n";
        }
        $this->js['show_update'] .= 'if(vm.item.'.$field.'){ue'.$field.'.setContent(vm.item.'.$field.');}'."\r\n";
        
        if($this->js['do_update'] == ''){
            $this->js['do_update'] .= 'var vm = this;'."\r\n";
        }
        $this->js['do_update'] .= 'vm.item.'.$field.' = ue'.$field.'.getContent();'."\r\n";
        
        if($this->js['do_create'] == ''){
            $this->js['do_create'] .= 'var vm = this;'."\r\n";
        }
        $this->js['do_create'] .= 'vm.item.'.$field.' = ue'.$field.'.getContent();'."\r\n";
    }
    
    public function setPicFieldShow($field){
        $this->html['thead_content'] .= '                           <th class="text-center">'.$field.'</th>'."\r\n";
        $this->html['tbody_content'] .= '                           <td><a :href="item.'.$field.'" data-lightbox="image-item-list"><img :src="item.'.$field.'" style="width:100px;"/></a></td>'."\r\n";
        
    }
    
    public function setPicFieldEdit($field){
        $this->html['edit_content']  .= '                                   <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">'.$field.'预览:</label>
                                            <div class="img thumbnail" style="width: 200px; height: 200px; overflow:hidden">
                                                <a id="aPreview" href="" data-lightbox="image-item-newitem">
                                                    <img id="imgPreview" class="img-responsive" v-bind:src="item.'.$field.'"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label class="control-label">'.$field.':<span class="require">*</span></label>
                                            <input type="text" class="form-control"  name="'.$field.'" v-model="item.'.$field.'"/>
                                            <em class="invalid">必填字段!</em>
                                            <div style="padding-top:15px;">
                                                <span class="btn btn-success fileinput-button" v-on:click="upload(\''.$field.'\')">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>上传图片</span>
                                                    <input class="fileupload" type="file" name="files[]" multiple="true" accept=".jpge,.jpg,.png,.gif,.bmp">
                                                </span>
                                                <span class="btn btn-warning" v-on:click="resetUpload(\''.$field.'\')">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>重置图片</span>
                                                </span>
                                            </div>
                                        </div>
                                     </div>
                                 </div>'."\r\n";
        
        if($this->js['show_create'] == ''){
            $this->js['show_create'] .= 'var Req = {process: function(vm){'."\r\n";
            $this->js['show_create'] .= 'vm.$set(\'item\', {';
        }
        $this->js['show_create'] .= $field.':\'\',';
    }
    
    public function setJSEnd(){
        if($this->js['show_update'] == ''){
            $this->js['show_update'] .= 'xsShow.edit(this,ID)';
        }else{
            $this->js['show_update'] .= '}};
                xsShow.edit(this,ID,Req)'."\r\n";
        }
        
        if($this->js['do_update'] == ''){
            $this->js['do_update'] .= 'xsHttp.edit(this)';
        }else{
            $this->js['do_update'] .= 'xsHttp.edit(vm)'."\r\n";
        }
        
        if($this->js['do_create'] == ''){
            $this->js['do_create'] .= 'xsShow.add(this)';
        }else{
            $this->js['do_create'] .= 'xsShow.add(vm)'."\r\n";
        }
        
        if($this->js['show_create'] == ''){
            $this->js['show_create'] .= 'xsHttp.add(this)';
        }else{
            $this->js['show_create'] .= '});'."\r\n".'}}'."\r\n".'xsShow.add(this,Req)'."\r\n";
        }
    }
    
}