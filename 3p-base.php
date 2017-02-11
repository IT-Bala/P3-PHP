<?php
// 3p-Base
#error_reporting(E_ERROR | E_WARNING | E_PARSE);
#error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(0);
# ob_start();
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler'); else ob_start();

if(!defined('p3')){ die("Access Denied!"); }
# APPLICATION DIRECTORIES #

$baseGetCwd = basename(getcwd());
if($_SERVER['HTTP_HOST']=='localhost') 
	$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$baseGetCwd.'/'; 
else
	$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/'; # LIVE SERVER

# BASE_URL Variable

require_once 'definer.php';

$ArrayUserModel = array(__MAIN__.'mainController.php',__SESSION__.'sessionController.php',__COOKIE__.'cookieController.php',__FILEMANAGER__.'filemanagerController.php',__PUBLIC__.'publicController.php'); # PHP 5

foreach($ArrayUserModel as $fileName){
	if(is_dir(__SESSION__) && file_exists($fileName)){ require_once $fileName;} # PHP 5 Logic
}


if(file_exists(__CONFIG__.'routes.php')) require_once __CONFIG__.'routes.php';


$setting = $system.'setting/';

# BEGIN SYSTEM DIRECTORIES #

# The Common Setting File should be alignable { Error, Action, Model, Controller }

$ArraySetting = array($setting.'settingError.php',$setting.'settingAction.php',$setting.'settingModel.php',$setting.'settingController.php');

# The Common Setting File should be alignable { Error, Action, Model, Controller }

foreach($ArraySetting as $fileName){
	if(is_dir($setting) && file_exists($fileName)){ require_once $fileName;  }
}

# END SYSTEM DIRECTORIES #
?>