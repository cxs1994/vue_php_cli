
{include file="../application/admin/view/header.php" /}
<div class="wrapper wrapper-content animated fadeInUp">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-search"></i>&nbsp;&nbsp;搜索栏</h5>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content">
                    <form role="form" id="searchform">
                        <div class="row">
                            
                            <!--{{search_content}}-->
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-sm" v-on:click="getData('search')">提交查询</button>&nbsp;
                                        <button type="reset" class="btn btn-default btn-sm" v-on:click="reSearch()">重置查询</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5><i class="fa fa-database"></i>&nbsp;&nbsp;{{subject}}管理</h5>
                    <div class="ibox-tools">
                        <!--{{add_allow}}-->
                        <!--{{dels_allow}}-->
                        <div class="btn-group hidden">
                            <button type="button" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">批量操作 &nbsp;<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="" ng-click="doUpdates('IsEnabled',true)">全部启用</a>
                                </li>
                                <li>
                                    <a href="" ng-click="doUpdates('IsEnabled',false)">全部禁用</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover table-striped table-bordered table-advanced tablesorter" id="data_container">
                        <thead>
                        <tr>
                            <th class="text-center" width="30px">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle"><span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a v-on:click='checkedAll(true)'>全选</a>
                                        </li>
                                        <li>
                                            <a v-on:click="checkedAll(false)">全不选</a>
                                        </li>
                                    </ul>
                                </div>
                            </th>
                            
                            <!--{{thead_content}}-->
                            
                            <th class="text-center" width="200px">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items">
                        
                            <td class="text-center"><input type='checkbox'  v-model="checkedNames"  name="checkedNames" value="{{ item[key] }}"/></td>
                            
                            <!--{{tbody_content}}-->
                            
                            <td class="text-center">
                                <!--{{edit_allow}}-->
                                <!--{{del_allow}}-->
                            </td>
                            
                        </tr>
                        </tbody>
                        <tfoot v-show="tModels==0">
                        <tr>
                            <td colspan="5"><p class="text-center">没有找到记录.</p></td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="row" ng-show="tModels>0">
                        <div class="col-sm-6 form-inline">
                            <div class="form-group">
                                <label class="control-label"> 总 <span class="require">{{ tPages }}</span>页  |</label>
                                <label class="control-label"> 共 <span class="require" ng-bind="tmodels"> {{ tModels }} </span>条记录</label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-white"  v-on:click="clickStartPage()" title="首页">
                                    <i class="fa fa-angle-double-left"></i>
                                </button>
                                <button type="button" class="btn btn-white" title="上一页"  v-on:click="clickPrevPage()">
                                    <i class="fa fa-angle-left"></i>
                                </button>
                                <button v-for="index in indexs"  v-bind:class="{ 'active': cur == index}" class="btn btn-white" v-on:click="clickPage(index)">
                                    {{ index }}
                                </button>
                                <button type="button" class="btn btn-white" v-on:click="clickNextPage()" title="下一页">
                                    <i class="fa fa-angle-right"></i>
                                </button>
                                <button type="button" class="btn btn-white" v-on:click="clickEndPage()" title="末页">
                                    <i class="fa fa-angle-double-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--编辑信息-->
    <div  v-bind:class="{ 'show in': show }" id="ej-modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal-stackable-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog" style="width:1000px;">
            <div class="modal-content"  style="max-height: 600px;overflow: auto;z-index:100">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close" @click="close">&times;</button>
                    <h4 id="modal-stackable-label" class="modal-title">{{subject}} - 编辑</h4>
                </div>
                <div class="modal-body">
                
                    <!--{{edit_content}}-->
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" @click="save">保存</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default"  @click="close">关闭</button>
                </div>
            </div>
        </div>
    </div>

</div>

{include file="../application/admin/view/layer.php" /}

<script type="text/javascript">
    $('.datepicker-default').datepicker({format: 'yyyy/mm/dd'});  //初始化日期控件
    Vue.http.options.emulateJSON = true
    
    Vue.filter('time',function(value) {return xsHelp.time(value);});
    
    /*{{ue_editor}}*/
    
    new Vue({
        el : '#App',
        data : xsHelp.data('admin/{{name}}','{{key}}',{/*{{query}}*/},{/*{{more}}*/}),
        //data : xsHelp.data(/*{{data}}*/),
        ready: function() {this.getData();/*{{get_left}}*/},
        methods: {
        	getSelect :function(name){xsHttp.select(this,name)},
        	getData: function(type) {xsHttp.get(this,type)},
        	showCreate:function(){/*{{show_create}}*/},
            showUpdate : function(ID){/*{{show_update}}*/},
            save: function(){this.item[this.key] ? this.doUpdate() : this.doCreate()},
            doUpdate: function() {/*{{do_update}}*/},
            doCreate: function() {/*{{do_create}}*/},
            doDelete: function(o){xsHttp.del(this,o)},
            close: function() {this.show = false},
            clickPage:function(data){xsPage.click(data,this);},
            clickPrevPage : function(data){xsPage.clickPrev(data,this);},
            clickEndPage : function(data){xsPage.clickEnd(data,this);},
            clickStartPage : function(data){xsPage.clickStart(data,this);},
            clickNextPage : function(data){xsPage.clickNext(data,this);},
            checkedAll : function(status){xsHelp:check(status,this)},
            resetUpload : function (col) {this.item[col] = '';},
            upload : function(col){xsHelp.upload(col,this);}
        },
        computed: {indexs: function(){return xsPage.computed(this);}}
    })
</script>
{include file="../application/admin/view/footer.php" /}