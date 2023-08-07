<?php

class form_user extends controller
{

    public function formMyaccount($data= [])
    {

        $formaction = $this->getAction( 'actionUser' , 'user-console/user');
        $view     = $data[0];
        $ID       = $this->hashId("dec" , $data[1]);
        
    
        // get company list 
    
        $access = false;
    
        if($view == "update"):
    
            $btn_text = "Update User";
            $content = $this->getData("clients")->get(array("by_id" , array($ID)));
    
            $access = true;
    
        endif;
    
    
        if(isset($_POST['formSubmit']))
        {
    
            $time = $this->datesetting("time");
            $key  = $this->act_key($time);
            $formaction->actioncontrol($arr = array("manageuser" , "$time" , "$key" , $ID , "" ,  $content));
    
            
    
        }

    ?>

    <div class="col-12">

    <form method="post" enctype="multipa">

    <div class="card">
        <div class="card-body">


            <div class="form-group">
                <label class="form-control-label">Name</label>
                <input type="text" name="client_name" class="form-control" value="<?= $content['client_name'] ?>">
            </div>


            <div class="form-group">
                <label class="form-control-label">Email</label>
                <input type="text" name="client_email" class="form-control" value="<?= $content['client_email'] ?>">
            </div>

            <div class="form-group">
                <label class="form-control-label">Password</label>
                <input type="password" name="client_password" class="form-control"  >

                <?php if($view == "update"): ?>
                    <span class="text-danger">leave blank if you don't want to change the password</span>
                <?php endif; ?>
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


    public function form($data = [])
    {

    $formaction = $this->getAction( 'actionUser' , 'user-console/user');
    $view     = $data[0];
    $parentID = $data[1];
    

    // get company list 

    $access = false;

    if($view == "add"):

        $access = true;
        $btn_text = "Create New User";
        $ID = "";
        $content = "";

    endif;

    if($view == "update"):

        $btn_text = "Update User";
        $ID = $this->hashId("dec" , $data[2]);
        $content = $this->getData("clients")->get(array("by_id" , array($ID)));

        $access = true;

    endif;


    if(isset($_POST['formSubmit']))
    {

        $time = $this->datesetting("time");
        $key  = $this->act_key($time);
        $formaction->actioncontrol($arr = array("$view" , "$time" , "$key" , $ID , $parentID ,  $content));

        

    }


    ?>


    <?php if($access): ?>
    <div class="col-12">

    <form method="post" enctype="multipa">

    <div class="card">
        <div class="card-body">


            <div class="form-group">
                <label class="form-control-label">Name</label>
                <input type="text" class="form-control" name="client_name" <?php if($view == "update"): ?> value="<?= $content['client_name'] ?>" <?php endif; ?> >
            </div>


            <div class="form-group">
                <label class="form-control-label">Email</label>
                <input type="text" class="form-control" name="client_email" <?php if($view == "update"): ?> value="<?= $content['client_email'] ?>" <?php endif; ?> >
            </div>

            <div class="form-group">
                <label class="form-control-label">Password</label>
                <input type="password" name="client_password" class="form-control"  >

                <?php if($view == "update"): ?>
                    <span class="text-danger">leave blank if you don't want to change the password</span>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <label class="form-control-label">Status</label>
                <select name="client_status" class="form-control" data-toggle="select2">
                    <option value="1" <?php if($view == "update"){  if($content['client_status'] == 1){ echo "selected"; } } ?> >Active</option>
                    <option value="0" <?php if($view == "update"){ if($content['client_status'] == 0){ echo "selected"; } } ?> >Non Active</option>
                </select>
            </div>

            <hr>

            <div class="form-group">

            <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i><?= $btn_text ?></button>


            </div>

       
        </div>
       
    </div>

    </form>
    </div>


   <?php endif; ?>


    <?php

    }


}
