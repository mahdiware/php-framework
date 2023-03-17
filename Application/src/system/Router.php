<?php
namespace Mahdiware;

class Router
{
    protected static $Routes= [];
    
    public static function set($type, $name, $direction){
    	if($name == "/") $name = "";
        $data = [
            'type' => strtoupper($type),
            'name' => $name,
            'direction' => $direction,
        ];
        static::$Routes[] = $data ;
    }
    public static function get(){
    
        return static::$Routes;
    }
}