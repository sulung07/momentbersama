<?php
class Models_event_category extends controller {

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
        categoryID , category_name, status
        ";

        $table  = "event_category";

        switch ($data[0]) {

            case 'get_all' :
                return $this->database->get_data($select , $table , array("order_by" => "categoryID ASC" , "return_type" => "all"));
                break;

            case 'by_categoryID' :
                return $this->database->get_data($select , $table , array("where" => array("cateogryID" => $param[0]) , "return_type" => "single"));
                break;
            
            default:
                return;
                break;
        }
        
    }

}