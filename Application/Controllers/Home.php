<?php
namespace Application\Controllers;
use Mahdiware\Controller;
use Mahdiware\Routes;
use Application\Libraries\TestLib;

class Home extends Controller {

    function Index() { 
    
        $content = [
        	"title" => "Welcome To Mahdiware",
        ];
        $this->view("index", $content);
        
        #	you can test in library function!
   	 	# 	echo TestLib::Test();
    	
    }
}