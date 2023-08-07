<?php
class Models_guest_type extends controller {

    protected $connection;
    public function __construct($connection) {
       
        $db     = $connection->getConnection();
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
        typeID,
        type_name
       
        ";

        $table = "
        guest_type
        ";

        switch ($data[0]) {
            case 'get_all':
                return $this->database->get_data($select , $table , array("order_by" => "typeID ASC" , "return_type" => "all"));
                break;

            case 'by_id' :
                return $this->database->get_data($select , $table , array("where" => array("typeID" => $param[0]) , "return_type" => "single"));
                break;
            
            default:
                return;
                break;
        }

    }

}