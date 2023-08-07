<?php
class Models_activity extends controller {

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
        activityID,
        activity_name,
        activity_date,
        activity_time,
        activity_time_end,
        activity_loc_title,
        activity_loc_maps
        ";

        $select_count = "COUNT(activityID) as jmldata";

        $table  = "activity";

        switch ($data[0]) {

            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("order_by" => "activityID ASC" , "return_type" => "all"));
                break;

            case 'by_activityID' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("activityID" => $param[1]) , "return_type" => "single"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
