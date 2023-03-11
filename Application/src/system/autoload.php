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
    $System_autoload = __DIR__.str_replace('\\', '/', (str_replace('Mahdiware\\', '/', $className))).".php";
    if (file_exists($System_autoload)){
        require_once $System_autoload;
    }
    // echo  $System_autoload;
    
    # -------------------------------------------
    # LOAD Application
    # -------------------------------------------
    $Application_autoload = PATH . str_replace('\\', '/', ($className)).".php";
    
    if(file_exists($Application_autoload)){
        require_once $Application_autoload;
    }
    
    # -------------------------------------------
    # LOAD Views
    # -------------------------------------------
    $Views_autoload = $Os->ViewsPath . str_replace('\\', '/', ($className)).".php";
    
    if(file_exists($Views_autoload)){
        require_once $Views_autoload;
    }
    // echo  $Views_autoload;

});
?>