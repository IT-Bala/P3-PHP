<?php
# 3P-P3 COOKIE CONTROLLER
if(!defined('p3')) die('Access Denied!');
trait cookieController{ 
	protected function setCookie(){ $args = func_get_args();
	    if(count($args)>=2){
			$_2 = (isset($args[2]))?$args[2]:'';$_3 = (isset($args[3]))?$args[3]:'';
			$_4 = (isset($args[4]))?$args[4]:'';$_5 = (isset($args[5]))?$args[5]:'';
			setcookie($args[0],$args[1],$_2,$_3,$_4,$_5);
		}else{
			$this->error("setCookie() function must have atleast 2 args!");
		}
	}
	protected function getCookie(){ $args = func_get_args();
		if(count($args)==1){
			if(isset($_COOKIE[$args[0]])){
				$getCookie = $_COOKIE[$args[0]];
			}else{
				$getCookie = false;
			}
			
		}else{
			$this->error("getCookie() function should have 1 args!");
		}
		return $getCookie;
	}
	protected function unsetCookie(){ $args = func_get_args();
		if(count($args)==1){
			setcookie($args[0],'');
		}elseif(count($args)>1){
			foreach($args as $arg){
			 setcookie($arg,'');
			}
		}else{
			$this->error("unsetCookie() function must have atleast 1 args!");
		}
		return $getCookie;
	}
	protected function destroyCookie(){ 
	  # Destroy All Cookie
	  if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
			}
		}
	}
}