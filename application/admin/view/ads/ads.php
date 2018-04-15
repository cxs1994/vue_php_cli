
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
                            
                            
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        <label for="InputText" style="line-height:36px;float:right">广告分类</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select  v-model="query.AdsPlaceID" id="search-AdsPlaceID" data-type="left" class="form-control">
                                            <option value="">全部</option>
                                            <template v-for="entry in AdsPlace">
                                                 <option :value="entry.AdsPlaceID" v-else>
                                                     {{ entry.AdsPlaceName }}
                                                 </option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="InputText" style="line-height:36px;float:right">标题</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input v-model="query.Title" id="search-Title" data-type="input" type="text" placeholder="输入关键字查询" class="form-control" />
                                    </div>
                                </div>
                            </div>
<div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="InputText" style="line-height:36px;float:right">时间</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-6" style="padding-right:0;">
                                            <input v-model="query.AddTimeStartTime" id="search-AddTimeStartTime" data-type="starttime" type="text" placeholder="开始日期" class="form-control datepicker-default" />
                                        </div>
                                        <div class="col-md-1" style="padding:0;line-height:36px;text-align: center">至</div>
                                        <div class="col-md-5" style="padding-left:0;">
                                            <input v-model="query.AddTimeEndTime" id="search-AddTimeEndTime" data-type="endtime" type="text" placeholder="结束日期" class="form-control datepicker-default" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
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
                        <button type="button" v-on:click="showCreate" class="btn btn-primary btn-xs">添加&nbsp;<i class="fa fa-plus"></i></button>
                        <button type="button" v-on:click="doDelete()" class="btn btn-danger btn-xs">删除&nbsp;<i class="fa fa-trash-o"></i></button>
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
                            
                            
                           <th class="text-center">广告分类</th>
                           <th class="text-center">标题</th>
                           <th class="text-center">图片</th>
                           <th class="text-center">链接</th>
                           <th class="text-center">排序</th>
                           <th class="text-center">状态</th>
                           <th class="text-center">时间</th>

                            
                            <th class="text-center" width="200px">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items">
                        
                            <td class="text-center"><input type='checkbox'  v-model="checkedNames"  name="checkedNames" value="{{ item[key] }}"/></td>
                            
                            
                           <td class="text-center">{{ AdsPlace[item.AdsPlaceID].AdsPlaceName }}</td>
                           <td class="text-center">{{ item.Title }}</td>
                           <td><a :href="item.File" data-lightbox="image-item-list"><img :src="item.File" style="width:100px;"/></a></td>
                           <td class="text-center">{{ item.Url }}</td>
                           <td class="text-center">{{ item.Sort }}</td>
                           <td class="text-center">{{ item.Status|StatusFilter }}</td>
                           <td class="text-center">{{ item.AddTime|time }}</td>

                            
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-xs"  v-on:click="showUpdate(item[key])"><i class="fa fa-edit"></i>&nbsp;更新</button>&nbsp;
                                <button type="button" class="btn btn-danger btn-xs" v-on:click="doDelete(item)"><i class="fa fa-trash-o"></i>&nbsp;删除</button>
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
                
                    
                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">广告分类:<span class="require">*</span></label>
                                                <select name="NoteTypeID" class="form-control"  v-model="item.AdsPlaceID">
                                                    <option value="0">请选择</option>
                                                    <template v-for="entry in AdsPlace">
                                                        <option :value="entry.AdsPlaceID" v-if="entry.AdsPlaceID == item.AdsPlaceID" selected>
                                                            {{ entry.AdsPlaceName }}
                                                        </option>
                                                        <option :value="entry.AdsPlaceID" v-else>
                                                            {{ entry.AdsPlaceName }}
                                                        </option>
                                                    </template>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">标题:<span class="require">*</span></label>
                                                <input type="text" name="Name" v-model="item.Title" class="form-control" />
                                                <em class="invalid">必填字段!</em>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">图片预览:</label>
                                            <div class="img thumbnail" style="width: 200px; height: 200px; overflow:hidden">
                                                <a id="aPreview" href="" data-lightbox="image-item-newitem">
                                                    <img id="imgPreview" class="img-responsive" v-bind:src="item.File"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label class="control-label">File:<span class="require">*</span></label>
                                            <input type="text" class="form-control"  name="File" v-model="item.File"/>
                                            <em class="invalid">必填字段!</em>
                                            <div style="padding-top:15px;">
                                                <span class="btn btn-success fileinput-button" v-on:click="upload('File')">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>上传图片</span>
                                                    <input class="fileupload" type="file" name="files[]" multiple="true" accept=".jpge,.jpg,.png,.gif,.bmp">
                                                </span>
                                                <span class="btn btn-warning" v-on:click="resetUpload('File')">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>重置图片</span>
                                                </span>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">链接:<span class="require">*</span></label>
                                                <input type="text" name="Name" v-model="item.Url" class="form-control" />
                                                <em class="invalid">必填字段!</em>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">排序:<span class="require">*</span></label>
                                                <input type="text" name="Name" v-model="item.Sort" class="form-control" />
                                                <em class="invalid">必填字段!</em>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">状态:<span class="require">*</span></label>
                                                        <select name="Status" v-model="item.Status"  class="form-control"><option value="0">未审核</option><option value="1">通过</option><option value="2">拒绝</option></select>
                                                    </div>
                                                </div>
                                            </div>
                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">时间:<span class="require">*</span></label>
                                                <input type="text" name="Name" v-model="item.AddTime|time" class="form-control datepicker-default" />
                                                <em class="invalid">必填字段!</em>
                                            </div>
                                        </div>
                                    </div>

                    
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
    
    var StatusFilter = {"0":"未审核","1":"通过","2":"拒绝",};
    Vue.filter('StatusFilter',function(items){return StatusFilter[items];});

    
    new Vue({
        el : '#App',
        data : xsHelp.data('admin/Ads','AdsID',{AdsPlace:'',AddTimeStartTime:'',AddTimeEndTime:''},{AdsPlace:[]}),
        //data : xsHelp.data(/*{{data}}*/),
        ready: function() {this.getData();this.getSelect('AdsPlace')},
        methods: {
        	getSelect :function(name){xsHttp.select(this,name)},
        	getData: function(type) {xsHttp.get(this,type)},
        	showCreate:function(){var Req = {process: function(vm){
        	    vm.$set('item', {File:'',});
        	}}
xsShow.add(this,Req)
},
            showUpdate : function(ID){xsShow.edit(this,ID)},
            save: function(){this.item[this.key] ? this.doUpdate() : this.doCreate()},
            doUpdate: function() {xsHttp.edit(this)},
            doCreate: function() {xsHttp.add(this)},
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