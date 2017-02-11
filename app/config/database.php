<?php
if(!defined('p3')){ die("Access Denied!");}
# DATABASE CONNECTION #

$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = '3p-php';

# DATABASE CONNECTION #
# YOU CAN ACTIVE 2 MORE DB DRIVER AT THE SAME TIME -::-
# MYSQL is Deprecated Don't Use it Please
$GLOBALS['defaultDatabase'] = array(
									'mysqli'=>array('connection'=>'true','database'=>$DATABASE,'hostname'=>$HOSTNAME,'username'=>$USERNAME,'password'=>$PASSWORD),
									#'pdo'=>array('connection'=>'true','database'=>$DATABASE,'hostname'=>$HOSTNAME,'username'=>$USERNAME,'password'=>$PASSWORD),
            				);
