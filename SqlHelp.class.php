<?php 
	//php工具类
  /*
	1，设计该类的必要属性；
	2，可以创建数据库对象的同时并建立跟数据库的连接（或连接失败信息）；
	2.1，可以在建立连接的同时设定所要连接的数据库和所要使用的连接编码；
	2.2，还可以单独设置所要连接的数据库；
	2.3，还可以单独设置所要使用的连接编码；
	3，可以断开连接；
	4，实现其单例化。
	实例化该类并进行简单测试。*/
	class SqlHelper{
		private static $is_link = null ;  //定义一个私有静态变量

		private function __construct(){

		}

		static function GetLink($host,$user,$pass,$charset,$db){
			$link = mysql_connect($host,$user,$pass);  //调用该方法自动连接数据库
			if(!$link){
				die('连接失败'.mysql_error());      //连接失败就提示错误并退出
			}
			mysql_query("set names $charset",$link); //设置编码
			mysql_select_db($db,$link);				//选择数据库
			if(empty(self::$is_link)){
				self::$is_link = new self();
				return self::$is_link;
			}else{
				return self::$is_link;
			}
		}
		 static function selectDB($db){
		 	if(!empty(self::$is_link)){
				mysql_select_db($db);
		 	}
			
		}
		static function setNames($charset){
			if(!empty(self::$is_link)){
				mysql_query("set names $charset");
			}
		}
		static function close_connect(){			
			if(!empty(self::$is_link)){
				mysql_close();
				echo "断开成功";
			}
		}
		
	}
	$obj1 = SqlHelper::GetLink('localhost','root','wanlei','utf8','db1');
	SqlHelper::selectDB('db1');
	SqlHelper::setNames('gbk');
  SqlHelper::close_connect();




 ?>
