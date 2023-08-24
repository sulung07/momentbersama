<?php
$template = new templateControllerPanel();
$userID   = $_SESSION['userID'];
$template->head($pages , array("dataForms" , "dataTables" , "galery"));
$eventModels = $this->getData("event");


if(isset($_SESSION['parentID']))
{

    $parentID = $this->hashId("dec" , $_SESSION['parentID']);

    if($parentID == 0)
    {

        $clientID    = $this->hashId("dec" , $_SESSION['userID']);


    }else{

        $clientID    = $parentID;


    }

}


?>


<?php if($view == ""): 

$event_list = $eventModels->get(array("by_clientID" , array($clientID)));

?>

<div class="content-page">
    <div class="content">

        <div class="container-fluid">
                        
            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/">Dashboard  </a></li>
                                <li class="breadcrumb-item active">Events</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Events List</h4>
                    </div>
                </div>
            </div>     

         
            <div class="row mb-2">

                <div class="col-12">
                    <a href="/events/manage-events"><button class="btn btn-dark">Create New Events</button></a>
                </div>

                <div class="col-12 mt-2">

                <div class="card-box">
                    <div class="table-responsive">
                    <table id="basic-datatable" class="table table-striped border-0">
                        <thead class="border-0">
                            <tr>
                                <th class="border-0">Client Name</th>
                                <th class="border-0">Event Name</th>
                                <th class="border-0">Event Date</th>
                                <th class="border-0">Event Link</th>
                                <th class="border-0 text-right">#</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php if(!empty($event_list)){ foreach ($event_list as $key => $list) { 
                        
                        $formatDate = $this->dateIndo($list['event_date']);
                        
                        ?>
                            
                            <tr>
                                <td class="border-0"><?= $list['client_name'] ?></td>
                                <td class="border-0"><?= $list['event_name'] ?></td>
                                <td class="border-0"><?= $formatDate ?></td>
                                <td class="border-0"><?= $list['event_link'] ?></td>
                                <td class="border-0">

                                    <!--  -->
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if($parentID == 0): ?>
                                            <a href="/events/detail-events/<?= $this->hashId("enc" , $list['eventID']) ?>" class="dropdown-item">Manage</a>
                                            <?php endif; ?>
                                            <a href="/events/statistik/<?= $this->hashId("enc" , $list['eventID']) ?>" class="dropdown-item">Statistik</a>
                                            <a href="/events/guestbook/<?= $this->hashId("enc" , $list['eventID']) ?>" class="dropdown-item">Guestbook Dashboard</a>

                                        </div>
                                    </div>
                                    <!--  -->

                                </td>
                            </tr>

                        <?php }  } ?>

                        </tbody>
                    </table>
                    </div>
                </div>

                </div>

            </div>
           

        </div>
    </div>
</div>

<?php endif; ?>


<?php if($view == "guestbook"): 

$event = $eventModels->get(array("by_eventID" , array($this->hashId("dec" , $value))));

$formatDate = $this->dateIndo($event['event_date']);



$sum_guest = $this->getData("guest")->get(array("sum_all" , array($event['event_code'])));
$sum_guest_groom = $this->getData("guest")->get(array("sum_by_from" , array($event['event_code'] , "groom")));
$sum_guest_bride = $this->getData("guest")->get(array("sum_by_from" , array($event['event_code'] , "bride")));


$sum_guest_checkin = $this->getData("guest_book")->get(array("sum_all" , array($event['event_code'])));
$sum_guest_groom_checkin = $this->getData("guest_book")->get(array("sum_by_from" , array($event['event_code'] , "groom")));
$sum_guest_bride_checkin = $this->getData("guest_book")->get(array("sum_by_from" , array($event['event_code'] , "bride")));

?>

