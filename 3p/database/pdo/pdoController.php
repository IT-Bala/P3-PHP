<?php
if(!defined('p3')){ die("Access Denied!");}
class pdoController extends settingError{ # Collections Of pdo query functions
    public $db;
    public function pdoController(){ $this->db='';
			$pdoArgs = func_get_args(); extract($pdoArgs[0]);
	        $dsn = 'mysql:dbname='.$database.';host='.$hostname;
			try {
				$this->db = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			} catch (PDOException $e) {
				$this->error(ucfirst($e->getMessage()));
			} 
			return $this->db;
	}
	public function dbConnection(){
		 return $this->db;
	}
	public function __call($name, $arguments){
        if (!method_exists($this, $name)){
            return $this->error('$db->'.$name.'('.$arguments[0].')  call to undefined method '.$name.'()');
        }
    }
} 