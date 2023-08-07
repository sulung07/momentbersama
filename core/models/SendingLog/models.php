<?php
class Models_SendingLog extends controller {

    protected $connection;
    public function __construct($connection) {

        $db     = $connection->getConnection();
        $this->database = $connection;

    }


    public function get($data = [])
    {

        if(isset($data[1]))
        {
            $param      = $data[1];
            $companyID  = $param[0];

        }else{

            $param      = null;
            $companyID  = null;
        }

       
        // get company data 

        $company   = $this->getData("company")->get(array("by_id" , array($companyID)));
        
        if(!empty($company))
        {
            
            $rootDir = $company['rootdir'];

        }else{
            
            $rootDir = "";

        }

        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$rootDir/$rootDir.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $select = "
        LogID,
        REFID,
        SEND_TYPE,
        XML_PATH,
        SEND_DATE,
        RES
        ";

        $select_count = "COUNT(LogID) as jmldata";

        $table  = "SendingLog";

        switch ($data[0]) {

            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("order_by" => 'LogID DESC' , "return_type" => "all" ));
                break;

            case 'by_id' :
                return $sqlite_conn->get_data($dbName , $select , $table, array("where" => array("LogID" => $param[1]) , "return_type" => "single"));
                break;
            
            case 'by_type_reff' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("SEND_TYPE" => $param[1] , "REFID" => $param[2]) , "order_by" => "LogID DESC" , "return_type" => "all"));
                break;

            case 'by_type_last' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("SEND_TYPE" => $param[1]) , "order_by" => "LogID DESC" , "return_type" => "single"));
                break;

            case 'count_by_type' :
                return $sqlite_conn->get_data($dbName , $select_count , $table , array("where" => array("SEND_TYPE" => $param[1]) , "return_type" => "single"));
                break;

            default:
                return;
                break;
        }


    }


    }
