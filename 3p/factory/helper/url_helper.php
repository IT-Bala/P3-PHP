<?php
# Helper
function base_url(){
	$baseGetCwd = basename(getcwd());
	if(isset($GLOBALS['CONFIG']['BASE_URL']) && $GLOBALS['CONFIG']['BASE_URL']!=''){
		$base_url = $GLOBALS['CONFIG']['BASE_URL'];
	}else{
		if($_SERVER['HTTP_HOST']=='localhost' or $_SERVER['HTTP_HOST']=='::') 
			$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$baseGetCwd.'/'; 
		else
			$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/'; # LIVE SERVER 
	}
	return $base_url;
}
