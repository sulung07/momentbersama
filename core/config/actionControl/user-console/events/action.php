<?php
class actionEvents extends controller{

    protected $connection;
    public function __construct($connection) {

        $db = $connection->getConnection();
        $this->crud = $connection;
        $this->pdo = $db;

     
    }


    public function actioncontrol_event_checkin($data = [])
    {

        $time        = $data[1];
        $key         = $data[2];
        
        $guestID     = $this->hashId("dec" , $data[3]);
        $eventID     = $_POST['event'];
        $generateKey = $this->act_key($time);  

        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        if($generateKey == $key)
        {

            switch ($data[0]) {
                case 'checkin':

                        if(isset($_POST['activity']))
                        {

                            $activity = $_POST['activity'];
                        }else{

                            $activity = "";

                        }
                        

                        $validation = $this->form_validation(array("$guestID" , "$_POST[checkin_number]" , "$activity"));

                        if($validation == "true")
                        {

                            $guest = $this->getData("guest")->get(array("by_id" , array($eventID , $guestID)));


                            $array = array(
                                "guestID"   => $guestID,
                                "check_in_date" => $this->datesetting("date"),
                                "check_in_time" => $this->datesetting("time"),
                                "guest_number"  => $_POST['checkin_number'],
                                "activityID"    => $_POST['activity'],
                                "guest_rom"     => $guest['guestFrom']
                            );
                            $execute = $sqlite_conn->crud($dbName , "guest_book" , "insert" , $array , "");

                            if($execute[0] == "true")
                            {
    
                                echo "true";
    
                            }

                        }else{
                            echo "formerror";
                        }

                       

                    break;

                case 'delete' :

                    $param = array(

                        "bookID"    => $guestID

                    );

                    $execute = $sqlite_conn->crud($dbName , "guest_book" , "delete" , "" , $param);

                    if($execute[0] == "true")
                    {
                        echo "true";
                    }

                    break;
                
                default:
                    # code...
                    break;
            }

        }

    }


    public function actioncontrol_templatesetting($data = [])
    {


        $time        = $data[1];
        $key         = $data[2];
        $eventID     = $data[3];
        $generateKey = $this->act_key($time);  


        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $event       = $this->getData("event")->get(array("by_code" , array($eventID)));
        $eventHashId = $this->hashId("enc" , $event['eventID']);

        if($generateKey == $key)
        {

            $header_section_title = $this->form_scan(array("pro" , $_POST['header_section_title']));
            $header_section_title_small  = $this->form_scan(array("pro" , $_POST['header_section_title_small']));
            $splash_title                = $this->form_scan(array("pro" , $_POST['splash_title']));
            $splash_title_small          = $this->form_scan(array("pro" , $_POST['splash_title_small']));
            $video_link                  = $this->form_scan(array("pro" , $_POST['video_link']));

            $music_file                  = $this->form_scan(array("pro" , $_POST['music_file']));

            $background_sec_1            = $_FILES['background_section_1']['name'];
            $background_sec_2            = $_FILES['background_section_2']['name'];
            $background_sec_3            = $_FILES['background_section_3']['name'];


            $array = array(

                "header_section_title"  => $header_section_title,
                "header_section_title_small"    => $header_section_title_small,
                "splash_title"                  => $splash_title,
                "splash_title_small"            => $splash_title_small,
                "video_link"                    => $video_link,
                "music_file"                    => $music_file

            );

            if($background_sec_1 != "")
            {
                $temp = explode(".", $_FILES["background_section_1"]["name"]);
                $bg_sec_1 = round(microtime(true)) . '.' . end($temp); 
                $this->UploadImage($background_sec_1 , "media" , "background_section_1");
                $array['background_sec_1'] = $bg_sec_1;
            }


            if($background_sec_2 != "")
            {
                $temp = explode(".", $_FILES["background_section_2"]["name"]);
                $bg_sec_2 = round(microtime(true)) . '.' . end($temp); 
                $this->UploadImage($background_sec_2 , "media" , "background_section_2");
                $array['background_sec_2'] = $bg_sec_2;
            }

            if($background_sec_3 != "")
            {
                $temp = explode(".", $_FILES["background_section_3"]["name"]);
                $bg_sec_3 = round(microtime(true)) . '.' . end($temp); 
                $this->UploadImage($background_sec_3 , "media" , "background_section_3");
                $array['background_sec_3'] = $bg_sec_3;
            }


            $check_data = $this->getData("template_setting")->get(array("get_single" , array($eventID)));

            if(!empty($check_data))
            {

                ## update

                $param = array(
                    "tsID"  => $check_data['tsID']
                );

                $execute = $sqlite_conn->crud($dbName , "template_setting" , "update" , $array , $param);


            }elseif(empty($check_data))
            {

                ## insert

                $execute = $sqlite_conn->crud($dbName , "template_setting" , "insert" , $array , "");

            }

            if($execute[0] == "true")
            {
                $this->headerLoc("/events/detail-events/$eventHashId?tab=templatesetting&res=true");

            }
        

        }

    }

