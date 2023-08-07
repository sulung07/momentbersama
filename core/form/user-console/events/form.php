<?php

class form_events extends controller
{


    public function form($data = [])
    {

    $formaction = $this->getAction( 'actionEvents' , 'user-console/events');
    $view   = $data[0];
    $clientID = $data[2];
        
    $category_list = $this->getData("event_category")->get(array("get_all"));

    if($view == "add"):

        $access = true;
        $btn_text = "Create New Event";
        $ID = "";
        $content = "";

    endif;

    if($view == "update"):

        $btn_text = "Manage Event";
        $ID = $this->hashId("dec" , $data[1]);

       
    endif;


    if(isset($_POST['formSubmit']))
    {

        $time = $this->datesetting("time");
        $key  = $this->act_key($time);
        $formaction->actioncontrol_event($arr = array("$view" , "$time" , "$key" , $ID , $clientID) , $content);

        

    }


    ?>


    <div class="col-12">

    <form method="post" enctype="multipa">

    <div class="card">
        <div class="card-body">


            <div class="form-group">
                <label class="form-control-label">Event Name</label>
                <input type="text" name="event_name" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-control-label">Event Date</label>
                <div class="input-group">
                
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>

                    <input type="text" name="event_date"   id="basic-datepicker" class="form-control"  placeholder="Set Date" value="2023-07-25"  >

                </div>
            </div>

            <div class="form-group">
                <label class="form-control-label">Event Category</label>
                <select name="event_category" class="form-control" data-toggle="select2">
                    <?php if(!empty($category_list)){ foreach ($category_list as $key => $list) { ?>
                        <option value="<?= $this->hashId("enc" , $list['categoryID']) ?>"><?= $list['category_name'] ?></option>
                    <?php } } ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-control-label">Event Link</label>
                <input type="text" name="event_link" class="form-control">
            </div>

            <hr>

            <div class="form-group">

            <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i><?= $btn_text ?></button>


            </div>

       
        </div>
       
    </div>

    </form>
    </div>




    <?php

    }


}
