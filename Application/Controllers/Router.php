<?php
namespace Application\Controllers;
use Mahdiware\Router;


Router::set("BOTH","/","Home::Index");
Router::set("BOTH","a/b/c","Home::Index");
