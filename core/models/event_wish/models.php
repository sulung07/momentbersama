<?php
class Models_event_wish extends controller {

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
        event_wish.wishID,
        event_wish.guestID,
        event_wish.wish_date,
        event_wish.wish_time,
        event_wish.wish_desc,

        guest.guest_name
      
        ";

        $select_count = "COUNT(wishID) as jmldata";

        $table  = "event_wish LEFT JOIN guest ON event_wish.guestID = guest.guestID ";

        $table_single = "event_wish";

        switch ($data[0]) {

            case 'by_id' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("event_wish.wishID" => $param[1]) , "return_type" => "single"));
                break;

            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("order_by" => "event_wish.wishID DESC"  , "return_type" => "all"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
