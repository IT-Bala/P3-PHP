<?php
# 3P-P3 SESSION CONTROLLER
if(!defined('p3')) die('Access Denied!');
trait sessionController{ 
	public $sessionStart; public $sessionKey;
	public function __construct(){
		self::start();
	}
	protected function start(){
		session_start();
	}
	protected function setSession(){ $args = func_get_args();
	    if(count($args)==2){
			$this->sessionKey = $args[0];
			$_SESSION[$this->sessionKey] = $args[1];
		}else{
			$this->warning("setSession() function should have 2 args!");
		}
	}
	protected function getSession(){ $args = func_get_args();
		if(count($args)==1){
			if(isset($_SESSION[$args[0]])){
				$getSession = $_SESSION[$args[0]];
			}else{
				$getSession = false;
			}
		}else{
			$getSession = $this->warning("getSession() function should have 1 args!");
		}
		return $getSession;
	}
	protected function unsetSession(){ $args = func_get_args();
		if(count($args)==1){
			unset($_SESSION[$args[0]]);
		}elseif(count($args)>1){
			foreach($args as $arg){
			unset($_SESSION[$arg]);
			}
		}else{
			$this->warning("unsetSession() function must have atleast 1 args!");
		}
		//return $getSession;
	}
	protected function destroySession(){ 
	  session_destroy();
	}
}