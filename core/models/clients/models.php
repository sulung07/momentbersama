<?php
class Models_clients extends controller {

    protected $connection;

    public function __construct($connection) {
       
        $db = $connection->getConnection();
        $this->database = $connection;

    }


    public function get($data = [])
    {
        if(isset($data[1]))
        {

            $param = $data[1];

        }else{

            $param = "";
        }
        
       
        $select = "
        clientID , parentID ,  tokenID , client_name , client_email , client_phone , client_password , client_status
        
        ";

        $table  = "clients";

        switch ($data[0]) {
            
            case 'get_all' :    
                return $this->database->get_data($select , $table , array("order_by" => "clientID" , "return_type" => "all"));
            break;

            case 'by_id' :
                return $this->database->get_data($select , $table , array("where" => array("clientID"  => $param[0]) , "return_type" => "single"));
                break;

            case 'by_parentID' :
                return $this->database->get_data($select , $table , array("where" => array("parentID" => $param[0]) , "return_type" => "all"));
                break;  

            case 'login_check' :
                return $this->database->get_data($select , $table , array("where" => array("client_email" => $param[0] , "client_password" => $param[1]), "return_type" => "single"));
                break;

            case 'by_mail' :
                return $this->database->get_data($select , $table , array("where" => array("client_email" => $param[0]) ,  "return_type" => "single"));
                break;

            default:
                return;
                break;
        }
        
    }

}