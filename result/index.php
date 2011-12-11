<?php include('../init.php');?>
<?php include('../include/result_class.php');?>
<?php include('../include/sql_class.php');?>
<?php include('../include/other.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo (!isset($site_name)?'作業缺交系統':$site_name);?> | 查詢</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="all" />
	<script type="text/javascript" src="../js/func.js"></script>
	<script type="text/javascript" src="../js/jquery-1.7.js"></script>
	<script type="text/javascript" src="../js/jquery-ui/js/jquery-ui-1.7.3.custom.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui/js/jquery.ui.datepicker-zh-TW.js"></script>
	<link rel="stylesheet" type="text/css" href="../js/jquery-ui/css/smoothness/jquery-ui-1.7.3.custom.css" media="all" />

</head>
<body>
	<script type="text/javascript">
		$(function(){
			// Datepicker
			$('#search_time').datepicker({
					dateFormat:'yy-mm-dd',firstDay:1
				});
			
		});
	</script>
	<div id="content">
		<h2>查詢缺交作業</h2>
		<?=wel(); ?>
		<input type="button" value="登出" onclick="logout()"/>
		<div id="result">
			<form action="" method="get">
				<p>查詢時間：<input type="text" name="search_time" id="search_time">
				<input type="submit" value="查詢" /></p>
				
			</form>
			<h2>公告</h2>
			<ul>
			<?php 
				$sql=new sql;
				$re=new result;
				$result=@$re->get_public($_GET['search_time']);
				
				if($result[0]!=''){
					foreach($result as $t){
						echo '<li style="text-align:left;">' , $t[1] , '</li>';
					}	
				}else{
					echo '<p style="color:red;">查無資料</p>';
				}
			?>
			</ul>
			<h2>缺交作業</h2>
			<table>
			<?php
			
				$result=@$re->get_secret($_GET['search_time'],$_SESSION['user']['userid']);
				
				if($result[0]==''){
					echo '<p style="color:red;">查無資料</p>';
				}else{
					echo '<tr><td style="width:150px;font-weight:bold;">時間</td><td style="width:300px;text-align:left;font-weight:bold;">缺交項目</td></tr>';
					foreach($result as $t){
						echo '<tr>';
						echo '<td style="width:150px;">' , $t[0] , '</td>';
						echo '<td style="width:300px;text-align:left;">' , $t[1] , '</td>';
						echo '</tr>';
						
					}	
				}
			?>
			</table>
		</div>
	</div>
</body>
</html>