    public function actioncontrol_guest($data = [] , $content = "")
    {

        $time        = $data[1];
        $key         = $data[2];
        $eventID     = $data[3];
        $guestID     = $data[4];
        $generateKey = $this->act_key($time);  


        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $event       = $this->getData("event")->get(array("by_code" , array($eventID)));
        $eventHashId = $this->hashId("enc" , $event['eventID']);


        if($generateKey == $key)
        {

            if($data[0] != "delete"):

                $guest_name  = $this->form_scan(array("pro" , $_POST['guest_name']));
                $guest_phone = $this->form_scan(array("pro" , $_POST['guest_phone']));
                $guest_email = $this->form_scan(array("pro" , $_POST['guest_email']));
                $guestCatID  = $this->hashId("dec" , $_POST['guestCatID']);
                $guest_type  = $this->hashId("dec" , $_POST['guest_type']);
                $guestFrom   = $this->form_scan(array("pro" , $_POST['guestFrom']));
                $guest_number = $this->form_scan(array("pro" , $_POST['guest_number']));

               

                $activity     = $_POST['activity'];

                $array = array(

                    "guest_name"    => $guest_name,
                    "guest_phone"   => $guest_phone,
                    "guest_email"   => $guest_email,
                    "guestCatID"    => $guestCatID,
                    "guestTypeID"   => $guest_type,
                    "guestFrom"     => $guestFrom,
                    "guest_number"  => $guest_number,
                    "wa_send"       => "0"

                );


                if($data[0] == "add"):

                    $removeSpecialChars = preg_replace('/[^a-zA-Z0-9\s]/', '', $guest_name);
                    $str_username  = strtolower(str_replace(' ', '', $removeSpecialChars));
                    $code_username = $this->datesetting("date_number");
                    $generate_username       = "$str_username-$code_username";
                    $array['guest_username'] = $generate_username;

                endif;

            endif;


            switch ($data[0]) {
                case 'add':

                    $validation = $this->form_validation(array("$guest_name"));
                    if($validation == "true")
                    {

                        $execute = $sqlite_conn->crud($dbName , "guest" , "insert" , $array , "");

                        if($execute[0] == "true")
                        {

                            $guestID = $execute[1];
                            $count_activity = COUNT($activity);

                            for($x = 0; $x < $count_activity; $x++)
                            {

                                $activityID = $activity[$x];
                                $array_activity = array(
                                    "guestID"       => $guestID,
                                    "activityID"    => $activityID
                                );

                                $execute_activity = $sqlite_conn->crud($dbName , "guest_activity" , "insert" , $array_activity , "");

                            }

                            $this->headerLoc("/events/detail-events/$eventHashId?tab=guestbook&subtab=guestlist&res=true");
                        }

                    }

                    break;

                case 'update' :

                    $validation = $this->form_validation(array("$guest_name" , "$guestID"));
                    if($validation == "true")
                    {

                        $param = array(
                            "guestID"   => $guestID
                        );


                        $execute = $sqlite_conn->crud($dbName , "guest" , "update" , $array , $param);

                        if($execute[0] == "true")
                        {

                            ## delete 

                            $execute_delete = $sqlite_conn->crud($dbName , "guest_activity" , "delete" , "" , $param);
                            if($execute_delete[0] == "true")
                            {

                                ## guest activity 
                                $count_activity = COUNT($activity);

                                for($x = 0; $x < $count_activity; $x++)
                                {
    
                                    $activityID = $activity[$x];
                                    $array_activity = array(
                                        "guestID"       => $guestID,
                                        "activityID"    => $activityID
                                    );
    
                                    $execute_activity = $sqlite_conn->crud($dbName , "guest_activity" , "insert" , $array_activity , "");
                                }

                            }

                            $this->headerLoc("/events/detail-events/$eventHashId?tab=guestbook&subtab=guestlist&res=true");

                        }

                    }

                    break;

                case 'delete' :

                    $clientID = $this->hashId("dec" , $data[5]);

                    if($clientID == $event['clientID'])
                    {

                        $param = array(
                            "guestID"    => $this->hashId("dec" , $guestID)
                        );

                        $execute = $sqlite_conn->crud($dbName , "guest" , "delete" , "" , $param);

                        if($execute[0] == "true")
                        {

                            $execute_del_activity = $sqlite_conn->crud($dbName , "guest_activity" , "delete" , "" , $param);

                            echo "true";

                        }

                    }else{

                        echo "false";
                    }

                    break;
                
                default:
                    return;
                    break;
            }

        }

    }


