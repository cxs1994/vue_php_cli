<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit" />
    <title>网站的标题</title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;lowie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="/static/admin/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/static/admin/css/font-awesome.min.css-v=4.6.0.css" rel="stylesheet" />
    <link href="/static/admin/css/animate.min.css" rel="stylesheet" />
    <link href="/static/admin/css/style.min.css-v=4.0.0.css" rel="stylesheet" />
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close">
            <i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" src="/static/admin/images/face.jpg" width="64"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs"><strong class="font-bold">admin</strong></span>
                                    <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <!--<li>
                                <a class="J_menuItem" href="/Admin/Sys/UpdatePwd">修改密码</a>
                            </li>-->
							<li>
                                <a class="J_menuItem" href="">修改密码</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        EJ
                    </div>
                </li>
                
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label">敏捷开发</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="/admin/giiview">单表生成</a>
                        </li>
                    </ul>
                </li>
                
                <?php foreach(\Middleware\Auth::$channel as $key => $val):?>
                <?php if(array_key_exists($key,\Middleware\Auth::$tree_name)):?>
                <li>
                    <a href="#">
                        <i class="fa fa fa-bar-chart-o"></i>
                        <span class="nav-label"><?php echo \Middleware\Auth::$tree_name[$key]['Name']?>管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <?php foreach($val as $k => $v):?>
    							<?php if(array_key_exists($v,\Middleware\Auth::$tree_name[$key]['Son'])):?>
                                    <a class="J_menuItem" href="<?php echo DOMAIN.'admin/'.$v.'/index'?>">
                                    <?php echo \Middleware\Auth::$tree_name[$key]['Son'][$v]['Name']?>管理</a>
    							<?php endif;?>
							<?php endforeach;?>
                        </li>
                    </ul>
                </li>
                <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header hidden">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="http://www.zi-han.net/theme/hplus/search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right hidden">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li class="m-t-xs">
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="/Content/images/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46小时前</small>
                                        <strong>小四</strong> 这个在日本投降书上签字的军官，建国后一定是个不小的干部吧？
                                        <br>
                                        <small class="text-muted">3天前 2014.11.8</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="/Content/images/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">25小时前</small>
                                        <strong>国民岳父</strong> 如何看待“男子不满自己爱犬被称为狗，刺伤路人”？——这人比犬还凶
                                        <br>
                                        <small class="text-muted">昨天</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a class="J_menuItem" href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                        <span class="pull-right text-muted small">4分钟前</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-qq fa-fw"></i> 3条新回复
                                        <span class="pull-right text-muted small">12分钟钱</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a class="J_menuItem" href="notifications.html">
                                        <strong>查看所有 </strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden-xs">
                        <a href="index_v1.html" class="J_menuItem" data-index="0"><i class="fa fa-cart-arrow-down"></i> 购买</a>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft">
                <i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight">
                <i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">
                    关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive">
                        <a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll">
                        <a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther">
                        <a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="" frameborder="0" data-id="" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">
                &copy; 2017-2018 <a href="#" target="_blank">vpc-xs</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<script src="/static/admin/js/jquery-2.2.3.min.js"></script>
<script src="/static/admin/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/admin/libs/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/admin/libs/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
<script src="/static/admin/libs/layer/layer.min.js"></script>
<script src="/static/admin/js/hplus.min.js-v=4.0.0.js"></script>
<script src="/static/admin/js/contabs.min.js"></script>
<script src="/static/admin/libs/pace/pace.min.js"></script>
</body>
</html>
