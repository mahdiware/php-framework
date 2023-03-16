<?php
namespace Application\Controllers;
use Mahdiware\Router;

class Routes extends Router {
    public function __construct($activity){
        parent::__construct($activity);
        #####################
        
        $this->set("BOTH","/","Home::Index");
        $this->set("BOTH","a/b/c","Home::Index");
        //POST    -> can only be seen by the person who enter post request on the page 
        //GET     -> can be seen other request only POST
        //BOTH   -> can be seen all request
    }
}