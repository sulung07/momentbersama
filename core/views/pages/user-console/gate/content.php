<?php $act      = $view; 
//$template = new templateControllerPanel();

switch ($act) {

    case 'sendwa' :

        if(isset($_POST['guestID']))
        {

            $eventID = $this->form_scan(array("pro" , $_POST['eventID']));
            $guestID = $this->form_scan(array("pro" , $_POST['guestID']));

            $directory   = $this->site_setting('rootDirectory');
            $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
            $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

            $array = array(
                "wa_send"   => "1",
            );

            $param = array(
                "guestID"   => $guestID
            );

            $execute = $sqlite_conn->crud( $dbName , "guest" , "update" , $array , $param);

            if($execute[0] == "true")
            {echo "true";
            }else{
            echo "false";
            }
        }

        break;
    case 'singout':
        session_start();
        unset($_SESSION['userID']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['parentID']);
        header("location: ../../");
        break;
}