<?php

class form_guest extends controller
{


    public function form($data = [])
    {

    $view          = $data[0];
    $clientID      = $data[1];
    $eventID       = $data[2];
    $guestID       = $this->hashId("dec" , $data[3]);    
    $eventHash     = $data[4];

    $formaction = $this->getAction( 'actionEvents' , 'user-console/events');

    $type_list = $this->getData("guest_type")->get(array("get_all"));
    $category_list = $this->getData("guest_category")->get(array("get_all" , array($eventID)));
    $activity_list = $this->getData("activity")->get(array("get_all" , array($eventID)));


    if($view == "add"):

        $content = "";
        $btn_title = "Create New Guest";
       
    endif;

    if($view == "update")
    {


        $content = $this->getData("guest")->get(array("by_id" , array($eventID , $guestID)));
        $btn_title = "Manage Guest";


    }


    if(isset($_POST['formCancel']))
    {

        header("location:/events/detail-events/$eventHash?tab=guestbook");

    }

    if(isset($_POST['formSubmit']))
    {

        $time = $this->datesetting("time");
        $key  = $this->act_key($time);
        $formaction->actioncontrol_guest($arr = array("$view" , "$time" , "$key" , $eventID , $guestID) , $content);



    }
    



    ?>


    <div class="col-12">
    <form method="post" id="my-form">

        <div class="form-group">
            <label class="form-control-label">Guest Name*</label>
            <input type="text" name="guest_name" class="form-control" <?php if($view == "update"): ?> value="<?= $content['guest_name'] ?>" <?php endif ?> >
        </div>

        <div class="form-group">
            <label class="form-control-label">Whatsapp Number</label>
            <input type="text" name="guest_phone" class="form-control" placeholder="ex:6281*********" <?php if($view == "update"): ?> value="<?= $content['guest_phone'] ?>" <?php endif; ?> >
        </div>
     
        <div class="form-group">
            <label class="form-control-label">Email</label>
            <input type="text" name="guest_email" class="form-control" <?php if($view == "update"): ?> value="<?= $content['guest_email'] ?>" <?php endif; ?> >
        </div>

        <div class="form-group">
            <label class="form-control-label">Guest Category</label>
            <select name="guestCatID" class="form-control" data-toggle="select2">
                <?php if(!empty($category_list)){ foreach ($category_list as $key => $list) { ?>
                    <option value="<?= $this->hashId("enc" , $list['guestCatID']) ?>" <?php if($view == "update"){ if($content['guestCatID'] == $list['guestCatID']){echo"selected";} } ?> ><?= $list['guest_cat_name'] ?></option>
                <?php } } ?>
            </select>
        </div>

        <div class="form-group">
            <label class="form-control-label">Invitation Type</label>
            <select name="guest_type" class="form-control" data-toggle="select2">
                <?php if(!empty($type_list)){ foreach ($type_list as $key => $list) { ?>
                    <option value="<?= $this->hashId("enc" , $list['typeID']) ?>" <?php if($view == "update"){ if($content['guestTypeID'] == $list['typeID']){echo"selected";} } ?> ><?= $list['type_name'] ?></option>
                <?php } } ?>
            </select>
        </div>

        <div class="form-group">
            <label class="form-control-label">Guest From</label>
            <select name="guestFrom" class="form-control" data-toggle="select2">
                <option value="groom" <?php if($view == "update"){ if($content['guestFrom'] == "groom"){ echo "selected"; } } ?> >Groom</option>
                <option value="bride" <?php if($view == "update"){ if($content['guestFrom'] == "bride"){ echo "selected"; } } ?> >Bride</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-control-label">Guest Number</label>
            <input type="number" class="form-control" name="guest_number" min="1" <?php if($view == "update"): ?> value="<?= $content['guest_number'] ?>" <?php endif; ?> <?php if($view == "add"): ?> value="1" <?php endif; ?> >
        </div>

        <hr>

        <h5>Guest Invitation For : </h5>


        <div class="row">

        <?php $no = 0; if(!empty($activity_list)){ foreach ($activity_list as $key => $list) { $no++; 
        
        if($view == "update"){

            $countData = $this->getData("guest_activity")->get(array("count_by_guest_activity" , array($eventID , $content['guestID'] , $list['activityID'])));

        }
        
            
        ?>
            
            <div class="col-md-6 mb-2">
                <div class="border p-3 rounded mb-3 mb-md-0">
                                                            
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="checkbox" value="<?= $list['activityID'] ?>" name="activity[]" id="customRadio<?= $no ?>" name="customRadio" class="custom-control-input" <?php if($view == "add"):  if($no == 1){echo"checked";} endif; if($view == "update"): if($countData['jmldata'] == 1){ echo "checked"; }  endif; ?> >
                    <label class="custom-control-label font-16 font-weight-bold" for="customRadio<?= $no ?>"><?= $list['activity_name'] ?></label>
                </div>
                   
                <h5 class="mt-3"> <?= $list['activity_loc_title'] ?></h5>
                                                    
                </div>
            </div>

        <?php } } ?>

        </div>


        <hr>

        <div class="form-group">

        <button type="submit" name="formCancel" class="btn btn-danger"><i class="fas fa-arrow-left mr-2"></i>Cancel</button>


        <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i><?= $btn_title ?></button>


        </div>



    </form>
    </div>


<?php } } ?>