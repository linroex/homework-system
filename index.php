<?php include('init.php');?>
<?php 
	if($_SESSION['login_status']==1){
		if($_SESSION['user']['level']=='admin'){
			header('location:admin/index.php');
		}elseif($_SESSION['user']['level']=='normal'){
			header('location:result/index.php');
		}
		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo (!isset($site_name)?'作業缺交系統':$site_name);?> | 首頁</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
</head>
<body>
	<div id="login-form">
		<h2>作業缺交系統</h2>
		<form action="login.php" method="post">
			<p>帳號：<input type="text" name="user_name"/></p>
			<p>密碼：<input type="password" name="passwd"/></p>
			<p style="color:red;"><?=isset($_SESSION['login_error'])?$_SESSION['login_error']:'';unset($_SESSION['login_error']);?></p>
			<input type="hidden" name="auth" value="<?=$_SESSION['AUTH']=md5(time());?>" />
			<input type="submit" value="登入"/>
		</form>
		<!--[if IE]><p>建議使用<a href="http://moztw.org/" target="_blank">Firefox</a>、<a href="http://www.google.com/chrome?hl=zh-TW" target="_blank">Chrome瀏覽本站</a></p><![endif]-->
		
	</div>
</body>
</html>