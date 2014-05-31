<!DOCTYPE html >
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{$APP.$MODULE_NAME} - {$APP.LBL_BROWSER_TITLE}</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="themes/bootcss/css/bootstrap.css" rel="stylesheet">
<link href="themes/bootcss/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="themes/bootcss/css/style.css" rel="stylesheet">
<link href="themes/bootcss/css/cus-icons.css" rel="stylesheet">
<link href="themes/bootcss/css/main.css" rel="stylesheet">
<link href="themes/bootcss/css/datepicker.css" rel="stylesheet">
<script src="themes/bootcss/js/jquery-latest.js"></script>
<script src="themes/bootcss/js/bootstrap.min.js"></script>
<script src="themes/bootcss/js/bootstrap-datepicker.js"></script>
<script src="themes/bootcss/js/script.js"></script>
<script src="include/js/general.js"></script>
<script src="include/js/zh_cn.lang.js"></script>
</head>
<body>
<div class="container-fluid wraper clearfix">
  <div class="row-fluid brand">
	<div class="span2">
		<a href="./"><img src="themes/bootcss/img/logonew.png"></a>
	</div>
	<div class="pull-right navbar topbar">
		<ul class="nav">
		  <li><a href="index.php?module=Qunfas&action=index"><i class="cus-phone"></i>手机短信</a></li>
		  <li><a href="index.php?module=Relsettings&action=index"><i class="cus-cog"></i>&nbsp;个人设置</a></li>
		{if $IS_ADMIN === true}
		  <li><a href="index.php?module=Settings&action=index"><i class="cus-cog"></i>&nbsp;系统设置</a></li>
		  <li class="hidden-phone"><a href="index.php?module=Caches&action=index"><i class="cus-cog"></i>&nbsp;清除缓存</a></li>
		{/if}
		  <li><a href="Logout.php"><i class="icon-off"></i>&nbsp;退出</a></li>
		</ul>
	</div>
  </div>
</div>
<div class="clear navbar navbar-inverse">
  <div class="navbar-inner ">
	<div class="container  ">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <div class="nav-collapse collapse navbar-inverse-collapse ">
		<ul class="nav">
		{foreach key=maintabs item=detail from=$HEADERS}
			<li class="dropdown{if $detail eq $MODULE_NAME} active{/if}">
				<a href="index.php?module={$detail}&action=index" class="dropdown-toggle" >{$APP[$detail]}</a>
			</li>
		{/foreach}
		</ul>
		<form class="navbar-search pull-right" action="index.php" name="UnifiedSearch" method="post">
			<input type="hidden" name="action" value="UnifiedSearch"/>
			<input type="hidden" name="module" value="Home"/>
			<input type="text" class="search-query span2" placeholder="Search" id="query_string" name="query_string" />
		</form>
	  </div><!-- /.nav-collapse -->
	</div>
  </div><!-- /navbar-inner -->
</div><!-- /navbar -->
<div id="status"><img src="{$IMAGEPATH}status.gif"></div>
<div id="SelCustomer_popview" class="layerPopup hide"></div>
<div id="searchallacct" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div id="selectProductRows" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>