    public function actioncontrol_guest_category($data = [] , $content = "")
    {

         
        $time        = $data[1];
        $key         = $data[2];
        $eventID     = $data[3];
        $catID       = $data[4];
        $generateKey = $this->act_key($time);  


        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $event       = $this->getData("event")->get(array("by_code" , array($eventID)));
        $eventHashId = $this->hashId("enc" , $event['eventID']);

        if($generateKey == $key)
        {

            if($data[0] != "delete"):

            $category_name = $this->form_scan(array("pro" , $_POST['category_name']));

            $array = array(
                "guest_cat_name"    => $category_name
            );

            endif;



            switch ($data[0]) {
                case 'add':

                    $validation = $this->form_validation(array("$category_name"));
                    if($validation == "true")
                    {

                        $execute = $sqlite_conn->crud($dbName , "guest_category" , "insert" , $array , "");
                        if($execute[0] == "true")
                        {
                            $this->headerLoc("/events/detail-events/$eventHashId?tab=guestbook&subtab=guestcat&res=true");
                        }

                    }

                    break;

                case 'update' :

                    $validation = $this->form_validation(array("$category_name" , "$catID"));
                    if($validation == "true")
                    {

                        $param = array(
                            "guestCatID"    => $catID
                        );

                        $execute = $sqlite_conn->crud($dbName , "guest_category" , "update" , $array , $param);
                        if($execute[0] == "true")
                        {
                            $this->headerLoc("/events/detail-events/$eventHashId?tab=guestbook&subtab=guestcat&res=true");
                        }

                    }

                    break;

                case 'delete' :

                    $clientID = $this->hashId("dec" , $data[5]);

                    if($clientID == $event['clientID'])
                    {

                        $param = array(
                            "guestCatID"    => $this->hashId("dec" , $catID)
                        );

                        $execute = $sqlite_conn->crud($dbName , "guest_category" , "delete" , "" , $param);

                        if($execute[0] == "true")
                        {

                            echo "true";

                        }

                    }else{

                        echo "false";
                    }

                    break;
                
                default:
                    return;
                    break;
            }

        }

    }


