<?php
class Models_event_info extends controller {

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
        eiID,
        eventID,
        groom_name,
        groom_desc,
        bride_name,
        bride_desc,
        groom_pic,
        bride_pic,
        event_date
        ";

        $select_count = "COUNT(eiID) as jmldata";

        $table  = "event_info";

        switch ($data[0]) {

            case 'by_event' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("return_type" => "single"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
