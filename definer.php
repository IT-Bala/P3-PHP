<?
$application = __DIR__.'/app/';
# BEGIN SYSTEM DIRECTORIES #
$system = __DIR__.'/3p/';
# SYSTEM PATH #

$controller = $application.'controller/';

$model = $application.'model/';

$helper 	   = $application.'factory/helper/';
$built_helper = $system.'factory/helper/';

$library = $application.'factory/library/';
$built_library= $system.'factory/library/';

$config = $application.'config/';

$html = $application.'html/';

$cache = $application.'cache/';

define('BASE_URL',$base_url);
define('__APP__',$application);
define('__CONTROLLER__',$controller);
define('__MODEL__',$model);
define('__HELPER__',$helper);
define('__S_HELPER__',$built_helper);
define('__LIBRARY__',$library);
define('__S_LIBRARY__',$built_library);
define('__CONFIG__',$config);
define('__HTML__',$html); # 
define('__CACHE__',$cache);
# SYSTEM COMMON #
$session = $system.'session/';

$cookie = $system.'cookie/';

$filemanager = $system.'filemanager/';

$protected = $system.'protected/';

$public = $system.'public/';

$private = $system.'private/';

$void = $system.'void/';

$main = $system.'main/';


define('__SESSION__',$session);
define('__COOKIE__',$cookie);
define('__FILEMANAGER__',$filemanager);
define('__PUBLIC__',$public);
define('__MAIN__',$main);

# ERROR DIRECTORIES #
define('__404__','<strong>Error</strong>: 404 file not found!');
# ERROR DIRECTORIES #


# DATABASE DEFINER #
$database = $system.'database/';
define('__DATABASE__',$database);

$security = $system.'security/';

$dllPath = $system.'security/dll/';

define('__DLL__',$dllPath);

define('DLL','true'); 				# Default will be false. TO CODE SECURITY PURPOSE SET AS { TRUE }

define('__SECURITY__',$security);
?>
