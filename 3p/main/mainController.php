<?php
if(!defined('p3')) die('Access Denied!');
trait mainController{
	protected function request(){ $args = func_get_args(); 
		if(count($args) == 0){ 
			$req = $_REQUEST;
		}else{ $var = $args[0];
			if(isset($_REQUEST[$var])){
				$req = $_REQUEST[$var];
			}else{
				$req = $this->warning('$this->request(`'.$var.'`) is undefined variable.');
			} 
		}
		return $req;
	}
	protected function get(){ $args = func_get_args(); 
		if(count($args) == 0){ 
			$get = $_GET;
		}else{ $var = $args[0];
			if(isset($_GET[$var])){
				$get = $_GET[$var];
			}else{
				$get = $this->warning('$this->get(`'.$var.'`) is undefined variable.');
			} 
		}
		return $get;
	}
	protected function post(){
		$args = func_get_args(); 
		if(count($args) == 0){ 
			$post = $_POST;
		}else{ $var = $args[0];
			if(isset($_POST[$var])){
				$post = $_POST[$var];
			}else{
				$post = $this->warning('$this->post(`'.$var.'`) is undefined variable.');
			} 
		}
		return $post;
	}
}