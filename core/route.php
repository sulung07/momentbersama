<?php

  class route{

      protected $controller = 'pagesController';
      protected $method     = 'index';
      protected $params     = [];

      public function  __construct(){

          /////// ORIGINAL //////
          if(isset($_GET['url'])){

              $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
              $pages = (explode("/",$path));
              $url = explode('/', filter_var(trim($_GET['url']), FILTER_SANITIZE_URL));
            
              $url[0]  = 'pagesController';

           }else{
              $url[0]  = 'pagesController';
           }

        
           if( file_exists('../core/controllers/'. $url[0] .'.php') ){
             $this->controller = $url[0];
           }else{
              return require_once '../core/views/error/404.php';
           }

           require_once '../core/controllers/'.  $this->controller .'.php';
           $this->controller = new $this->controller;

           if(isset($url[1])){
              if(method_exists($this->controller, $url[1])){
                  $this->method = $url[1];
               }
            }

            //var_dump(   $url = explode('/', filter_var(trim($_GET['url']), FILTER_SANITIZE_URL)) );

            unset($url[0]);
            unset($url[1]);

            if(isset($_GET['url']) || empty($_GET['url']))
            {


            if(isset($_GET['url']))
            {

               $get_url = $_GET['url'];

            }else{
               
               $get_url = "";

            }

            $pages = $url = explode('.', filter_var(trim($get_url), FILTER_SANITIZE_URL));
            $this->params = $pages;
            call_user_func_array([$this->controller, $this->method], $this->params);

            }


       } // __ Construct

   } // Class Route

 ?>
