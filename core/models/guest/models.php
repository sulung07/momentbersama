<?php
class Models_guest extends controller {

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
        guestID,
        guest_name,
        guest_phone,
        guest_email,
        guest_username,
        guest_number,
        guestCatID,
        guestTypeID,
        
        guestFrom,
        guest_checkin_plan,
        guest_checkin,
        guest_checkin_time,
        guest_checkin_number,
        wa_send
        ";

        //guest_checkin_plan_number,


        $select_sum   = "SUM(guest_number) as jmldata";

        $select_count = "COUNT(guestID) as jmldata";

        $table  = "guest";

        switch ($data[0]) {

            case 'count_by_rsvp_default' :
                return $sqlite_conn->get_data($dbName , $select_count , $table , array("manual" => "where guest_checkin_plan = '0' " , "return_type" => "single"));
                break;

            case 'count_by_rsvp' :
                return $sqlite_conn->get_data($dbName , $select_count , $table , array("where" => array("guest_checkin_plan" => $param[1]) , "return_type" => "single"));
                break;

            case 'sum_by_rsvp' :
                return $sqlite_conn->get_data($dbName , $select_sum , $table , array("where" => array("guest_checkin_plan" => $param[1]) , "return_type" => "single"));
                break;

            case 'get_rsvp' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("manual" => "where guest_checkin_plan != '0' " , "return_type" => "all"));
                break;

            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("return_type" => "all"));
                break;

            case 'by_username' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("guest_username" => $param[1]) , "return_type" => "single"));
                break;

            case 'sum_all' :
                return $sqlite_conn->get_data($dbName , $select_sum , $table , array("return_type" => "single"));
                break;

            case 'sum_by_from' :
                return $sqlite_conn->get_data($dbName , $select_sum , $table , array("where" => array("guestFrom" => $param[1]) , "return_type" => "single"));
                break;

            case 'count_all' :
                return $sqlite_conn->get_data($dbName , $select_count , $table , array("return_type" => "single"));
                break;

            case 'count_by_type' :
                return $sqlite_conn->get_data($dbName , $select_count , $table , array("where" => array("guestTypeID" => $param[1]) , "return_type" => "single"));
                break;

            case 'sum_by_category' :
                return $sqlite_conn->get_data($dbName , $select_sum , $table , array("where" => array("guestCatID" => $param[1]) , "return_type" => "single"));
                break;

            case 'sum_by_id' :
                return $sqlite_conn->get_data($dbName , $select_sum , $table , array("where" => array("guestID" => $param[1]) , "return_type" => "single"));
                break;  

            case 'by_id' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("guestID" => $param[1]) , "return_type" => "single"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
