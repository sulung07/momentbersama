<?php

class form_tradingAccount extends controller
{


    public function index($data = [])
    {

    $formaction = $this->getAction( 'actionAccount' , 'master/account');
    $view   = $data[0];
    $models = $this->getData("dataTrading" , "trading");

    if($view == "add"):

        $btn_text = "Create Account";

    endif;

    if($view == "update"):

        $btn_text = "Change Account";
        $account  = $models->account($arr = array("get_by_hashId" , $data[1]));

    endif;


    if(isset($_POST['formSubmit']))
    {

        if($view == "add"):

            $formaction->actioncontrol($arr = array("add" , "1" , $data[1]));

        endif;

        if($view == "update"):

            $formaction->actioncontrol($arr = array("update" , $account['accountID']));

        endif;

    }


    ?>


    <form method="post">

    
    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <label class="form-control-label">Account No </label>
                <input type="text" class="form-control" name="account_no" <?php if($view == "update"): ?> value="<?= $account['account_no'] ?>" <?php endif; ?> >
            </div>

            <div class="form-group">
                <label class="form-control-label">Account Label</label>
                <input type="text" class="form-control" name="account_label" <?php if($view == "update"): ?> value="<?= $account['account_label'] ?>" <?php endif; ?> >
            </div>

            <div class="form-group">
                <label class="form-control-label">Account Password</label>
                <input type="text" class="form-control" name="account_password" <?php if($view == "update"): ?> value="<?= $account['account_password'] ?>" <?php endif; ?>  >
            </div>

           
        </div>
        <div class="card-footer bg-white">

            <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i><?= $btn_text ?></button>

        </div>
    </div>


    </form>





    <?php

    }


}
