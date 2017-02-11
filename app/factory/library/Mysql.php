<?php
# Library
class Mysql{
	public function result_array($sql){ 
		while($result = $sql->fetch_array()) $results[] = $result;
		return $results;
		
	}
	public function result_object($sql){
		while($result = $sql->fetch_object()) $results[] = $result;
		return (object)array_merge($results);
	}
	public function results(){
		while($result = $sql->fetch_object()) $results[] = $result;
		return (object)array_merge($results);
	} 
}
