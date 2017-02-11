<?php
# 3P-P3 SECURITY CONTROLLER
class securityController{ 
	# COMMON FILES
	public $dll_key;
	public function __construct(){ # Cache Check Before Generate DLL File
		$this->dll_key = '!@#$%^&*'; $args = func_get_args();  
		if(isset($args[0]) && $args[0]!=''){ $modelClass = $args[0];
			if(is_dir(__MODEL__)){ chmod(__MODEL__,777);
					  $modelFile = __MODEL__.$modelClass.'.php';
					  if(file_exists($modelFile)){
						  if(file_exists(__DLL__.$modelClass.'.dll')){
								if( (filemtime($modelFile) >= filemtime(__DLL__.$modelClass.'.dll'))){
										$this->php2dll($modelFile,$this->dll_key); # DLL CONVERTION #
								  }
						  }else{
							   $this->php2dll($modelFile,$this->dll_key);
						  }
					  }
			}
		}
	}
	public function unsetDll($className){ $dllFile = __DLL__.$className.'.dll';
		if(file_exists($dllFile)){
			unlink($dllFile);
		}
	}
	public function allModel2dll(){
		 if(is_dir(__MODEL__)){ chmod(__MODEL__,777);
				foreach (glob(__MODEL__."*.php") as $classFile){
					  if(file_exists($classFile)){
						$this->php2dll($classFile,$this->dll_key); # DLL CONVERTION #
					  }
				}
			}
	}
	public function strbin($str){ $code='';
	 for($i=0;$i<strlen($str);$i++){
	  $code.=str_pad(decbin(ord(substr($str,$i,1))) , 8,"0",STR_PAD_LEFT);
	 }
	 return $code;
	}

	public function binstr($str){ $code='';
	 for($i=0;$i<strlen($str);$i=$i+8){
	  $code .= chr(bindec(substr($str,$i,8)));
	 }
	 return $code;
	}  
	public function php2dll($file, $encryption_key){
		if(is_readable($file))
		$pure_string = file_get_contents($file);
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
		#return $encrypted_string;
		$className = basename($file);
		$file = __DLL__.$className;
		$file = str_replace('.php','.dll',$file);
		$dll_file = fopen($file, 'w');
		if(file_exists($file)){
			fwrite($dll_file,$encrypted_string);
		}
    }
	public function dll2php($file, $encryption_key){
	$encrypted_string = file_get_contents($file);
	
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
	// Dev__
    return $decrypted_string;
    }
	public function getClass(){ $arg = func_get_args(); #error_reporting(0);
	        $object = "Sorry file not found!";
			if($arg[0]!=''){ $class = $arg[0];
				$classFile = __DLL__.$class.'.dll';
				if(file_exists($classFile)){ 
				$dllClass = $this->dll2php($classFile,$this->dll_key);		
				eval("?>$dllClass");
				$object = new $class;				
				}
	       }
			return $object;
	}
}