<?php
class Models_user extends controller {

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
        user.userID , 
        user.companyID , 
        user.email , 
        user.password , 
        user.username , 
        user.status,
        user.level,
        
        company.company_name
        
        ";

        $table  = "user LEFT JOIN company ON user.companyID = company.companyID";

        switch ($data[0]) {
            
            case 'get_all' :    
                return $this->database->get_data($select , $table , array("order_by" => "user.companyID" , "return_type" => "all"));
            break;

            case 'by_id' :
                return $this->database->get_data($select , $table , array("where" => array("user.userID"  => $param[0]) , "return_type" => "single"));
                break;

            case 'by_company':
                return $this->database->get_data($select , $table , array("where" => array("user.companyID" => $param[0]) , "return_type" => "all"));
                break;

            case 'login_check' :
                return $this->database->get_data($select , $table , array("where" => array("user.email" => $param[0] , "user.password" => $param[1]), "return_type" => "single"));
                break;

            default:
                return;
                break;
        }
        
    }

}