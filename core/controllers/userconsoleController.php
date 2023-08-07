<?php
  class userconsoleController extends controller{

    public function index($link , $value = []){

      $getpages = explode('/', filter_var(trim($link), FILTER_SANITIZE_URL));
      $pages = $getpages[0];
      $root = "user-console";
      if(isset($getpages['1'])){ $view = $getpages['1']; }else{ $view = ""; }
      if(isset($getpages['2'])){ $data = $getpages['2']; }else{ $data = ""; }
      if($pages == ''){ return $this->view('pages/user-console/events/content' , $pages); }
      else{ return $this->view("pages/$root/$pages/content" , $pages , '' , $view , $data); }
      
    }

  } 
 ?>
