<?php
$template = new templateControllerPanel();
$userID   = $_SESSION['userID'];
$template->head($pages , array("dataForms"));

// count in 

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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

         
            <div class="row mb-2">



            </div>
           

        </div>
    </div>
</div>
<?php 
$template->footer($pages , array("dataForms")); 
?>