    public function actioncontrol_event_activity($data = [] , $content = "")
    {

          
        $time        = $data[1];
        $key         = $data[2];
        $eventID     = $data[3];
        $activityID  = $data[4];
        $generateKey = $this->act_key($time);

        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $event       = $this->getData("event")->get(array("by_code" , array($eventID)));
        $eventHashId = $this->hashId("enc" , $event['eventID']);

        if($generateKey == $key)
        {

            if($data[0] != "delete"):

            $activity_name      = $this->form_scan(array("pro" , $_POST['activity_name']));
            $activity_date      = $this->form_scan(array("basic" , $_POST['activity_date']));
            $activity_time      = $this->form_scan(array("basic" , $_POST['activity_time']));
            $activity_time_end  = $this->form_scan(array("basic" , $_POST['activity_time_end']));
            $activity_loc_title = $this->form_scan(array("pro" , $_POST['activity_loc_title']));
            $activity_loc_maps  = $this->form_scan(array("pro" , $_POST['activity_loc_maps']));

            $array = array(

                "activity_name"         => $activity_name,
                "activity_date"         => $activity_date,
                "activity_time"         => $activity_time,
                "activity_time_end"     => $activity_time_end,
                "activity_loc_title"    => $activity_loc_title,
                "activity_loc_maps"     => $activity_loc_maps

            );

            endif;

            switch ($data[0]) {
                case 'add':
                    
                    $validation = $this->form_validation(array("$activity_name" , "$activity_date" , "$activity_time" , "$activity_loc_title"));

                    if($validation == "true")
                    {
                        $execute = $sqlite_conn->crud($dbName , "activity" , "insert" , $array , "");
                        if($execute[0] == "true")
                        {
                            $this->headerLoc("/events/detail-events/$eventHashId?tab=activity&res=true");
                        }

                    }

                    break;

                case 'update' :

                    $validation = $this->form_validation(array("$activity_name" , "$activity_date" , "$activity_time" , "$activity_loc_title"));

                    if($validation == "true")
                    {
                        $param = array(
                            "activityID"    => $activityID
                        );

                        $execute = $sqlite_conn->crud($dbName , "activity" , "update" , $array , $param);
                        if($execute[0] == "true")
                        {
                            $this->headerLoc("/events/detail-events/$eventHashId?tab=activity&res=true");

                        }

                    }

                    break;

                case 'delete' :

                    $clientID = $this->hashId("dec" , $data[5]);
                    if($clientID == $event['clientID'])
                    {

                        $param = array(
                            "activityID"    => $this->hashId("dec" , $activityID)
                        );

                        $execute = $sqlite_conn->crud($dbName , "activity" , "delete" , "" , $param);
                        if($execute[0] == "true")
                        {
                            echo "true";
                        }

                    }else{
                        echo "false";
                    }

                    break;
                
                default:
                    # code...
                    break;
            }

        }

    }

