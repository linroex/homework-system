<?php
	include_once('include/sql_class.php');
	include_once('init.php');
	if($_POST['auth']==$_SESSION['AUTH']){
		$sql=new sql;
		
		$passwd=$sql->get('password','user','`username`=\''. trim($_POST['user_name']) .'\'');
		if($passwd==md5(trim($_POST['passwd']))){
			
			$_SESSION['user']['realname']=$sql->get('real_name','user','`username`=\''. trim($_POST['user_name']) .'\'');
			$_SESSION['user']['userid']=$sql->get('user_id','user','`username`=\''. trim($_POST['user_name']) .'\'');
			
			$_SESSION['user']['level']=$sql->get('level','user','`username`=\''. trim($_POST['user_name']) .'\'');
			
			if($_SESSION['user']['level']=='admin'){
				
				$_SESSION['login_status']=1;
				header('location:admin/index.php');
			}elseif($_SESSION['user']['level']=='normal'){
				header('location:result/index.php');
				$_SESSION['login_status']=1;
			}
		}else{
			$_SESSION['login_error']="帳號或密碼錯誤";
			header('location:index.php');
		}
		$sql=null;	
	}else{
		header('location:index.php');
	}
	
	
	
?>