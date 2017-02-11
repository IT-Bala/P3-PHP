<?php
if(!defined('p3')){ die("Access Denied!");}
class WLT_Controller extends settingError{
	public $data = array(); public $db; public $defaultTheme,$defaultController;
	public function __construct(){
		#if(defined('__DBGLOBAL__') && __DBGLOBAL__=='true')
		if(isset($GLOBALS['CONFIG']['__DBGLOBAL__']) && $GLOBALS['CONFIG']['__DBGLOBAL__']=='true'){	
			$this->db = $this->setDatabase();
		}
		global $defaultTheme,$defaultController;
		$this->defaultTheme = $defaultTheme;
		$this->defaultController = $defaultController;
	}
	protected function end(){exit();}
	protected function setHtml(){ $args = func_get_args();
	    if(count($args)!=0){ $htmlFile = $args[0];
			if(count($args)==2){
				if($args[1]!=NULL){
					$this->data = $args[1]; extract($this->data);
				}
			}
			if(is_dir(__HTML__)){ global $defaultTheme;
			 	/*$phtmlFile = __HTML__.$defaultTheme.'/'.$htmlFile.'.phtml';		 # ORIGINAL
				$cacheOutputFile = __CACHE__.$defaultTheme.'/'.$htmlFile.'.html';# CACHE
			    if(!is_dir(__CACHE__)){ 
					$cacheMask = umask(0);
					mkdir(__APP__."cache", 0777);
					umask($cacheMask);
				}
			 	if(is_dir(__CACHE__)){
					if(!is_dir(__CACHE__.$defaultTheme)){
						$cacheThemeMask = umask(0);
						mkdir(__CACHE__.$defaultTheme, 0777);
						umask($cacheThemeMask);
					}
					if(is_dir(__CACHE__.$defaultTheme)){
						   if(strpos($htmlFile,'/')!==false){ # CRAETE THEME CACHE FOLDERS
							   $sectionExplode = explode('/',$htmlFile);
							   array_pop($sectionExplode);
							   chdir(__CACHE__.$defaultTheme);
							   foreach($sectionExplode as $subFolders){
									 if(!is_dir($subFolders)){  
										mkdir($subFolders);									 
									 } chdir($subFolders);
						   	   }
						   }
						   
						  if(file_exists($phtmlFile)){
						   # FILE MODIFIED TIME COMPARISON
						   if(!file_exists($cacheOutputFile) or (filemtime($phtmlFile) >= filemtime($cacheOutputFile)) ){
								#echo 'Original DATA Load';
								ob_start();
								if(file_exists($phtmlFile)){
									include_once $phtmlFile; # Browser Bufferring data
								}
								$htmlOutputContents = ob_get_contents();							
								ob_end_clean();
								# WRITE CACHE FILE
								$cacheFile = fopen($cacheOutputFile, 'w');
								if(file_exists($cacheOutputFile)){
								 fwrite($cacheFile,$htmlOutputContents);
								}
						   }else{ # FILE MODIFIED OPERATION
						   # MATCH BUFFER CONTENTS AND EXISTING CACHE CONTENT
						    #echo 'Cache DATA Load';
						    ob_start();
							if(file_exists($phtmlFile)){
								include_once $phtmlFile; # Browser Bufferring data
							}
							$htmlOutputContents = ob_get_contents();
							$cacheContents = file_get_contents($cacheOutputFile);		
							ob_end_clean();
							if (strcmp($htmlOutputContents, $cacheContents) !== 0){
								# START TO OVERWRITTE CONTENTS
								$cacheFile = fopen($cacheOutputFile, 'w');
								if(file_exists($cacheOutputFile)){
								 fwrite($cacheFile,$htmlOutputContents);
								}
							}
						   }
						   # MATCH BUFFER CONTENTS AND EXISTING CACHE CONTENT
						}else{
							$this->warning("'".$phtmlFile."' File does not exist!");
						}
					} 
				} 
			 if(file_exists($cacheOutputFile)){ # RETURN CACHE OUTPUT
			 	require_once $cacheOutputFile;
			 }else{ $this->warning("'".$phtmlFile."' File does not exist!"); }*/
			 $phtmlFile = __HTML__.$defaultTheme.'/'.$htmlFile.'.phtml';		 # ORIGINAL
			 if(file_exists($phtmlFile)){
			 	require_once $phtmlFile;
			 }else{ $this->warning("'".$phtmlFile."' File does not exist!"); }
			 
			}else{  $this->error(__HTML__." Path does not set!"); }
		}else{
			# Error
			$this->warning("'".$phtmlFile."' File does not exist!");
		} return $this;
	}
	protected function setModel(){ $args = func_get_args();
	    if(count($args)!=0){ $modelClass = $args[0];
			if(count($args)==2){
				if($args[1]!=NULL){
					$this->data = $args[1]; extract($this->data);
				}
			} 
			if(defined(DLL) && DLL=='true'){ # Secure Dll Method Class
				if(is_dir(__SECURITY__)){ 
					 if(file_exists(__SECURITY__.'securityController.php')){
						 require_once __SECURITY__.'securityController.php';
						 $objectDLL = new securityController($modelClass);
						 $modelObject = $objectDLL->getClass($modelClass);
						 if(class_exists($modelClass)){
							 if(!is_subclass_of($modelObject,'WLT_Model')){
								 $this->error("Model '".$modelClass."' should be extends WLT_Model class !");
							 }
							}else{
								$this->error("Model '".$modelClass."' class name should be file name!");
							}
					 }
					 
				}
			}else{ # Normal Method Class
			
				if(is_dir(__MODEL__)){ global $defaultTheme;
				 $modelClassFile = __MODEL__.$modelClass.'.php';
				 if(file_exists($modelClassFile)){
					require_once $modelClassFile; 
					if(class_exists($modelClass)){ $modelObject = new $modelClass;
					 if(!is_subclass_of($modelObject,'WLT_Model')){
						 $this->error("Model '".$modelClass."' should be extends WLT_Model class !");
					 }
					}else{
						$this->error("Model '".$modelClass."' class name should be file name!");
					}
				 }else{ $this->error("Model '".$modelClassFile."' file does not exist!"); }
				}else{  $this->error("__MODEL__ Path does not set!"); }
		  	  }
			
			
		} return $modelObject; # return Model Object
	}
	protected function setJs(){ $args = func_get_args(); $script='';
	    if(count($args)!=0){ $js = $args[0];
			
			if(is_dir(__HTML__)){ global $defaultTheme;
			 if(count($args)>1){
				foreach($args as $js){
					 $jsDirFile = __HTML__.$defaultTheme.'/js/'.$js;
					 $jsFile = BASE_URL.'app/html/'.$defaultTheme.'/js/'.$js;
					 if(file_exists($jsDirFile)){
						$script = '<script src="'.$jsFile.'" type="application/javascript"></script>';
					 }else{ $this->warning("'".$jsFile."' Js file does not exist!"); }
				}
			  }else{
				     $jsDirFile = __HTML__.$defaultTheme.'/js/'.$js;
					 $jsFile = BASE_URL.'app/html/'.$defaultTheme.'/js/'.$js;
					 if(file_exists($jsDirFile)){
						$script = '<script src="'.$jsFile.'" type="application/javascript"></script>';
					 }else{ $this->warning("'".$jsFile."' Js file does not exist!"); }
			  }
			 
			}
		} return $script; # return Model Object
	}
	protected function setCss(){ $args = func_get_args(); $css='';
	    if(count($args)!=0){ $css = $args[0];
			
			if(is_dir(__HTML__)){ global $defaultTheme;
				 if(count($args)>1){
					foreach($args as $css){
						 $cssDirFile = __HTML__.$defaultTheme.'/css/'.$css;
						 $cssFile = BASE_URL.'app/html/'.$defaultTheme.'/css/'.$css; 
						 if(file_exists($cssDirFile)){
							$css = '<link href="'.$cssFile.'" rel="stylesheet" type="text/css">';
						 }else{ $this->warning("'".$cssFile."' css file does not exist!"); }
					}
				  }else{
						 $cssDirFile = __HTML__.$defaultTheme.'/css/'.$css;
						 $cssFile = BASE_URL.'app/html/'.$defaultTheme.'/css/'.$css;
						 if(file_exists($cssDirFile)){
							$css = '<link href="'.$cssFile.'" rel="stylesheet" type="text/css"></script>';
						 }else{ $this->warning("'".$cssFile."' css file does not exist!"); }
				  }
			 }
		} return $css; # return Model Object
	}
	protected function setImageSrc(){ $args = func_get_args(); $src='';
	    if(count($args)!=0){ $src = $args[0];
			
			if(is_dir(__HTML__)){ global $defaultTheme;
				 
					 $imgDirFile = __HTML__.$defaultTheme.'/images/'.$src;
					 $imgFile = BASE_URL.'app/html/'.$defaultTheme.'/images/'.$src;
					 if(file_exists($imgDirFile)){
						$src = $imgFile;
					 }else{ $this->warning("'".$cssFile."' src file does not exist!"); }
				  
			 }
		} return $src; # return Model Object
	}
	protected function setImage(){ $args = func_get_args(); $img='';
	    if(count($args)!=0){ $img = (isset($args[0]))?$args[0]:'';
			
			if(is_dir(__HTML__)){ global $defaultTheme;
				 if(count($args)>1){  $imgWidth = (isset($args[1]))?(int)$args[1]:'100'; $imgHeight = (isset($args[2]))?(int)$args[2]:'100';
						 $imgDirFile = __HTML__.$defaultTheme.'/images/'.$img;
						 $imgFile = BASE_URL.'app/html/'.$defaultTheme.'/images/'.$img; 
						 if(file_exists($imgDirFile)){
							$img = '<img src="'.$imgFile.'" width="'.$imgWidth.'" height="'.$imgHeight.'">';
						 }else{ $this->warning("'".$imgFile."' image file does not exist!"); }
				  }else{
						 $imgDirFile = __HTML__.$defaultTheme.'/images/'.$img;
						 $imgFile = BASE_URL.'app/html/'.$defaultTheme.'/images/'.$img;
						 if(file_exists($imgDirFile)){
							$img = '<img src="'.$imgFile.'">';
						 }else{ $this->warning("'".$imgFile."' image file does not exist!"); }
				  }
			 }
		} return $img; # return Model Object
	}
	protected function themePath(){ $themePath = '';
			
			if(is_dir(__HTML__)){ global $defaultTheme;
				 
					 $themeDirFile = __HTML__.$defaultTheme.'/';
					 $themeDir = BASE_URL.'app/html/'.$defaultTheme.'/';
					 if(file_exists($themeDirFile)){
						$themePath = $themeDir;
					 }else{ $this->warning("'".$themeDirFile."' could not find!"); }
				  
			 }
		 	return $themePath; # return Model Object
	}
	protected function themeBase(){ $themePath = '';
			
			if(is_dir(__HTML__)){ global $defaultTheme;
				 
					 $themeDirFile = __HTML__.$defaultTheme.'/';
					 $themeDir = BASE_URL.'app/html/'.$defaultTheme.'/';
					 if(file_exists($themeDirFile)){
						$themePath = $themeDir;
					 }else{ $this->warning("'".$themeDirFile."' could not find!"); }
				  
			 }
		 	return $themePath; # return Model Object
	}
	protected function basePath(){ $themePath = '';
			
			if(is_dir(__HTML__)){ global $defaultTheme;
				 
					 $themeDirFile = __HTML__.$defaultTheme.'/';
					 $themeDir = BASE_URL.'app/html/'.$defaultTheme.'/';
					 if(file_exists($themeDirFile)){
						$themePath = $themeDir;
					 }else{ $this->warning("'".$themeDirFile."' could not find!"); }
				  
			 }
		 	return $themePath; # return Model Object
	}
	protected function baseUrl(){ $basePath = '';			
			if(defined('BASE_URL')){
				 	 $basePath = BASE_URL;
				  
			 }else{ $this->warning("Base url could not find!"); }
		 	return $basePath; # return Model Object
	}
	protected function base_url(){ $basePath = '';			
			if(defined('BASE_URL')){
				 	 $basePath = BASE_URL;
				  
			 }else{ $this->warning("Base url could not find!"); }
		 	return $basePath; # return Model Object
	}
	# DATABASE
	protected function setDatabase(){ global $defaultDatabase; $controller = 'Controller'; $error=$dbObject='';
	    if(defined('__DATABASE__')){
			if(isset($defaultDatabase)){
				foreach($defaultDatabase as $driver=>$DB){ 
					$driverPath = __DATABASE__.$driver.'/'.$driver;
						if($driver=='mysql'):
									if($DB['connection']=='true'){
									require_once $driverPath.$controller.'.php';
									$mysql = new mysqlController($DB); # Return DB Object
									$dbObject = $mysql->dbConnection();
									
									}
						endif;
						if($driver=='mysqli'):
									if($DB['connection']=='true'){ 
									require_once $driverPath.$controller.'.php';
									$mysqli = new mysqliController($DB); # Return DB Object
									$dbObject = $mysqli->dbConnection();
									}
						endif;
						if($driver=='pdo'):
									if($DB['connection']=='true'){
									require_once $driverPath.$controller.'.php';
									$pdo = new pdoController($DB); # Return DB Object
									$dbObject = $pdo->dbConnection();
									}
						endif;
				}
			}
		}else{ $this->error('Database driver path problem!'); }
		return $dbObject; # Return DB Object
	}
	# HELPER & LIBRARY
	protected function setHelper(){
		$args = func_get_args();
	    if(count($args)!=0){ $helperName = $args[0];			
			if(is_dir(__HELPER__)){			
			 $helperFile = __HELPER__.$helperName.'_helper.php';
			 $sHelperFile = __S_HELPER__.$helperName.'_helper.php';
			 if(file_exists($sHelperFile)){
				require_once $sHelperFile;  
			 }elseif(file_exists($helperFile)){
				require_once $helperFile;
			 }else{ $this->error("Helper '".$helperName."' does not exist!"); }
			}else{  $this->error("__HELPER__ Path does not set!"); }
		  }
	}
	
