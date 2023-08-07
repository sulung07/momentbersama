<?php
$template = new templateControllerPanel();
$template->head($pages , array("dataForms" , "dataTables"));

$userID    = $this->hashId("dec" , $_SESSION['userID']);


?>


<?php if($view == ""): 
    
$userlist = $this->getData("clients")->get(array("by_parentID" , array($userID)));
   
?>



<div class="content-page">
    <div class="content">

        <div class="container-fluid">

            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/events">Events List  </a></li>
                                <li class="breadcrumb-item active">User List</li>
                            </ol>
                        </div>
                        <h4 class="page-title">User List </h4>
                    </div>
                </div>
            </div>

            <div class="row mb-2">

            <!--  -->
            <div class="col-12">
                <a href="/usermanage/manage"><button class="btn btn-dark"><i class="fas fa fa-plus mr-2"></i>Create New User</button></a>
            </div>

            <div class="col-12 mt-2">
                <div class="card-box">
                    <table id="basic-datatable" class="table table-striped border-0">
                        <thead class="border-0">
                            <tr>
                                <th class="">Name</th>
                                <th class="">email</th>
                                <th class=" text-right">#</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php if(!empty($userlist)){ foreach ($userlist as $key => $list) { ?>
                            
                            <tr>
                                <td><?= $list['client_name'] ?></td>
                                <td><?= $list['client_email'] ?></td>
                                <td>
                            
                                <!--  -->

                                <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="/usermanage/manage/<?= $this->hashId("enc" , $list['clientID'])?>" class="dropdown-item">update</a>
                                   
                                </div>
                                </div>

                                <!--  -->

                                </td>
                            </tr>

                        <?php } } ?>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<?php endif; ?>


<?php if($view == "manage"): 

$form      = $this->controllerForm('form_user' , 'user-console/user');

if($value == "")
{
    $title = "Create New User";
    $task  = "add";

}else{

    $title = "Update User";
    $task  = "update";
}

?>


<div class="content-page">
    <div class="content">

        <div class="container-fluid">

            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/events">Events List  </a></li>
                                <li class="breadcrumb-item"><a href="/usermanage">User List  </a></li>

                                <li class="breadcrumb-item active">Manage User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Manage User </h4>
                    </div>
                </div>
            </div>

            <div class="row mb-2">

            <?php
            $form->form(array("$task" , $userID , $value));
            ?>

            </div>
        </div>
    </div>
</div>


<?php endif; ?>



<?php       
$template->footer($pages , array("dataTables" , "dataForms")); 
?>


<?php if(isset($_GET['res']) && $_GET['res'] == "true") { ?>
<script>
$.toast({heading: 'Success',text: 'Success',showHideTransition: 'plain',position: 'top-right',hideAfter: 1000,icon: 'success'});
</script>
<?php } ?>

<?php if(isset($_GET['res']) && $_GET['res'] == "false") { ?>
<script>
$.toast({heading: 'Danger',text: 'Failed',showHideTransition: 'plain',position: 'top-right',hideAfter: 1000,icon: 'danger'});
</script>
<?php } ?>