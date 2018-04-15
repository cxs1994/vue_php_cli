</div>
<script src="/static/admin/js/jquery-2.2.3.min.js"></script>
<script src="/static/admin/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/admin/js/content.min.js-v=1.0.0.js"></script>
<script src="/static/admin/libs/sweetalert/sweetalert.min.js"></script>
<script src="/static/admin/libs/jquery-toastr/toastr.min.js"></script>
<script src="/static/admin/js/ej.js"></script>
<script src="/static/admin/js/ejUtils.js"></script>
<!--<script src="/static/admin/libs/angular/angular.min.js"></script>-->
<script src="/static/admin/js/vue.js"></script>
<script src="/static/admin/libs/iCheck/icheck.min.js"></script>
<!--<script src="/static/admin/libs/iCheck/angular-icheck.js"></script>-->
<script>
    var loader;
    function showLoading() { loader = parent.layer.load(0); }
    function hideLoading() { if (loader) parent.layer.close(loader); }
    function errorFn(data, status, headers, config) { EJ.showRemoteError(data, status, headers, config); hideLoading(); }
</script>

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