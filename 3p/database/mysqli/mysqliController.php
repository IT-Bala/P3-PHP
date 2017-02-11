<?php
if(!defined('p3')){ die("Access Denied!");}
class mysqliController extends settingError{ # Collections Of MYSQLI query functions
    protected $db,$sql,$fields;
    public function mysqliController(){ 
	        mysqli_report(MYSQLI_REPORT_STRICT);
			$this->db='';
			$pdoArgs = func_get_args(); extract($pdoArgs[0]);
			try {
				$this->db = new mysqli($hostname, $username, $password,$database) or $this->error("Unable to connect with database");
			} catch (Exception $e) {
				$this->error(ucfirst($e->getMessage()));
			} 
			return $this->db;
	}
	public function dbConnection(){
		 return  $this->db;
	}
	public function __call($name, $arguments){
        if (!method_exists($this, $name)){
            return $this->error('$db->'.$name.'('.$arguments[0].')  call to undefined method '.$name.'()');
        }
    }
	public function dberror(){
		return $this->db->error();
	}
	public function _error($error){
		return $error;
	}
	public function fields($fields){
		 $this->fields = $fields;
		 return  $this->fields;
	}
	public function table($table){
		 $selectedFields = ($this->fields)?$this->fields:'*';
		 $sql = "SELECT $selectedFields FROM $table";
		 $this->query($sql);
		 return $this->db;
	}	
	public function insert($tbl,$datas){ $msg='';
		if(!empty($tbl) && !empty($datas)){
			$count = 0;
			$fields = '';
			foreach($datas as $name=>$value){
				
				  if ($count++ != 0) $fields .= ', ';
				  $name  =  $this->db->escape_string($name);
				  $value = $this->db->escape_string($value);
				  $fields .= "`$name` = '$value'";
				
			} $msg = $this->query("insert into $tbl set $fields");
		}else{	$msg = $this->_error("Invalid insert( ) function must be 2 args!");}
		return $msg;		
	}
	public function update($tbl,$datas,$where){ $msg='';
		while(list($key,$value) = each($where)){
			$where_and[] = $key."='".$value."'";
		};
		$where_condition = implode(' AND ',$where_and);
		
		if(!empty($tbl) && !empty($datas) && !empty($where)){
			$count = 0;
			$fields = '';
			foreach($datas as $name=>$value){				
				  if ($count++ != 0) $fields .= ', ';
				  $name  =  $this->db->escape_string($name);
				  $value = $this->db->escape_string($value);
				  $fields .= "`$name` = '$value'";
				
			}			
			$msg = $this->query("UPDATE $tbl set $fields WHERE ".$where_condition);
		}else{	$msg = $this->_error("Invalid insert( ) function must be 2 args!");	}
		return $msg;		
	}
	public function query($sql){
		 $this->sql 		= $this->db->query($sql);
		 if (!$this->sql) {
		   $this->error($this->db->error);
		   exit();
		}
		 $this->last_query = $sql;
		 return  $this->sql;
	}
	
	public function insert_id(){
		 $this->sql = $this->db->insert_id;
		 return  $this->sql;
	}
	public function last_query(){
		return $this->last_query;
	}
	public function num_rows(){
		$result = $this->sql->num_rows; 
		return $result;
	}
	public function row(){
		$result = $this->sql->fetch_object();
		return $result;
	}
	public function result_array(){ 
		while($result = $this->sql->fetch_array()) $results[] = $result;
		return $results;
		
	}
	public function result_assoc(){ 
		while($result = $this->sql->fetch_assoc()) $results[] = $result;
		return $results;		
	}
	public function result_object(){
		while($result = $this->sql->fetch_object()) $results[] = $result;
		return (object)array_merge($results);
	}	
	public function results(){
		while($result = $this->sql->fetch_object()) $results[] = $result;
		return (object)array_merge($results);
	}
	public function result_json(){
		while($result = $this->sql->fetch_object()) $results[] = $result;
		return json_encode(array_merge($results));
	} 
}