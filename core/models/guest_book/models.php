<?php
class Models_guest_book extends controller {

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
        gb.bookID,
        gb.guestID,
        gb.check_in_date,
        gb.check_in_time,
        gb.guest_number,
        gb.activityID,
        gb.guest_rom,

        guest.guest_name,
        activity.activity_name,
        activity.activity_time,
        activity.activity_time_end
        ";

        $select_sum   = "SUM(guest_number) as jmldata";

        $select_count = "COUNT(bookID) as jmldata";

        $table  = "guest_book as gb
        LEFT JOIN guest ON gb.guestID = guest.guestID
        LEFT JOIN activity ON gb.activityID = activity.activityID
        ";

        $table_single = "guest_book";

        switch ($data[0]) {

            case 'sum_by_from' :
                return $sqlite_conn->get_data($dbName , $select_sum , $table_single , array("where" => array("guest_rom" => $param[1]) , "return_type" => "single"));
                break;

            case 'sum_all' :
                return $sqlite_conn->get_data($dbName , $select_sum , $table_single , array("return_type" => "single"));
                break;

            case 'c' :
                return $sqlite_conn->get_data($dbName , $select_count , $table , array("manual" => "where guest_checkin_plan = '0' " , "return_type" => "single"));
                break;

            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("order_by" => "gb.bookID DESC" , "return_type" => "all"));
                break;

            case 'by_activityID' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("gb.activityID" => $param[1]) , "order_by" => "gb.bookID DESC" , "return_type" => "all"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
