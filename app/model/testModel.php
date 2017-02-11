<?php
# Controller
if(!defined('p3')){ die("Access Denied!");}
class testModel extends WLT_Model{
	public function test(){ 
		return array('Apple','Window','Linux');
	}
	public function ramesh(){
 		return "Rhis ramesh!";
	}
}
