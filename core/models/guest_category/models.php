<?php
class Models_guest_category extends controller {

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
            $eventID    = $param[0];
        }else{

            $param      = null;
            $eventID    = null;
        }

       
   

        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $select = "
        guestCatID,
        guest_cat_name
        ";

        $select_count = "COUNT(guestCatID) as jmldata";

        $table  = "guest_category";

        switch ($data[0]) {

            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("return_type" => "all"));
                break;

            case 'by_id' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("guestCatID" => $param[1]) , "return_type" => "single"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
