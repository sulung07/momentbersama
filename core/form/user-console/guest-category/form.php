<?php

class form_guest_category extends controller
{


    public function form($data = [])
    {

    $view          = $data[0];
    $clientID      = $data[1];
    $eventID       = $data[2];
    $guestCat      = $this->hashId("dec" , $data[3]);    
    $eventHash     = $data[4];

    $formaction = $this->getAction( 'actionEvents' , 'user-console/events');


    if($view == "add"):

        $content = "";
        $btn_title = "Create New Guest Category";
       
    endif;

    if($view == "update")
    {


        $content = $this->getData("guest_category")->get(array("by_id" , array($eventID , $guestCat)));
        $btn_title = "Manage Guest Category";


    }


    if(isset($_POST['formCancel']))
    {

        header("location:/events/detail-events/$eventHash?tab=guestbook&subtab=guestcat");

    }

    if(isset($_POST['formSubmit']))
    {

        $time = $this->datesetting("time");
        $key  = $this->act_key($time);
        $formaction->actioncontrol_guest_category($arr = array("$view" , "$time" , "$key" , $eventID , $guestCat) , $content);



    }
    



    ?>


    <div class="col-12">
    <form method="post" id="my-form">

        <div class="form-group">
            <label class="form-control-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" <?php if($view == "update"): ?> value="<?= $content['guest_cat_name'] ?>" <?php endif; ?> >
        </div>

        


        <hr>

        <div class="form-group">

        <button type="submit" name="formCancel" class="btn btn-danger"><i class="fas fa-arrow-left mr-2"></i>Cancel</button>


        <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i><?= $btn_title ?></button>


        </div>



    </form>
    </div>


<?php } } ?>