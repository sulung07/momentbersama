<?php 

class config_sqlite
{

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;

        // off line linux
        //$this->serverbase = "/var/www/html/tpsonline/core/serverbase/userbase";

        // off line mac
        //$this->serverbase = "/usr/local/var/www/tpsonline/core/serverbase/userbase";

        // public 
        $this->serverbase = "../core/serverbase/userbase";
    }

    public function getConnection()
    {
        $conn = $this->connection;
        return $conn;

    }


    public function generateDB($task)
    {

        switch ($task) {
            case 'user-control':

                $tableManifest = array(

                    "event_info" => array(

                        "field" => array(

                            "eiID"            => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "eventID"         => "text",
                            "groom_name"      => "text",
                            "groom_desc"      => "text",
                            "bride_name"      => "text",
                            "bride_desc"      => "text",
                            "groom_pic"       => "text",
                            "bride_pic"       => "text",
                            "event_date"      => "text"
                        )

                    ),

                    "guest" => array(
                        "field"   => array(
                            "guestID"              => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "guest_name"           => "text",
                            "guest_phone"          => "text",
                            "guest_email"          => "text",
                            "guest_username"       => "text",
                            "guest_type"           => "text",
                            "guest_checkin_plan"   => "int",
                            "guest_checkin"        => "int",
                            "guest_number"         => "int",
                            "guestCatID"           => "int",
                            "guestTypeID"          => "int",
                            "guestFrom"            => "text",
                            "guest_checkin_time"   => "text",
                            "guest_checkin_number" => "int",
                            "wa_send"              => "int"
                          
                        )

                    ),

                    "guest_category" => array(

                        "field"   => array(
                            "guestCatID"          => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "guest_cat_name"      => "text"
                        )

                    ),

                    "guest_post" => array(
                        "field" => array(

                            "postID"              => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "guestID"             => "int",
                            "post_text"           => "text",
                            "pic"                 => "text",
                            "post_type"           => "text"
                            
                           
                        )
                    ),

                    "activity"  => array(

                        "field" => array(

                            "activityID"             => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "activity_name"          => "text",
                            "activity_date"          => "text",
                            "activity_time"          => "text",
                            "activity_time_end"      => "text",
                            "activity_loc_title"     => "text",
                            "activity_loc_maps"      => "text"
                            
                        )

                    ),


                    "guest_activity"  => array(

                        "field" => array(

                            "gaID"               => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "guestID"            => "int",
                            "activityID"         => "text"
                           
                        )

                    ),



                    "event_galery"  => array(

                        "field" => array(

                            "egID"               => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "images"             => "text",
                            "description"        => "text"
                      
                        )

                    ),

                    "template_setting"  => array(

                        "field" => array(

                            "tsID"                              => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "header_section_title"              => "text",
                            "header_section_title_small"        => "text",
                            "splash_title"                      => "text",
                            "splash_title_small"                => "text",
                            "background_sec_1"                  => "text",
                            "background_sec_2"                  => "text",
                            "background_sec_3"                  => "text",
                            "video_link"                        => "text",
                            "music_file"                        => "text"
                      
                        )

                    ),

                    "template_slide"  => array(

                        "field" => array(

                            "slideID"            => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "images"             => "text",
                            "position"           => "int"
                        )

                    ),


                    "template_story"  => array(

                        "field" => array(

                            "storyID"            => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "story_title"        => "text",
                            "story_date"         => "text",
                            "story_desc"         => "text",
                            "story_images"       => "text",
                            "story_position"     => "int"
                          
                      
                        )

                    ),

                    "guest_book"  => array(

                        "field" => array(

                            "bookID"             => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "guestID"            => "int",
                            "check_in_date"      => "text",
                            "check_in_time"      => "text",
                            "guest_number"       => "int",
                            "activityID"         => "int"
                          
                      
                        )

                    ),


                    "log_invitation"  => array(

                        "field" => array(

                            "logID"                   => "INTEGER PRIMARY KEY AUTOINCREMENT",
                            "guestID"                 => "int",
                            "open_invitation_date"    => "text",
                            "open_invitation_time"    => "text"
                           
                        )

                    ),




                );

                break;

         

            
        }


        return $tableManifest;

    }


    public function tableSchema($task , $table)
    {

        $getSchema = $this->generateDB($task);
       
        foreach ($getSchema as $key_schema => $list) {

            $prepare_table = "";
            $getField      = "";
            $tableName     = $key_schema;

            if($tableName == $table)
            {

                $getField  = $list['field'];
                $get_columns = array();

                foreach ($getField as $key => $value) {
                    $get_columns[] = "".$key."";
                }
            
                $columnString = implode(', ', $get_columns);

                return $columnString;
                                

            }


        }

    }

    public function accessDB($task , $user , $service = "")
    {

        switch ($task) {
            case 'user':
                $access = ''.$this->serverbase.'/'.$user.'/'.$user.'.db';
                break;

            case 'service' :
                $access = ''.$this->serverbase.'/'.$user.'/'.$service.'.db';

                break;
            
            default:
                $access = "";
                break;
        }


        return $access;

    }
    

    public function ManageDB($data = [])
    {

        $progress   = "false";
        switch ($data[0]) {

            case 'MergerDB' :

                break;

            case 'CreateUserDB':
                
                $userID = $data[1];
                $directory = "$this->serverbase/$userID";

                if (!file_exists("$directory")) {           
                mkdir($directory , 0777);
                }

                $userDB = $this->accessDB("user" , $userID);

                if (file_exists($userDB))
                {
                    $progress = "exists";

                }else{

                    try{ 
                        
                        ## create Clients Database
                        $exe = new PDO("sqlite:$userDB"); 
                        ## get table schema
                        $schema = $this->generateDB("user-control");
                            ## create table
                            if(!empty($schema)){ foreach ($schema as $key_schema => $list) {
                                
                            $prepare_table = "";
                            $getField      = "";

                            $tableName = $key_schema;
            
                                $getField  = $list['field'];
                                $get_columns = array();

                                foreach ($getField as $key => $value) {
                                    $get_columns[] = "".$key."  ".$value."";
                                }
            
                                $columnString = implode(', ', $get_columns);
                                
                                ## generate table
                                $prepare_table = "create table if not exists $tableName ($columnString) ";
                                $this->executeComment($userDB , $prepare_table);
            
                            } }
                                
                        $progress = "true";
                        return $progress;
                    
                    } catch(Exception $exception){ echo $exception->getMessage(); } 


                }
                
                break;

            case 'createServicesDB' :

                $userID   = $data[1];
                $service  = $data[2];
                //$directory = "$this->serverbase/$userID";

                $DB = $this->accessDB("service" , $userID , $service);

                if (file_exists($DB))
                {
                    $progress = "exists";

                }else{

                // chmod("$DB",0777);


                try{ 
                        
                    ## create Clients Database
                    $exe = new PDO("sqlite:$DB"); 
                    ## get table schema
                    $schema = $this->generateDB("services");
                        ## create table
                        if(!empty($schema)){ foreach ($schema as $key_schema => $list) {
                            
                        $prepare_table = "";
                        $getField      = "";

                        $tableName = $key_schema;
        
                            $getField  = $list['field'];
                            $get_columns = array();

                            foreach ($getField as $key => $value) {
                                $get_columns[] = "".$key."  ".$value."";
                            }
        
                            $columnString = implode(', ', $get_columns);
                            
                            ## generate table
                            $prepare_table = "create table if not exists $tableName ($columnString) ";
                            $this->executeComment($DB , $prepare_table);
        
                        } }
                            
                    $progress = "true";
                    // chmod("$DB",0644);
                    return $progress;
                
                } catch(Exception $exception){ echo $exception->getMessage(); } 

                }
               
                break;

            case 'createCatalogDB' :

                $userID   = $data[1];
                $service  = $data[2];
                //$directory = "$this->serverbase/$userID";

                $DB = $this->accessDB("service" , $userID , $service);

                // Read and write for owner, read for everybody else
                chmod("$DB",0777);

                if (file_exists($DB))
                {
               
                    try{ 
                        
                        ## create Clients Database
                        $exe = new PDO("sqlite:$DB"); 
                        ## get table schema

                        $check_services = explode('-',$service);

                        switch ($check_services[0]) {
                            case 'cts':
                                $schema = $this->generateDB("services-store");
                                break;

                            case 'ctp' :

                                break;

                            case 'ctsv' :

                                break;
                            
                        }
                            ## create table
                            if(!empty($schema)){ foreach ($schema as $key_schema => $list) {
                                
                            $prepare_table = "";
                            $getField      = "";
    
                            $tableName = $key_schema;
            
                                $getField  = $list['field'];
                                $get_columns = array();
    
                                foreach ($getField as $key => $value) {
                                    $get_columns[] = "".$key."  ".$value."";
                                }
            
                                $columnString = implode(', ', $get_columns);
                                
                                ## generate table
                                $prepare_table = "create table if not exists $tableName ($columnString) ";

                                $this->executeComment($DB , $prepare_table);
            
                            } }
                                
                        $progress = "true";
                         chmod("$DB",0644);

                        return $progress;
                    
                    } catch(Exception $exception){ echo $exception->getMessage(); } 

                }else{

                    $progress = "failed";
                    return $progress;
                

                }


                break;

            
            default:
                return $progress;
                break;
        }

    }


    public function executeComment($database ,$comment)
    {

        $exe = new PDO("sqlite:$database");
        $exe->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $exe->exec("$comment");
        $progress = "true";
        return $progress;

    }


    public function crud($database , $table , $condition , $columns = [] , $param = [])
    {

        $msg = [];
        
        $generateDB = $database;

        $exe  = new PDO("sqlite:$generateDB");
        $exe -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        switch ($condition) {
            case 'insert':

                try {

                    $columnString = implode(',', array_keys($columns));
                    $valueString  = implode(',', array_fill(0, count($columns), '?'));

                    $prepare = "INSERT INTO $table ({$columnString}) VALUES ({$valueString})";
              
                    $stmt = $exe->prepare($prepare);
                    if($stmt->execute(array_values($columns))){
                        $lastID = $exe->lastInsertId();
                        $msg = array("true","$lastID");
                        
                    }else{

                        array_push($msg,"false");
                    }
                
                }
                catch(PDOException $e) {

                    array_push($msg,"false");
                  
                }


                return $msg;

                break;

            case 'update' :

                try {

                    $get_columns = array();
                    $get_params  = array();
                    
                    foreach ($columns as $key => $value) {
                        $get_columns[] = "".$key." = :".$key."";
                    }

                    foreach ($param as $key => $value) {
                        $get_params[] = "".$key."= :".$key."";
                    }

                    $columnString = implode(', ', $get_columns);
                    $paramString  = implode(' and ', $get_params);

                    
                    $prepare = "UPDATE ".$table." SET ".$columnString." WHERE ".$paramString."";

                    if($stmt = $exe->prepare($prepare))
                    {

                        foreach ($columns as $key => $value) 
                        {
                            $stmt->bindValue(":" .$key , $value);
                        }

                        foreach ($param as $key => $value) 
                        {
                            $stmt->bindValue(":" .$key , $value);

                        }


                        if($stmt->execute())
                        {

                            $msg = array("true");

                        }

                    }

                }catch(PDOException $e) {

                    //echo "<h1>$e</h1>";
                    array_push($msg,"false");
                  
                }

                return $msg;

                break;

            case 'delete' :

                try{

                    $get_params = array();

                    foreach ($param as $key => $value) {
                        $get_params[] = "".$key."= :".$key.""; 
                    }

                    $paramString = implode(', ',$get_params);

                    $prepare = "DELETE FROM ".$table." WHERE ".$paramString."";

                    if($stmt = $exe->prepare($prepare))
                    {

                        foreach ($param as $key => $value) 
                        {
                            $stmt->bindValue(":" .$key , $value);
                        }

                        if($stmt->execute())
                        {
                            $msg = array("true");
                        }

                    }


                }catch(PDOException $e) {

                    array_push($msg,"false");
                  
                }

                return $msg;

                break;
            
            default:
                return $msg = array("false");
                break;
        }

    }


    public function get_data($database,$select,$table,$conditions = array())
    {


        $generateDB = $database;        
        $db         = new PDO("sqlite:$generateDB");

        $sql = 'SELECT ';
            $sql .= array_key_exists("select",$conditions)?$conditions['select']:$select;
            $sql .= ' FROM '.$table;
            if(array_key_exists("where",$conditions)){
                $sql .= ' WHERE ';
                $i = 0;
                foreach($conditions['where'] as $key => $value)
                {
                    // if where condition > 1
                    $pre = ($i > 0)?' AND ':'';
                    $sql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }

            if(array_key_exists("group_by",$conditions)){
                $sql .= ' GROUP BY '.$conditions['group_by'];
            }

            if(array_key_exists("order_by",$conditions)){
                $sql .= ' ORDER BY '.$conditions['order_by'];
            }


            if(array_key_exists("manual",$conditions)){
                $sql .= '  '.$conditions['manual'];
            }

            if(array_key_exists("like",$conditions)){
                $sql .= ' WHERE '.$conditions['like'];

            }

            if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];
            }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['limit'];
            }


            $query = $db->prepare("$sql");
            $query->execute();

            if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
                switch($conditions['return_type'])
                {
                    case 'count':
                        $data = $query->rowCount();
                        break;
                    case 'single':
                        $data = $query->fetch(PDO::FETCH_ASSOC);
                        break;
                    default:
                        $data = '';
                }
            }else{               
                // if($query->rowCount() > 0)
                // {
                   // $data = $query->fetchAll();
                   $data = $query->fetchAll();
                // }
            }

        return !empty($data)?$data:false;


    }

}

?>