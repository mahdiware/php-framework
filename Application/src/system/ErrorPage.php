<?php
namespace Mahdiware;

class ErrorPage extends Controller {
	
	//not found
    function Error404() {
    	$content = [
        	"title" => "Page Not Found!",
        ];
        $this->view("errors/error404", $content);
    }
	//forbidden
    function AccessDenied() {
        $this->private = false;
        
        $content = [
        	"title" => "Access Denied!",
        ];
        $this->view("errors/accessDenied", $content);
    }
}