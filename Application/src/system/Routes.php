<?php

namespace Mahdiware;

class Routes
{
    private $Routes= array();
    
    public function set($type, $name, $direction){
        $data = [
            'type' => strtoupper($type),
            'name' => $name,
            'direction' => $direction,
        ];
        $this->$Routes[] = $data ;
    }
    public function get(){
    
        return $this->$Routes;
    }    
}