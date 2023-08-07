<?php
class actionApiSetting extends controller{

    protected $connection;
    public function __construct($connection) {

        $db = $connection->getConnection();
        $this->crud = $connection;
        $this->pdo = $db;
        $this->models  = $this->getData("user");
     
    }


    public function actioncontrol($data = [])
    {

        $time = $data[1];
        $key  = $data[2];
        $ID   = $data[3];
        $companyID = $data[4];
        $content   = $data[5];

        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

            if($companyID == 1)
            {
                
                $company = $this->form_scan(array("basic",$_POST['companyID']));

            }

            $api_username = $this->form_scan(array("basic",$_POST['api_username']));
            $api_password = $this->form_scan(array("basic",$_POST['api_key']));
            $api_npwp     = $this->form_scan(array("basic",$_POST['api_npwp']));
            $ref_prefix   = $this->form_scan(array("basic",$_POST['ref_prefix']));
           
            switch ($data[0]) {
                case 'add':


                    if($companyID == 1):
                        
                        $validation = $this->form_validation(array("$api_username" , "$api_password" , "$api_npwp" , "$ref_prefix"));

                        if($validation == "true")
                        {

                            $array = array(


                                "companyID"     => $company,
                                "api_username"  => $api_username,
                                "api_password"  => $api_password,
                                "api_npwp"      => $api_npwp,
                                "ref_prefix"    => $ref_prefix
                                

                            );


                            $execute = $this->crud->manage_data("api_setting" , "insert" , $array , "");

                            if($execute[0] ==  "true")
                            {
 
                                $this->directLoc("user_site" , "master/api-setting?res=true");

                            }


                        }


                    endif;
                    
                    

    
                    break;
    
                case 'update' :

                    $validation = $this->form_validation(array("$api_username" , "$api_password" , "$api_npwp" , "$ID"));
                    if($validation == "true")
                    {

                      
                        $array = array(

                            "api_username"  => $api_username,
                            "api_password"  => $api_password,
                            "api_npwp"      => $api_npwp,
                            "ref_prefix"    => $ref_prefix
                           

                        );

                        if($companyID == 1)
                        {
                            $array['companyID'] = $company;
                        }
                        
                        $param = array(
                            "apiID" => $ID
                        );

                       
                        

                        $execute = $this->crud->manage_data("api_setting" , "update" , $array , $param);


                        if($execute[0] == "true")
                        {

                            $this->directLoc("user_site","master/api-setting?res=true");

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