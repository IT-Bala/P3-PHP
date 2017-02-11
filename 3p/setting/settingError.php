<?php
if(!defined('p3')){ die("Access Denied!");}
class settingError extends publicController{
	public $frameWork = '<h2>[ -:WLT:- ]</h2>';
	public $errorTableStyle = 'width:50%; text-align:center;';
	protected function error(){ $arg = func_get_args();
	    $errorText = (isset($arg[0]))?$arg[0]:'';
		$errorText = '<table align="center" style="'.$this->errorTableStyle.'"><tr><td style="background:#F2DEDE; padding:15px; color:#a94442;border-color: #ebccd1;">'.$this->frameWork.'<strong>Error</strong>: '.$errorText.'</td></tr></table>';
		die($errorText);
	}
	protected function warning(){ $arg = func_get_args();
	    $errorText = (isset($arg[0]))?$arg[0]:'';
		$errorText = '<table align="center" style="'.$this->errorTableStyle.'"><tr><td style="background:#fcf8e3; padding:15px; color:#8a6d3b;border-color: #faebcc;">'.$this->frameWork.'<strong>Warning</strong>: '.$errorText.'</td></tr></table>';
		echo $errorText;
	}
	protected function success(){ $arg = func_get_args();
	    $errorText = (isset($arg[0]))?$arg[0]:'';
		$errorText = '<table align="center" style="'.$this->errorTableStyle.'"><tr><td style="background:#dff0d8; padding:15px; color:#3c763d;border-color: #d6e9c6;">'.$this->frameWork.'<strong>Success</strong>: '.$errorText.'</td></tr></table>';
		echo $errorText;
	}
	protected function info(){ $arg = func_get_args();
	    $errorText = (isset($arg[0]))?$arg[0]:'';
		$errorText = '<table align="center" style="'.$this->errorTableStyle.'"><tr><td style="background:#d9edf7; padding:15px; color:#31708f;border-color: #bce8f1;">'.$this->frameWork.'<strong>Information</strong>: '.$errorText.'</td></tr></table>';
		echo $errorText;
	}
	protected function __404__(){ $arg = func_get_args();
	    $errorText = (isset($arg[0]))?'<br> <strong>File</strong> &nbsp;&nbsp;: '.$arg[0]:'';
	    return $this->error("404 File not found !".$errorText);
	}
} 