    public function actioncontrol_event_story($data = [] , $content = "")
    {

        $time      = $data[1];
        $key       = $data[2];
        $storyID   = $data[3];
        $eventID   = $this->form_scan(array("basic" , $_POST['event']));

        $generateKey = $this->act_key($time);

        $event = $this->getData("event")->get(array("by_code" , array($eventID)));
        $eventHashId = $this->hashId("enc" , $event['eventID']);

        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        if($generateKey == $key)
        {

            if($data[0] != "delete")
            {

                $position    = $this->form_scan(array("pro" , $_POST['position']));
                $story_title = $this->form_scan(array("pro" , $_POST['story_title']));
                $story_date  = $this->form_scan(array("pro" , $_POST['story_date']));
                $story_desc  = $_POST['story_desc'];
                $image       = $_POST['image'];

                $array = array(

                    "story_title"       => $story_title,
                    "story_date"        => $story_date,
                    "story_desc"        => $story_desc,
                    "story_position"    => $position

                );

                if($image != "")
                {


                if($data[0] == "update"):
                ## get last images 

                $slidedata = $this->getData("template_story")->get(array("by_id" , array($eventID , $this->hashId("dec" , $storyID))));

                $file_path = "/$directory/public/assets/media/$slidedata[story_images]";
                if (file_exists($file_path)) {
                unlink($file_path);
                }
                endif;

                list($type, $image) = explode(';',$image);
                list(, $image)      = explode(',',$image);

                $image = base64_decode($image);

                $signature = substr($image, 0, 12);
                if (strpos($signature, 'GIF') === 0) {
                    $extension = 'gif';
                } elseif (strpos($signature, "\x89PNG\x0D\x0A\x1A\x0A") === 0) {
                    $extension = 'png';
                } elseif (strpos($signature, "\xFF\xD8\xFF") === 0) {
                    $extension = 'jpg';
                } elseif (strpos($signature, "\xFF\xD8\xFF\xE0") === 0 || strpos($signature, "\xFF\xD8\xFF\xE1") === 0) {
                    $extension = 'jpeg'; // or 'jpg' (both are commonly used for JPEG)
                } elseif (strpos($signature, "WEBP") === 8) {
                    $extension = 'webp';
                } else {
                    // Set a default extension (e.g., if the image type is not recognized)
                    $extension = 'jpg';
                }
                    


                // if (strlen($image) > 1000000) {
                //   // Resize the image to a smaller size
                //   $img = imagecreatefromstring($image);
                //   $width = imagesx($img);
                //   $height = imagesy($img);
                //   $newWidth = $width; // Set the new width of the image
                //   $newHeight = ($newWidth / $width) * $height;
                //   $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
                //   imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                //   ob_start();
                //   imagepng($tmpImg);
                //   $image = ob_get_clean();
                //   imagedestroy($tmpImg);
                //   imagedestroy($img);
                // }

                //$filename    = uniqid() . '.png';

                $filename = uniqid() . '.' . $extension;

                $mediaDir    = $this->site_setting("media_loc");

                file_put_contents("/$directory/public/assets/media/" . $filename, $image);
                
                $array['story_images']   = "$filename";


                }
            }

            switch ($data[0]) {
                case 'add':

                    $validation = $this->form_validation(array("$story_title" , "$story_date" , "$position"));

                    if($validation == "true")
                    {

                        $execute = $sqlite_conn->crud($dbName , "template_story" , "insert" , $array , "");
                        if($execute[0] == "true")
                        {
                            echo "/events/detail-events/$eventHashId?tab=templatesetting&subtab=lovestory&res=true";

                        }

                    }

                    break;

                case 'update' :

                    $validation = $this->form_validation(array("$story_title" , "$story_date" , "$position" , "$storyID"));

                    if($validation == "true")
                    {

                        $param = array(
                            "storyID"   => $this->hashId("dec" , $storyID)
                        );

                        $execute = $sqlite_conn->crud($dbName , "template_story" , "update" , $array , $param);
                        if($execute[0] == "true")
                        {
                            echo "/events/detail-events/$eventHashId?tab=templatesetting&subtab=lovestory&res=true";
 
                        }

                    }


                    break;

                case 'delete' :

                    $clientID = $this->hashId("dec" , $data[4]);

                    if($clientID == $event['clientID'])
                    {
                        $storydata = $this->getData("template_story")->get(array("by_id" , array($eventID , $this->hashId("dec" , $storyID))));

                        ## remove images
                        $file_path = "/$directory/public/assets/media/$storydata[story_images]";
                        if (file_exists($file_path)) {
                        unlink($file_path);
                        }

                        ## end remove images

                        $param = array(
                            "storyID"    => $this->hashId("dec" , $storyID)
                        );

                        $execute = $sqlite_conn->crud($dbName , "template_story" , "delete" , "" , $param);

                        if($execute[0] == "true")
                        {
                            echo "true";
                        }

                    }else{

                        echo "false";
                    }

                    break;
                
                default:
                    # code...
                    break;
            }

        }

    }


