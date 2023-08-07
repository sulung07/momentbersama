<?php
class actionLogRegister extends controller{

    protected $connection;
    public function __construct($connection) {

        $db = $connection->getConnection();
        $this->crud = $connection;
        $this->pdo = $db;
        $this->models  = $this->getData("clients");
     
    }

  

    function actioncontrol($data = []){

        switch ($data[0]) {

            case 'update_user_management' :

                $file = $_FILES['file']['name'];
                $email    = $this->form_scan($arr = array("basic" , $_POST['email']));
                $fullname = $this->form_scan($arr = array("basic" , $_POST['nama_lengkap']));
                $password = $this->form_scan($arr = array("pro"   , $_POST['password']));
                $repass   = $this->form_scan($arr = array("pro"   , $_POST['repassword']));

                $userdata = $this->models->user($arr = array("get_by_id" , $data[1]));

                $key      = $this->form_scan($arr = array("pro" , $_POST['key']));
                $userhash = $this->form_scan($arr = array("pro" , $_POST['userID']));

                $generate_key = $this->act_key($userhash);



                if($key == $generate_key):

                    if($file != "")
                    {

                        $temp = explode(".", $_FILES["file"]["name"]);
                        $newfilename = round(microtime(true)) . '.' . end($temp); 

                        $upload = $this->Upload($file , "users");



                    }else{

                        $newfilename = $userdata['profile_images'];

                    }


                    if($_POST['password'] != "")
                    {

                        if($password == $repass)
                        {
                            $generate_pass = $this->key($password);
                        }else{

                            header("location:../../../myaccount?msg=errorpassword");
                        }

                    }else{

                        $generate_pass = $userdata['password'];

                    }


                    ## check email

                    if($email == $userdata['email'])
                    {

                        $get_mail = $email;

                    }else{

                        ## count mail 

                        $countmail = $this->models->user($arr = array("count_by_field" , "email" , $email));

                        if($countmail == "" || $countmail == 0)
                        {

                            $get_mail = $email;

                        }else{

                            header("location:../../../myaccount?msg=erroremail");

                        }

                    }


                    $valid = $this->form_validation($push = array("$get_mail" , "$generate_pass" , "$fullname" ));

                    if($valid == "true")
                    {

                        $array = array(
                            "email"             => $get_mail,
                            "nama_lengkap"      => $fullname,
                            "password"          => $generate_pass,
                            "profile_images"    => $newfilename
                        );
        
        
                        $param = array(
                            "Id"                => $data[1]
                        );
        
        
                        $execute = $this->crud->manage_data("user" , "update" , $array , $param);
        
                        if($execute[0] == "true")
                        {
        
                            header("location:../../myaccount?msg=success");
        
                        }


                    }


                endif;



                break;

            
            case 'signin':

                $mail      =  $this->form_scan($arr = array("pro" , $_POST['email']));
                $password  =  $this->form_scan($arr = array("pro" , $_POST['password']));
                $generate  =  $this->key($password);

                $check_account  = $this->models->get(array("login_check" , array($mail , $generate)));

                if(empty($check_account))
                {
                    echo "
                        <div class='alert alert-danger mt-1 alert-validation-msg' role='alert'>
                        <div class='alert-body'>
                            <i data-feather='info' class='mr-50 align-middle'></i>
                            <span>User atau password yang ada masukan salah</span>
                        </div>
                        </div>
                    ";

                }else{

                    $_SESSION['userID']       = $this->hashId("enc" , $check_account['clientID']);
                    $_SESSION['username']     = $check_account['client_name'];
                    $_SESSION['email']        = $check_account['client_email'];
                    $_SESSION['parentID']     = $this->hashId("enc" , $check_account['parentID']);
                   


                    if(!empty($_POST["remember"])) { 

                        setcookie ("userMail",$mail,time()+ (10 * 365 * 24 * 60 * 60));
                        setcookie ("userPass",$password,time()+ (10 * 365 * 24 * 60 * 60));

                    }else{

                        if(isset($_COOKIE["userMail"])) {
                            setcookie ("userMail","");
                        }

                        if(isset($_COOKIE['userPass'])){
                            setcookie ("userPass","");
                        }
                    }
                    

                    header("location:../../../events");

                }
            
                break;
        }

    }

}

?>