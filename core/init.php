<?php

spl_autoload_register(function($class){

  $rootDir = "../";


  if( file_exists(''.$rootDir.'/core/'.$class.'.php') ){
     require_once ''.$rootDir.'/core/'.$class.'.php';
  }
  
  elseif( file_exists (''.$rootDir.'/core/engine/'.$class.'.php')){
    require_once ''.$rootDir.'/core/engine/'.$class.'.php';
  }
  
  elseif(file_exists(''.$rootDir.'/core/form/'.$class.'.php')) {
    require_once ''.$rootDir.'/core/form/'.$class.'.php';
  }
  
  elseif(file_exists(''.$rootDir.'/core/config/'.$class.'.php')) {
    require_once ''.$rootDir.'/core/config/'.$class.'.php';
  }
  
});

?>
