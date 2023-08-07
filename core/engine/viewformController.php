<?php 

   class viewformController extends controller {

        public function formcontrol($class_controller , $location , $base){

            $function = $this->get_function; $get_value = $this->get_value;            

            if($function == ""){ $get_function = "index"; }else{ $get_function="$function"; }
             
            return $this->viewForm($class_controller , $location , $base )->$get_function($get_value);

        }

   } 

?>