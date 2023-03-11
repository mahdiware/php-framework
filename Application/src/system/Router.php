<?php
namespace Mahdiware;

abstract class Router {
    var $activity;
    
    public function __construct($activity){
        $this->activity = $activity;
    }
    
    function set($type, $name, $direction){
    	if($name == "/")
    		$name = "";
        $this->activity->getRoutes()->set($type, $name, $direction); 
    } 
     
    function get(){
        return $this->activity->getRoutes()->get();
    } 


}