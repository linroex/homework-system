<?php 
	class result{
		
		function get_secret($time,$user_id){
			if($time==''){$time=date('Y-m-d');}
			$resource=mysql_query('SELECT * FROM `message` where `user_id`=\'' . $user_id . '\' and `date`=\'' . $time . '\';');		
			
			$result=array('');
			$i=0;
			while($temp=mysql_fetch_array($resource)){
				$result[$i]=$temp;
				$i++;
			}
			return $result;
		}
		
		function get_public($time){
			if($time==''){$time=date('Y-m-d');}
			$resource=mysql_query('SELECT * FROM `message` where `type`=\'public\' and `date`=\'' . $time . '\';');		
			
			$result=array('');
			$i=0;
			while($temp=mysql_fetch_array($resource)){
				$result[$i]=$temp;
				$i++;
			}
			return $result;
		}
		
	}
	
?>