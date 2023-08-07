<?php
$template = new templateControllerPanel();
$userID   = $_SESSION['userID'];
$template->head($pages , array("dataTables" , "dataForms"));

$companyID = $this->hashId("dec"  , $_SESSION['companyID']);
?>





<?php if($view == ""): 

$master_list = $this->getData("CN_PIBK_MASTER")->get(array("get_all" , array($companyID)));
    
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
                                <li class="breadcrumb-item active">Barang Kiriman</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Barang Kiriman </h4>
                    </div>
                </div>
            </div>

            <div class="row mb-2">

            <div class="col-12">

                <a href="/barang-kiriman/manage-header"><button class="btn btn-dark"><i class="fas fa fa-plus mr-2"></i>Create New Header</button></a>
                <a href="/download"><button class="btn btn-secondary"><i class="fas fa fa-download mr-2"></i>Download Template Xls</button></a>
                <!-- <a href="/download/detil"><button class="btn btn-secondary"><i class="fas fa fa-download mr-2"></i>Download Template Detil</button></a> -->
                <a href="/upload"><button class="btn btn-success"><i class="fas fa fa-upload mr-2"></i>Upload File Xls</button></a>
                <!-- <a href="/upload/detil"><button class="btn btn-success"><i class="fas fa fa-upload mr-2"></i>Upload Detil</button></a> -->


            </div>

            <div class="col-12 mt-2">

                <div class="card-box">

                <table id="basic-datatable" class="table table-striped border-0">
                    <thead class="border-0">
                        <tr>
                            <th class="border-0">Reff ID</th>
                            <th class="border-0">Master BL/AWB</th>
                            <th class="border-0">Tgl Bl/AWB</th>
                            <th class="border-0 text-right">#</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if(!empty($master_list)){ foreach ($master_list as $key => $list) { 
                    
                    $master_hash = $this->key($list['MASTER_ID']);
                    
                    ?>

                        <tr>
                            <td class="border-0"><?= $list['REFID'] ?></td>
                            <td class="border-0"><?= $list['NO_MASTER_BLAWB'] ?></td>
                            <td class="border-0"><?= $list['TGL_MASTER_BLAWB'] ?></td>
                            <td class="border-0">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="/barang-kiriman/master/<?= $list['REFID'] ?>" class="dropdown-item">Detail</a>
                                    <a href=""  data-toggle="modal" data-target="#remove_master_<?= $master_hash ?>" class="dropdown-item">Delete</a>

                                </div>
                            </div>

                            <form id="masterform<?= $master_hash ?>" method="post">
                            <input type="hidden" name="action" value="removemaster">
                            <input type="hidden" name="company" value="<?= $this->hashId("enc" , $companyID) ?>">
                            <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['MASTER_ID']) ?>">
                            <input type="hidden" name="keyID" value="<?= $master_hash ?>">
                            <input type="hidden" name="key" value="<?= $this->act_key($master_hash) ?>">
                            </form>
                            <?= $alert = $this->modalAlert(array("danger" , "remove_master_$master_hash" , "removemaster('$master_hash')")); ?>


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
<?php endif; ?>

<?php if($view == "master"): 

$reff_master = $value;

