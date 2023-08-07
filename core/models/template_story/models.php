<?php
class Models_template_story extends controller {

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
        storyID,
        story_title,
        story_date,
        story_desc,
        story_images,
        story_position
        ";


        $select_count = "COUNT(storyID) as jmldata";

        $table  = "template_story";


        switch ($data[0]) {

           
            case 'get_all' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("order_by" => "story_position ASC" , "return_type" => "all"));
                break;

            case 'by_id' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("where" => array("storyID" => $param[1]) , "return_type" => "single"));
                break;
          
            default:
                return;
                break;
        }


    }


    }
