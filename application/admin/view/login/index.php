<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站后台管理系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/admin/css/font-awesome.min.css-v=4.4.0.css" rel="stylesheet" />
    <link href="/static/admin/css/animate.min.css" rel="stylesheet" />
    <link href="/static/admin/css/style.min.css-v=4.0.0.css" rel="stylesheet" />
    <link href="/static/admin/libs/sco.message/sco.message.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if (window.top !== window.self) { window.top.location = window.location; }</script>
    <style type="text/css">
        .ad {
            display: none !important;
            display: none;
        }

        .middle-box h1 {
            font-size: 30px;
            font-weight: bold;
        }

        .gray-bg {
            background:#FFF url("/static/admin/images/1.jpg") no-repeat center center;
        }

        .loginscreen.middle-box {
            background: #eeeeee none repeat scroll 0 0;
            border-radius: 4px;
            margin: 5% auto 0;
            width: 400px;
            padding-top: 10px;
        }

        .body-content {
            padding: 15px 20px;
            position: relative;
        }
        .form-group{
            margin-bottom:15px;
        }
    </style>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated ">
    <div>
        <h1>后台管理系统</h1>
        <form class="m-t" role="form" onsubmit="return false" id="submitForm">
            <div class="body-content">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" required="" name="UserName">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required="" name="PassWord">
                </div>
                <div class="form-group" style="clear:both;overflow: hidden">
                    <div class="col-md-8" style="padding-left:0;padding-right: 0">
                        <input type="text" class="form-control" placeholder="手机号码" required="" name="Phone">
                    </div>
                    <div class="col-md-4" style="padding-right: 0">
                        <input type="button" class="form-control" value="发送验证码" id="Send">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" maxlength="6" placeholder="手机验证码" required="" name="verifyCode">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </div>
        </form>
    </div>
</div>
<script src="/static/admin/js/jquery-2.2.3.js"></script>
<script src="/static/admin/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/admin/libs/sco.message/sco.message.js"></script>
<script>
    $("#submitForm").submit(function () {
        console.log($(this).serialize())
        $.ajax({
            type: "POST",
            url: "<?=X2\Url::site_url('admin/login/handle')?>",
            dataType: "json",
            data: $(this).serialize(),
            success: function (data) {
                if (data.Success) {
                    location.href = data.msg;
                } else {
                    $.scojs_message(data.msg, $.scojs_message.TYPE_ERROR);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("远程服务器异常！");
            }
        })
    });
    $("#Send").click(function () {
        var phone = $("input[name='Phone']").val();
        var username = $("input[name='UserName']").val();
        if(phone == '' && username) {
            alert('请输入手机号码');return false;
        }
        $.ajax({
            type: "POST",
            url: "<?=X2\Url::site_url('admin/auth/send')?>",
            dataType: "json",
            data: {'Phone':phone,'UserName':username},
            success: function (data) {
                alert(data.msg);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("远程服务器异常！");
            }
        })
    });
</script>
</body>

</html>