$master      = $this->getData("CN_PIBK_MASTER")->get(array("by_refid" , array($companyID , $reff_master)));
$header_list = $this->getData("CN_PIBK_HEADER")->get(array("by_masterid" , array($companyID , $master['MASTER_ID'])));


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
                                <li class="breadcrumb-item"><a href="/barang-kiriman">Barang Kiriman  </a></li>

                                <li class="breadcrumb-item active">Master</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Master :: <?= $master['NO_MASTER_BLAWB'] ?> </h4>
                    </div>
                </div>
            </div>

            <div class="row mb-2">

            <div class="col-12">

                <a href="/barang-kiriman/manage-header"><button class="btn btn-dark"><i class="fas fa fa-plus mr-2"></i>Create New Header</button></a>


            </div>

            <div class="col-12 mt-2">

                <div class="card-box">

                <!--  -->

                <table id="basic-datatable" class="table table-striped border-0">
                    <thead class="border-0">
                        <tr>
                            <th class="border-0">NO BARANG</th>
                            <th class="border-0">Master BL/AWB</th>
                            <th class="border-0">Tgl Bl/AWB</th>
                            <th class="border-0">Jenis Aju</th>
                            <th class="border-0">Jenis PIBK</th>
                            <th class="border-0">Pengangkut</th>
                            <th class="border-0">No Invoice</th>
                            <th class="border-0">Tgl Invoice</th>
                            <th class="border-0 text-right">#</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if(!empty($header_list)){ foreach ($header_list as $key => $list) { 
                        
                        $header_hash = $this->key($list['HEADER_ID']);
                       
                    ?>

                        <tr>
                            <td class="border-0"><?= $list['NO_BARANG'] ?></td>
                            <td class="border-0"><?= $list['NO_MASTER_BLAWB'] ?></td>
                            <td class="border-0"><?= $list['TGL_MASTER_BLAWB'] ?></td>
                            <td class="border-0"><?= $this->masterData("jenis_aju" , $list['JNS_AJU'])['description']; ?></td>
                            <td class="border-0"><?= $this->masterData("jenis_pibk" , $list['KD_JNS_PIBK'])['description'] ?></td>
                            <td class="border-0"><?= $list['NM_PENGANGKUT'] ?> <br> <small><?= $list['NO_FLIGHT'] ?></small></td>
                            <td class="border-0"><?= $list['NO_INVOICE'] ?></td>
                            <td class="border-0"><?= $list['TGL_INVOICE'] ?></td>
                            <td class="border-0">
                            <!--  -->
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="/barang-kiriman/header/<?= $list['REFID'] ?>" class="dropdown-item">Detail</a>
                                    <a href=""  data-toggle="modal" data-target="#remove_header_<?= $header_hash ?>" class="dropdown-item">Delete</a>

                                </div>
                            </div>

                            <form id="headerform<?= $header_hash ?>" method="post">
                            <input type="hidden" name="action" value="removeheader">
                            <input type="hidden" name="company" value="<?= $this->hashId("enc" , $companyID) ?>">
                            <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['HEADER_ID']) ?>">
                            <input type="hidden" name="keyID" value="<?= $header_hash ?>">
                            <input type="hidden" name="key" value="<?= $this->act_key($header_hash) ?>">
                            </form>
                            <?= $alert = $this->modalAlert(array("danger" , "remove_header_$header_hash" , "removeheader('$header_hash')")); ?>

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

        </div>
    </div>
</div>  

<?php endif; ?>


<?php if($view == "manage-header"): 

if($value == "")
{
    $task = "add";
    $dataID   = "";
}else{
    $task = "update";
    $dataID   = $value;
}

$form = $this->controllerForm('form_pibk_header' , 'user-console/pibk-header');


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
                                <li class="breadcrumb-item"><a href="/barang-kiriman">Barang Kiriman  </a></li>
                                <li class="breadcrumb-item active">Manage Header</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Manage Header</h4>
                    </div>
                </div>
            </div>

            <div class="row mb-2">

            <?php $form->form(array("$task" , $companyID , $dataID)); ?>

            </div>

        </div>
    </div>
</div>
<?php endif; ?>

<?php if($view == "header"): 

