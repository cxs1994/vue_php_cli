<!DOCTYPE html>
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/form_advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:16 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gii可视化操作</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/admin/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/plugins/codemirror/ambiance.css" rel="stylesheet">
    <link href="/static/admin/hplus/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    
    <link href="/static/admin/libs/iCheck/custom.css" rel="stylesheet" />
    <link href="/static/admin/libs/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="/static/admin/libs/jquery-toastr/toastr.min.css" rel="stylesheet" />
    <link href="/static/admin/css/ej.css" rel="stylesheet" />
    <link href="/static/admin/libs/lightbox/css/lightbox.css" rel="stylesheet" />
    <link href="/static/admin/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="/static/admin/libs/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
    
    <link href="/static/admin/css/xs/xs.giiview.css" rel="stylesheet" />
    <style>
        .checkbox label::before {opacity: 0;}
        .checkbox {margin-top: 0px; margin-bottom: 0px;}
        .xs_icheckbox_green{    
            display: inline-block;
            vertical-align: middle;
            margin: 0;
            padding: 0;
            width: 22px;
            height: 22px;
            /*background: url(http://www.tp.com/static/admin/libs/iCheck/green.png) no-repeat;*/
            border: none;
            cursor: pointer;
        	
        	background-image: url(http://www.tp.com/static/admin/libs/iCheck/green%402x.png);
        	background-size: 240px 24px;
        	background-position: -96px 0;        	
        }
        .xs_checked{
            background-image: url(http://www.tp.com/static/admin/libs/iCheck/green@2x.png);
            background-size: 240px 24px;
        	background-position: -48px 0;
        }
        .radio-success input[type="radio"]:checked + label::before {
            border-color: #1ab394;
        }
        .radio-success input[type="radio"]:checked + label::after {
            background-color: #1ab394;
        }
        .chosen-drop{
	        height: 200px;
        }
        .chosen-results{
	        height: 160px;
        }
        .checkbox {
            line-height: 30px;
        }
        .agile-list li.success-element {
            margin: 3px 0;
            padding: 3px 3px;
        }
    </style>
</head>

<body class="gray-bg" id="App">

    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>第一步</h5>
                    </div>
                    <div class="ibox-content" style="height: 200px;">
    
                        <div class="row select_table">
                            <div class="col-xs-12 col-sm-11 col-md-10">
                                <div class="form-group">
                                    <div class="col-sm-2 ">
                                        <h3 style="line-height: 26px;">下拉选择表</h3>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="input-group" style="float: left;">
                                            <select id="table" name="table" data-placeholder="选择表..." class="chosen-select" style="width:285px;" tabindex="2">
                                                <option value="">请选择表</option>
                                                <?php foreach ($tables as $key => $table):?>
                                                <option hassubinfo="true"><?php echo $table['Tables_in_vpc-xs'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="input-group">
                                            <button v-on:click="getFields()" class="btn btn-w-m btn-primary">确定</button>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-3">
                                        <button v-on:click="getFields()" class="btn btn-w-m btn-primary">确定</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="row select_allow">
                            <div class="col-sm-12" id="allow_list">
                                <div class="col-sm-3 checkbox i-checks" >
                                    <label class="">
                                        <div id="allow_get" class="xs_icheckbox_green xs_checked"  style="position: relative;">
                                            <input type="checkbox" value="get" checkbox_green checked="" style="position: absolute; opacity: 0;">
                                            <ins v-on:click="doChecked('allow','get')" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div> <i></i> 查看
                                    </label>
                                </div>
                                <div class="col-sm-3 checkbox i-checks" >
                                    <label class="">
                                        <div id="allow_add" class="xs_icheckbox_green xs_checked"  style="position: relative;">
                                            <input type="checkbox" value="add" checkbox_green checked="" style="position: absolute; opacity: 0;">
                                            <ins v-on:click="doChecked('allow','add')" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div> <i></i> 添加
                                    </label>
                                </div>
                                <div class="col-sm-3 checkbox i-checks" >
                                    <label class="">
                                        <div id="allow_edit" class="xs_icheckbox_green xs_checked"  style="position: relative;">
                                            <input type="checkbox" value="edit" checkbox_green checked="" style="position: absolute; opacity: 0;">
                                            <ins v-on:click="doChecked('allow','edit')" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div> <i></i> 编辑
                                    </label>
                                </div>
                                <div class="col-sm-3 checkbox i-checks" >
                                    <label class="">
                                        <div id="allow_del" class="xs_icheckbox_green xs_checked"  style="position: relative;">
                                            <input type="checkbox" value="del" checkbox_green checked="" style="position: absolute; opacity: 0;">
                                            <ins v-on:click="doChecked('allow','del')" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div> <i></i> 删除
                                    </label>
                                </div>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>   
        </div>
        
         <div class="wrapper wrapper-content animated fadeInUp" id="fieldshow">
            <div class="row">
                <div class="col-sm-12">
    
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>第二步</h5>
                        </div>
                        <div class="ibox-content">

         
         
        <div class="row" id="list-edit">
        
            <div class="col-sm-4">
            
                <div class="ibox">
                        <div class="ibox-content">
                            <h3>设置搜索字段</h3>
                            <p class="small"><i class="fa fa-hand-o-up"></i> 可上下拉动改变排序</p>
                            
                            <ul id="searchlist" class="sortable-list connectList agile-list ui-sortable">
                                <li class="success-element" v-for="field in Fields" data-name="{{field}}">
                                    <div class="row" style="margin-right:15px;margin-left:15px">
                                
                                        <div class="col-sm-6 checkbox i-checks" >
                                            <label class="">
                                                <div id="search_{{field}}" class="xs_icheckbox_green"  style="position: relative;">
                                                    <input type="checkbox" value="" checked="" style="position: absolute; opacity: 0;">
                                                    <ins v-on:click="doChecked('search',field)" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div> <i></i> {{field}}
                                            </label>
                                        </div>
                                        
                                        <div id="inlineRadio_search_{{field}}" data-type="default" class="col-sm-6 radio i-checks inlineRadio_search" style="margin-top: 0px;margin-bottom: 0px;">
                                            
                                            <select name="edit_radio_{{field}}" class="form-control xs-select">
                                                <option value="default">自动</option>
                                                <option value="input">文本框</option>
                                                <option value="option">选项</option>
                                                <option value="left">外键</option>
                                                <option value="time">时间</option>
                                            </select>
                                            
                                        </div>
                                        
                                    </div>
                                </li>
                            </ul>
                        </div>
                 </div>
                
            </div>
        
            <div class="col-sm-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>设置列表字段</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> 可上下拉动改变排序</p>
                        <ul id="showlist" class="sortable-list connectList agile-list ui-sortable">
                            <li class="success-element" v-for="field in Fields" data-name="{{field}}">
                                <div class="row" style="margin-right:15px;margin-left:15px">
                                
                                    <div class="col-sm-6 checkbox i-checks" >
                                        <label class="">
                                            <div id="list_{{field}}" class="xs_icheckbox_green xs_checked"  style="position: relative;">
                                                <input type="checkbox" value="" checked="" style="position: absolute; opacity: 0;">
                                                <ins v-on:click="doChecked('list',field)" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                            </div> <i></i> {{field}}
                                        </label>
                                    </div>
                                    
                                    <div id="inlineRadio_list_{{field}}" class="col-sm-6 radio i-checks inlineRadio_list" style="margin-top: 0px;margin-bottom: 0px;" data-type="default">
                                        
                                        <select name="edit_radio_{{field}}"  class="form-control xs-select">
                                            <option value="default">自动</option>
                                            <option value="text">文本</option>
                                            <option value="option">选项</option>
                                            <option value="left">外键</option>
                                            <option value="pic">图片</option>
                                            <option value="time">时间</option>
                                        </select>
                                        
                                    </div>
                                    
                                </div>
                             </li>   
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>设置编辑字段</h3>
                        <p class="small"><i class="fa fa-hand-o-up"></i> 可上下拉动改变排序</p>
                        <ul id="editlist" class="sortable-list connectList agile-list ui-sortable">
                            <li class="success-element" v-for="field in Fields" data-name="{{field}}">
                                <div class="row" style="margin-right:15px;margin-left:15px">
                            
                                    <div class="col-sm-6 checkbox i-checks" >
                                        <div class="checkbox i-checks" >
                                            <label class="">
                                                <div id="edit_{{field}}" class="xs_icheckbox_green xs_checked"  style="position: relative;">
                                                    <input type="checkbox" value="" checked="" style="position: absolute; opacity: 0;">
                                                    <ins v-on:click="doChecked('edit',field)" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div> <i></i>{{field}}
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div id="inlineRadio_edit_{{field}}" class="col-sm-6 radio i-checks inlineRadio_edit" style="margin-top: 0px;margin-bottom: 0px;" data-type="default">
                                        
                                        <select name="edit_radio_{{field}}"  class="form-control xs-select">
                                            <option value="default">自动</option>
                                            <option value="input">文本编辑</option>
                                            <option value="text">文本显示</option>
                                            <option value="option">选项</option>
                                            <option value="left">外键</option>
                                            <option value="pic">图片</option>
                                            <option value="content">编辑器</option>
                                        </select>
                                        
                                    </div>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            <div class="col-sm-12" style="text-align: center;">
                <button v-on:click="doBuild()" class="btn btn-w-m btn-primary">生成模块</button>
            </div>
            
            
        </div>
        
        
        
            
            </div>
                </div>
            </div>
           </div> 
        </div>
        
        
        <div class="wrapper wrapper-content animated fadeInUp" id="buildshow">
            <div class="row">
                <div class="col-sm-12">
    
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>第三步</h5>
                        </div>
                        <div class="ibox-content">
        
        <div class="wrapper wrapper-content  animated fadeInRight">
        
            <div class="row build" style="width: 20%;float: right;margin: 0px -15px 15px;">
                <button v-on:click="doSaveFile()" class="btn btn-w-m btn-primary">保存模块</button>
            </div>
            
            <div class="row build" style="width: 20%;float: right;margin: 0px -15px 15px;display: none">
                <button id="updateview" v-on:click="doBuildView()" class="btn btn-w-m btn-primary">刷新代码</button>
            </div>
        
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>控制器</h5>
                        </div>
                        <div class="ibox-content">
    
                            <p class="m-b-lg">
                                <strong>Controller</strong> <font></font>
                            </p>
    
                            <textarea id="code1">
                            {{controller_content}}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>视图</h5>
                        </div>
                        <div class="ibox-content">
    
                            <p class="m-b-lg">
                                <strong>View</strong> <font><font>
                            </p>
                            <textarea id="code2">
                            {{view_content}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
    
    </div>
                    </div>
                </div>
            </div>
        
    </div>
    
    </div>
</body>  
                

<script src="/static/admin/hplus/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/hplus/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/hplus/js/jquery-ui-1.10.4.min.js"></script>
<script src="/static/admin/hplus/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/static/admin/hplus/js/plugins/codemirror/codemirror.js"></script>
<script src="/static/admin/hplus/js/plugins/codemirror/mode/javascript/javascript.js"></script>
<script src="/static/admin/hplus/js/content.min.js?v=1.0.0"></script>
<script>
    $(document).ready(function(){
        //var editor_one=CodeMirror.fromTextArea(document.getElementById("code1"),{lineNumbers:true,matchBrackets:true,styleActiveLine:true,theme:"ambiance"});
        //var editor_two=CodeMirror.fromTextArea(document.getElementById("code2"),{lineNumbers:true,matchBrackets:true,styleActiveLine:true,theme:"ambiance"})
    });
</script>
<script>
    $(document).ready(function(){$(".sortable-list").sortable({connectWith:".connectList"}).disableSelection()});
</script>
<script src="/static/admin/hplus/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/static/admin/hplus/js/plugins/jsKnob/jquery.knob.js"></script>
<script src="/static/admin/hplus/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="/static/admin/hplus/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/static/admin/hplus/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
<!-- <script src="/static/admin/hplus/js/plugins/nouslider/jquery.nouislider.min.js"></script> -->
<script src="/static/admin/hplus/js/plugins/switchery/switchery.js"></script>
<script src="/static/admin/hplus/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>
<script src="/static/admin/hplus/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/admin/hplus/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/admin/hplus/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/static/admin/hplus/js/plugins/clockpicker/clockpicker.js"></script>
<script src="/static/admin/hplus/js/plugins/cropper/cropper.min.js"></script>
<script src="/static/admin/hplus/js/demo/form-advanced-demo.min.js"></script>
<script>
    /* $(".success-element").click(function(){
        alert(1);
        $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})
    }); */
</script>
<!-- <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script> -->

<script src="/static/admin/libs/sweetalert/sweetalert.min.js"></script>
<script src="/static/admin/libs/jquery-toastr/toastr.min.js"></script>
<script src="/static/admin/js/ej.js"></script>
<script src="/static/admin/js/ejUtils.js"></script>
<script src="/static/admin/js/vue.js"></script>

<script src="/static/admin/libs/ueditor/ueditor.config.js" type="text/javascript"></script>
<script src="/static/admin/libs/ueditor/ueditor.all.js" type="text/javascript"></script>
<script src="/static/admin/libs/lightbox/js/lightbox.min.js"></script>
<script src="/static/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/static/admin/libs/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="/static/admin/libs/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="/static/admin/libs/jquery-file-upload/js/jquery.fileupload.js"></script>

<script src="/static/admin/js/vue-resource.min.js"></script>
<script src="/static/admin/js/xs/xsHttp.js"></script>
<script src="/static/admin/js/xs/xsShow.js"></script>
<script src="/static/admin/js/xs/xsHelp.js"></script>
<script src="/static/admin/js/xs/xsPage.js"></script>
<script type="text/javascript">
    new Vue({
        el : '#App',
        data : {
        	table_name : '',
        	Table : [],
        	Fields : [],
        	controller_content : '',
        	view_content : ''
        },
        ready: function() {
        	this.getTable();
        	//this.getFields();
        },
        methods: {
        	doRadio: function(name,type,index){
        		$('#inlineRadio_'+name+'_'+index).attr("data-type",type);
            },
            doChecked: function(name,index){
            	$('#'+name+'_'+index).toggleClass("xs_checked");
            },
        	getTable: function(){
        		$('#fieldshow').hide();
        		$('#buildshow').hide();
        		
        		
            	var vm = this;
        		this.$http.get('/admin/giiapi/table').then((response) => {
                    var contents = response.json();
                    vm.Table = contents.data;
                }, (response) => { });
            },
            getFields: function(){
            	var vm = this;
            	vm.table_name = $('#table').val();
            	var params = {
                    table : vm.table_name,
                };
        		this.$http.get('/admin/giiapi/fields',{params:params}).then((response) => {
                    var contents = response.json();
                    vm.Fields = contents.data;
                    $('#fieldshow').show();
                }, (response) => { });
            },
            doBuild: function(){
            	var vm = this;

            	var searchlist = $('#searchlist li');
            	var searchlist_length = searchlist.length;
            	var searchlist_params = new Array();
            	for(var i=0,j=0; i < searchlist_length; i++) {
            		if(searchlist.eq(i).find('.xs_icheckbox_green').hasClass("xs_checked")){
            			//searchlist_params[j] = searchlist.eq(i).attr('data-name')+'_'+searchlist.eq(i).find('.inlineRadio_search').attr('data-type');
         			    //j++;
            			searchlist_params[j] = searchlist.eq(i).attr('data-name')+'_'+searchlist.eq(i).find(".xs-select").children("option:selected").val();
                		j++;
            		}
                }
                
            	var showlist = $('#showlist li');
            	var showlist_length = showlist.length;
            	var showlist_params = new Array();
            	for(var i=0,j=0; i < showlist_length; i++) {
            		if(showlist.eq(i).find('.xs_icheckbox_green').hasClass("xs_checked")){
         			   //showlist_params[j] = showlist.eq(i).attr('data-name')+'_'+showlist.eq(i).find('.inlineRadio_list').attr('data-type');
         			   //j++;
            			showlist_params[j] = showlist.eq(i).attr('data-name')+'_'+showlist.eq(i).find(".xs-select").children("option:selected").val();
                		j++;
            		}
                }
                
            	var editlist = $('#editlist li');
            	var editlist_length = editlist.length;
            	var editlist_params = new Array();
            	for(var i=0,j=0; i < editlist_length; i++) {
            		if(editlist.eq(i).find('.xs_icheckbox_green').hasClass("xs_checked")){
         			   //editlist_params[j] = editlist.eq(i).attr('data-name')+'_'+editlist.eq(i).find('.inlineRadio_edit').attr('data-type');
         			   //j++;
            			editlist_params[j] = editlist.eq(i).attr('data-name')+'_'+editlist.eq(i).find(".xs-select").children("option:selected").val();
                		j++;
            		}
                }

            	var allowlist = $('#allow_list div');
            	var allowlist_length = allowlist.length;
            	var allowlist_params = new Array();
            	for(var i=0,j=0; i < allowlist_length; i++) {
            		if(allowlist.eq(i).find('.xs_icheckbox_green').hasClass("xs_checked")){
            			allowlist_params[j] = allowlist.eq(i).find('input').val();
         			    j++;
            		}
                }
                
            	var params = {
                    table : vm.table_name,
                    showlist : showlist_params,
                    editlist : editlist_params,
                    allowlist : allowlist_params,
                    searchlist : searchlist_params
                };
            	//console.log(params);return;
            	this.$http.get('/admin/giiapi/build',{params:params}).then((response) => {
                    var contents = response.json();
                    if(contents.status){
                    	//EJ.showSuccess("创建成功");
                    	vm.controller_content = contents.data.controller_content;
                    	vm.view_content = contents.data.view_content;
                    	setTimeout("document.getElementById('updateview').click()",100);
                    	
                    }
                }, (response) => {});
            },
            doBuildView: function(){
                var vm = this;
                if($('.CodeMirror-code').html() == undefined || $('.CodeMirror-code').html() == ''){
                    var editor_one=CodeMirror.fromTextArea(document.getElementById("code1"),{lineNumbers:true,matchBrackets:true,styleActiveLine:true,theme:"ambiance"});
                    var editor_two=CodeMirror.fromTextArea(document.getElementById("code2"),{lineNumbers:true,matchBrackets:true,styleActiveLine:true,theme:"ambiance"})
                    setTimeout("document.getElementById('updateview').click()",100);
                }
                $('#buildshow').show();
            },
            doSaveFile: function(){
                var vm = this;
            	var params = {
                    table : vm.table_name,
                    controller_content : vm.controller_content,
                    view_content : vm.view_content,
                };
            	this.$http.post('/admin/giiapi/save',{params:params}).then((response) => {
                    var contents = response.json();
                    if(contents.status){
                    	EJ.showSuccess("保存成功");
                    }
                }, (response) => {});
            }
        }
    })
</script>
<!-- Mirrored from www.zi-han.net/theme/hplus/form_advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:28 GMT -->
</html>