<div class="content-page">
    <div class="content">

        <div class="container-fluid">
                        
            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/">Dashboard  </a></li>
                                <li class="breadcrumb-item"><a href="/events">Events List  </a></li>

                                <li class="breadcrumb-item active">Events Guest Book</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Events Guest Book</h4>
                    </div>
                </div>
            </div> 
            
            <div class="row mb-2">

                <div class="col-12">

                <!--  -->
                <div class="card-box mb-2">
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="mt-0 mb-2 font-16"><?= $event['event_name'] ?> </h4>
                                    <p class="mb-1"><b>Category:</b> <?= $event['category_name'] ?></p>
                                    <p class="mb-0"><b>Client:</b> <?= $event['client_name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class=" my-3 my-sm-0">
                            <p class="mb-0"><b>Event Date : <?= $formatDate ?></b></p>
                            <p class="mb-0"><b>Link:</b> <?= $event['event_link'] ?></p>


                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-right button-list">
                            <?php if($parentID == 0): ?>
                            <a href="/events/detail-events/<?= $value ?>" class="btn btn-success waves-effect waves-light"><i class="fas fa-pencil-ruler mr-2"></i>Manage Events</a>             
                            <?php endif; ?>
                            <a href="/events/statistik/<?= $value ?>" class="btn btn-primary waves-effect waves-light"><i class=" far fa-chart-bar mr-2"></i>Lihat Statistik</a>             

                            </div>
                        </div>
                                    
                    </div> <!-- end row -->
                </div>
                <!--  -->

                </div>

                <div class="col-lg-4">

                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12">
                            <h4 class="header-title">Global Guest</h4>

                            </div>
                            <div class="col-lg-8">

                                <div class="mt-4 chartjs-chart">
                                <canvas id="donut-chart-example-total" height="150" data-colors="#44cf9c,#1abc9c"></canvas>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <table class="table mt-4">
                                    <tr>
                                        <td style="background:#9b9b5b; color:white;">Total Guest : <?= $sum_guest['jmldata'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="background:#d0c5b1; color:white;">Checkin : <?= $sum_guest_checkin['jmldata'] ?></td>

                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4">

                    <!--  -->

                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12">
                            <h4 class="header-title">Groom Guest</h4>
                            <!--  -->

                            </div>
                            <div class="col-lg-8">

                                <div class="mt-4 chartjs-chart">
                                <canvas id="donut-chart-example-groom" height="150" data-colors="#44cf9c,#1abc9c"></canvas>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <table class="table mt-4">
                                    <tr>
                                        <td style="background:#9b9b5b; color:white;">Total Guest : <?= $sum_guest_groom['jmldata'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="background:#d0c5b1; color:white;"> Checkin : <?= $sum_guest_groom_checkin['jmldata'] ?></td>

                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                    <!--  -->

                </div>

                <div class="col-lg-4">

                    <!--  -->

                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12">
                            <h4 class="header-title">Bride Guest</h4>

                            </div>
                            <div class="col-lg-8">

                                <div class="mt-4 chartjs-chart">
                                <canvas id="donut-chart-example-bride" height="150" data-colors="#44cf9c,#1abc9c"></canvas>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <table class="table mt-4">
                                    <tr>
                                        <td style="background:#9b9b5b; color:white;">Total Guest : <?= $sum_guest_bride['jmldata'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="background:#d0c5b1; color:white;"> Checkin : <?= $sum_guest_bride_checkin['jmldata'] ?></td>

                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                    <!--  -->

                </div>


                <div class="col-lg-6">
                   <div class="card">
                        <div class="card-body">

                        <h4 class="header-title">Guest List</h4>

                        <?php 
                                                    
                            $guestlist = $this->getData("guest")->get(array("get_all" , array($event['event_code']))) ?>
                            <div class="table-responsive">
                                <table id="basic-datatable2" class="table table-striped border-0">
                                    <thead class="border-0">
                                        <tr>
                                            <th class="border-0">Guest Name</th>
                                            <th class="border-0">Type</th>
                                            <th class="border-0">Persons</th>
                                                            
                                            <th class="border-0 text-right">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(!empty($guestlist)){ foreach ($guestlist as $key => $list) { 

                                    $hashGuest = $this->key($list['guestID']);
                                                    
                                    $category = $this->getData("guest_category")->get(array("by_id" , array($event['event_code'] , $list['guestCatID'])));
                                    $type     = $this->getData("guest_type")->get(array("by_id" , array($list['guestTypeID'])));

                                    $guest_act = $this->getData("guest_activity")->get(array("by_guestID" , array($event['event_code'] , $list['guestID'])));
                                    ?>

                                    <tr>
                                        <td class="border-0"><?= $list['guest_name'] ?></td>
                                        <td class="border-0"><?= $type['type_name'] ?></td>

                                        <td class="border-0"><?= $list['guest_number'] ?></td>
                                       
                                        <td class="border-0">

                                        <button data-toggle="modal" data-target="#guestcheckin_<?= $hashGuest ?>" class="btn btn-success btn-sm"><i class="fas fa-sign-out-alt mr-2"></i>Checkin</button>         

                                        <!--  -->

                                        <div class="modal fade" id="guestcheckin_<?= $hashGuest ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myCenterModalLabel">Guest Checkin</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!--  -->
                                                        <table class="table">
                                                            <tr>
                                                                <td class="border-0">Guest ID</td>
                                                                <td class="border-0 text-right font-weight-bold"><?= $list['guest_username'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Guest Name</td>
                                                                <td class="border-0 text-right font-weight-bold"><?= $list['guest_name'] ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="border-0">Guest Category</td>
                                                                <td class="border-0 text-right font-weight-bold"><?= $category['guest_cat_name'] ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="border-0">Guest From</td>
                                                                <td class="border-0 text-right font-weight-bold"><?= $list['guestFrom'] ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="border-0">Guest Number</td>
                                                                <td class="border-0 text-right font-weight-bold"><?= $list['guest_number'] ?></td>
                                                            </tr>

                                                           
                                                            
                                                        </table>

                                                        <br>
                                                        <h5><i class="fab fa-wpforms mr-2"></i>Checkin Form</h5>
                                                        
                                                        <form method="post" id="formcheckin_<?= $hashGuest ?>">

                                                        <?php 
                                                         $time = $this->datesetting("time");
                                                         $key  = $this->act_key($time);
                                                        ?>

                                                        <input type="hidden" id="action" name="action" value="guest_checkin">
                                                        <input type="hidden" id="event" name="event" value="<?= $event['event_code'] ?>">

                                                        <input type="hidden" id="contentID" name="contentID" value="<?= $this->hashId("enc" , $list['guestID']) ?>">
                                                        <input type="hidden" id="keyID" name="keyID" value="<?= $time ?>">
                                                        <input type="hidden" id="key" name="key" value="<?= $key ?>">

                                                        <div class="form-group">
                                                            <input type="text" name="checkin_number" class="form-control" placeholder="Checkin Number">
                                                        </div>

                                                        <div class="row">

                                                        <?php $no = 0; if(!empty($guest_act)){ foreach ($guest_act as $key => $list) { $no++; ?>
                                                            
                                                             
                                                        <div class="col-md-12 mb-2">
                                                            <div class="border p-3 rounded mb-3 mb-md-0">
                                                                                                        
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" value="<?= $list['activityID'] ?>" name="activity" id="customRadio_<?= $hashGuest ?><?= $no ?>" name="customRadio" class="custom-control-input" >
                                                                <label class="custom-control-label font-14 font-weight-bold" for="customRadio_<?= $hashGuest ?><?= $no ?>"><?= $list['activity_name'] ?>  </label>
                                                            </div>
                                                            
                                                            <h5 class="mt-3"> <?= $list['activity_loc_title'] ?> <br> <small><?= $list['activity_time'] ?> - <?= $list['activity_time_end'] ?></small></h5>
                                                                                                
                                                            </div>
                                                        </div>

                                                        <?php } } ?>

                                                        </div>

                                                        </form>

                                                        <button id="checkinButton" class="btn btn-block btn-success" onclick="guestcheckin('<?= $hashGuest ?>')"><i class="fas fa-sign-out-alt mr-2"></i>CHECKIN</button>

                                                        <div id="errormessage" class="col-12 mt-2 text-danger text-center"></div>
                                                        <!--  -->
                                                       
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
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

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">

                        <h4 class="header-title">Guest Checkin List</h4>

                        <?php 
                        $checkin_list = $this->getData("guest_book")->get(array("get_all" , array($event['event_code'])));
                        ?>

                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-striped border-0">
                                <thead class="border-0">
                                        <tr>
                                            <th class="border-0">Guest Name</th>
                                            <th class="border-0">Checkin Time</th>
                                            <th class="border-0">Persons</th>
                                            <th class="border-0 text-right">#</th>
                                        </tr>
                                </thead>
                                <tbody>

                                <?php if(!empty($checkin_list)){ foreach ($checkin_list as $key => $list) { 
                                
                                $hashCheckin = $this->key($list['bookID']);
                                
                                ?>
                                   
                                    <tr>
                                        <td class="border-0"><?= $list['guest_name'] ?> <br> <small>( <?= $list['activity_name'] ?> )</small></td>
                                        <td class="border-0"><?= $list['check_in_date'] ?> ( <?= $list['check_in_time'] ?> )</td>
                                        <td class="border-0"><?= $list['guest_number'] ?></td>
                                        <td class="border-0">
                                         <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#remove_checkin_<?= $hashCheckin ?>"><i class="fas fa-trash-alt"></i></button>

                                         <!--  -->

                                          
                                         <form id="checkindeleteform<?= $hashCheckin ?>" method="post">
                                         <input type="hidden" name="action" value="removecheckin">
                                         <input type="hidden" name="event" value="<?= $event['event_code'] ?>">
                                         <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['bookID']) ?>">
                                         <input type="hidden" name="keyID" value="<?= $hashCheckin ?>">
                                         <input type="hidden" name="key" value="<?= $this->act_key($hashCheckin) ?>">
                                         </form>

                                        <?= $alert = $this->modalAlert(array("danger" , "remove_checkin_$hashCheckin" , "removecheckin('$hashCheckin')")); ?>


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

            
            
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($view == "manage-events"): 

$form = $this->controllerForm('form_events' , 'user-console/events');

if($value == "")
{

    $task = "add";
    $ID   = "";

}else{

    $task = "update";
    $ID   = $value;
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
                                <li class="breadcrumb-item"><a href="/">Dashboard  </a></li>
                                <li class="breadcrumb-item"><a href="/events">Events List  </a></li>

                                <li class="breadcrumb-item active">Manage Events</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Manage Events</h4>
                    </div>
                </div>
            </div>     

            <div class="row mb-2">
                <?php $form->form(array("$task" ,  $ID , $clientID)); ?>
            </div>
           

        </div>
    </div>
</div>


<?php endif; ?>


<?php if($view == "statistik"): 

$event = $eventModels->get(array("by_eventID" , array($this->hashId("dec" , $value))));

$formatDate = $this->dateIndo($event['event_date']);

$activity_list = $this->getData("activity")->get(array("get_all" , array($event['event_code'])));

$sum_guest = $this->getData("guest")->get(array("sum_all" , array($event['event_code'])));
$sum_guest_groom = $this->getData("guest")->get(array("sum_by_from" , array($event['event_code'] , "groom")));
$sum_guest_bride = $this->getData("guest")->get(array("sum_by_from" , array($event['event_code'] , "bride")));


$count_in_online = $this->getData("guest")->get(array("count_by_type" , array($event['event_code'] , "1")));
$count_in_ofline = $this->getData("guest")->get(array("count_by_type" , array($event['event_code'] , "2")));
$count_in        = $this->getData("guest")->get(array("count_all" , array($event['event_code'])));

$count_rsvp_default = $this->getData("guest")->get(array("count_by_rsvp_default" , array($event['event_code'])));
$count_rsvp_yes     = $this->getData("guest")->get(array("count_by_rsvp" , array($event['event_code'] , "1")));
$count_rsvp_no      = $this->getData("guest")->get(array("count_by_rsvp", array($event['event_code'] , "2")));

$count_inv_open     = $this->getData("log_invitation")->get(array("count_all" , array($event['event_code'])));


?>


<div class="content-page">
    <div class="content">

        <div class="container-fluid">
                        
            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/">Dashboard  </a></li>
                                <li class="breadcrumb-item"><a href="/events">Event List  </a></li>

                                <li class="breadcrumb-item active">Events Statistik</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Events Statistik</h4>
                    </div>
                </div>
            </div>     

         
            <div class="row mb-2">

            <div class="col-12">

                <!--  -->
                <div class="card-box mb-2">
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="mt-0 mb-2 font-16"><?= $event['event_name'] ?> </h4>
                                    <p class="mb-1"><b>Category:</b> <?= $event['category_name'] ?></p>
                                    <p class="mb-0"><b>Client:</b> <?= $event['client_name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class=" my-3 my-sm-0">
                            <p class="mb-0">Event Date : <?= $formatDate ?></p>
                            <p class="mb-0"><b>Link:</b> <?= $event['event_link'] ?></p>


                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-right button-list">
                            <?php if($parentID == 0): ?>
                            <a href="/events/detail-events/<?= $value ?>" class="btn btn-success waves-effect waves-light"><i class="fas fa-pencil-ruler mr-2"></i>Manage Events</a>             
                            <?php endif; ?>
                            <a href="/events/guestbook/<?= $value ?>" class="btn btn-light waves-effect waves-light"><i class="fas fa-house-user mr-2"></i>Guest Checkin</a>             

                            </div>
                        </div>
                                      
                    </div> <!-- end row -->
                </div>
                <!--  -->

            </div>

            <div class="col-lg-6">

                    

                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Guest By Groom & Bride</h4>
                            <div class="row">

                                <div class="col-lg-6">

                                <div class="mt-4 chartjs-chart">
                                <canvas id="donut-chart-example" height="150" data-colors="#44cf9c,#1abc9c,#ebeff2"></canvas>
                                </div>

                                </div>
                                <div class="col-lg-6">

                                    <div class="row">

                                    <!--  -->

                                    <div class="col-md-12 col-xl-12">
                                        <div class="widget-rounded-circle card-box" style="background:#ece5df;" >
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="avatar-lg rounded-circle bg-soft-dark border-light border">
                                                    <i class="fe-users font-22 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin=""><?= $this->formatNumber($sum_guest['jmldata'],0) ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Total Guest</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div> <!-- end widget-rounded-circle-->
                                    </div>


                                    <div class="col-md-6 col-xl-6">
                                        <div class="widget-rounded-circle card-box" style="background:#9b9b5b;">
                                            <div class="row">
                                                           
                                                <div class="col-12">
                                                    <div class="text-right">
                                                    <h3 class="mt-1 text-white"><span data-plugin=""><?= $this->formatNumber($sum_guest_groom['jmldata'],0) ?></span></h3>
                                                    <p class="text-white mb-1 text-truncate">Groom Guest</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div> <!-- end widget-rounded-circle-->
                                    </div>

                                    <div class="col-md-6 col-xl-6">
                                        <div class="widget-rounded-circle card-box" style="background:#dba8bb;">
                                            <div class="row">
                                                           
                                                <div class="col-12">
                                                    <div class="text-right">
                                                        <h3 class="mt-1 text-white"><span data-plugin=""><?= $this->formatNumber($sum_guest_bride['jmldata'],0) ?></span></h3>
                                                        <p class="text-white mb-1 text-truncate">Bride Guest</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div> <!-- end widget-rounded-circle-->
                                    </div>

                                    <!--  -->

                                    </div>

                                </div>

                            </div>
                           
                        </div> <!-- end card-body-->
                    </div>


                    <div class="card">
                        <div class="card-body">
                                        
                        <h4 class="header-title mb-0">Guest By Category</h4>

                        <div id="cardCollpase8" class="collapse pt-3 show" dir="ltr">
                        <div id="apex-bar-1" class="apex-charts" data-colors="#9b9b5b"></div>
                        </div> <!-- collapsed end -->
                        </div> <!-- end card-body -->
                    </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                    <h4 class="header-title">Invitation</h4>

                    <div class="row">

                        <div class="col-md-12 col-xl-12">
                            <div class="widget-rounded-circle card-box" style="background:#ece5df;" >
                                <div class="row">
                                  
                                    <div class="col-12">
                                        <div class="text-right">
                                        <h3 class="mt-1 text-dark"><span data-plugin=""><?= $this->formatNumber($count_in['jmldata'],0) ?></span></h3>
                                        <p class="text-dark mb-1 text-truncate">Total Invitation</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="widget-rounded-circle card-box" style="background:#9b9b5f;" >
                                <div class="row">
                                  
                                    <div class="col-12">
                                        <div class="text-right">
                                        <h3 class="mt-1 text-white"><span data-plugin=""><?= $this->formatNumber($count_in_online['jmldata'],0) ?></span></h3>
                                        <p class="text-white mb-1 text-truncate">Total Invitation Online</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="widget-rounded-circle card-box" style="background:#d0c5b1;" >
                                <div class="row">
                                  
                                    <div class="col-12">
                                        <div class="text-right">
                                        <h3 class="mt-1 text-white"><span data-plugin=""><?= $this->formatNumber($count_in_ofline['jmldata'],0) ?></span></h3>
                                        <p class="text-white mb-1 text-truncate">Total Invitation Offline</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div>

                    </div>

                    </div>
                </div>

                <div class="widget-rounded-circle card-box">
                     <div class="row">
                     
                        <div class="col-4">

                        <button class="btn btn-light text-white" style="background:#9b9b5b;" data-toggle="modal" data-target="#logguestopeninvitation"><i class="fas fa-align-left mr-2"></i>Guest Visitor Log</button>

                        </div>
                     
                        <div class="col-8">
                        <div class="text-right">           
                            <h3 class="mt-1"><span data-plugin=""> <i class="fas fa-book-reader mr-2"></i><?= $this->formatNumber($count_inv_open['jmldata'],0) ?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Guest Open Invitation</p>
                        </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->

                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mb-2">Guest By Event Location</h4>

                        <div class="row">


                            <?php
                                                    
                                if(!empty($activity_list)){ foreach ($activity_list as $key => $list) { 
                                $count_activity = 0;
                                $ga_list = $this->getData("guest_activity")->get(array("by_activity" , array($event['event_code'] , $list['activityID'])));


                                if(!empty($ga_list)){ foreach ($ga_list as $keyga => $listga) {

                                $getguest = $this->getData("guest")->get(array("by_id" , array($event['event_code'] , $listga['guestID'])));
                                $count_activity = $count_activity + $getguest['guest_number'];
                                                        
                                } }

                                                        
                            ?>

                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card-box">
                                <div class="row">
                                                         
                                    <div class="col-12">
                                        <div class="text-right">           
                                            <h3 class="mt-1"><span data-plugin=""> <i class="fas fa fa-users mr-2"></i><?= $this->formatNumber($count_activity,0) ?></span></h3>
                                            <p class="text-muted mb-1 text-truncate"><?= $list['activity_loc_title'] ?> <br> <?= $list['activity_name'] ?></p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div>

                            <?php } } ?>

                        </div>


                    </div>
                </div>

            </div>

            <div class="col-lg-12">

             <div class="card">
                <div class="card-body">
                <h4 class="header-title mb-2">RSVP</h4>

                <div class="row">

                    <div class="col-lg-6">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4 chartjs-chart">
                                <canvas id="donut-chart-example2" height="150" data-colors="#44cf9c,#1abc9c,#ebeff2"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">

                        <div class="row">
                      
                      
                            <div class="col-md-12 col-xl-12">
                                <div class="widget-rounded-circle card-box" style="background:#ece5df;">
                                    <div class="row">
                                                           
                                        <div class="col-12">
                                            <div class="text-right">
                                            <h3 class="mt-1 text-dark"><span data-plugin=""><?= $this->formatNumber($count_rsvp_default['jmldata'],0) ?></span></h3>
                                            <p class="text-dark mb-1 text-truncate">Unconfirmed</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card-box" style="background:#9b9b5f;">
                                    <div class="row">
                                                           
                                        <div class="col-12">
                                            <div class="text-right">
                                            <h3 class="mt-1 text-white"><span data-plugin=""><?= $this->formatNumber($count_rsvp_yes['jmldata'],0) ?></span></h3>
                                            <p class="text-white mb-1 text-truncate">Reserved</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card-box" style="background:#d0c5b1;">
                                    <div class="row">
                                                           
                                        <div class="col-12">
                                            <div class="text-right">
                                            <h3 class="mt-1 text-dark"><span data-plugin=""><?= $this->formatNumber($count_rsvp_no['jmldata'],0) ?></span></h3>
                                            <p class="text-dark mb-1 text-truncate">Decline</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div>

                        </div>

                        </div>
                    </div> 

                    </div>
                    <div class="col-lg-6">

                        <?php $rsvp_list = $this->getData("guest")->get(array("get_rsvp" , array($event['event_code']))); ?>

                        <div class="card-box">
                        <div class="table-responsive">
                        <table id="basic-datatable2" class="table table-striped border-0">
                            <thead class="border-0">
                                <tr>
                                    <th class="border-0">Guest Name</th>
                                                            
                                    <th class="border-0">Guest Number (Invitation)</th>
                                    <th class="border-0">RSVP</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php if(!empty($rsvp_list)){ foreach ($rsvp_list as $key => $list) { 
                            
                            switch ($list['guest_checkin_plan']) {
                                case '1':
                                    $status_rsvp = "Reservation";
                                    break;

                                case '1':
                                    $status_rsvp = "Decline";
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                            
                            ?>
                                <tr>
                                    <td class="border-0"><?= $list['guest_name'] ?></td>
                                    <td class="border-0"><?= $list['guest_number'] ?></td>
                                    <td class="border-0"><?= $status_rsvp ?> <?= $list['guest_checkin_plan_number'] ?> Persons </td>
                                </tr>
                            <?php } } ?>

                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>

                </div>

                </div>
             </div>

            </div>

            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="logguestopeninvitation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Guest Visitor Log</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            <!--  -->

            <?php 
            $log_list = $this->getData("log_invitation")->get(array("get_all" , array($event['event_code'])));
            ?>

            <table id="basic-datatable" class="table table-striped border-0">
                <thead class="border-0">
                    <tr>
                    <th class="border-0">Guest Name</th>                     
                    <th class="border-0 text-right">Date & Time</th>
                    </tr>
                </thead>
                <tbody>

                <?php if(!empty($log_list)){ foreach ($log_list as $key => $list) { 
                
                $formaDate = $this->dateIndo($list['open_invitation_date']);
                    
                ?>
                    <tr>
                        <td class="border-0"><?= $list['guest_name'] ?></td>
                        <td class="border-0 text-right"><?= $formaDate ?> - <?= $list['open_invitation_time'] ?></td>
                    </tr>
                <?php } } ?>

                </tbody>
            </table>

            <!--  -->
                                                       
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<?php endif; ?>


<?php if($view == "detail-events"): 
 
 $event = $eventModels->get(array("by_eventID" , array($this->hashId("dec" , $value))));

 $formatDate = $this->dateIndo($event['event_date']);
    
?>


<div class="content-page">
    <div class="content">

        <div class="container-fluid">
                        
            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/">Dashboard  </a></li>
                                <li class="breadcrumb-item"><a href="/events">Event List  </a></li>

                                <li class="breadcrumb-item active">Events Detail</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Events Detail</h4>
                    </div>
                </div>
            </div>     

         
            <div class="row mb-2">

                <div class="col-12">

                <div id="warning-waiting" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body p-4">
                                <div class="text-center">
                                <i class="dripicons-primary h1 text-primary"></i>
                                <h4 class="mt-2">Please wait,</h4>
                                <p class="mt-3">we are uploading your data</p>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div>
                
                <!--  -->
                <div class="card-box mb-2">
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="mt-0 mb-2 font-16"><?= $event['event_name'] ?> </h4>
                                    <p class="mb-1"><b>Category:</b> <?= $event['category_name'] ?></p>
                                    <p class="mb-0"><b>Client:</b> <?= $event['client_name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class=" my-3 my-sm-0">
                            <p class="mb-0">Event Date : <?= $formatDate ?></p>
                            <p class="mb-0"><b>Link:</b> <?= $event['event_link'] ?></p>


                            </div>
                        </div>
                        <div class="col-sm-4 ">
                            <div class="text-right button-list">
                            <a href="/events/statistik/<?= $value ?>" class="btn btn-primary waves-effect waves-light"><i class=" far fa-chart-bar mr-2"></i>Lihat Statistik</a>             
                                               
                            </div>
                        </div>
                                      
                    </div> <!-- end row -->
                </div>
                <!--  -->

                </div>

                <div class="col-12">

                    <div class="card-box">

                        <div class="row">

                            <div class="col-sm-2">

                            <?php 

                            $tab_info      = false;
                            $tab_activity  = false;
                            $tab_guestbook = false;
                            $tab_post      = false;
                            $tab_galery    = false;
                            $tab_template  = false;
                            $tab_wish      = false;

                            $subtab_guestlist = false;
                            $subtab_guestcat  = false;
                            $subtab_generaltemplate = false;
                            $subtab_slideshow       = false;
                            $subtab_lovestory       = false;

                            
                            if(isset($_GET['tab']))
                            {

                                switch ($_GET['tab']) {
                                    case 'info':
                                        $tab_info = true;
                                        $subtab_guestlist = true;
                                        $subtab_generaltemplate = true;
                                        break;

                                    case 'wish':
                                        $tab_wish = true;
                                        $subtab_guestlist = true;
                                        $subtab_generaltemplate = true;
                                        break;
    
                                    
                                    case 'activity' :
                                        $tab_activity = true;
                                        $subtab_guestlist = true;
                                        $subtab_generaltemplate = true;
                                        break;

                                    case 'guestbook' :
                                        $tab_guestbook = true;

                                        if(isset($_GET['subtab']))
                                        {

                                            switch ($_GET['subtab']) {
                                                case 'guestlist':
                                                    $subtab_guestlist = true;
                                                    break;

                                                case 'guestcat' :
                                                    $subtab_guestcat = true;
                                                    break;

                                            }

                                        }else{
                                            $subtab_guestlist = true;
                                            $subtab_generaltemplate = true;
                                        }

                                        break;

                                    case 'guestpost' :
                                        $tab_post = true;
                                        $subtab_guestlist = true;
                                        $subtab_generaltemplate = true;
                                        break;

                                    case 'galery' :
                                        $tab_galery = true;
                                        $subtab_guestlist = true;
                                        $subtab_generaltemplate = true;
                                        break;

                                    case 'templatesetting' :
                                        $tab_template = true;
                                        $subtab_guestlist = true;
                                        
                                        if(isset($_GET['subtab']))
                                        {

                                            switch ($_GET['subtab']) {
                                                case 'generaltemplate':
                                                    $subtab_generaltemplate = true;
                                                    break;

                                                case 'slideshow' :
                                                    $subtab_slideshow = true;
                                                    break;

                                                case 'lovestory' :
                                                    $subtab_lovestory = true;
                                                    break;
                                            }

                                        }else{
                                            $subtab_generaltemplate = true;
                                        }

                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }

                            }else{

                                $tab_info = true;
                                $subtab_guestlist = true;
                                $subtab_generaltemplate = true;

                            }
                            
                            ?>

                                <!--  -->
                                <div class="nav nav-pills flex-column navtab-bg nav-pills-tab text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                   
                                    <a class="nav-link <?php if($tab_info){ echo "active show"; }  ?> py-2" id="custom-v-pills-info-tab" data-toggle="pill" href="#custom-v-pills-info" role="tab" aria-controls="custom-v-pills-info"
                                    aria-selected="true">
                                    <i class="mdi mdi-information-outline d-block font-24"></i>
                                    Event Information
                                    </a>


                                    <a class="nav-link <?php if($tab_activity){ echo "active show"; } ?>  mt-2 py-2" id="custom-v-pills-activity-tab" data-toggle="pill" href="#custom-v-pills-activity" role="tab" aria-controls="custom-v-pills-activity"
                                    aria-selected="false">
                                    <i class="mdi mdi-map-clock-outline d-block font-24"></i>
                                    Event Activity</a>

                                    <a class="nav-link <?php if($tab_guestbook){ echo "active show"; } ?>  mt-2 py-2" id="custom-v-pills-guestbook-tab" data-toggle="pill" href="#custom-v-pills-guestbook" role="tab" aria-controls="custom-v-pills-guestbook"
                                    aria-selected="false">
                                    <i class="mdi mdi-book-account d-block font-24"></i>
                                    Guest Book</a>

                                    <!-- <a class="nav-link <?php if($tab_post){ echo "active show"; } ?> mt-2 py-2" id="custom-v-pills-post-tab" data-toggle="pill" href="#custom-v-pills-post" role="tab" aria-controls="custom-v-pills-post"
                                    aria-selected="false">
                                    <i class="mdi mdi-microsoft d-block font-24"></i>
                                    Guest Post</a> -->

                                    <a class="nav-link <?php if($tab_galery){ echo "active show"; } ?>  mt-2 py-2" id="custom-v-pills-galery-tab" data-toggle="pill" href="#custom-v-pills-galery" role="tab" aria-controls="custom-v-pills-galery"
                                    aria-selected="false">
                                    <i class="mdi mdi-folder-multiple-image d-block font-24"></i>
                                    Event Galery</a>


                                    <a class="nav-link <?php if($tab_wish){ echo "active show"; } ?> mt-2 py-2" id="custom-v-pills-wish-tab" data-toggle="pill" href="#custom-v-pills-wish" role="tab" aria-controls="custom-v-pills-wish"
                                    aria-selected="false">
                                    <i class="mdi mdi-candle d-block font-24"></i>
                                    Event Wish</a>

                                    <a class="nav-link <?php if($tab_template){ echo "active show"; } ?> mt-2 py-2" id="custom-v-pills-template-tab" data-toggle="pill" href="#custom-v-pills-template" role="tab" aria-controls="custom-v-pills-template"
                                    aria-selected="false">
                                    <i class="mdi mdi-table-settings d-block font-24"></i>
                                    Template Setting</a>



                                </div>  
                                <!--  -->

                            </div>

                            <div class="col-sm-10">

                                <!--  -->

                                <div class="tab-content pt-0">
                                    
                                    <div class="tab-pane <?php if($tab_info){ ?> fade active show <?php } ?>" id="custom-v-pills-info" role="tabpanel" aria-labelledby="custom-v-pills-info-tab">

                                        <h4 class="header-title">Event Information</h4>
                                        <p class="sub-header">Fill the form for your event information</p>

                                        <hr>

                                        <?php
                                        $form = $this->controllerForm('form_events_information' , 'user-console/events-information')->form(array("manage" , $clientID , $event['event_code']));  
                                        ?>
                                    
                                    </div>

                                    <div class="tab-pane <?php if($tab_activity){ ?> fade active show <?php } ?> " id="custom-v-pills-activity" role="tabpanel" aria-labelledby="custom-v-pills-activity-tab">

                                        <h4 class="header-title">Event List</h4>
                                        <p class="sub-header">Manage Your Event List ( ex : your ceremony , wedding , etc )</p>

                                        <hr>
                                        <?php 
                                        if(isset($_GET['manage'])){

                                            if($_GET['manage'] == "true"):
                                                if($_GET['id'] == "null")
                                                {
                                                    $ID   = "";
                                                    $task = "add";
                                                }else{
                                                    $task = "update";
                                                    $ID   = $_GET['id'];
                                                }

                                                $form = $this->controllerForm('form_events_activity' , 'user-console/events-activity')->form(array("$task" , $clientID , $event['event_code'] , $ID , $value));
                                            endif;

                                        }else{ 
                                        
                                        $activity_list = $this->getData("activity")->get(array("get_all" , array($event['event_code'])));
                                            
                                        ?>

                                        <a href="/events/detail-events/<?= $value ?>?tab=activity&manage=true&id=null"><button class="btn btn-success"><i class="fas fa fa-calendar mr-2"></i>Create Event List</button></a>



                                        <?php if(!empty($activity_list)): ?>


                                            <div class="row mt-2">

                                                <?php foreach ($activity_list as $key => $list) { 
                                                $hashKey = $this->key($list['activityID']);    
                                                ?>
                                                    
                                                    <div class="col-md-6 mb-2">
                                                        <div class="border p-3 rounded mb-3 mb-md-0">
                                                            

                                                            <div class="float-right">
                                                                <a href="/events/detail-events/<?= $value ?>?tab=activity&manage=true&id=<?= $this->hashId("enc" , $list['activityID']) ?>"><i class="mdi mdi-square-edit-outline text-muted font-20"></i></a>
                                                                <a href="#" data-toggle="modal" data-target="#remove_activity_<?= $hashKey ?>"><i class="mdi mdi-trash-can-outline text-muted font-20"></i></a>

                                                            </div>
                                                            <h5 class="mt-3"><?= $list['activity_name'] ?></h5>
                                                    
                                                            <p class="mb-2"><span class="font-weight-semibold mr-2">Location : <?= $list['activity_loc_title'] ?></span></p>
                                                            <p class="mb-2"><span class="font-weight-semibold mr-2"><?= $this->dateIndoHari($list['activity_date']) ?></span></p>
                                                            <p class="mb-2"><span class="font-weight-semibold mr-2">Time:</span> <?= $list['activity_time'] ?> - <?= $list['activity_time_end'] ?></p>
                                                            <p class="mb-0"><span class="font-weight-semibold mr-2">Maps:</span> <a href="<?= $list['activity_loc_maps'] ?>"><?= $list['activity_loc_maps'] ?></a></p>
                                                        </div>
                                                    </div>
                                                    
                                                    <form id="activitydeleteform<?= $hashKey ?>" method="post">
                                                    <input type="hidden" name="action" value="removeactivity">
                                                    <input type="hidden" name="eventID" value="<?= $event['event_code'] ?>">
                                                    <input type="hidden" name="client" value="<?= $userID ?>">
                                                    <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['activityID']) ?>">
                                                    <input type="hidden" name="keyID" value="<?= $hashKey ?>">
                                                    <input type="hidden" name="key" value="<?= $this->act_key($hashKey) ?>">
                                                    </form>

                                                    <?= $alert = $this->modalAlert(array("danger" , "remove_activity_$hashKey" , "removeactivity('$hashKey')")); ?>


                                                <?php } ?>

                                            </div>

                                        <?php endif; ?>

                                        <?php } ?>


                                    </div>

                                    <div class="tab-pane <?php if($tab_guestbook){ ?> fade active show <?php } ?> " id="custom-v-pills-guestbook" role="tabpanel" aria-labelledby="custom-v-pills-guestbook-tab">

                                        <h4 class="header-title">Guest Book</h4>
                                        <p class="sub-header">Manage your invited guest list</p>

                                        <hr>


                                        <?php if(isset($_GET['manage'])){  ?>

                                            <?php 
                                            
                                            if(isset($_GET['subtab'])):
                                                        
                                                if($_GET['subtab'] == "guestlist"):


                                                    if($_GET['id'] == "null")
                                                    {
                                                        $task      = "add";
                                                        $guestID   = "";
                                                    }else{

                                                        $task      = "update";
                                                        $guestID   = $_GET['id'];

                                                    }

                                                    $form = $this->controllerForm('form_guest' , 'user-console/guest')->form(array("$task" , $clientID , $event['event_code'] , $guestID , $value));


                                                endif;

                                                if($_GET['subtab'] == "guestcat"):

                                                    if($_GET['id'] == "null")
                                                    {
                                                        $task      = "add";
                                                        $catID     = "";
                                                    }else{

                                                        $task      = "update";
                                                        $catID     = $_GET['id'];

                                                    }

                                                    $form = $this->controllerForm('form_guest_category' , 'user-console/guest-category')->form(array("$task" , $clientID , $event['event_code'] , $catID , $value));

                                                endif;

                                                
                                                
                                            endif;
                                                
                                            ?>


                                        <?php }else{ 
                                        
                                        $guest_category_list = $this->getData("guest_category")->get(array("get_all" , array($event['event_code'])));
                                            
                                            
                                        ?>

                                        <ul class="nav nav-pills navtab-bg nav-justified">
                                            <li class="nav-item">
                                                <a href="#guestlist" data-toggle="tab" aria-expanded="false" class="nav-link <?php if($subtab_guestlist){echo "active";} ?> ">
                                                    Guest List
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#guestcat" data-toggle="tab" aria-expanded="true" class="nav-link <?php if($subtab_guestcat){echo "active";} ?>  ">
                                                    Guest Category
                                                </a>
                                            </li>
                                        </ul>


                                        <div class="tab-content">

                                        <div class="tab-pane <?php if($subtab_guestlist){echo "show active";} ?> " id="guestlist">

                                            <?php 
                                            
                                            $sum_guest = $this->getData("guest")->get(array("sum_all" , array($event['event_code'])));
                                            $sum_guest_groom = $this->getData("guest")->get(array("sum_by_from" , array($event['event_code'] , "groom")));
                                            $sum_guest_bride = $this->getData("guest")->get(array("sum_by_from" , array($event['event_code'] , "bride")));

                                            ?>

                                            <div class="row">

                                                <div class="col-md-4 col-xl-4">
                                                    <div class="widget-rounded-circle card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                                    <i class="fe-users font-22 avatar-title text-dark"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="text-right">
                                                                    <h3 class="mt-1"><span data-plugin=""><?= $this->formatNumber($sum_guest['jmldata'],0) ?></span></h3>
                                                                    <p class="text-muted mb-1 text-truncate">Total Guest</p>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row-->
                                                    </div> <!-- end widget-rounded-circle-->
                                                </div>


                                                <div class="col-md-4 col-xl-4">
                                                    <div class="widget-rounded-circle card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                                    <i class="fe-users font-22 avatar-title text-dark"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="text-right">
                                                                    <h3 class="mt-1"><span data-plugin=""><?= $this->formatNumber($sum_guest_groom['jmldata'],0) ?></span></h3>
                                                                    <p class="text-muted mb-1 text-truncate">Groom Guest</p>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row-->
                                                    </div> <!-- end widget-rounded-circle-->
                                                </div>

                                                <div class="col-md-4 col-xl-4">
                                                    <div class="widget-rounded-circle card-box">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                                                                    <i class="fe-users font-22 avatar-title text-dark"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="text-right">
                                                                    <h3 class="mt-1"><span data-plugin=""><?= $this->formatNumber($sum_guest_bride['jmldata'],0) ?></span></h3>
                                                                    <p class="text-muted mb-1 text-truncate">Bride Guest</p>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row-->
                                                    </div> <!-- end widget-rounded-circle-->
                                                </div>

                                                <div class="col-12">

                                                <a href="/events/detail-events/<?= $value ?>?tab=guestbook&subtab=guestlist&manage=true&id=null"><button class="btn btn-success"><i class="fas fa fa-users mr-2"></i>Add Guest List</button></a>


                                                </div>

                                                <div class="col-12 mt-2">
                                                    <div class="card-box">

                                                    <!--  -->

                                                    <?php 
                                                    
                                                    $guestlist = $this->getData("guest")->get(array("get_all" , array($event['event_code']))) ?>
                                                    <div class="table-responsive">
                                                    <table id="basic-datatable2" class="table table-striped border-0">
                                                    <thead class="border-0">
                                                        <tr>
                                                            <th class="border-0">Guest Name</th>
                                                            <th class="border-0">Wa</th>
                                                            <th class="border-0">Type</th>
                                                            <th class="border-0">From</th>
                                                            <th class="border-0">Guest Number</th>
                                                            <th class="border-0">Invite For</th>
                                                            <th class="border-0 text-right">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                    <?php if(!empty($guestlist)){ foreach ($guestlist as $key => $list) { 

                                                    $hashGuest = $this->key($list['guestID']);
                                                    
                                                    $category = $this->getData("guest_category")->get(array("by_id" , array($event['event_code'] , $list['guestCatID'])));
                                                    $type     = $this->getData("guest_type")->get(array("by_id" , array($list['guestTypeID'])));

                                                    $guest_act = $this->getData("guest_activity")->get(array("by_guestID" , array($event['event_code'] , $list['guestID'])));




                                                    $message = "Salam Sejahtera Bagi Kita Semua, 🙏\n\n";
                                                    $message .= "Dengan rahmat dan berkat Tuhan Yang Maha Esa, kami bermaksud mengundang Yang Terhormat: \n\n"; 
                                                    $message .= "*$list[guest_name]*\n\n";
                                                    $message .= "Untuk hadir dalam moment pernikahan kami pada :\n\n";

                                                    if(!empty($guest_act)){ foreach ($guest_act as $key_act => $list_act) { 

                                                    $formattedDate = $this->dateIndoHari($list_act['activity_date']);

                                                    $message .= "*$list_act[activity_name]*\n";

                                                    $message .= "Hari/Tanggal:\n$formattedDate\n";
                                                    $message .= "Waktu:\n$list_act[activity_time] - $list_act[activity_time_end] WITA \n";
                                                    $message .= "Lokasi:\n$list_act[activity_loc_title]\n\n";

                                                    }}

                                                    $message .= "Merupakan Suatu Kehormatan dan kebahagiaan\nBagi kami Apabila Bapak / ibu / Saudara/i Berkenan Hadir Memberikan Doa restu.\n\n";
                                                    $message .= "*LINK UNDANGAN:*\nhttps://ourwedding.08-09-2023.com/$list[guest_username]\n\n";

                                                    $message .= "Atas kehadiran dan doa restunya, kami mengucapkan terima kasih\n\n";
                                                    $message .= "Dengan Penuh Syukur🙏\n\n";
                                                    $message .= "Kami yg Berbahagia\n*Johannes I Gede Herman Adi Cahya & Komang Warmani*\nBeserta Keluarga\n\n";
                                                    $message .= "*Note : Tanpa Mengurangi Rasa Hormat, Dikarenakan Keterbatasan Waktu & Tempat, Undangan ini berlaku untuk $list[guest_number] Orang, Dan Mohon Undangan Harap Dibawa*\n\n";

                                                    $message .= "Filter Instagram:\nhttps://www.instagram.com/ar/1005660167449853/\n\n";


                                                    


                                                    $url_wa = 'https://api.whatsapp.com/send?phone=' . urlencode($list['guest_phone']) . '&text=' . urlencode($message);
    

                                                    ?>

                                                        <tr>
                                                            <td class="border-0"><?= $list['guest_name'] ?> <br> 
                                                            
                                                            <small class="font-weight-bold"><?= $category['guest_cat_name'] ?> <br> 
                                                            
                                                            <a target="_blank" href="<?= $event['event_link'] ?>/<?= $list['guest_username'] ?>"><?= $list['guest_username'] ?></a>
                                                        
                                                            </small> 
                                                            
                                                            <br> 

                                                            <?php if($list['guest_phone'] != ""): ?>
                                                            <input type="hidden" id="whatsapplink_<?= $list['guestID'] ?>" value="<?= $url_wa ?>">
                                                            <!-- <a target="_blank" href="<?= $url_wa ?>"> -->

                                                            <?php if($list['wa_send'] == 0){ 

                                                                $color_btn = "btn-success";

                                                             }else{

                                                                $color_btn = "btn-secondary";

                                                             } ?>

                                                            <button id="sendwabtn_<?= $list['guestID'] ?>" class="btn <?= $color_btn ?> btn-sm" onclick="sendwa('<?= $list['guestID'] ?>' , '<?= $event['event_code'] ?>')">Whatsapp</button>
                                                            <?php endif; ?>
                                                    
                                                            </td>
                                                            <td class="border-0"><?= $list['guest_phone'] ?></td>
                                                            <td class="border-0"><?= $type['type_name'] ?></td>
                                                            <td class="border-0"><?= $list['guestFrom'] ?></td>
                                                            <td class="border-0"><?= $list['guest_number'] ?></td>
                                                            <td class="border-0">

                                                                
                                                                <?php if(!empty($guest_act)){ foreach ($guest_act as $key_act => $list_act) { ?>

                                                                    <span class="font-weight-bold"><small><?= $list_act['activity_name'] ?> <br></small> </span>

                                                                <?php } } ?>

                                                            </td>
                                                            <td class="border-0">

                                                            <!--  -->
                                                            <div class="dropdown float-right">
                                                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="/events/detail-events/<?= $value ?>?tab=guestbook&subtab=guestlist&manage=true&id=<?= $this->hashId("enc" , $list['guestID']) ?>" class="dropdown-item">Update</a>
                                                                    <a href="#" data-toggle="modal" data-target="#remove_guest_<?= $hashGuest ?>" class="dropdown-item">Delete</a>
                                                                </div>
                                                            </div>

                                                            <form id="guestdeleteform<?= $hashGuest ?>" method="post">
                                                            <input type="hidden" name="action" value="removeguest">
                                                            <input type="hidden" name="eventID" value="<?= $event['event_code'] ?>">
                                                            <input type="hidden" name="client" value="<?= $userID ?>">
                                                            <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['guestID']) ?>">
                                                            <input type="hidden" name="keyID" value="<?= $hashGuest ?>">
                                                            <input type="hidden" name="key" value="<?= $this->act_key($hashGuest) ?>">
                                                            </form>

                                                            <?= $alert = $this->modalAlert(array("danger" , "remove_guest_$hashGuest" , "removeguest('$hashGuest')")); ?>

                                                            <!--  -->

                                                            </td>
                                                        </tr>
                                                    <?php } } ?>

                                                    </tbody>
                                                    </table>
                                                    </div>
                                                    <!--  -->

                                                    </div>

                                                    

                                            </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane <?php if($subtab_guestcat){ echo "show active"; } ?> " id="guestcat">

                                            <div class="row">

                                            <!--  -->

                                            <div class="col-12">
                                            <a href="/events/detail-events/<?= $value ?>?tab=guestbook&subtab=guestcat&manage=true&id=null"><button class="btn btn-success"><i class="fas fa fa-plus mr-2"></i>Add Guest Category</button></a>
                                            </div>

                                            <div class="col-12 mt-2">

                                                <!--  -->
                                                <div class="card-box">

                                                <table id="basic-datatable" class="table table-striped border-0">
                                                <thead class="border-0">
                                                    <tr>
                                                        <th class="border-0">Category Name</th>
                                                        <th class="border-0 text-right">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php if(!empty($guest_category_list)){ foreach ($guest_category_list as $key => $list) { 
                                                
                                                $hashGuestCatKey = $this->key($list['guestCatID']);
                                                
                                                ?>
                                                    <tr>
                                                        <td class="border-0"><?= $list['guest_cat_name'] ?></td>
                                                        <td class="border-0">

                                                        <!--  -->

                                                        <div class="dropdown float-right">
                                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="/events/detail-events/<?= $value ?>?tab=guestbook&subtab=guestcat&manage=true&id=<?= $this->hashId("enc" , $list['guestCatID']) ?>" class="dropdown-item">Update</a>
                                                                <a href="#" data-toggle="modal" data-target="#remove_guest_category<?= $hashGuestCatKey ?>" class="dropdown-item">Delete</a>
                                                            </div>
                                                        </div>

                                                        <form id="guestcatdeleteform<?= $hashGuestCatKey ?>" method="post">
                                                        <input type="hidden" name="action" value="removeguestcat">
                                                        <input type="hidden" name="eventID" value="<?= $event['event_code'] ?>">
                                                        <input type="hidden" name="client" value="<?= $userID ?>">
                                                        <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['guestCatID']) ?>">
                                                        <input type="hidden" name="keyID" value="<?= $hashGuestCatKey ?>">
                                                        <input type="hidden" name="key" value="<?= $this->act_key($hashGuestCatKey) ?>">
                                                        </form>

                                                        <?= $alert = $this->modalAlert(array("danger" , "remove_guest_category$hashGuestCatKey" , "removeguestcat('$hashGuestCatKey')")); ?>


                                                        <!--  -->

                                                        </td>
                                                    </tr>
                                                <?php } } ?>

                                                </tbody>
                                                </table>

                                                </div>
                                                <!--  -->

                                            </div>

                                            <!--  -->

                                            </div>

                                        </div>

                                        </div>

                                        <?php } ?>

                                    </div>


                                    <div class="tab-pane <?php if($tab_galery){ ?> fade active show <?php } ?> " id="custom-v-pills-galery" role="tabpanel" aria-labelledby="custom-v-pills-galery-tab">

                                        <h4 class="header-title">Galery</h4>
                                        <p class="sub-header">Manage Your Galery</p>

                                        <hr>

                                        <?php 


                                        if(isset($_GET['manage'])){

                                            if($_GET['manage'] == "true"):
                                                if($_GET['id'] == "null")
                                                {
                                                    $ID   = "";
                                                    $task = "add";
                                                }else{
                                                    $task = "update";
                                                    $ID   = $_GET['id'];
                                                }

                                                $form = $this->controllerForm('form_events_galery' , 'user-console/galery')->form(array("$task" , $clientID , $event['event_code'] , $ID , $value));
                                            
                                            endif;

                                        }else{ 

                                        $galery_list = $this->getData("event_galery")->get(array("get_all" , array($event['event_code'])));

                                        ?>


                                        <a href="/events/detail-events/<?= $value ?>?tab=galery&manage=true&id=null"><button class="btn btn-success"><i class="fas fa fa-image mr-2"></i>Upload Images</button></a>


                                        <div class="row filterable-content mt-2">

                                            <?php if(!empty($galery_list)){ foreach ($galery_list as $key => $list) { 
                                            $hashGalery = $this->key($list['egID']);    
                                            ?>
                                                
                                                <div class="col-sm-6 col-xl-3 filter-item all graphic photography">
                                                    <div class="gal-box">
                                                        <a href="<?= $event['event_link'] ?>/assets/media/<?= $list['images'] ?>" class="image-popup" title="<?= $list['description'] ?>">
                                                            <img src="<?= $event['event_link'] ?>/assets/media/<?= $list['images'] ?>" class="img-fluid" alt="work-thumbnail">
                                                        </a>

                                                        <div class="row">
                                                            <div class="col-12">
                                                            <a class="ml-2" href="/events/detail-events/<?= $value ?>?tab=galery&manage=true&id=<?= $this->hashId("enc" , $list['egID']) ?>"><i class="mdi mdi-square-edit-outline text-muted font-20"></i></a>
                                                            <a href="#" data-toggle="modal" data-target="#remove_galery_<?= $hashGalery ?>"><i class="mdi mdi-trash-can-outline text-muted font-20"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="gall-info">
                                                            <h4 class="font-16 mt-0"></h4>
                                                            <span class="text-muted ml-1"><?= $list['description'] ?></span>
                                                        </div> <!-- gallery info -->
                                                    </div> <!-- end gal-box -->
                                                </div> 

                                                <!--  -->
                                                <form id="galerydeleteform<?= $hashGalery ?>" method="post">
                                                <input type="hidden" name="action" value="removegalery">
                                                <input type="hidden" name="event" value="<?= $event['event_code'] ?>">
                                                <input type="hidden" name="client" value="<?= $userID ?>">
                                                <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['egID']) ?>">
                                                <input type="hidden" name="keyID" value="<?= $hashGalery ?>">
                                                <input type="hidden" name="key" value="<?= $this->act_key($hashGalery) ?>">
                                                </form>

                                                <?= $alert = $this->modalAlert(array("danger" , "remove_galery_$hashGalery" , "removegalery('$hashGalery')")); ?>

                                                <!--  -->

                                            <?php } } ?>

                                        </div>

                                        <?php } ?>

                                    </div>

                                    <div class="tab-pane <?php if($tab_template){ ?> fade active show <?php } ?>" id="custom-v-pills-template" role="tabpanel" aria-labelledby="custom-v-pills-template-tab">

                                        <h4 class="header-title">Template Setting</h4>
                                        <p class="sub-header">Manage Your Online Invitation Pages</p>

                                        <hr>


                                        <ul class="nav nav-pills navtab-bg nav-justified">

                                        <li class="nav-item">
                                            <a href="#generaltemplate" data-toggle="tab" aria-expanded="false" class="nav-link <?php if($subtab_generaltemplate){ echo "active"; } ?>">
                                                General Setting
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#slideshow " data-toggle="tab" aria-expanded="false" class="nav-link <?php if($subtab_slideshow){ echo "active"; } ?> ">
                                                Slideshow
                                            </a>
                                        </li>
                                      
                                        <li class="nav-item">
                                            <a href="#lovestory" data-toggle="tab" aria-expanded="false" class="nav-link <?php if($subtab_lovestory){ echo "active"; } ?> ">
                                                Love Story
                                            </a>
                                        </li>
                                        </ul>


                                        <div class="tab-content">
                                            <div class="tab-pane <?php if($subtab_generaltemplate){echo"show active";} ?> " id="generaltemplate">
                                             
                                            <?php 
                                            $form = $this->controllerForm('form_template_setting' , 'user-console/template_setting')->form(array("manage" , $clientID , $event['event_code'] , $value));
                                            ?> 
                                            </div>

                                            <div class="tab-pane <?php if($subtab_slideshow){echo"show active";} ?> " id="slideshow">
                                            
                                            <?php 
                                            
                                            $templateSetFormSlide = false;
                                            $templateSetDataSlide = true;

                                            if(isset($_GET['manage'])){

                                                if(isset($_GET['tab']))
                                                {
                                                    if($_GET['tab'] == "templatesetting"){

                                                        if(isset($_GET['subtab']))
                                                        {

                                                            if($_GET['subtab'] == "slideshow")
                                                            {
                                                                $templateSetFormSlide = true;
                                                                $templateSetDataSlide  = false;
                                                            }

                                                        }

                                                    }
                                                }

                                            }
                                           
                                            ?>


                                            <?php if($templateSetDataSlide): 
                                            
                                            $slide_list = $this->getData("template_slide")->get(array("get_all" , array($event['event_code'])));
                                            
                                            ?>

                                                <a href="/events/detail-events/<?= $value ?>?tab=templatesetting&subtab=slideshow&manage=true&id=null"><button class="btn btn-success ml-1"><i class="fas fa fa-image mr-2"></i>Upload Images Slideshow</button></a>
                                                <!--  -->

                                                <div class="row filterable-content mt-2">

                                                    <?php if(!empty($slide_list)){ foreach ($slide_list as $key => $list) { 
                                                    $hashSlie = $this->key($list['slideID']);    
                                                    ?>
                                                        
                                                        <div class="col-sm-6 col-xl-6 filter-item all graphic photography">
                                                            <div class="gal-box">
                                                                <a href="<?= $event['event_link'] ?>/assets/media/<?= $list['images'] ?>" class="image-popup" title="<?= $list['position'] ?>">
                                                                    <img src="<?= $event['event_link'] ?>/assets/media/<?= $list['images'] ?>" class="img-fluid" alt="work-thumbnail">
                                                                </a>

                                                                <div class="row">
                                                                    <div class="col-12">
                                                                    <a class="ml-2" href="/events/detail-events/<?= $value ?>?tab=templatesetting&subtab=slideshow&manage=true&id=<?= $this->hashId("enc" , $list['slideID']) ?>"><i class="mdi mdi-square-edit-outline text-muted font-20"></i></a>
                                                                    <a href="#" data-toggle="modal" data-target="#remove_slideshow_<?= $hashSlie ?>"><i class="mdi mdi-trash-can-outline text-muted font-20"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="gall-info">
                                                                    <h4 class="font-16 mt-0"></h4>
                                                                    <span class="text-muted ml-1"><?= $list['position'] ?></span>
                                                                </div> <!-- gallery info -->
                                                            </div> <!-- end gal-box -->
                                                        </div> 

                                                        <!--  -->
                                                        <form id="slidedeleteform<?= $hashSlie ?>" method="post">
                                                        <input type="hidden" name="action" value="removeslide">
                                                        <input type="hidden" name="event" value="<?= $event['event_code'] ?>">
                                                        <input type="hidden" name="client" value="<?= $userID ?>">
                                                        <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['slideID']) ?>">
                                                        <input type="hidden" name="keyID" value="<?= $hashSlie ?>">
                                                        <input type="hidden" name="key" value="<?= $this->act_key($hashSlie) ?>">
                                                        </form>

                                                        <?= $alert = $this->modalAlert(array("danger" , "remove_slideshow_$hashSlie" , "removeslide('$hashSlie')")); ?>

                                                        <!--  -->

                                                    <?php } } ?>

                                                </div>


                                                <!--  -->

                                            <?php endif; ?>

                                            <?php if($templateSetFormSlide): ?>

                                                <?php 
                                                
                                                if($_GET['id'] == "null")
                                                {
                                                    $task      = "add";
                                                    $slideID   = "";
                                                }else{
                                                    $task      = "update";
                                                    $slideID   = $_GET['id'];
                                                }

                                                $form = $this->controllerForm('form_template_slideshow' , 'user-console/template_slideshow')->form(array("$task" , $clientID , $event['event_code'] , $slideID , $value));

                                                
                                                ?>

                                            <?php endif; ?>


                                            </div>

                                           


                                            <div class="tab-pane <?php if($subtab_lovestory){echo"show active";} ?> " id="lovestory">
                                            
                                            <?php 

                                              
                                            $templateSetFormLove = false;
                                            $templateSetDataLove = true;

                                            if(isset($_GET['manage'])){

                                                if(isset($_GET['tab']))
                                                {
                                                    if($_GET['tab'] == "templatesetting"){

                                                        if(isset($_GET['subtab']))
                                                        {

                                                            if($_GET['subtab'] == "lovestory")
                                                            {
                                                                $templateSetFormLove = true;
                                                                $templateSetDataLove  = false;
                                                            }

                                                        }

                                                    }
                                                }

                                            }

                                            ?>

                                            <?php if($templateSetDataLove): 
                                            
                                            $love_story = $this->getData("template_story")->get(array("get_all" , array($event['event_code'])));
                                            
                                            ?>


                                            <a href="/events/detail-events/<?= $value ?>?tab=templatesetting&subtab=lovestory&manage=true&id=null"><button class="btn btn-success"><i class="fas fa fa-image mr-2"></i>Add Love Story</button></a>


                                           <div class="row">
                                                <div class="col-12 mt-2">
                                                    <div class="card-box">

                                                        <!--  -->

                                                        <table id="basic-datatable3" class="table table-striped border-0">
                                                            <thead class="border-0">
                                                                <tr>
                                                                    <th class="border-0">Images</th>

                                                                    <th class="border-0">Position</th>
                                                                    <th class="border-0">Story Title</th>
                                                                    <th class="border-0">Date</th>
                                                                    <th class="border-0">Desc</th>

                                                                    <th class="border-0 text-right">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php if(!empty($love_story)){ foreach ($love_story as $key => $list) { 
                                                            
                                                            $hashStory = $this->key($list['storyID']);
                                                            
                                                            ?>

                                                                <tr>
                                                                    <td class="border-0"><img src="<?= $event['event_link'] ?>/assets/media/<?= $list['story_images'] ?>" width="50" height="50" ></td>
                                                                    <td class="border-0"><?= $list['story_position'] ?></td>
                                                                    <td class="border-0"><?= $list['story_title'] ?></td>
                                                                    <td class="border-0"><?= $list['story_date'] ?></td>
                                                                    <td class="border-0"><?= $list['story_desc'] ?></td>
                                                                    <td class="border-0">

                                                                    <!--  -->

                                                                    <div class="dropdown float-right">
                                                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a href="/events/detail-events/<?= $value ?>?tab=templatesetting&subtab=lovestory&manage=true&id=<?= $this->hashId("enc" , $list['storyID']) ?>" class="dropdown-item">Update</a>
                                                                            <a href="#" data-toggle="modal" data-target="#remove_story_<?= $hashStory ?>" class="dropdown-item">Delete</a>
                                                                        </div>
                                                                    </div>

                                                                    <form id="storydeleteform<?= $hashStory ?>" method="post">
                                                                    <input type="hidden" name="action" value="removestory">
                                                                    <input type="hidden" name="event" value="<?= $event['event_code'] ?>">
                                                                    <input type="hidden" name="client" value="<?= $userID ?>">
                                                                    <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['storyID']) ?>">
                                                                    <input type="hidden" name="keyID" value="<?= $hashStory ?>">
                                                                    <input type="hidden" name="key" value="<?= $this->act_key($hashStory) ?>">
                                                                    </form>

                                                                    <?= $alert = $this->modalAlert(array("danger" , "remove_story_$hashStory" , "removestory('$hashStory')")); ?>


                                                                    <!--  -->

                                                                    </td>
                                                                </tr>

                                                            <?php } } ?>

                                                            </tbody>
                                                        </table>
                                                        <!--  -->

                                                    </div>
                                                </div>
                                           </div>


                                            <?php endif; ?>

                                            <?php if($templateSetFormLove): ?>

                                                <?php 
                                                
                                                if(isset($_GET['id']))
                                                {

                                                    if($_GET['id'] == "null")
                                                    {
                                                        $task   = "add";
                                                        $loveID = "";
                                                    }else{

                                                        $task   = "update";
                                                        $loveID = $_GET['id'];
                                                    }

                                                }

                                                $form = $this->controllerForm('form_template_lovestory' , 'user-console/template_lovestory')->form(array("$task" , $clientID , $event['event_code'] , $loveID , $value));

                                                
                                                ?>

                                            <?php endif; ?>


                                            </div>

                                        </div>


                                    </div>

                                    <div class="tab-pane <?php if($tab_wish){ ?> fade active show <?php } ?> " id="custom-v-pills-wish" role="tabpanel" aria-labelledby="custom-v-pills-wish-tab">

                                    <h4 class="header-title">Event Wish</h4>

                                    <?php 
                                    
                                    $wish_list = $this->getData("event_wish")->get(array("get_all" , array($event['event_code'])));

                                    ?>

                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <div class="card-box">

                                                <table id="basic-datatable4" class="table table-striped border-0">
                                                    <thead class="border-0">
                                                        <tr>
                                                            <th class="border-0">Guest</th>
                                                            <th class="border-0">Wish Date</th>
                                                            <th class="border-0">Wish</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php if(!empty($wish_list)){ foreach ($wish_list as $key => $list) { ?>
                                                        <tr>
                                                            <td class="border-0"><?= $list['guest_name'] ?></td>
                                                            <td class="border-0"><?= $list['wish_date'] ?> <?= $list['wish_time'] ?></td>
                                                            <td class="border-0"><?= $list['wish_desc'] ?></td>
                                                        </tr>
                                                    <?php } } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                               
                                </div>

                                <!--  -->

                            </div>


                        </div>

                    </div>

                </div>

            </div>


        </div>
    </div>
</div>



<?php endif; ?>



   


<?php       
$template->footer($pages , array("dataTables" , "dataForms" , "galery" , "Charts")); 
?>

<?php if($view == "detail-events"): ?>

<script>

function sendwa(guestID , eventID)
{

    document.getElementById("sendwabtn_"+guestID).classList.remove("btn-success");
    document.getElementById("sendwabtn_"+guestID).classList.add("btn-secondary");
    var link = $("#whatsapplink_" + guestID).val();
    console.log("Link: ", link);

    $.ajax({

        type : "post",
        url  : "/gate/sendwa",
        data : {guestID : guestID , eventID : eventID},
        cache : false


    })


    .done(function(response){

        console.log("Response: ", response);
        
         // Create an anchor element
         var a = document.createElement("a");
                a.href = link;
                a.target = "_blank";

                // Append the anchor element to the document
                document.body.appendChild(a);

                // Simulate a click on the anchor element
                a.click();

                // Remove the anchor element from the document (optional)
                document.body.removeChild(a);

    })  

}

</script>

<?php endif; ?>

<?php if($view == "guestbook"): ?>

<script>

function guestcheckin(contentID)
{

    var checkinButton = document.getElementById('checkinButton');
    checkinButton.style.display = 'none';

    var data = $("#formcheckin_"+contentID).serialize();

   


    $.ajax({

    type  : "post",
    url   : "/ajax/loadaction.php",
    data  : data,
    cache : false

    })

    .done(function(response){

    if(response == "true")
    {

    window.location.reload();

    }

    if(response == "formerror")
    {

        checkinButton.style.display = 'block';

        $("#errormessage").html("<h5 class='text-center text-danger'>FORM TIDAK BOLEH KOSONG !</h5>");

    }

    })  

}



function hexToRGB(a, r) {
	var e = parseInt(a.slice(1, 3), 16),
		t = parseInt(a.slice(3, 5), 16),
		o = parseInt(a.slice(5, 7), 16);
	return r ? "rgba(" + e + ", " + t + ", " + o + ", " + r + ")" : "rgb(" + e + ", " + t + ", " + o + ")"
}! function(d) {
	"use strict";

	function a() {

		this.$body = d("body"), this.charts = []
	}
	a.prototype.respChart = function(r, e, t, o) {
		var n = r.get(0).getContext("2d"),
			l = d(r).parent();
		    return Chart.defaults.global.defaultFontColor = "#8391a2", Chart.defaults.scale.gridLines.color = "#8391a2",
			function() {
				var a;
				switch (r.attr("width", d(l).width()), e) {
					
					case "Doughnut":
						a = new Chart(n, {
							type: "doughnut",
							data: t,
							options: o
						});
						break;
				
				
				}
				return a
			}()
	}, a.prototype.initCharts = function() {
		var a = [],
			r = ["#ffb6c1", "#ffb6c1", "#ffb6c1", "#ffb6c1"];
		
		
		if (0 < d("#donut-chart-example-total").length) {
			var n = {
				labels: ["Total Guest", "Total Checkin"],
				datasets: [{
					data: [<?= $sum_guest['jmldata'] ?>, <?= $sum_guest_groom_checkin['jmldata'] ?>],
					backgroundColor: ["#9b9b5b" , "#d0c5b1"],
					borderColor: "transparent",
					borderWidth: "3"
				}]
			};
			a.push(this.respChart(d("#donut-chart-example-total"), "Doughnut", n, {
				maintainAspectRatio: !1,
				cutoutPercentage: 60,
				legend: {
					display: !1
				}
			}))
		}


        if (0 < d("#donut-chart-example-groom").length) {
			var n = {
				labels: ["Total Guest", "Total Checkin"],
				datasets: [{
					data: [<?= $sum_guest_groom['jmldata'] ?>, <?= $sum_guest_groom_checkin['jmldata'] ?>],
					backgroundColor: ["#9b9b5b" , "#d0c5b1"],
					borderColor: "transparent",
					borderWidth: "3"
				}]
			};
			a.push(this.respChart(d("#donut-chart-example-groom"), "Doughnut", n, {
				maintainAspectRatio: !1,
				cutoutPercentage: 60,
				legend: {
					display: !1
				}
			}))
		}


        if (0 < d("#donut-chart-example-bride").length) {
			var n = {
				labels: ["Total Guest", "Total Checkin"],
				datasets: [{
					data: [<?= $sum_guest_bride['jmldata'] ?>, <?= $sum_guest_bride_checkin['jmldata'] ?>],
					backgroundColor: ["#9b9b5b" , "#d0c5b1"],
					borderColor: "transparent",
					borderWidth: "3"
				}]
			};
			a.push(this.respChart(d("#donut-chart-example-bride"), "Doughnut", n, {
				maintainAspectRatio: !1,
				cutoutPercentage: 60,
				legend: {
					display: !1
				}
			}))
		}


        
		return a
	}, a.prototype.init = function() {
		var r = this;
		Chart.defaults.global.defaultFontFamily = "Nunito,sans-serif", r.charts = this.initCharts(), d(window).on("resize", function(a) {
			d.each(r.charts, function(a, r) {
				try {
					r.destroy()
				} catch (a) {}
			}), r.charts = r.initCharts()
		})
	}, d.ChartJs = new a, d.ChartJs.Constructor = a
}(window.jQuery),
function() {
	"use strict";
	window.jQuery.ChartJs.init()
}();




</script>

<?php endif; ?>

<?php  
if($view == "statistik"):

$guest_category_list = $this->getData("guest_category")->get(array("get_all" , array($event['event_code'])));


?>

<script>

function hexToRGB(a, r) {
	var e = parseInt(a.slice(1, 3), 16),
		t = parseInt(a.slice(3, 5), 16),
		o = parseInt(a.slice(5, 7), 16);
	return r ? "rgba(" + e + ", " + t + ", " + o + ", " + r + ")" : "rgb(" + e + ", " + t + ", " + o + ")"
}! function(d) {
	"use strict";

	function a() {

		this.$body = d("body"), this.charts = []
	}
	a.prototype.respChart = function(r, e, t, o) {
		var n = r.get(0).getContext("2d"),
			l = d(r).parent();
		    return Chart.defaults.global.defaultFontColor = "#8391a2", Chart.defaults.scale.gridLines.color = "#8391a2",
			function() {
				var a;
				switch (r.attr("width", d(l).width()), e) {
					
					case "Doughnut":
						a = new Chart(n, {
							type: "doughnut",
							data: t,
							options: o
						});
						break;
				
				
				}
				return a
			}()
	}, a.prototype.initCharts = function() {
		var a = [],
			r = ["#ffb6c1", "#ffb6c1", "#ffb6c1", "#ffb6c1"];
		
		
		if (0 < d("#donut-chart-example").length) {
			var n = {
				labels: ["Pengantin Pria", "Pengantin Wanita"],
				datasets: [{
					data: [<?= $sum_guest_groom['jmldata'] ?>, <?= $sum_guest_bride['jmldata'] ?>],
					backgroundColor: ["#9b9b5b" , "#dba8bb"],
					borderColor: "transparent",
					borderWidth: "3"
				}]
			};
			a.push(this.respChart(d("#donut-chart-example"), "Doughnut", n, {
				maintainAspectRatio: !1,
				cutoutPercentage: 60,
				legend: {
					display: !1
				}
			}))
		}


        if (0 < d("#donut-chart-example2").length) {
			var n = {
				labels: ["Belum Konfirmasi", "Datang" , "Tidak Datang"],
				datasets: [{
					data: [<?= $count_rsvp_default['jmldata'] ?>, <?= $count_rsvp_yes['jmldata'] ?> , <?= $count_rsvp_no['jmldata'] ?>],
					backgroundColor: ["#ece5df" , "#9a9c5b" , "#d0c5b1"],
					borderColor: "transparent",
					borderWidth: "3"
				}]
			};
			a.push(this.respChart(d("#donut-chart-example2"), "Doughnut", n, {
				maintainAspectRatio: !1,
				cutoutPercentage: 60,
				legend: {
					display: !1
				}
			}))
		}
        
		return a
	}, a.prototype.init = function() {
		var r = this;
		Chart.defaults.global.defaultFontFamily = "Nunito,sans-serif", r.charts = this.initCharts(), d(window).on("resize", function(a) {
			d.each(r.charts, function(a, r) {
				try {
					r.destroy()
				} catch (a) {}
			}), r.charts = r.initCharts()
		})
	}, d.ChartJs = new a, d.ChartJs.Constructor = a
}(window.jQuery),
function() {
	"use strict";
	window.jQuery.ChartJs.init()
}();



//  APEX CHARTS 

Apex.grid = {
	padding: {
		right: 0,
		left: 0
	}
}, Apex.dataLabels = {
	enabled: !1
};
var randomizeArray = function(e) {
		for (var o, t, a = e.slice(), r = a.length; 0 !== r;) t = Math.floor(Math.random() * r), o = a[--r], a[r] = a[t], a[t] = o;
		return a
	},
	sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46],
	colorPalette = ["#9b9b5b", "#9b9b5f", "#9b9b5b", "#9b9b5b", "#9b9b5b"],

colors = ["#9b9b5f"];
(dataColors = $("#apex-bar-1").data("colors")) && (colors = dataColors.split(","));
options = {
	chart: {
		height: 450,
		type: "bar",
        
		toolbar: {
			show: !1
		}
	},
	plotOptions: {
		bar: {
			horizontal: !0,
            background : '#9b9b5f'
		}
	},
	dataLabels: {
		enabled: !1
	},
	series: [{
		data: [
            <?php if(!empty($guest_category_list)){ foreach ($guest_category_list as $key => $list) { 
            $sum_guest_cat = $this->getData("guest")->get(array("sum_by_category" , array($event['event_code'] , "$list[guestCatID]")));
            ?>
            <?= $sum_guest_cat['jmldata'] ?>, 
            <?php }}  ?>
        ]
	}],
	colors: colors,
	xaxis: {
		categories: [
            <?php if(!empty($guest_category_list)){ foreach ($guest_category_list as $key => $list) { 
            
        
            ?>
           
            "<?= $list['guest_cat_name'] ?>",

            <?php }} ?>
        ]
	},
	states: {
		hover: {
			filter: "none"
		}
	},
	grid: {
		borderColor: "#9b9b5b"
	}
};
(chart = new ApexCharts(document.querySelector("#apex-bar-1"), options)).render();
colors = ["#9b9b5b", "#9b9b5b"];
function generateData(e, o, t) {
	for (var a = 0, r = []; a < o;) {
		var s = Math.floor(750 * Math.random()) + 1,
			i = Math.floor(Math.random() * (t.max - t.min + 1)) + t.min,
			l = Math.floor(61 * Math.random()) + 15;
		r.push([s, i, l]), a++
	}
	return r
}





</script>


<?php endif; ?>


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