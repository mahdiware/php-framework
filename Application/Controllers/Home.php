<?php
namespace Application\Controllers;
use Mahdiware\Controller;
use Mahdiware\Routes;
use Mahdiware\Session;
use Application\Libraries\TestLib;

class Home extends Controller {

    function Index() { 

    	// Check if the session variable "visited" is null
    	if(Session::get("visited") == null){
    		Session::set("visited", 1); // If so, set it to 1
    	}else{
    		Session::set("visited", 1+(Session::get("visited"))); // If not, increment the value of "visited"
    	}

        $content = [
        	"title" => "Welcome To Mahdiware",
        	"visited" => Session::get("visited"),
        ];
        $this->view("index", $content);
        
        #	you can test in library function!
   	 	# 	echo TestLib::Test();
    	
    }
}
