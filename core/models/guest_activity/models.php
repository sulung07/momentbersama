<?php
class Models_guest_activity extends controller {

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
        ga.gaID,
        ga.guestID,
        ga.activityID,
        guest.guest_name,
        activity.activity_name,
        activity.activity_date,
        activity.activity_time,
        activity.activity_loc_title,
        activity.activity_loc_maps,
        activity.activity_time_end

        ";


        $select_count = "COUNT(gaID) as jmldata";

        $table  = "guest_activity AS ga
        LEFT JOIN guest ON ga.guestID = guest.guestID
        LEFT JOIN activity ON ga.activityID = activity.activityID
        ";

        $table_single = "guest_activity";

        switch ($data[0]) {

           
            case 'by_guestID' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("ga.guestID" => $param[1]) , "return_type" => "all"));
                break;

            case 'by_activity':
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("ga.activityID" => $param[1]) , "return_type" => "all"));
                break;

            case 'count_by_guest_activity' :
                return $sqlite_conn->get_data($dbName , $select_count , $table_single , array("where" => array("guestID" => $param[1] , "activityID" => $param[2]) , "return_type" => "single"));
                break;

            case 'count_by_activity' :
                return $sqlite_conn->get_data($dbName , $select_count , $table_single , array("where" => array("activityID" => $param[1]) , "return_type" => "single"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
