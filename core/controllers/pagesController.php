<?php
  class pagesController extends controller{

    public function index($link , $value = []){

      $getpages = explode('/', filter_var(trim($link), FILTER_SANITIZE_URL));
      $pages    = $getpages[0];
      $root     = "public";

      if(isset($getpages['1'])){ $view = $getpages['1']; }else{ $view = ""; }
      if(isset($getpages['2'])){ $data = $getpages['2']; }else{ $data = ""; }

      if($pages == 'gate'){
        return $this->view("pages/$root/gate/content" , $pages , "" , "$view" , "$data"); 
      }else{

        return $this->view("pages/$root/home/content" , $pages , ""); 


      }
   
      
    }

  } 
 ?>
