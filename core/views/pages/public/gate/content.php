<?php 
$template = new templateController();
$template->head($pages , array(""));
$eventID    = "720620230726095130";


if($view == "open"):

    if(isset($value))
    {
        $guest = $this->getData("guest")->get(array("by_username" , array($eventID , $value)));

        if(!empty($guest))
        {

            ## insert into invitation_log

            $directory   = $this->site_setting('rootDirectory');
            $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
            $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

            $array = array(

                "guestID"   => $guest['guestID'],
                "open_invitation_date"  => $this->datesetting("date"),
                "open_invitation_time"  => $this->datesetting("time")

            );

            $execute = $sqlite_conn->crud($dbName , "log_invitation" , "insert" , $array , "");

            if($execute[0] == "true")
            {
                echo "true";
            }
        }
        
    }

endif;

if($view == "close"):
    session_start();
    unset($_SESSION['guestID']);

    header("location:/$value");
endif;

if($view == "sendrsvp"):


    $guestID = $this->form_scan(array("pro", $_POST['guestID']));
    $guestnumber = $this->form_scan(array("pro" , $_POST['guest']));
    $arrival     = $this->form_scan(array("pro" , $_POST['arrival']));

    if($arrival == "yes")
    {
        $plan_checkin = 1;
    }else{
        $plan_checkin = 2;
    }

    $guest = $this->getData("guest")->get(array("by_username" , array($eventID , $guestID)));

    $directory   = $this->site_setting('rootDirectory');
    $dbName      = "$directory/core/serverbase/userbase/$eventID/$eventID.db";
    $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

    $array = array(

        "guest_checkin_plan"    => $plan_checkin,
        "guest_checkin_plan_number" => $guestnumber

    );

    $param = array(

        "guestID"   => $guest['guestID']

    );

    $execute = $sqlite_conn->crud($dbName , "guest" , "update" , $array , $param);

    if($execute[0] == "true")
    {
        echo "true";
    }else{
        echo "false";
    }



endif;


$template->footer($pages , array("")); 
?>