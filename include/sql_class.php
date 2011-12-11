<?php

	class sql{
		private $sql_info=array("user_name"=>"root",
								"passwd"=>"",
								"db_name"=>"homework"
		);
		
		private $sql_handle=null;
		public $sql_status;
		
		function __construct(){
			$this->sql_handle=@mysql_connect('localhost',$this->sql_info['user_name'],$this->sql_info['passwd']);		//建立連線
			if($this->sql_handle!=null){
				mysql_select_db($this->sql_info['db_name']);
				mysql_query('SET NAMES UTF8');
			}else{
				$this->sql_status=mysql_error();		//回傳錯誤原因
			}
			
		}
		
		function parameter_pro(){
			//把傳入的字串處理成SQL接受的格式(`xxx`)
			$num=func_num_args();
			$result[$num]=null;
			$args=func_get_args();
			
			for($i=0;$i<$num;$i++){
				$result[$i]='`' . $args[$i] . '`';
				
			}
			return $result;
		}
		
		function get($field,$table,$condition,$limit=1){
			//取資料
			$temp=$this->parameter_pro($field,$table);		
			$sql_resource=mysql_query("SELECT $temp[0] from $temp[1] where $condition limit $limit");
			return @implode(mysql_fetch_row($sql_resource));
			
		}
		
		function __destruct(){
			//關閉雨資料庫的連線
			mysql_close($this->sql_handle);
			
		}	
	}
	
?>