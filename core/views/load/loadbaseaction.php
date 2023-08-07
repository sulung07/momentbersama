<?php
    class loadAction extends controller {

    public function act_events($task , $getid)
    {


        require_once '../../core/config/config.php';
        require_once '../../core/config/actionControl/user-console/events/action.php';

        $database  = new config();
        $getaction = new actionEvents($database);


        $keyid     = $_POST['keyID'];
        $key       = $_POST['key'];
        $contentID = $_POST['contentID'];


        switch ($task) {


            case 'guest_checkin' :
                $getaction->actioncontrol_event_checkin(array("checkin" , $keyid , $key , $contentID));
                break;

            case 'manage-event-information':
                $getaction->actioncontrol_event_info(array("manage" , $keyid , $key , $contentID));
                break;

            case 'manage-story' :
                $task = $_POST['task'];
                $getaction->actioncontrol_event_story(array("$task" , $keyid , $key , $contentID));
                break;

            case 'manage-galery' :
                $getaction->actioncontrol_event_galery(array("manage" , $keyid , $key , $contentID));
                break;

            case 'manage-slideshow' :
                $task = $_POST['task'];
                $getaction->actioncontrol_event_slideshow(array("$task" , $keyid , $key , $contentID));
                break;

            case 'removeactivity' :
                $client  = $this->form_scan(array("basic" , $_POST['client']));
                $eventID = $this->form_scan(array("basic" , $_POST['eventID']));
                $getaction->actioncontrol_event_activity(array("delete" , $keyid , $key  , $eventID , $contentID , $client));
                break;

            case 'removeguestcat' :
                $client  = $this->form_scan(array("basic" , $_POST['client']));
                $eventID = $this->form_scan(array("basic" , $_POST['eventID']));
                $getaction->actioncontrol_guest_category(array("delete" , $keyid , $key  , $eventID , $contentID , $client));
                break;

            case 'removeguest' :
                $client  = $this->form_scan(array("basic" , $_POST['client']));
                $eventID = $this->form_scan(array("basic" , $_POST['eventID']));
                $getaction->actioncontrol_guest(array("delete" , $keyid , $key  , $eventID , $contentID , $client));
                break;

            case 'removegalery' :
                $client  = $this->form_scan(array("basic" , $_POST['client']));
                $getaction->actioncontrol_event_galery(array("delete" , $keyid , $key , $contentID , $client));
                break;

            case 'removeslide' :
                $client  = $this->form_scan(array("basic" , $_POST['client']));
                $getaction->actioncontrol_event_slideshow(array("delete" , $keyid , $key , $contentID , $client));
                break;

            case 'removestory' :
                $client  = $this->form_scan(array("basic" , $_POST['client']));
                $getaction->actioncontrol_event_story(array("delete" , $keyid , $key , $contentID , $client));
                break;

            case 'removecheckin' :
                $getaction->actioncontrol_event_checkin(array("delete" , $keyid , $key , $contentID ));
                break;
            
        }  

    }

   
    public function singoutUser(){
        session_start();
        unset($_SESSION['userID']);
        unset($_SESSION['email']);
        unset($_SESSION['username']);
        unset($_SESSION['level']);

        header("location: ../../");
    }

    }
?>
