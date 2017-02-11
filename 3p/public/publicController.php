<?php
if(!defined('p3')){ die("Access Denied!");}
class publicController{
	
	use mainController,sessionController,cookieController,filemanagerController; # PHP 5
	
} new publicController; # PUBLIC CONTRUCTOR HAS SESSION START() FUNCTION -::-