    public function actioncontrol_event_slideshow($data = [] , $content = "")
    {

        $time      = $data[1];
        $key       = $data[2];
        $slideID   = $data[3];
        $eventID   = $this->form_scan(array("basic" , $_POST['event']));

        $generateKey = $this->act_key($time);

        $event = $this->getData("event")->get(array("by_code" , array($eventID)));
        $eventHashId = $this->hashId("enc" , $event['eventID']);

        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        if($generateKey == $key)
        {

            
            if($data[0] != "delete")
            {

                $position = $this->form_scan(array("basic" , $_POST['position']));

                $array = array(
                    "position"  => $position
                );


                $image = $_POST['image'];
                if($image != "")
                {


                if($data[0] == "update"):
                ## get last images 

                $slidedata = $this->getData("template_slide")->get(array("by_id" , array($eventID , $this->hashId("dec" , $slideID))));

                $file_path = "/$directory/public/assets/media/$slidedata[images]";
                if (file_exists($file_path)) {
                unlink($file_path);
                }
                endif;

                list($type, $image) = explode(';',$image);
                list(, $image)      = explode(',',$image);

                $image = base64_decode($image);

                $signature = substr($image, 0, 12);
                if (strpos($signature, 'GIF') === 0) {
                    $extension = 'gif';
                } elseif (strpos($signature, "\x89PNG\x0D\x0A\x1A\x0A") === 0) {
                    $extension = 'png';
                } elseif (strpos($signature, "\xFF\xD8\xFF") === 0) {
                    $extension = 'jpg';
                } elseif (strpos($signature, "\xFF\xD8\xFF\xE0") === 0 || strpos($signature, "\xFF\xD8\xFF\xE1") === 0) {
                    $extension = 'jpeg'; // or 'jpg' (both are commonly used for JPEG)
                } elseif (strpos($signature, "WEBP") === 8) {
                    $extension = 'webp';
                } else {
                    // Set a default extension (e.g., if the image type is not recognized)
                    $extension = 'jpg';
                }
                    


                // if (strlen($image) > 1000000) {
                //   // Resize the image to a smaller size
                //   $img = imagecreatefromstring($image);
                //   $width = imagesx($img);
                //   $height = imagesy($img);
                //   $newWidth = $width; // Set the new width of the image
                //   $newHeight = ($newWidth / $width) * $height;
                //   $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
                //   imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                //   ob_start();
                //   imagepng($tmpImg);
                //   $image = ob_get_clean();
                //   imagedestroy($tmpImg);
                //   imagedestroy($img);
                // }

                //$filename    = uniqid() . '.png';

                $filename = uniqid() . '.' . $extension;


                file_put_contents("/$directory/public/assets/media/" . $filename, $image);
                $array['images']   = "$filename";


                }


            }


            switch ($data[0]) {
                case 'add':

                    $validation = $this->form_validation(array("$position"));

                    if($validation == "true")
                    {

                        $execute = $sqlite_conn->crud($dbName , "template_slide" , "insert" , $array , "");
                        if($execute[0] == "true")
                        {

                            echo "/events/detail-events/$eventHashId?tab=templatesetting&subtab=slideshow&res=true";

                        }

                    }

                    break;

                case 'update' :

                    $validation = $this->form_validation(array("$position" , "$slideID"));

                    if($validation == "true")
                    {

                        $param = array(

                            "slideID"   => $this->hashId("dec" , $slideID)

                        );

                        $execute = $sqlite_conn->crud($dbName , "template_slide" , "update" , $array , $param);

                        if($execute[0] == "true")
                        {
                            echo "/events/detail-events/$eventHashId?tab=templatesetting&subtab=slideshow&res=true";

                        }

                    }

                    break;

                case 'delete' :

                    $clientID = $this->hashId("dec" , $data[4]);

                    if($clientID == $event['clientID'])
                    {
                        $slidedata = $this->getData("template_slide")->get(array("by_id" , array($eventID , $this->hashId("dec" , $slideID))));

                        ## remove images
                        $file_path = "/$directory/public/assets/media/$slidedata[images]";
                        if (file_exists($file_path)) {
                        unlink($file_path);
                        }

                        ## end remove images

                        $param = array(
                            "slideID"    => $this->hashId("dec" , $slideID)
                        );

                        $execute = $sqlite_conn->crud($dbName , "template_slide" , "delete" , "" , $param);

                        if($execute[0] == "true")
                        {
                            echo "true";
                        }

                    }else{

                        echo "false";
                    }

                    break;
                
                default:
                    return;
                    break;
            }



        }


    }


