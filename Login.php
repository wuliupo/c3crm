<?php
error_reporting(0);
$theme_path="themes/softed/";
$image_path="include/images/";
$default_language = "zh_cn";
$default_theme = "softed";
$default_user_name = "";
$default_password = "";
$default_company_name = "";
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>CRM</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
	<!-- CSS -->
    <link href="themes/bootcss/css/bootstrap.css" rel="stylesheet">
    <link href="themes/bootcss/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="themes/bootcss/css/style.css" rel="stylesheet">
    <link href="themes/bootcss/css/cus-icons.css" rel="stylesheet">
	<link href="themes/bootcss/css/Login.css" rel="stylesheet">
  </head>
<script language="javascript">
function check() {
	if (document.loginform.user_name.value == '') {
		alert('用户名不能为空');
		document.loginform.user_name.focus();
		return false;
	}
	if (document.loginform.user_password.value == '') {
		alert('密码不能为空');
		document.loginform.user_password.focus();
		return false;
	}
	return true;
}
function logining_load(){
	document.loginform.user_name.focus();
}
</script>
<body onLoad="logining_load()">
<div class="navbar navbar-fixed-top">	
	<div class="navbar-inner">
		<div class="container">
			<a class="" href="./"><img src="themes/bootcss/img/logonew.png"></a>
			<ul class="nav pull-right">
				<li class="" style="line-height: 30px;">
					<a href="./">CRM</a>
				</li>
			</ul>
		</div> <!-- /container -->
	</div> <!-- /navbar-inner -->
</div> <!-- /navbar -->
<div id="login-container">
	<div id="login-header">
		<h3 style="line-height: 15px;">登录</h3>
	</div> <!-- /login-header -->
	<div id="login-content" class="clearfix">
	
	<form action="Authenticate.php" method="post" name="loginform" id="loginform">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="user_name">用户名</label>
						<div class="controls">
							<input type="text" class="" id="user_name" name="user_name" value="<?php echo $login_user_name ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="user_password">密码</label>
						<div class="controls">
							<input type="password" class="" id="user_password" name="user_password" value="<?php echo $login_password ?>">
						</div>
					</div>
					<!--<div class="control-group">
						<label class="control-label" for="password">验证码</label>
						<div class="controls">
							<input type="password" class="" id="password" style="width:200px;">
							<img src="picture.php?authnum=<?php echo $authnum; ?>">
							<input type="hidden" name="authnum" value="<?php echo $randtext; ?>">
						</div>
					</div>-->
					  <input type="hidden" name="login_theme" value="softed">
					  <input type="hidden" name="login_language" value="zh_cn">						 
					  <?php
						if( isset($_SESSION['validation'])){
						?>
						<tr>
							<td colspan="2"><font color="Red"> 出错 </font></td>
						</tr>
						<?php
						}
						else if(isset($_REQUEST["login_error"]) && $_REQUEST["login_error"] != "")
						{
						?>
						<tr>
							<td colspan="2"><b class="small"><font color="Brown">
							<?php echo $_REQUEST["login_error"] ?>
							</font>
							</b>
							</td>
						</tr>
						<?php
						}
					  ?>
				</fieldset>
				<!--
				<div id="remember-me" class="pull-left"><br><br>
					<A href="register.php">&nbsp;注册</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A href="sendpwd.php">忘记密码&nbsp;</A>
				</div>-->
				
				<div class="pull-right">
					<button type="submit" class="btn btn-warning btn-large" onClick="return check()">
						登录
					</button>
				</div>
			</form>
			
		</div> <!-- /login-content -->
		
		<div id="login-extra">
			<p>
			</p>
			
             <br>
             <p>Copyright &copy; 2014 <a href="http://pauli.cn" target="_blank">pauli.cn</a>, all rights reserved.</p>
		</div> <!-- /login-extra -->
	
</div> <!-- /login-wrapper -->