	protected function setLibrary(){
		$args = func_get_args();
	    if(count($args)!=0){ $libraryName = $args[0];			
			if(is_dir(__LIBRARY__)){ 
			 $sLibraryFile = __S_LIBRARY__.$libraryName.'.php';
			 $libraryFile = __LIBRARY__.$libraryName.'.php';
			 if(file_exists($sLibraryFile)){ 
				require_once $sLibraryFile;
				if(class_exists($libraryName)){ 
					$libraryObject = new $libraryName;
				}
			 }elseif(file_exists($libraryFile)){ 
				require_once $libraryFile;
				if(class_exists($libraryName)){ 
					$libraryObject = new $libraryName;
				}
			 }else{ $this->error("Library '".$libraryName."' does not exist!"); }
			}else{  $this->error("__LIBRARY__ Path does not set!"); }
		  }
		return $libraryObject;
	}
	
	# CACHE FUNCTIONS
	protected function unsetCache(){ $args = func_get_args();
		if(isset($args[0]) && $args[0]!=''){
			if(file_exists(__CACHE__.$this->defaultTheme.'/'.$args[0].'html')){
			unlink(__CACHE__.$this->defaultTheme.'/'.$args[0].'html');
			}
		}else{ $this->warning('Choose your cahce file !'); }
	}
	protected function clearCache(){ $args = func_get_args();
		if(isset($args[0]) && $args[0]!=''){
			if(file_exists(__CACHE__.$this->defaultTheme.'/'.$args[0].'html')){
			unlink(__CACHE__.$this->defaultTheme.'/'.$args[0].'html');
			}
		}else{ $this->warning('Choose your cahce file !'); }
	}
	protected function clearAllCache(){ $args = func_get_args();
		if(isset($args[0]) && $args[0]!=''){
			if(file_exists(__CACHE__.$this->defaultTheme.'/'.$args[0].'html')){
			unlink(__CACHE__.$this->defaultTheme.'/'.$args[0].'html');
			}
		}else{ $this->warning('Choose your cahce file !'); }
	}
} 