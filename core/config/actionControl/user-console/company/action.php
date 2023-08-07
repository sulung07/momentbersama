<?php
class actionCompany extends controller{

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

            $company_name = $this->form_scan(array("basic",$_POST['company_name']));
            $file         = $_FILES['file']['name'];

            if($companyID == 1)
            {
                $status   = $this->form_scan(array("basic",$_POST['status']));

            }
            

            switch ($data[0]) {
                case 'add':
                    
                    $validation = $this->form_validation(array("$company_name"));

                    if($validation == "true")
                    {

                        if($file != "")
                        {
                            $temp = explode(".", $_FILES["file"]["name"]);
                            $newfilename = round(microtime(true)) . '.' . end($temp); 
                            $this->UploadImage($file , "images/brands");
                        }else{

                            $newfilename = "";
                        }

                        $get_comp_name = str_replace(' ', '', $company_name); // Menghapus spasi
                        $rootdir = strtolower($get_comp_name);

                        $array = array(


                            "company_name"      => $company_name,
                            "company_logo"      => $newfilename,
                            "company_status"    => $status,
                            "rootdir"           => $rootdir

                        );

                        $execute = $this->crud->manage_data("company" , "insert" , $array , "");

                        if($execute[0] == "true")
                        {

                            $createDB = $this->sqlite(array("CreateDB" , $rootdir , "CreateUserDB"));

                            if($createDB == "true")
                            {
    
                                 $this->directLoc("user_site" , "master/company?res=true"); 

                            }
                                

                        
                        }

                    }
    
                    break;
    
                case 'update' :

                    $validation = $this->form_validation(array("$company_name" , "$ID"));
                    if($validation == "true")
                    {

                        if($file != "")
                        {
                            $temp = explode(".", $_FILES["file"]["name"]);
                            $newfilename = round(microtime(true)) . '.' . end($temp); 
                            $this->UploadImage($file , "images/brands");
                        }else{

                            $newfilename = $content['company_logo'];
                        }

                        $array = array(
                            "company_name"  => $company_name,
                            "company_logo"  => $newfilename
                        );
                        
                        $param = array(
                            "companyID" => $ID
                        );

                        if($companyID == 1)
                        {
                            $array['company_status']  = $status;
                        }
                        

                        $execute = $this->crud->manage_data("company" , "update" , $array , $param);


                        if($execute[0] == "true")
                        {

                            $this->directLoc("user_site","master/company?res=true");

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