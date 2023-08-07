<?php
    if(!isset($_SESSION)){
        session_start();
    }
    // get id
    if(isset($_POST['action']) && !empty($_POST['action'])){ $act = $_POST['action']; }else{ $act = ""; }
    if(isset($_SESSION['userID']))
    {

    $usersID = $_SESSION['userID'];
    require '../../core/engine/controller.php';
    $load = new loadactions();


        switch ($act) {

            case 'removecheckin' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'guest_checkin' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'removestory' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'manage-story' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'removeslide' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'manage-slideshow' :
                $load->crudControl($act , "" , "act_events");
                break;
            
            case 'manage-galery' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'removegalery' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'removeguest' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'removeguestcat' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'removeactivity' :
                $load->crudControl($act , "" , "act_events");
                break;
        
            case 'manage-event-information' :
                $load->crudControl($act , "" , "act_events");
                break;

            case 'singout' :
                $load->singoutControl();
                break;


        }

    }



?>
