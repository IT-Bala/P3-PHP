<?php
if(!defined('p3')){ die("Access Denied!"); }
class settingController extends settingError { # THIS IS MAIN CLASS FOR 3P-FRAMEWORK
	public function __construct(){
		self::routing();
	}  # SYSTEM WILL CHECK SECOND BASENAME { SECOND BASE NAME == controller name, aftre controller method will take}
	public function routing(){ $controllerBase = 'Controller';
		
		if(is_dir(__APP__) && is_dir(__CONTROLLER__)){
		  if(self::home()){
				  $controllerClass = self::baseUrl().$controllerBase;
				  $controllerClassFile = $controllerClass.'.php';
				  if(file_exists(__CONTROLLER__.$controllerClassFile)){
					  require_once __CONTROLLER__.$controllerClassFile;
					  if(class_exists($controllerClass)){ $object = new $controllerClass;
					 	  $classMethods = get_class_methods($controllerClass);
						  if(in_array('index',$classMethods)){				
							  $object->index();
						  }
					  }else{
						  $this->error(" Controller Class name should be file name! ");
					  }
				  }else{
					  $this->__404__(__CONTROLLER__.$controllerClassFile);
				  }
		  }else{ # Not For HOme
			     #$args=array();
				 
				 $controllerClass = self::baseUrl()->_class.$controllerBase;
				  $controllerClassFile = $controllerClass.'.php';
				  if(file_exists(__CONTROLLER__.$controllerClassFile)){
					  require_once __CONTROLLER__.$controllerClassFile;
					  if(class_exists($controllerClass)){ $object = new $controllerClass; 
						  #$classMethods = get_class_methods($controllerClass);
						  #var_dump($classMethods);
						  $classMethods = array();
						  $class = new ReflectionClass($controllerClass);						  
						  foreach($class->getMethods(ReflectionMethod::IS_PUBLIC) as $method){
							   if($method->name != 'WLT_Controller'){ 
								   	$classMethods[] = $method->name;
							   }
						   }#print_r($classMethods);
						  if(isset(self::baseUrl()->_method) && self::baseUrl()->_method!='' && in_array(self::baseUrl()->_method,$classMethods)){ 				$method = self::baseUrl()->_method;	
								$arguments = (isset(self::baseUrl()->_args) && self::baseUrl()->_args!='')?self::baseUrl()->_args:NULL;	
								$arguments = explode(',',$arguments);
					  			$object->$method($arguments);
						  }elseif(self::baseUrl()->_class){  #echo self::baseUrl()->_method;
							  if(!isset(self::baseUrl()->_method) || self::baseUrl()->_method == NULL){						  	   
								  if(in_array('index',$classMethods)){				
										$object->index();
								  } 
							  }else{
								  $this->warning('Method `'.self::baseUrl()->_method.'` not found in '.$controllerClassFile.'<br><strong>File:</strong>'.__CONTROLLER__.$controllerClassFile);
								}
						  }elseif(self::baseUrl()->_method!='' && !in_array(self::baseUrl()->_method,$classMethods)){
							  $this->warning('Method `'.self::baseUrl()->_method.'` not found in '.$controllerClassFile.'<br><strong>File:</strong>'.__CONTROLLER__.$controllerClassFile);	
							  #$object->index();
						  }
					  }else{
						  $this->error(" Controller Class name should be file name! ");
					  }
				  }else{
					      $this->__404__(__CONTROLLER__.$controllerClassFile);
				  }
				 
		  }
		}
	}
	public function baseUrl(){ $baseController='';
		if(is_dir(__CONFIG__)){
			  if(file_exists(__CONFIG__.'config.php')){
				  require_once __CONFIG__.'config.php';
			  }
			  if(file_exists(__CONFIG__.'constant.php')){
				  require_once __CONFIG__.'constant.php';
			  }
			  if(file_exists(__CONFIG__.'database.php')){
				  require_once __CONFIG__.'database.php'; 
			  }
			  if(file_exists(__CONFIG__.'routes.php')){
				  require_once __CONFIG__.'routes.php';
				  global $defaultController;
				  $baseController = $defaultController;
			  }
		  }
		  if(self::home()){ 
			  
		  }else{ # NOT FOR HOME

			    	 $arrayController=array();
					 if(strpos($_SERVER['REQUEST_URI'],basename(getcwd()))!==false){
						 $explode = explode(basename(getcwd()).'/',$_SERVER['REQUEST_URI']);
						 $afterIndex = explode('/',$explode[1]);
						 if($afterIndex[0]=='index.php'){ unset($afterIndex[0]);}
					 } 
					 $arrayOfArgs = array('_class','_method','_args');
					 if(strpos($_SERVER['REQUEST_URI'],'index.php')!==false){
						 if(isset($afterIndex[1]) && $afterIndex[1]!=''){ 
						  $arrayController['_class'] = $afterIndex[1]; 
						 }
						 if(isset($afterIndex[2]) && $afterIndex[2]!=''){  
						  if(!preg_match('/[\'^£$%&*()}{@~?><>,|?=_+¬-]/', $afterIndex[2])){
								$arrayController['_method'] = $afterIndex[2];
							} 
						 }
						 if(isset($afterIndex[3]) && $afterIndex[3]!=''){  
							  unset($afterIndex[1],$afterIndex[2]); # Class , Method unset from args
							  foreach($afterIndex as $key=>$afterIndexVal){ 
							   if(isset($afterIndex[$key])){ if($afterIndex[$key]==''){ unset($afterIndex[$key]);} 
							   } 
							  }
							  $afterIndex = implode(',',$afterIndex);
							  $arrayController['_args'] = $afterIndex;
						 }
					 }else{
						 if(isset($afterIndex[0]) && $afterIndex[0]!=''){   
						  $arrayController['_class'] = $afterIndex[0];
						 }
						 if(isset($afterIndex[1]) && $afterIndex[1]!=''){
						   if(!preg_match('/[\'^£$%&*()}{@~?><>,|?=_+¬-]/', $afterIndex[1])){
								$arrayController['_method'] = $afterIndex[1];
							} 
						  
						 }
						 if(isset($afterIndex[2]) && $afterIndex[2]!=''){ 
							  unset($afterIndex[0],$afterIndex[1]); # Class , Method unset from args
							  foreach($afterIndex as $key=>$afterIndexVal){ 
							   if(isset($afterIndex[$key])){ if($afterIndex[$key]==''){ unset($afterIndex[$key]);} 
							   } 
							  }
							  $afterIndex = implode(',',$afterIndex);
							  $arrayController['_args'] = $afterIndex;
						 }
						 
		  			} #print_r($afterIndex);
			         $baseController = (object)$arrayController;
		            #$baseController = basename($_SERVER['REQUEST_URI']);
		  } return $baseController;
	}
	public function nthBaseUrl($num){
		$url = $_SERVER['REQUEST_URI'];
		$tokens = explode('/', $url);
		$which = sizeof($tokens)-$num;
		return trim($tokens[$which]);
	}
	public function home(){ $return = false;
		$requestUrl   = $_SERVER['REQUEST_URI'];
	   	$website_home = basename($requestUrl); 
		$query 		= parse_url($requestUrl);
		
		if(isset($query['query']) || strpos($requestUrl,'?')!==false){
			$exp = explode('?',$requestUrl); $website_home = $exp[0]; $website_home = basename($website_home); 
		}
	    $home = basename(getcwd());
		$home_ = 'index.php';
		if($website_home==$home or $website_home==$home_){
				$return = true;
		}
		return $return;
	}
} new settingController();