$reff_header = $value;
$header = $this->getData("CN_PIBK_HEADER")->get(array("by_refid" , array($companyID , $reff_header)));
$master = $this->getData("CN_PIBK_MASTER")->get(array("by_id" , array($companyID , $header['MASTER_ID'])));
$header_pungutan = $this->getData("CN_PIBK_HEADER_PUNGUTAN")->get(array("by_headerid" , array($companyID , $header['HEADER_ID'])));
$detil = $this->getData("CN_PIBK_DETIL")->get(array("by_headerid" , array($companyID , $header['HEADER_ID'])));
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
                                <li class="breadcrumb-item"><a href="/barang-kiriman">Barang Kiriman  </a></li>
                                <li class="breadcrumb-item"><a href="/barang-kiriman/master/<?= $master['REFID'] ?>">Master  </a></li>
                                
                                <?php if(isset($_GET['form'])){ ?>

                                <li class="breadcrumb-item"><a href="/barang-kiriman/header/<?= $header['REFID'] ?>">Header  </a></li>

                                <li class="breadcrumb-item active">Manage</li>

                                <?php }else{ ?>
                                
                                <li class="breadcrumb-item active">Header</li>

                                <?php } ?>
                            
                            </ol>
                        </div>
                        <h4 class="page-title">Header :: <?= $reff_header ?> </h4>
                    </div>
                </div>
            </div>

            <div class="row mb-2">

            
                <div class="col-lg-4 mt-2">

                    <div class="card-box">
                        <h5 class="text-small">Header Data</h5>

                        <ul class="nav nav-tabs nav-bordered nav-justified">
                            <li class="nav-item">
                                <a href="#tab-1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Primary
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab-2" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                Doc
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab-3" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Shipment
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab-4" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Val
                                </a>
                            </li>
                        </ul>


                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">

                            <!--  -->

                            <div class="table-responsive">
                            <table class="table table-striped">

                                <tr>
                                    <td class="border-0 text-left"><small>JNS_AJU <br> <span class="font-weight-bold"><?= $this->masterData("jenis_aju" , $header['JNS_AJU'])['description'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>KD_JNS_PIBK <br> <span class="font-weight-bold"><?= $this->masterData("jenis_pibk" , $header['KD_JNS_PIBK'])['description'] ?></span></small></td>

                                </tr>
                            
                                <tr>
                                    <td class="border-0 text-left"><small>NO_BARANG <br> <span class="font-weight-bold"><?= $header['NO_BARANG'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>KD_KANTOR <br> <span class="font-weight-bold"><?= $header['KD_KANTOR'] ?></span></small></td>

                                </tr>
                            
                                <tr>
                                    <td class="border-0 text-left"><small>KD_JNS_ANGKUT <br> <span class="font-weight-bold"><?= $header['KD_JNS_ANGKUT'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>NM_PENGANGKUT <br> <span class="font-weight-bold"><?= $header['NM_PENGANGKUT'] ?></span></small></td>

                                </tr>
                                
                                <tr>
                                    <td  class="border-0 text-left"><small>NO_FLIGHT <br> <span class="font-weight-bold"><?= $header['NO_FLIGHT'] ?></span></small></td>
                                    <td  class="border-0 text-right"><small>KD_GUDANG <br> <span class="font-weight-bold"><?= $header['KD_GUDANG'] ?></span></small></td>

                                </tr>
                                <tr>
                                    <td class="border-0 text-left"><small>KD_PEL_MUAT <br> <span class="font-weight-bold"><?= $header['KD_PEL_MUAT'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>KD_PEL_BONGKAR <br> <span class="font-weight-bold"><?= $header['KD_PEL_BONGKAR'] ?></span></small></td>

                                </tr>
                            
                                <tr>
                                    <td class="border-0 text-left"><small>NO_INVOICE <br> <span class="font-weight-bold"><?= $header['NO_INVOICE'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>TGL_INVOICE <br> <span class="font-weight-bold"><?= $header['TGL_INVOICE'] ?></span></small></td>

                                </tr>
                            
                                <tr>
                                    <td class="border-0 text-left"><small>KD_NEGARA_ASAL <br> <span class="font-weight-bold"><?= $header['KD_NEGARA_ASAL'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>KD_NEG_PENGIRIM <br> <span class="font-weight-bold"><?= $header['KD_NEG_PENGIRIM'] ?></span></small></td>


                                </tr>

                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>JML_BRG <br> <span class="font-weight-bold"><?= $header['JML_BRG'] ?></span></small></td>

                                </tr>
                                
                                
                            </table>

                            </div>
                            <!--  -->

                            </div>
                            <div class="tab-pane " id="tab-2">

                            <div class="table-responsive">
                            <table class="table table-striped">

                            <!--  -->
                                <tr>
                                    <td class="border-0 text-left"><small>NO_BC11 <br> <span class="font-weight-bold"><?= $header['NO_BC11'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>TGL_BC11 <br> <span class="font-weight-bold"><?= $header['TGL_BC11'] ?></span></small></td>

                                </tr>
                            
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NO_POS_BC11 <br> <span class="font-weight-bold"><?= $header['NO_POS_BC11'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NO_SUBPOS_BC11 <br> <span class="font-weight-bold"><?= $header['NO_SUBPOS_BC11'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NO_SUBSUBPOS_BC11 <br> <span class="font-weight-bold"><?= $header['NO_SUBSUBPOS_BC11'] ?></span></small></td>
                                </tr>

                                <tr>
                                    <td class="border-0 text-left"><small>NO_MASTER_BLAWB <br> <span class="font-weight-bold"><?= $header['NO_MASTER_BLAWB'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>TGL_MASTER_BLAWB <br> <span class="font-weight-bold"><?= $header['TGL_MASTER_BLAWB'] ?></span></small></td>
                                </tr>
                            
                                <tr>
                                    <td  class="border-0 text-left"><small>NO_HOUSE_BLAWB <br> <span class="font-weight-bold"><?= $header['NO_HOUSE_BLAWB'] ?></span></small></td>
                                    <td  class="border-0 text-right"><small>TGL_HOUSE_BLAWB <br> <span class="font-weight-bold"><?= $header['TGL_HOUSE_BLAWB'] ?></span></small></td>

                                </tr>
                               
                            <!--  -->

                            </table>
                            </div>

                            </div>
                            <div class="tab-pane " id="tab-3">

                            <!--  -->
                            <div class="table-responsive">
                            <table class="table table-striped">

                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NM_PENGIRIM <br> <span class="font-weight-bold"><?= $header['NM_PENGIRIM'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>AL_PENGIRIM <br> <span class="font-weight-bold"><?= $header['AL_PENGIRIM'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>JNS_ID_PENERIMA <br> <span class="font-weight-bold"><?= $header['JNS_ID_PENERIMA'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NO_ID_PENERIMA <br> <span class="font-weight-bold"><?= $header['NO_ID_PENERIMA'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NM_PENERIMA <br> <span class="font-weight-bold"><?= $header['NM_PENERIMA'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>AL_PENERIMA <br> <span class="font-weight-bold"><?= $header['AL_PENERIMA'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>TELP_PENERIMA <br> <span class="font-weight-bold"><?= $header['TELP_PENERIMA'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>JNS_ID_PEMBERITAHU <br> <span class="font-weight-bold"><?= $header['JNS_ID_PEMBERITAHU'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NO_ID_PEMBERITAHU <br> <span class="font-weight-bold"><?= $header['NO_ID_PEMBERITAHU'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NM_PEMBERITAHU <br> <span class="font-weight-bold"><?= $header['NM_PEMBERITAHU'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>AL_PEMBERITAHU <br> <span class="font-weight-bold"><?= $header['AL_PEMBERITAHU'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td class="border-0 text-left"><small>NO_IZIN_PEMBERITAHU <br> <span class="font-weight-bold"><?= $header['NO_IZIN_PEMBERITAHU'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>TGL_IZIN_PEMBERITAHU <br> <span class="font-weight-bold"><?= $header['TGL_IZIN_PEMBERITAHU'] ?></span></small></td>
                                </tr>

                            </table>
                            </div>

                            <!--  -->

                            </div>
                            <div class="tab-pane " id="tab-4">

                            <!--  -->

                            <div class="table-responsive">
                            <table class="table table-striped">

                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>KD_VAL <br> <span class="font-weight-bold"><?= $header['KD_VAL'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td class="border-0 text-left"><small>NDPBM <br> <span class="font-weight-bold"><?= $header['NDPBM'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>FOB <br> <span class="font-weight-bold"><?= $header['FOB'] ?></span></small></td>

                                </tr>
                            
                                <tr>
                                    <td class="border-0 text-left"><small>ASURANSI <br> <span class="font-weight-bold"><?= $header['ASURANSI'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>FREIGHT <br> <span class="font-weight-bold"><?= $header['FREIGHT'] ?></span></small></td>

                                </tr>
                            
                                <tr>
                                    <td class="border-0 text-left"><small>CIF <br> <span class="font-weight-bold"><?= $header['CIF'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>NETTO <br> <span class="font-weight-bold"><?= $header['NETTO'] ?></span></small></td>
                                </tr>
                                
                                <tr>
                                    <td class="border-0 text-left"><small>BRUTO <br> <span class="font-weight-bold"><?= $header['BRUTO'] ?></span></small></td>
                                    <td class="border-0 text-right"><small>TOT_DIBAYAR <br> <span class="font-weight-bold"><?= $header['TOT_DIBAYAR'] ?></span></small></td>

                                </tr>
                                
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NPWP_BILLING <br> <span class="font-weight-bold"><?= $header['NPWP_BILLING'] ?></span></small></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-left"><small>NAMA_BILLING <br> <span class="font-weight-bold"><?= $header['NAMA_BILLING'] ?></span></small></td>
                                </tr>

                            </table>
                            </div>

                            <!--  -->

                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <a href="/barang-kiriman/manage-header/<?= $this->hashId("enc" , $header['HEADER_ID']) ?>"><button class="btn btn-dark btn-block">Manage Header</button></a>
                        </div>
                      
                    </div>

                </div>

                <div class="col-lg-8 mt-2">

                    <?php if(isset($_GET['form'])){ 
                    
                    if(isset($_GET['id']))
                    {
                        $task   = "update";
                        $dataID = $_GET['id'];

                    }else{
                        $task   = "add";
                        $dataID = "";
                    }


                    
                    ?>

                        <?php if(isset($_GET['form'])): ?>

                            <?php if($_GET['form'] == "header-pungutan"): 
                            $form = $this->controllerForm('form_pibk_header_pungutan' , 'user-console/pibk-header-pungutan');
                            ?>

                            <div class="card-box">
                                <h5>Manage PIBK Header Pungutan</h5>
                                <?php $form->form(array("$task" , $companyID , $header['HEADER_ID'] , $dataID)); ?>
                            </div>

                            <?php endif; ?>

                            <?php if($_GET['form'] == "detil"): 
                            $form = $this->controllerForm('form_pibk_detil' , 'user-console/pibk-detil');    
                            ?>

                            <div class="card-box">
                                <h5>Manage PIBK Detil</h5>
                                <?php $form->form(array("$task" , $companyID , $header['HEADER_ID'] , $dataID)); ?>
                            </div> 
                            <?php endif; ?>

                            <?php if($_GET['form'] == "detil-pungutan"): 
                            $form = $this->controllerForm('form_pibk_detil_pungutan' , 'user-console/pibk-detil-pungutan');    

                            ?>
                            <div class="card-box">
                                <h5>Manage PIBK Detil Pungutan</h5>
                                <?php $form->form(array("$task" , $companyID , $_GET['parentID'] , $dataID)); ?>
                            </div>

                            <?php endif; ?>

                        <?php endif; ?>

                        

                    <?php }else{ ?>

                    <div class="card-box">
                        <h5>Header Pungutan</h5>

                        <a href="/barang-kiriman/header/<?= $value ?>?form=header-pungutan"><button class="btn btn-dark"><small><i class="fas fa fa-plus mr-2"></i>Tambah Data Header Pungutan</small></button></a>

                        <table class="table table-striped mt-2">
                            <thead>
                                <tr>
                                    <th class="border-0"><small>KD PUNGUTAN</small></th>
                                    <th class="border-0"><small>NILAI</small></th>
                                    <td class="border-0 text-right"><small>#</small></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($header_pungutan)){ foreach ($header_pungutan as $key => $list) { 
                                
                                $header_pungutan_hash = $this->key($list['PUNGUTAN_ID']);
                                
                                ?>

                                    <tr>
                                        <td class="border-0"><small><?= $this->masterData("jenis_pungutan" , $list['KD_PUNGUTAN'])['description'] ?></small></td>
                                        <td class="border-0"><small><?= $this->formatNumber($list['NILAI'] , 2) ?></small></td>
                                        <td class="border-0">
                                        <!--  -->
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="/barang-kiriman/header/<?= $value ?>?form=header-pungutan&id=<?= $this->hashId("enc",$list['PUNGUTAN_ID']) ?>" class="dropdown-item">Update</a>
                                                <a href="#" data-toggle="modal" data-target="#remove_header_pungutan_<?= $header_pungutan_hash ?>" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>


                                        <form id="headerpungutanform<?= $header_pungutan_hash ?>" method="post">
                                        <input type="hidden" name="action" value="removeheaderpungutan">
                                        <input type="hidden" name="company" value="<?= $this->hashId("enc" , $companyID) ?>">
                                        <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['PUNGUTAN_ID']) ?>">
                                        <input type="hidden" name="keyID" value="<?= $header_pungutan_hash ?>">
                                        <input type="hidden" name="key" value="<?= $this->act_key($header_pungutan_hash) ?>">
                                        </form>

                                        <?= $alert = $this->modalAlert(array("danger" , "remove_header_pungutan_$header_pungutan_hash" , "removeheaderpungutan('$header_pungutan_hash')")); ?>


                                        <!--  -->
                                        </td>
                                    </tr>

                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-box">
                        <h5>Detil</h5>
                        <a href="/barang-kiriman/header/<?= $value ?>?form=detil"><button class="btn btn-dark"><small><i class="fas fa fa-plus mr-2"></i>Tambah Data Detil</small></button></a>

                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th class="border-0"><small>SERI_BRG</small></th>
                                    <th class="border-0"><small>HS_CODE</small></th>
                                    <th class="border-0"><small>KD_NEG_ASAL</small></th>
                                    <th class="border-0"><small>UR_BRG</small></th>
                                    <th class="border-0"><small>JML_KMS</small></th>
                                    <th class="border-0"><small>JNS_KMS</small></th>
                                    <th class="border-0"><small>CIF</small></th>
                                    <th class="border-0 text-right"><small>#</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($detil)){ foreach ($detil as $key => $list) { 
                                $detil_pungutan = $this->getData("CN_PIBK_DETIL_PUNGUTAN")->get(array("by_detailid" , array($companyID , $list['DETIL_ID'])));
                                $detil_hash = $this->key($list['DETIL_ID']);
                                ?>
                                    
                                    <tr class="bg-light">
                                        <td class="border-0 text-small"><small><?= $list['SERI_BRG'] ?></small></td>
                                        <td class="border-0 text-small"><small><?= $list['HS_CODE'] ?></small></td>
                                        <td class="border-0 text-small"><small><?= $list['KD_NEG_ASAL'] ?></small></td>
                                        <td class="border-0 text-small"><small><?= $list['UR_BRG'] ?></small></td>
                                        <td class="border-0 text-small"><small><?= $list['JML_KMS'] ?></small></td>
                                        <td class="border-0 text-small"><small><?= $list['JNS_KMS'] ?></small></td>
                                        <td class="border-0 text-small"><small><?= $this->formatNumber($list['CIF'],2) ?></small></td>
                                        <td class="border-0">

                                            <div class="dropdown float-right">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="/barang-kiriman/header/<?= $value ?>?form=detil&id=<?= $this->hashId("enc",$list['DETIL_ID']) ?>" class="dropdown-item">Update</a>
                                                    <a href=""  data-toggle="modal" data-target="#remove_detil_<?= $detil_hash ?>" class="dropdown-item">Delete</a>
                                                    <a href="/barang-kiriman/header/<?= $value ?>?form=detil-pungutan&parentID=<?= $this->hashId("enc" , $list['DETIL_ID']) ?>" class="dropdown-item">Add Detil Pungutan</a>
                                                </div>
                                            </div>

                                            <!--  -->

                                            <form id="detilform<?= $detil_hash ?>" method="post">
                                            <input type="hidden" name="action" value="removeheaderdetil">
                                            <input type="hidden" name="company" value="<?= $this->hashId("enc" , $companyID) ?>">
                                            <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list['DETIL_ID']) ?>">
                                            <input type="hidden" name="keyID" value="<?= $detil_hash ?>">
                                            <input type="hidden" name="key" value="<?= $this->act_key($detil_hash) ?>">
                                            </form>

                                            <?= $alert = $this->modalAlert(array("danger" , "remove_detil_$detil_hash" , "removeheaderdetil('$detil_hash')")); ?>

                                            <!--  -->

                                        </td>
                                    </tr>

                                    <?php if(!empty($detil_pungutan)){ foreach ($detil_pungutan as $key_dp => $list_dp) { 
                                    
                                    $detil_pungutan_hash = $this->key($list_dp['DETIL_PUNGUTAN_ID']);
                                        
                                    ?>
                                        
                                        <tr>
                                            <td colspan="3" class="border-0 text-center"><small>---- DETIL PUNGUTAN ----</small></td>
                                            <td colspan="4" class="border-0">

                                                <div class="row">
                                                    <div class="col-lg-4">

                                                    <!--  -->
                                                    <small>
                                                    KD_PUNGUTAN : <span class="font-weight-bold"><?= $this->masterData("jenis_pungutan" , $list_dp['KD_PUNGUTAN'])['description'] ?></span>
                                                    <br>
                                                    NILAI       : <span class="font-weight-bold"><?= $this->formatNumber($list_dp['NILAI'],2) ?></span>
                                                    </small>
                                                    <!--  -->

                                                    </div>
                                                    <div class="col-lg-8">

                                                    <small>

                                                    KD_TARIF : <span class="font-weight-bold"><?= $this->masterData("jenis_tarif" , $list_dp['KD_TARIF'])['description'] ?></span>
                                                    <br>
                                                    KD_SAT_TARIF : <span class="font-weight-bold"><?= $list_dp['KD_SAT_TARIF'] ?></span>
                                                    <br>
                                                    JML_SAT      : <span class="font-weight-bold"><?= $list_dp['JML_SAT'] ?></span>
                                                    <br>
                                                    TARIF        : <span class="font-weight-bold"><?= $this->formatNumber($list_dp['TARIF'] , 2) ?></span>
                                                   
                                                    </small>

                                                    </div>
                                                  
                                                </div>
                                                

                                            </td>
                                            <td class="border-0">

                                                <div class="dropdown float-right">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="/barang-kiriman/header/<?= $value ?>?form=detil-pungutan&id=<?= $this->hashId("enc",$list_dp['DETIL_PUNGUTAN_ID']) ?>&parentID=<?= $this->hashId("enc" , $list_dp['DETIL_ID']) ?>" class="dropdown-item">Update</a>
                                                        <a href=""  data-toggle="modal" data-target="#remove_detil_pungutan_<?= $detil_pungutan_hash ?>" class="dropdown-item">Delete</a>

                                                    </div>
                                                </div>
                                                
                                                <!--  -->

                                                <form id="detilpungutanform<?= $detil_pungutan_hash ?>" method="post">
                                                <input type="hidden" name="action" value="removeheaderdetilpungutan">
                                                <input type="hidden" name="company" value="<?= $this->hashId("enc" , $companyID) ?>">
                                                <input type="hidden" name="contentID" value="<?= $this->hashId("enc",$list_dp['DETIL_PUNGUTAN_ID']) ?>">
                                                <input type="hidden" name="keyID" value="<?= $detil_pungutan_hash ?>">
                                                <input type="hidden" name="key" value="<?= $this->act_key($detil_pungutan_hash) ?>">
                                                </form>

                                                <?= $alert = $this->modalAlert(array("danger" , "remove_detil_pungutan_$detil_pungutan_hash" , "removeheaderdetilpungutan('$detil_pungutan_hash')")); ?>

                                                <!--  -->
                                            </td>
                                        </tr>

                                    <?php } } ?>

                                <?php } } ?>
                            </tbody>
                        </table>

                    </div>

                    <?php } ?>

                </div>

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
