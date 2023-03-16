<?php
namespace Mahdiware;
use Application\Controllers\Site;
use Application\Controllers;
use Application\Controllers\Routes as Router;
use Mahdiware\Routes;

class Mahdiware {
	public const VERSION = '4.2';
    private $ErrorPage; //ErrorPage
    private $Routes;
    private $data;
    private $action;
    private $classes;
    
    public function __construct() {
    	error_reporting(E_ERROR | E_WARNING);
    	ini_set('display_errors', false);
    	set_error_handler('myErrorHandler');
		set_exception_handler('exceptionHandler');
		
		
        $this->ErrorPage = new ErrorPage($this);
        $this->Routes = new Routes();
        $Router = new Router($this);
    }
    //fetching ErrorPage class
    function getErrorPage() {
        return $this->ErrorPage;
    }
    
    function isCurrentPage($name){
        if($this->action == $name or $this->action . "/" == $name){
            return true;
        }else {
            return false;
        }
    }
    function getRoutes(){
        return $this->Routes;
    }
    
    function run() {
        $array_action = [];
        $direction; $type; $_type;
        //getting all parameter e.g: http://example.com/?load=name
        $src = input_encode(filter_input(INPUT_GET, 'load'));
        
        $this->action = $this->getRequestUri();
        if($this->action == "/"){
        	$this->action = "";
        }
        
        foreach($this->Routes->get() as $name => $data){
        	$array_action[] = $data["name"];
            
            if($this->action == $data["name"]){
                $direction = explode("::", str_replace(" " , "", $data["direction"]));
                $type = $data["type"];
            }
        }
        
        if(!empty($_POST)){ 
        	$_type = "POST";
        }else{
        	$_type = "GET";
        }
        //in Storage Folder
        if(empty($src)){
			if(in_array($this->action, $array_action) && ($_type == $type || $type == "BOTH") && empty($src)){
                
                if (is_file(Controller . DIRECTORY_SEPARATOR . ucfirst($direction[0]) . '.php')) {
                    $controllerName = "Application\\Controllers\\" . $direction[0];
                    $activeController = new $controllerName($this);
                    $actionName = $direction[1];
                    if ($actionName != "") {
                        if (method_exists($activeController, ucfirst($actionName))) {
                            $activeController->{ucfirst($actionName)}();
                        } else {
                            $this->ErrorPage->Error404();
                        }
                    } else {
                        $activeController->Index();
                    }
                }
            }else{
                 $this->ErrorPage->Error404();
            }
        }else{
        	if(is_file(Storage . DIRECTORY_SEPARATOR . $src) && (!contains(".php", $src) && !contains(".htaccess", $src))){
        		$_source = array_pop(explode("/", $src));
        		
        		$extension = strtolower(pathinfo($_source, PATHINFO_EXTENSION));
        		
            	foreach(Extension() as $name => $content){
            		if($extension == $name){
            			header("Content-Type: " . $content);
            		}
            	}
            	header("Content-Disposition: inline; filename=\"".basename($_source)."\"");
        		
        		//header("Content-Disposition: inline; filename=\"".basename($_source)."\"");
        		$encode = binary_encode(file_get_contents(Storage . DIRECTORY_SEPARATOR . $src));
        		echo binary_decode($encode);
        	}else{
        		$this->ErrorPage->AccessDenied();
        	}
        }
        
    }
    
    function getRequestUri() {
	    $nh = preg_replace('#/\./#', '/', "/");
	    $nh = preg_replace('#^http[s]*://[^/]+/#i', '/', $nh);
	    $nh = preg_replace('#/[^/]+/\.\./#i', '/', $nh);
	    if (isset($_SERVER['HTTP_X_REQUEST_URI'])) {
		    $so = trim(urldecode($_SERVER['HTTP_X_REQUEST_URI']));
	    } else if (isset($_SERVER['REQUEST_URI'])) {
		    $so = trim(urldecode($_SERVER['REQUEST_URI']));
	    } else {
		    $so = '/';
	    }
	    if ($so == '/index.php' && !isset($_GET['route'])) $so = '/';
	    $so = preg_replace('#'.preg_quote($nh).'#i', '', $so, 1);
	    list($so) = explode('?', $so, 2);
	    return $so;
    }
}