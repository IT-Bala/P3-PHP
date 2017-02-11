<?php
if(!defined('p3')){ die("Access Denied!");}
class mysqlController extends settingError{ # Collections Of MYSQLI query functions
    public $db;
    public function mysqlController(){ 
			$pdoArgs = func_get_args(); extract($pdoArgs[0]);
			try {
				$mysqlConnection = mysql_connect($hostname, $username, $password);
				mysql_select_db($database, $mysqlConnection);
			} catch (Exception $e) {
				$this->error(ucfirst($e->getMessage()));
			} 
	} 
	public function dbConnection(){
	}
	public function sql(){ $sqlArgs = func_get_args(); $sql='';
	     if(isset($sqlArgs[0]) && $sqlArgs[0]!=''){ $sql = $sqlArgs[0]; }else{ $this->warning("Please enter sql query!");}
		 return $sql;
	}
	public function query(){
		 $sqlArgs = func_get_args(); $query='';
	     if(isset($sqlArgs[0]) && $sqlArgs[0]!=''){ $query = mysql_query($sqlArgs[0]); }else{ $this->warning("Please enter sql query!");}
		 return $query;
	}
} 