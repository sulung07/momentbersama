<?php

class form_events_activity extends controller
{


    public function form($data = [])
    {

    $view          = $data[0];
    $clientID      = $data[1];
    $eventID       = $data[2];
    $activityID    = $this->hashId("dec" , $data[3]);    
    $eventHash     = $data[4];

    $formaction = $this->getAction( 'actionEvents' , 'user-console/events');


    if($view == "add"):

        $content = "";
        $btn_title = "Create New Activity";
       
    endif;

    if($view == "update")
    {


        $content = $this->getData("activity")->get(array("by_activityID" , array($eventID , $activityID)));
        $btn_title = "Manage Activity";


    }


    if(isset($_POST['formCancel']))
    {

        header("location:/events/detail-events/$eventHash?tab=activity");

    }

    if(isset($_POST['formSubmit']))
    {

        $time = $this->datesetting("time");
        $key  = $this->act_key($time);
        $formaction->actioncontrol_event_activity($arr = array("$view" , "$time" , "$key" , $eventID , $activityID) , $content);



    }
    



    ?>


    <div class="col-12">
    <form method="post" id="my-form">

        <div class="form-group">
            <label class="form-control-label">Event Activity Name</label>
            <input type="text" name="activity_name" class="form-control" <?php if($view == "update"): ?> value="<?= $content['activity_name'] ?>" <?php endif; ?> >
        </div>

        <div class="form-group">
            <label class="form-control-label">Event Activity Date</label>
            <div class="input-group">
                
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>

                <input type="text" name="activity_date"   id="basic-datepicker2" class="form-control"  placeholder="Set Date"  <?php if(!empty($content)){ ?> value="<?= $content['activity_date'] ?>" <?php } ?> >

            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Event Activity Time</label>
            <div class="row">
                <div class="col-lg-5">
                <input type="text" name="activity_time" id="basic-timepicker" class="form-control" placeholder="12:00" <?php if($view == "update"): ?> value="<?= $content['activity_time'] ?>" <?php endif; ?>  >

                </div>
                <div class="col-lg-2 text-center">
                <h5>-</h5>
                </div>
                <div class="col-lg-5">
                <input type="text" name="activity_time_end" id="basic-timepicker2" class="form-control" placeholder="12:00" <?php if($view == "update"): ?> value="<?= $content['activity_time_end'] ?>" <?php endif; ?>  >

                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Event Activity Location</label>
            <input type="text" name="activity_loc_title" class="form-control" <?php if($view == "update"): ?> value="<?= $content['activity_loc_title'] ?>" <?php endif; ?> >
        </div>

        <div class="form-group">
            <label class="form-control-label">Event Activity Location Maps</label>
            <input type="text" name="activity_loc_maps" class="form-control" <?php if($view == "update"): ?> value="<?= $content['activity_loc_maps'] ?>" <?php endif; ?> >
        </div>


        <hr>

        <div class="form-group">

        <button type="submit" name="formCancel" class="btn btn-danger"><i class="fas fa-arrow-left mr-2"></i>Cancel</button>


        <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i><?= $btn_title ?></button>


        </div>



    </form>
    </div>


<?php } } ?>