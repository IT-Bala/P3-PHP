<?php
// configuration 3p-void
define("p3","true");
// BASE OF 3P-PHP
#set_error_handler('getError');
require "3p-base.php";

function getError($number, $msg, $file, $line, $vars){
	   $error = debug_backtrace(); #var_dump($error);
	   $msg = '<pre><div style="margin:auto;"><p align="center">File : '.$error[0]['file'].'<br>';
	   $msg .= 'Line : '.$error[0]['line'].'<br>';
	   $msg .= 'Error : '.$error[0]['args'][1].'</div></p></pre>';
	   die($msg);
}