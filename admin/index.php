<?php include('../init.php');?>
<?php include('../include/sql_class.php');?>
<?php include('../include/other.php');?>
<?php 
	if($_SESSION['login_status']==1){
		if($_SESSION['user']['level']=='normal'){
			header('location:../result/index.php');
		}
		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo (!isset($site_name)?'作業缺交系統':$site_name);?> | 後台</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="all" />
	<script type="text/javascript" src="../js/func.js"></script>
</head>
<body style="min-height:1000px;">
	<div id="content" >
		<h2>作業缺交系統</h2>
		<?=wel(); ?>
		<input type="button" value="登出" onclick="logout()"/>
		<h2>新增資料</h2>
		<div style="text-align:left;width:80%;margin:0 auto;" >
			<b>說明：</b>
			<p>批次新增資料，一行一筆，填入格式：日期;內容;類型;指定給</p>
			<b>解釋：</b>
			<ul>
				<li>日期：此筆訊息的日期，格式為yyyy-mm-dd，預設值為當日(如要使用預設值，請留空)</li>
				<li>內容：要張貼的訊息</li>
				<li>類型：公開訊息或私密訊息(公開=public,私密=secret)</li>
				<li>指定給：如果是私密訊息，則必須要設定指定給哪位使用者檢視，每筆訊息只能設定最多一個使用者檢視(輸入登入時的username)</li>
			</ul>
			<b>範例：</b>
			<ul>
				<li>2011-12-04;測試資料;secret;91504</li>
				<li>2011-12-04;測試公告;public</li>
				<li>;測試公告;public</li>
			</ul>
		</div>
		<form action="" method="post">
			<textarea name="data" cols="50" rows="8"></textarea>
			<br/>
			<input type="submit" value="新增" />
		</form>
		<?php
			$sql=new sql; 
			if(@trim($_POST['data'])!=''){
				$data=explode("\r\n",$_POST['data']);
				$re=array('');
				$i=0;
				
				foreach($data as $temp){
					$re[$i]=explode(";",$temp);
					$re[$i][0]=($re[$i][0]==''?date('Y-m-d'):$re[$i][0]);
					if($re[$i][2]=='secret'){
						$re[$i][3]=$sql->get('user_id','user',"username={$re[$i][3]}");
						$status=mysql_query("INSERT INTO `message` (`date`,`content`,`type`,`user_id`) VALUES('{$re[$i][0]}','{$re[$i][1]}','{$re[$i][2]}','{$re[$i][3]}');");
						
					}elseif($re[$i][2]=='public'){
						$status=mysql_query("INSERT INTO `message` (`date`,`content`,`type`) VALUES('{$re[$i][0]}','{$re[$i][1]}','{$re[$i][2]}');");
					}
					$i++;
				}
				if(@$status==1){
					echo '<p style="color:red;">上傳成功</p>';
				}else{
					echo '<p style="color:red;">上傳失敗</p>';
				}
			}elseif(isset($_POST['data'])){
				echo '<p style="color:red;">請填入資料</p>';
			}
			
		?>
		
	</div>
</body>
</html>
