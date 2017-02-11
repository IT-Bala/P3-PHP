<?php
# Controller
if(!defined('p3')){ die("Access Denied!");}
class TestController extends WLT_Controller{
	public function index(){
		$kdpl = $this->setLibrary('kdpl');
		var_dump($kdpl->designer());
		echo "Test is running...";
	}
}
