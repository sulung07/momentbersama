<?php
class Models_log_invitation extends controller {

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
        log.logID, 
        log.guestID ,
        log.open_invitation_date,
        log.open_invitation_time,

        guest.guest_name
        ";

        $select_count = "COUNT(logID) as jmldata";

        $table  = "log_invitation as log 
        LEFT JOIN guest ON log.guestID = guest.guestID";

        switch ($data[0]) {

            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("order_by" => "logID DESC" , "return_type" => "all"));
                break;

            case 'count_all' :
                return $sqlite_conn->get_data($dbName , $select_count , $table , array("return_type" => "single"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
