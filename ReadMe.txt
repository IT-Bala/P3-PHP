PHP MVC DLL

i. Major thing is dynamic DLL model is generating this framework. After done your code you can remove your model folder from app folder.

It will work from dynamic language library.

ii. it is very easiest MVC Framework any one can download and use it. iii. We can create a custom helpers and library file on it. iv. Please read the ReadMe.txt file that is inside of the zip file

Go to => app folder

app/controller Create a controller like : demoController.php and class should be file name.

Example :

class demoController extends WLT_Controller{ public function index(){ echo "Demo is running..."; } public function test(){ echo "test is runngin.." } }

Run it. : http://locahost/demo/ AND http://locahost/demo/test

To load view file :

app/html/{Theme folder}/ app/html/default/index.phtml

Call : $this->setHtml('index');

To load Modal :

app/model/

$obj = $this->setModal(ModalName);

$obj->method();

To connect Database

$db = $this->setDatabase();

$sql = $db->query("");

session ,cookie,filemanager lot of extension is there we can use it.

it's V.0.01

-:)

Caching system is ongoing....

Memcache & redis.