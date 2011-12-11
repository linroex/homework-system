<?php
	session_start();
	
	if($_SERVER['PHP_SELF']!='/homework-system/index.php' && $_SERVER['PHP_SELF']!='/homework-system/login.php'){
		//檢查所在頁面是否為登入畫面、首頁，如果不是，則需要登入才能檢視
		if(@$_SESSION['login_status']!=1){
			echo "請先登入";
			echo '<br/><a href="../index.php">按此回首頁</a>';
			exit();
		}
	}

?>
