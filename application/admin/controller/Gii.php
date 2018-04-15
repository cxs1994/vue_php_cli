<?php
namespace app\admin\controller;

class Gii extends Base
{
    public $table = 'subject_type';//public $table = 'notice';
    public $key;
    public $model;
    public $fields;
    
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
    
    public function index()
    {
        
        /**
         * 设置控制器名，获取主键和字段
         */
        $this->setModelFieldsKey();
        
        /**
         * 生成控制器
         */
        $this->buildController();
        
        /**
         * 生成视图
         */
        $this->buildView();
    }
    
    /**
     * 设置控制器名，获取主键和字段
     */
    public function setModelFieldsKey(){
        //设置控制器名
        $this->model = ucfirst(str_replace('_','',$this->table));
        //查询表字段
        $this->fields = db($this->table)->getTableFields();
        //主键赋值
        $this->key = $this->fields[0];
    }
    
    /**
     * 生成控制器
     */
    public function buildController(){
        //复制粘贴模板控制器
        copy(ROOT_PATH.'application'.DS.'admin'.DS.'controller'.DS.'Controller.php',ROOT_PATH.'application'.DS.'admin'.DS.'controller'.DS.$this->model.'.php');
        //修改控制器
        $controller_content = file_get_contents(ROOT_PATH.'application'.DS.'admin'.DS.'controller'.DS.$this->model.'.php');
        //参数替换
        $controller_content = str_replace('ControllerName',$this->model,$controller_content);
        $controller_content = str_replace('{{table_name}}',$this->table,$controller_content);
        $controller_content = str_replace('{{table_key}}',$this->key,$controller_content);
        //更新控制器
        file_put_contents(ROOT_PATH.'application'.DS.'admin'.DS.'controller'.DS.$this->model.'.php',$controller_content);
    }
    
    /**
     * 生成视图
     */
    public function buildView(){
        //生成对应文件夹，复制粘贴模板视图
        if (!file_exists(ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.str_replace('_', '', $this->table))){ mkdir (ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.str_replace('_', '', $this->table));}
        copy(ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.'view.php',ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.str_replace('_', '', $this->table).DS.str_replace('_', '', $this->table).'.php');
        //修改视图
        $view_content = file_get_contents(ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.str_replace('_', '', $this->table).DS.str_replace('_', '', $this->table).'.php');
        //为$html,$js赋值
        $this->setHtmlJS();
        //渲染视图
        $view_content = str_replace('{{name}}',$this->table,$view_content);
        $view_content = str_replace('{{key}}',$this->key,$view_content);
        $view_content = str_replace('<!--{{thead_content}}-->',$this->html['thead_content'],$view_content);
        $view_content = str_replace('<!--{{tbody_content}}-->',$this->html['tbody_content'],$view_content);
        $view_content = str_replace('<!--{{edit_content}}-->',$this->html['edit_content'],$view_content);
        //$view_content = str_replace('/*{{data}}*/',$this->js['data'],$view_content);
        $view_content = str_replace('/*{{query}}*/',$this->js['query'],$view_content);
        $view_content = str_replace('/*{{more}}*/',$this->js['more'],$view_content);
        $view_content = str_replace('/*{{ue_editor}}*/',$this->js['ue_editor'],$view_content);
        $view_content = str_replace('/*{{get_left}}*/',$this->js['get_left'],$view_content);
        $view_content = str_replace('/*{{do_create}}*/',$this->js['do_create'],$view_content);
        $view_content = str_replace('/*{{do_update}}*/',$this->js['do_update'],$view_content);
        $view_content = str_replace('/*{{show_create}}*/',$this->js['show_create'],$view_content);
        $view_content = str_replace('/*{{show_update}}*/',$this->js['show_update'],$view_content);
        //更新视图
        file_put_contents(ROOT_PATH.'application'.DS.'admin'.DS.'view'.DS.str_replace('_', '', $this->table).DS.str_replace('_', '', $this->table).'.php',$view_content);
    }
        
    public function setHtmlJS(){
        
        $this->setJSStart();
        
        foreach ($this->fields as $key => $field){
            if($this->key == $field) continue;
            if(array_key_exists($field, $this->left)){
                $this->setLeftField($field);
            }elseif(strstr($field,'Content')){
                $this->setContentField($field);
            }elseif(strstr($field,'File')||strstr($field,'Cover')||strstr($field,'Thumb')){
                $this->setPicField($field);
            }else{
                $this->setField($field);
            }
        }
        //拼接尾部，空处理
        $this->setJSEnd();
    }
    
    public function setJSStart(){
        //$this->js['data'] = "'admin/".$this->table."','".$this->key."'";
    }
    
    public function setField($field){
        $this->html['thead_content'] .= '<th class="text-center">'.$field.'</th>'."\r\n";
        $this->html['tbody_content'] .= '<td class="text-center">{{ item.'.$field.' }}</td>'."\r\n";
        $this->html['edit_content']  .= '<div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">'.$field.':<span class="require">*</span></label>
                                                <input type="text" name="Name" v-model="item.'.$field.'" maxlength="50" class="form-control" />
                                                <em class="invalid">必填字段!</em>
                                            </div>
                                        </div>
                                    </div>'."\r\n";
    }
    
    public function setLeftField($field){
        $left = explode('|', $this->left[$field]);
        $left[2] = str_replace(' ','',ucwords(str_replace('_',' ',$left[0])));
        $this->html['edit_content'] = '<div class="row">
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
    
    public function setContentField($field){
        $this->html['edit_content']  .= '<div class="row">
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
    
    public function setPicField($field){
        $this->html['thead_content'] .= '<th class="text-center">'.$field.'</th>'."\r\n";
        $this->html['tbody_content'] .= '<td><a :href="item.'.$field.'" data-lightbox="image-item-list"><img :src="item.'.$field.'" style="width:100px;"/></a></td>'."\r\n";
        $this->html['edit_content']  .= '<div class="row">
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
        }
        $this->js['show_create'] .= 'vm.$set(\'item\', {'.$field.':\'\'});'."\r\n";
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
            $this->js['show_create'] .= '}}
                xsShow.add(this,Req)'."\r\n";
        }
    }
    
}
/*  外键分类功能
 *  $this->html['edit_content']  .= '<div class="row">
 <div class="col-sm-12">
 <div class="form-group">
 <label class="control-label">'.$field.':<span class="require">*</span></label>
 <select name="AdsPlaceID" class="form-control"  v-model="item.AdsPlaceID">
 <option value="0">请选择'.$field.'</option>
 <template v-for="entry in AdsPlace">
 <option :value="entry.AdsPlaceID" v-if="entry.'.$field.' == item.'.$field.'" selected>
 {{ entry.'.$field.' }}
 </option>
 <option :value="entry.AdsPlaceID" v-else>
 {{ entry.'.$field.' }}
 </option>
 </template>
 </select>
 </div>
 </div>
 </div>'."\r\n"; */