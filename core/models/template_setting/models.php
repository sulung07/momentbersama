<?php
class Models_template_setting extends controller {

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
        tsID                             ,
        header_section_title             ,
        header_section_title_small       ,
        splash_title                     ,
        splash_title_small               ,
        background_sec_1                 ,
        background_sec_2                 ,
        background_sec_3                 ,
        video_link                       ,
        music_file                      
        ";


        $select_count = "COUNT(tsID) as jmldata";

        $table  = "template_setting";


        switch ($data[0]) {

           
           case 'get_single' :
                return $sqlite_conn->get_data($dbName , $select , $table , array("order_by" => "tsID" , "return_type" => "single"));
            break;
          
            default:
                return;
                break;
        }


    }


    }
