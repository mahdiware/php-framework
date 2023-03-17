<?php

spl_autoload_register(function ($className){
    # -------------------------------------------
    # LOAD Library
    # -------------------------------------------
	$library =  __DIR__ . "/Library.php";
    if(file_exists($library)){
    	require_once $library;
    }
    
    # -------------------------------------------
    # LOAD Mahdiware
    # -------------------------------------------
    $System_autoload = System . str_replace('\\', '/', (str_replace('Mahdiware\\', '/', $className))).".php";
    if (file_exists($System_autoload)){
        require_once $System_autoload;
    }
    
    # -------------------------------------------
    # LOAD Application
    # -------------------------------------------
    $Views_autoload = str_replace('\\', '/', ($className)).".php";
    if(file_exists($Views_autoload)){
        require_once $Views_autoload;
    }
});
?>