<?php
class actionUserSetting extends controller{

    protected $connection;
    public function __construct($connection) {

        $db = $connection->getConnection();
        $this->crud = $connection;
        $this->pdo  = $db;        
    }

    function actioncontrol($DB , $data = []){

        $time         = $data[1];
        $key          = $this->form_scan(array("pro" , $data[2]));
        $generateKey  = $this->act_key($time);
        $name         = $this->form_scan(array("basic" , $_POST['name']));
        $email        = $this->form_scan(array("basic" , $_POST['email']));
        $pass         = $this->form_scan(array("basic" , $_POST['password']));
        $repass       = $this->form_scan(array("basic" , $_POST['password']));

        if($generateKey == $key)
        {


            switch ($data[0]) {
                case 'add':

                    $file         = $_FILES['file']['name'];
                    if($validation == "true")
                    {

                        if($file != "")
                        {
                            $temp = explode(".", $_FILES["file"]["name"]);
                            $newfilename = round(microtime(true)) . '.' . end($temp); 
                            $this->UploadFile($file , "banner");
                            
                        }else{
                        
                            $newfilename = "";

                        }


                        $this->directLoc("master_site" , "banner?res=true");
                        


                    }

                    break;

                case 'update' :

                        $pass_sts     = false;
                        $email_sts    = false;

                        $userID       = $data[3];
                        $file         = $_FILES['file']['name'];
                        $user         = $DB->user(array("get_by_id" , $userID));

                        if($email == $user['username'])
                        {
                            $email_sts = true;
                            echo "<h1>Email aman</h1>";


                        }else{

                            $countMail    = $DB->user(array("count_by_field" , "username" , "$email"));
                            if($countMail == "")
                            {
                                $email_sts = true;
                                echo "<h1>Email aman</h1>";

                            }else{

                                echo "<h1>Email Exists</h1>";

                            }

                        }


                        if($email_sts == true)
                        {


                            if($pass != "")
                            {

                                if($pass == $repass)
                                {
                                    $generateNewPass = $this->act_key($pass);
                                    $pass_sts = true;
                                    
                                }

                            }else{

                                $pass_sts = true;
                                $generateNewPass  = $user['password'];


                            }

                            if($file != "")
                            {
                                $temp = explode(".", $_FILES["file"]["name"]);
                                $newfilename = round(microtime(true)) . '.' . end($temp); 
                                $this->UploadFile($file , "users");
                                    
                            }else{
                                
    
                                $newfilename = $user['profile'];
    
                            }
    
                            $array = array(
    
                                "username"      => $email,
                                "name"          => $name,
                                "password"      => $generateNewPass,
                                "profile"       => $newfilename
                            );

                            $param = array(
                                "userID"    => $userID
                            );


                            if($pass_sts == true)
                            {

                                $execute = $this->crud->manage_data("user" , "update" , $array , $param);
                                if($execute[0] == "true")
                                {

                                $this->directLoc("master_site" , "myaccount?res=true");


                                }

                            }


                        }else{


                            return;

                        }                           


                    break;

                case 'delete' :

                    $mediaID = $this->hashId("dec" , $_POST['bannerID']);

                    $param = array(
                        "mediaID"   => $mediaID
                    );

                    $execute = $this->crud->manage_data("media" , "delete" , "" , $param);

                    if($execute[0] == "true")
                    {

                        echo "../../../banner?res=true";

                    }

                    break;
                
                default:
                    return;
                    break;
            }

          
        }else{

            return;
        }

        

    }


}