<?php
# Controller
if(!defined('p3')){ die("Access Denied!");}
class HomeController extends WLT_Controller{
	public function index(){		
		$data['title'] = 'P3-PHP is the small foot print!';
		$data['products'] = $this->setModel('testModel')->test();
		$this->sethtml('section/header',$data);
			echo "Welcome to home page!";
		$this->sethtml('section/footer',$data);
	}
}
