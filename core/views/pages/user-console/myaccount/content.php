<?php
$template = new templateControllerPanel();
$template->head($pages , array("dataForms"));
$userID        = $_SESSION['userID'];
$models        = $this->getData("clients"); 
$form          = $this->controllerForm('form_user' , 'user-console/user');

$user          = $models->get(array("by_id" , $this->hashId("dec" , $userID)));

?>


<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
                        
            <!-- start page title -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/events">Events List  </a></li>

                                <li class="breadcrumb-item active">My Account</li>
                            </ol>
                        </div>
                        <h4 class="page-title">My Account </h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

         
            <div class="row mb-2">
           
            <!--  -->

            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">

               

                <h4 class="mb-0"><?= $user['client_name'] ?></h4>


                <div class="text-left mt-3">
                <h4 class="font-13 text-uppercase">About Me :</h4>
              
                <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ml-2"><?= $user['client_name'] ?></span></p>


                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "><?= $user['client_email'] ?></span></p>

                                       
                </div>

    
            </div> <!-- end card-box -->

            <!--  -->

            </div>

            <div class="col-lg-8 col-xl-8">

            <?php
            $form->formMyaccount(array("update" , $userID));
            ?>

            </div>

        </div>
    </div>
</div>

<?php $template->footer(); ?>


<?php if(isset($_GET['res']) && $_GET['res'] == "true") { ?>

<script>
$.toast({heading: 'Success',text: 'Success',showHideTransition: 'plain',position: 'top-right',hideAfter: 1000,icon: 'success'});
</script>

<?php } ?>