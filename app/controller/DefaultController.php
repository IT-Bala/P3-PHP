<?php
# Controller
if(!defined('p3')){ die("Access Denied!");}
class DefaultController extends WLT_Controller{
	public function __construct(){
		parent::__construct();
		#$this->setHelper('url');		
	}
	public function index(){  
		$data['title'] = 'P3-PHP is the small foot print!'; 
		$data['products'] = $this->setModel('testModel')->test();
		#$this->db = $this->setDatabase();
		#echo $this->get('edit');
		#$this->setHtml('section/header',$data);
		#$this->setHtml('index',$data);
		#$this->setHtml('section/footer',$data);
		#$cache = new Memcache;
		#$cache->connect('localhost', 11211) or die ("Could not connect");		
		
		$db = $this->setDatabase();		
		$db->query("select * from tbl_users");
		
		$data['users'] = $db->results();	
		
	    $this->setHtml('section/header',$data)
			 ->setHtml('index',$data)
			 ->setHtml('section/footer');
		
	}
	public function select(){
		#$db = $this->setDatabase();
		$this->db->fields("username,first_name");
		$this->db->table("tbl_users");
		#echo $this->db->result_json();
		$this->setHtml('test');
	}
	
	public function insert(){
		$db = $this->setDatabase();
		$datas = array("username"=>"kutung");
		$db->insert('tbl_users',$datas);		
		echo $db->insert_id();
	}
	public function update(){ # In progress
		$db = $this->setDatabase();
		$datas = array("username"=>"kutung 123");
		$where = array("user_id"=>"8");
		$a = $db->update('tbl_users',$datas,$where);
	}
	public function test($args){
		$data['title'] = "This test page";
		$obj = $this->setModel('testModel');
		$data['ramesh'] = $obj->ramesh();
		$data['products'] = $obj->test();
		$this->setHtml('section/header',$data);
		$this->setHtml('test',$data);
		$this->setHtml('section/footer',$data);
	}
	public function aboutus(){
		$this->setHtml('aboutus');
	}
	public function data(){
		echo $this->setModel('dataModel')->data();
	}
}