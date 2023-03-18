<?php
namespace Application\Controllers;
use Mahdiware\Controller;
use Mahdiware\Routes;
use Application\Libraries\TestLib;

class Example extends Controller {

    function Index() {           
        $content = [
        	"title" => "Welcome To Mahdiware",
        ];
        $this->view("--Name--", $content);
        //Design it yourself
    }
}