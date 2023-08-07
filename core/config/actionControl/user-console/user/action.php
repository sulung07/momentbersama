<?php
class actionUser extends controller{

    protected $connection;
    public function __construct($connection) {

        $db = $connection->getConnection();
        $this->crud = $connection;
        $this->pdo = $db;
        $this->models  = $this->getData("user");
     
    }


    public function actioncontrol($data = [])
    {

        $time     = $data[1];
        $key      = $data[2];
        $ID       = $data[3];
        $parentID = $data[4];
        $content  = $data[5];

        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

            if($data[0] != "manageuser"):

            $client_name     = $this->form_scan(array("basic" , $_POST['client_name']));
            $client_email    =  $this->form_scan(array("basic" , $_POST['client_email']));
            $client_password = $this->form_scan(array("pro" , $_POST['client_password']));
            $client_status   = $this->form_scan(array("basic" , $_POST['client_status']));


            $array = array(
                "client_name"   => $client_name,
                "client_email"  => $client_email,
                "client_status" => $client_status
            );

            endif;

            switch ($data[0]) {
                case 'add':
                    
                        $validation = $this->form_validation(array("$client_name" , "$client_email" ,  "$client_password" , "$client_status"));

                        if($validation == "true")
                        {

                            // generate password

                            $generatePassword = $this->key($client_password);

                            $array['client_password'] = $generatePassword;
                            $array['parentID']        = $parentID;


                            ## check email 

                            $check_mail = $this->getData("clients")->get(array("by_mail" , array($client_email)));

                            if(empty($check_mail))
                            {

                                $execute = $this->crud->manage_data("clients" , "insert" , $array , "");

                                if($execute[0] ==  "true")
                                {
                                    $this->directLoc("user_site" , "usermanage/?res=true");
                                }

                            }

                        
                        }

                
                    
                    break;
    
                case 'update' :


                    $mail = false;

                    $validation = $this->form_validation(array("$client_name" , "$client_email"  , "$client_status"));


                    if($validation == "true")
                    {

                        if($client_password != "")
                        {

                            $generatePassword = $this->key($client_password);
                            $array['client_password'] = $generatePassword;


                        }
                      
                  
                        $param = array(
                            "clientID" => $ID
                        );


                        #check_mail 
                        if($client_email != $content['client_email'])
                        {

                            $check_mail = $this->getData("clients")->get(array("by_mail" , array($client_email)));

                            if(empty($check_mail))
                            {
                                $mail = true;
                            }


                        }else{

                            $mail = true;

                        }



                        if($mail)
                        {

                            $execute = $this->crud->manage_data("clients" , "update" , $array , $param);
                            if($execute[0] == "true")
                            {

                                $this->directLoc("user_site","usermanage?res=true");

                            }


                        }

                    }
    
                    break;


                case 'manageuser' :

                    $mail = false;

                    $client_name     = $this->form_scan(array("basic" , $_POST['client_name']));
                    $client_email    = $this->form_scan(array("basic" , $_POST['client_email']));
                    $client_password = $this->form_scan(array("pro" , $_POST['client_password']));

                   
                    $array = array(
                        "client_name"   => $client_name,
                        "client_email"  => $client_email,
                    );


                    $validation = $this->form_validation(array("$client_name" , "$client_email"));

                    if($validation == "true")
                    {


                        if($client_password != "")
                        {

                            $generatePassword = $this->key($client_password);
                            $array['client_password'] = $generatePassword;


                        }
                      
                  
                        $param = array(
                            "clientID" => $ID
                        );


                        #check_mail 
                        if($client_email != $content['client_email'])
                        {

                            $check_mail = $this->getData("clients")->get(array("by_mail" , array($client_email)));

                            if(empty($check_mail))
                            {
                                $mail = true;
                            }


                        }else{

                            $mail = true;

                        }



                        if($mail)
                        {

                            $execute = $this->crud->manage_data("clients" , "update" , $array , $param);
                            if($execute[0] == "true")
                            {

                                $this->directLoc("user_site","myaccount?res=true");

                            }


                        }

                    }


                    break;
                
                default:
                    return; 
                    break;
            }

        }

        


    }


    

}

?>