    public function actioncontrol_event_galery($data = [] , $content = "")
    {

        $time      = $data[1];
        $key       = $data[2];
        $galeryID  = $data[3];
        $eventID   = $this->form_scan(array("basic" , $_POST['event']));

        $generateKey = $this->act_key($time);

        $event = $this->getData("event")->get(array("by_code" , array($eventID)));
        $eventHashId = $this->hashId("enc" , $event['eventID']);

        $directory   = $this->site_setting('rootDirectory');
        $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        if($generateKey == $key)
        {

            if($data[0] != "delete")
            {

                $array = array(
                    "description"   => $_POST['description']
                );


                $image = $_POST['image'];

                if($image != "")
                {

                list($type, $image) = explode(';',$image);
                list(, $image)      = explode(',',$image);

                $image = base64_decode($image);

                $signature = substr($image, 0, 12);
                if (strpos($signature, 'GIF') === 0) {
                    $extension = 'gif';
                } elseif (strpos($signature, "\x89PNG\x0D\x0A\x1A\x0A") === 0) {
                    $extension = 'png';
                } elseif (strpos($signature, "\xFF\xD8\xFF") === 0) {
                    $extension = 'jpg';
                } elseif (strpos($signature, "\xFF\xD8\xFF\xE0") === 0 || strpos($signature, "\xFF\xD8\xFF\xE1") === 0) {
                    $extension = 'jpeg'; // or 'jpg' (both are commonly used for JPEG)
                } elseif (strpos($signature, "WEBP") === 8) {
                    $extension = 'webp';
                } else {
                    // Set a default extension (e.g., if the image type is not recognized)
                    $extension = 'jpg';
                }
                    


                // if (strlen($image) > 1000000) {
                //   // Resize the image to a smaller size
                //   $img = imagecreatefromstring($image);
                //   $width = imagesx($img);
                //   $height = imagesy($img);
                //   $newWidth = $width; // Set the new width of the image
                //   $newHeight = ($newWidth / $width) * $height;
                //   $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
                //   imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                //   ob_start();
                //   imagepng($tmpImg);
                //   $image = ob_get_clean();
                //   imagedestroy($tmpImg);
                //   imagedestroy($img);
                // }

                //$filename    = uniqid() . '.png';

                $filename = uniqid() . '.' . $extension;

                $mediaDir    = $this->site_setting("media_loc");

                file_put_contents("/$directory/public/assets/media/" . $filename, $image);
                $array['images']   = "$filename";

                }


            }


            


            if($data[0] == "manage"):

                if($galeryID == "")
                {

                    ## add
                    $execute = $sqlite_conn->crud($dbName , "event_galery" , "insert" , $array , "");
                    if($execute[0] == "true")
                    {
                        echo "/events/detail-events/$eventHashId?tab=galery&res=true";
                    }
                    

                }else{

                    ## update

                    $param = array(
                        "egID"  => $this->hashId("dec" , $galeryID)
                    );

                    $execute = $sqlite_conn->crud($dbName , "event_galery" , "update" , $array , $param);

                    if($execute[0] == "true")
                    {
                        echo "/events/detail-events/$eventHashId?tab=galery&res=true";

                    }

                }

            endif;

            if($data[0] == "delete"):

                ## get data 

                $galeryID = $this->hashId("dec" , $galeryID);

                $content = $this->getData("event_galery")->get(array("by_id" , array($eventID , $galeryID)));

                $param   = array(
                    "egID"  => $galeryID
                );

                $file_path = "/$directory/public/assets/media/$content[images]";

                if (file_exists($file_path)) {
                unlink($file_path);
                }

                $execute = $sqlite_conn->crud($dbName , "event_galery" , "delete" , "" , $param);
                if($execute[0] == "true")
                {

                    echo "true";

                }

            endif;

            


        }


    }


    public function actioncontrol_event_info($data = [] , $content = "")
    {

        
        $time      = $data[1];
        $key       = $data[2];
        $eventID   = $data[3];
        $generateKey = $this->act_key($time);

        $event = $this->getData("event")->get(array("by_code" , array($eventID)));

        $eventHashId = $this->hashId("enc" , $event['eventID']);

        if($generateKey == $key)
        {

            $groom_name = $this->form_scan(array("pro" , $_POST['groom_name']));
            $groom_desc = $_POST['groom_desc'];
            $groomimage = $_POST['groomimage'];
            
            $bride_name = $this->form_scan(array("pro" , $_POST['bride_name']));
            $bride_desc = $_POST['bride_desc'];
            $brideimage = $_POST['brideimage'];

            $event_date = $this->form_scan(array("basic" , $_POST['event_date']));

            
            $directory   = $this->site_setting('rootDirectory');
            $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
            $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));
    

            $validation  = $this->form_validation(array("$groom_name" , "$bride_name"));

