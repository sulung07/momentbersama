<?php
class Models_company extends controller {

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
        companyID,
        company_name,
        company_logo,
        company_status,
        rootdir
        ";

        $table = "
        company
        ";

        switch ($data[0]) {
            case 'get_all':
                return $this->database->get_data($select , $table , array("order_by" => "companyID DESC" , "return_type" => "all"));
                break;

            case 'by_company':
                return $this->database->get_data($select , $table , array("where" => array("companyID"  => $param[0]) , "return_type" => "all"));
                break;

            case 'by_id' :
                return $this->database->get_data($select , $table , array("where" => array("companyID" => $param[0]) , "return_type" => "single"));
                break;

            case 'by_status' :
                return $this->database->get_data($select , $table , array("where" => array("status" => $param[0]) , "order_by" => "companyID DESC" , "return_type" => "all"));
                break;
            
            default:
                return;
                break;
        }

    }

}