<?php

  class actioncontrol {

    protected $connection;

    public function __construct($connection) {
        $db = $connection->getConnection('panel');
        $this->pdo = $db;
        $this->getdata = $connection;
    }


    public function check_mail ($data) {

        $select="email";
        $table ="tb_members";

        $getdata = $this->getdata->get_data($select , $table , array('where' => array('email' => $data) , 'return_type' => 'count'));

        return $getdata;

    }

    public function split_name($name){

      $parts = array();

        while ( strlen( trim($name)) > 0 ) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim( preg_replace('#'.$string.'#', '', $name ) );
        }

        if (empty($parts)) {
        return false;
        }

        $parts = array_reverse($parts);
        $name = array();
        $firstname = $parts[0];
        $middlename = (isset($parts[2])) ? $parts[1] : '';
        $lastname = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');

        return  array($firstname , $middlename , $lastname);


    }

    public function pass_check(){
      $getpass     = trim(htmlspecialchars($_POST['password']));

      $getPassword = $this->key($getpass);
      echo "$getPassword";
    }

    public function loginUser(){




      $getaccount  = trim(htmlspecialchars($_POST['username']));
      $getpass     = trim(htmlspecialchars($_POST['password']));

      $getPassword = $this->key($getpass);



        $select = "id , email , password , level , countlogin ";
        $table  = "tb_user";



         $count_data = $this->getdata->get_data($select , $table , array("where" => array("email" => $getaccount , "password" => $getPassword ) , "return_type" => "count"));
          if($count_data == 1 ){


            $get_admin = $this->getdata->get_data($select , $table , array("where" => array("email" => $getaccount , "password" => $getPassword) , "return_type" => "single"));


            $nextlogin = $get_admin['countlogin'] + 1;

            // update


            $prepare = "UPDATE tb_user SET countlogin = :countlogin WHERE id = :getid";

            if($stmt = $this->pdo->prepare($prepare)){

              $stmt->bindParam(":countlogin"      , $nextlogin            , PDO::PARAM_INT);
              $stmt->bindParam(":getid"           , $get_admin['id']      , PDO::PARAM_INT);

              if($stmt->execute()){


                  $_SESSION['userID']    = $get_admin['id'];
                  $_SESSION['level']     = $get_admin['level'];


                  //header("location:auth");
                  header("location:../main");



              }

            }

            /** GET OUTLET */


           



          }

     }





    public function singout(){
      session_start();
      $user = $_SESSION['idUser'];

      unset($_SESSION['positionUser']);
      unset($_SESSION['branch']);
      unset($_SESSION['idUser']);
      unset($_SESSION['idPanel']);
      unset($_SESSION['base']);


      header("location: https://pos.marijoin.com/");


    }






  }

 ?>