            if($validation == "true")
            {

                $check_data = $this->getData("event_info")->get(array("by_event" , array($eventID)));


                $array = array(
                    "eventID"       => $event['eventID'],
                    "groom_name"    => $groom_name,
                    "groom_desc"    => $groom_desc,
                    "bride_name"    => $bride_name,
                    "bride_desc"    => $bride_desc,
                    "event_date"    => $event_date
                );


                if($groomimage != "")
                {

                  

                  list($type, $groomimage) = explode(';',$groomimage);
                  list(, $groomimage)      = explode(',',$groomimage);

                  $groomimage = base64_decode($groomimage);

                  if (strlen($groomimage) > 1000000) {
                  // Resize the image to a smaller size
                  $img = imagecreatefromstring($groomimage);
                  $width = imagesx($img);
                  $height = imagesy($img);
                  $newWidth = 300; // Set the new width of the image
                  $newHeight = ($newWidth / $width) * $height;
                  $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
                  imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                  ob_start();
                  imagepng($tmpImg);
                  $groomimage = ob_get_clean();
                  imagedestroy($tmpImg);
                  imagedestroy($img);
                  }

                  $filename    = uniqid() . '.png';
                  $mediaDir    = $this->site_setting("media_loc");

                  file_put_contents("/$directory/public/assets/media/" . $filename, $groomimage);
                  $array['groom_pic']   = "$filename";

                  if($data[0] == "update")
                  {
                    $file_path_groom = "/$directory/public/assets/media/$check_data[groom_pic]";
                    if (file_exists($file_path_groom)) {
                        unlink($file_path_groom);
                    }
                  }

                }



                if($brideimage != "")
                {

                  list($type, $brideimage) = explode(';',$brideimage);
                  list(, $brideimage)      = explode(',',$brideimage);

                  $brideimage = base64_decode($brideimage);

                  if (strlen($brideimage) > 1000000) {
                  // Resize the image to a smaller size
                  $img = imagecreatefromstring($brideimage);
                  $width = imagesx($img);
                  $height = imagesy($img);
                  $newWidth = 300; // Set the new width of the image
                  $newHeight = ($newWidth / $width) * $height;
                  $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
                  imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                  ob_start();
                  imagepng($tmpImg);
                  $brideimage = ob_get_clean();
                  imagedestroy($tmpImg);
                  imagedestroy($img);
                  }

                  $filename    = uniqid() . '.png';
                  $mediaDir    = $this->site_setting("media_loc");

                  file_put_contents("/$directory/public/assets/media/" . $filename, $brideimage);
                  $array['bride_pic']   = "$filename";

                  if($data[0] == "update")
                  {

                    $file_path_bride = "/$directory/public/assets/media/$check_data[bride_pic]";

                    if (file_exists($file_path_bride)) {
                        unlink($file_path_bride);
                    }

                  }

                }
                

                if(!empty($check_data))
                {

                    ## update
                    $param = array(
                        "eventID" => $event['eventID']
                    );

                    $execute = $sqlite_conn->crud($dbName , "event_info" , "update" , $array , $param);


                }elseif(empty($check_data))
                {
                    ## insert
                    $execute = $sqlite_conn->crud($dbName , "event_info" , "insert" , $array , "");
                }

                echo "/events/detail-events/$eventHashId?res=true";
            }



        }


    }

    public function actioncontrol_event($data = [] , $content = "")
    {


        $time      = $data[1];
        $key       = $data[2];
        $ID        = $data[3];
        $clientID  = $data[4];

        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

            if($data[0] != "delete")
            {

                $event_name     = $this->form_scan(array("pro" , $_POST['event_name']));
                $event_date     = $this->form_scan(array("pro" , $_POST['event_date']));
                $event_category = $this->hashId("dec" , $_POST['event_category']);
                $event_link     = $this->form_scan(array("basic" , $_POST['event_link']));

            }

            switch ($data[0]) {
                case 'add':

                    $validation = $this->form_validation(array("$event_name" , "$event_date" , "$event_category" , "$event_link"));

                    if($validation == "true")
                    {

                        $randomNumber = rand(1000, 9999);
                        $generateCode = $this->datesetting("date_number");

                        $event_code = "$randomNumber$generateCode";

                        $array = array(

                            "clientID"  => $clientID,
                            "event_name"    => $event_name,
                            "event_date"    => $event_date,
                            "categoryID"    => $event_category,
                            "event_link"    => $event_link,
                            "event_status"  => "1",
                            "event_code"    => $event_code

                        );

                        $execute = $this->crud->manage_data("event" , "insert" , $array , "");



                        if($execute[0] == "true")
                        {

                            $eventsID = $this->hashId("enc" , $execute[1]);
                            $createDB = $this->sqlite(array("CreateDB" , $event_code , "CreateUserDB"));

                            if($createDB == "true")
                            {
                                $this->headerLoc("/events/detail-events/$eventsID?res=true");

                            }


                        }

                    }

                    break;
                
                default:
                    # code...
                    break;
            }


        }


    }



}

?>