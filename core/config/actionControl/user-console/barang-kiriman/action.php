<?php

use PhpOffice\PhpSpreadsheet\IOFactory;


class actionBarangKiriman extends controller{

    protected $connection;
    public function __construct($connection) {

        $db = $connection->getConnection();
        $this->crud = $connection;
        $this->pdo = $db;
        $this->models  = $this->getData("user");
    }


    public function uploadFilesXls($data = [])
    {
        $time      = $data[1];
        $key       = $data[2];
        $companyID = $data[3];
        $file      = $_FILES['file']['name'];

        $coreDir     = $this->site_setting("rootDirectory");
        require_once "$coreDir/core/vendor/autoload.php";


        if($file != "")
        {
           $upload = true;
        }else{
            $upload = false;
        }

        if($upload == true)
        {

            switch ($data[0]) {
                case 'fullupload':

                    $refMaster = "";

                    if ($_FILES["file"]["error"] == UPLOAD_ERR_OK && $_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") 
                    {
                        $tmpName = $_FILES["file"]["tmp_name"];
                        try {
                            $spreadsheet = IOFactory::load($tmpName);
                        } catch (Exception $e) {
                            die('Error loading file: ' . $e->getMessage());
                        }
                
                        $sheetNames = $spreadsheet->getSheetNames();
                        $datas = array();

                        foreach ($sheetNames as $sheetName) {
                            $worksheet  = $spreadsheet->getSheetByName($sheetName);
                            $rowCount   = $worksheet->getHighestRow()  ;


                            switch ($sheetName) {
                                case 'header':

                                    for($x = 2; $x <= $rowCount; $x++)
                                    {

                                        if($refMaster == "")
                                        {
                                            $refMaster = $worksheet->getCell("A" . $x)->getValue();
                                        }

                                        $array_header = array(
                                            "REF_MASTER"             => $worksheet->getCell("A" . $x)->getValue(),
                                            "REF_HEADER"             => $worksheet->getCell("B" . $x)->getValue(),
                                            "JNS_AJU"                => $worksheet->getCell("C" . $x)->getValue(),
                                            "KD_JNS_PIBK"            => $worksheet->getCell("D" . $x)->getValue(),
                                            "NO_BARANG"              => $worksheet->getCell("E" . $x)->getValue(),
                                            "KD_KANTOR"              => $worksheet->getCell("F" . $x)->getValue(),
                                            "KD_JNS_ANGKUT"          => $worksheet->getCell("G" . $x)->getValue(),
                                            "NM_PENGANGKUT"          => $worksheet->getCell("H" . $x)->getValue(),
                                            "NO_FLIGHT"              => $worksheet->getCell("I" . $x)->getValue(),
                                            "KD_PEL_MUAT"            => $worksheet->getCell("J" . $x)->getValue(),
                                            "KD_PEL_BONGKAR"         => $worksheet->getCell("K" . $x)->getValue(),
                                            "KD_GUDANG"              => $worksheet->getCell("L" . $x)->getValue(),
                                            "NO_INVOICE"             => $worksheet->getCell("M" . $x)->getValue(),
                                            "TGL_INVOICE"            => $worksheet->getCell("N" . $x)->getValue(),
                                            "KD_NEGARA_ASAL"         => $worksheet->getCell("O" . $x)->getValue(),
                                            "JML_BRG"                => $worksheet->getCell("P" . $x)->getValue(),
                                            "NO_BC11"                => $worksheet->getCell("Q" . $x)->getValue(),
                                            "TGL_BC11"               => $worksheet->getCell("R" . $x)->getValue(),
                                            "NO_POS_BC11"            => $worksheet->getCell("S" . $x)->getValue(),
                                            "NO_SUBPOS_BC11"         => $worksheet->getCell("T" . $x)->getValue(),
                                            "NO_SUBSUBPOS_BC11"      => $worksheet->getCell("U" . $x)->getValue(),
                                            "NO_MASTER_BLAWB"        => $worksheet->getCell("V" . $x)->getValue(),
                                            "TGL_MASTER_BLAWB"       => $worksheet->getCell("W" . $x)->getValue(),
                                            "NO_HOUSE_BLAWB"         => $worksheet->getCell("X" . $x)->getValue(),
                                            "TGL_HOUSE_BLAWB"        => $worksheet->getCell("Y" . $x)->getValue(),
                                            "KD_NEG_PENGIRIM"        => $worksheet->getCell("Z" . $x)->getValue(),
                                            "NM_PENGIRIM"            => $worksheet->getCell("AA" . $x)->getValue(),
                                            "AL_PENGIRIM"            => $worksheet->getCell("AB" . $x)->getValue(),
                                            "JNS_ID_PENERIMA"        => $worksheet->getCell("AC" . $x)->getValue(),
                                            "NO_ID_PENERIMA"         => $worksheet->getCell("AD" . $x)->getValue(),
                                            "NM_PENERIMA"            => $worksheet->getCell("AE" . $x)->getValue(),
                                            "AL_PENERIMA"            => $worksheet->getCell("AF" . $x)->getValue(),
                                            "TELP_PENERIMA"          => $worksheet->getCell("AG" . $x)->getValue(),
                                            "JNS_ID_PEMBERITAHU"     => $worksheet->getCell("AH" . $x)->getValue(),
                                            "NO_ID_PEMBERITAHU"      => $worksheet->getCell("AI" . $x)->getValue(),
                                            "NM_PEMBERITAHU"         => $worksheet->getCell("AJ" . $x)->getValue(),
                                            "AL_PEMBERITAHU"         => $worksheet->getCell("AK" . $x)->getValue(),
                                            "NO_IZIN_PEMBERITAHU"    => $worksheet->getCell("AL" . $x)->getValue(),
                                            "TGL_IZIN_PEMBERITAHU"   => $worksheet->getCell("AM" . $x)->getValue(),
                                            "KD_VAL"                 => $worksheet->getCell("AN" . $x)->getValue(),
                                            "NDPBM"                  => $worksheet->getCell("AO" . $x)->getValue(),
                                            "FOB"                    => $worksheet->getCell("AP" . $x)->getValue(),
                                            "ASURANSI"               => $worksheet->getCell("AQ" . $x)->getValue(),
                                            "FREIGHT"                => $worksheet->getCell("AR" . $x)->getValue(),
                                            "CIF"                    => $worksheet->getCell("AS" . $x)->getValue(),
                                            "NETTO"                  => $worksheet->getCell("AT" . $x)->getValue(),
                                            "BRUTO"                  => $worksheet->getCell("AU" . $x)->getValue(),
                                            "TOT_DIBAYAR"            => $worksheet->getCell("AV" . $x)->getValue(),
                                            "NPWP_BILLING"           => $worksheet->getCell("AW" . $x)->getValue(),
                                            "NAMA_BILLING"           => $worksheet->getCell("AX" . $x)->getValue()
                                        );

                                        $execute_header = $this->actioncontrolHeader(array("add" , "files" , $time , $key , $companyID) , $array_header);
                                        
                                    } 


                                    break;
                                case 'header_pungutan' :

                                    for($x = 2; $x <= $rowCount; $x++)
                                    {
                                        $REF_HEADER    = $worksheet->getCell("A" . $x)->getValue();
                                        $BM            = $worksheet->getCell("B" . $x)->getValue();
                                        $PPH           = $worksheet->getCell("C" . $x)->getValue();
                                        $PPN           = $worksheet->getCell("D" . $x)->getValue();
                                        $PPNBM         = $worksheet->getCell("E" . $x)->getValue();
                                        
                                        if($BM != "")
                                        {
                                            $array_header_pungutan = array(
                                                "REF_HEADER"    => $REF_HEADER,
                                                "KD_PUNGUTAN"   => "1",
                                                "NILAI"         => $BM
                                            );
                                        }

                                        if($PPH != "")
                                        {
                                            $array_header_pungutan = array(
                                                "REF_HEADER"    => $REF_HEADER,
                                                "KD_PUNGUTAN"   => "2",
                                                "NILAI"         => $PPH
                                            );
                                        }

                                        if($PPN != "")
                                        {
                                            $array_header_pungutan = array(
                                                "REF_HEADER"    => $REF_HEADER,
                                                "KD_PUNGUTAN"   => "3",
                                                "NILAI"         => $PPN
                                            );

                                        }

                                        if($PPNBM != "")
                                        {
                                            $array_header_pungutan = array(
                                                "REF_HEADER"    => $REF_HEADER,
                                                "KD_PUNGUTAN"   => "4",
                                                "NILAI"         => $PPNBM
                                            );
                                        }

                                        $execute_header_pungutan = $this->actioncontrolHeaderPungutan(array("add" , "files" , $time , $key , $companyID) , $array_header_pungutan);

                                    }

                                    break;

                                case 'detil' :

                                    $REF_HEADER_TAMPUNG = "";
                                    for($x = 2; $x <= $rowCount; $x++)
                                    {

                                        $REF_HEADER = $worksheet->getCell("A" . $x)->getValue();

                                        if($REF_HEADER != "-")
                                        {
                                            $REF_HEADER_TAMPUNG = $REF_HEADER;
                                        }

                                        $REF_DETIL   = $worksheet->getCell("B" . $x)->getValue();
                                        $SERI_BRG    = $worksheet->getCell("C" . $x)->getValue();
                                        $HS_CODE     = $worksheet->getCell("D" . $x)->getValue();
                                        $UR_BRG      = $worksheet->getCell("E" . $x)->getValue();
                                        $KD_NEG_ASAL = $worksheet->getCell("F" . $x)->getValue();
                                        $JML_KMS     = $worksheet->getCell("G" . $x)->getValue();
                                        $JNS_KMS     = $worksheet->getCell("H" . $x)->getValue();
                                        $CIF         = $worksheet->getCell("I" . $x)->getValue();
                                        $KD_SAT_HRG  = $worksheet->getCell("J" . $x)->getValue();
                                        $JML_SAT_HRG = $worksheet->getCell("K" . $x)->getValue();
                                        $FL_BEBAS    = $worksheet->getCell("L" . $x)->getValue();
                                        $NO_SKEP     = $worksheet->getCell("M" . $x)->getValue();
                                        $TGL_SKEP    = $worksheet->getCell("N" . $x)->getValue();

                                        if($SERI_BRG != "")
                                        {

                                            $array_detil = array(

                                                "REF_HEADER"    => $REF_HEADER_TAMPUNG,
                                                "REF_DETIL"     => $REF_DETIL,
                                                "SERI_BRG"      => $SERI_BRG,
                                                "HS_CODE"       => $HS_CODE,
                                                "UR_BRG"        => $UR_BRG,
                                                "KD_NEG_ASAL"   => $KD_NEG_ASAL,
                                                "JML_KMS"       => $JML_KMS,
                                                "JNS_KMS"       => $JNS_KMS,
                                                "CIF"           => $CIF,
                                                "KD_SAT_HRG"    => $KD_SAT_HRG,
                                                "JML_SAT_HRG"   => $JML_SAT_HRG,
                                                "FL_BEBAS"      => $FL_BEBAS,
                                                "NO_SKEP"       => $NO_SKEP,
                                                "TGL_SKEP"      => $TGL_SKEP
        
                                            );

                                            $execute_detil = $this->actioncontrolDetil(array("add" , "files" , $time , $key , $companyID) , $array_detil);
    
                                        }
                                        
                                    }

                                    break;

                                case 'detil_pungutan' :


                                    $REF_HEADER_TAMPUNG = "";
                                    $REF_DETIL_TAMPUNG   = "";
                                    for($x = 2; $x <= $rowCount; $x++)
                                    {

                                        $REF_HEADER = $worksheet->getCell("A" . $x)->getValue();
                                        $REF_DETIL  = $worksheet->getCell("B" . $x)->getValue();

                                        if($REF_HEADER != "-")
                                        {
                                            $REF_HEADER_TAMPUNG = $REF_HEADER;
                                        }

                                        if($REF_DETIL != "-")
                                        {
                                            $REF_DETIL_TAMPUNG = $REF_DETIL;
                                        }


                                        $KD_PUNGUTAN  = $worksheet->getCell("D" . $x)->getValue();
                                        $NILAI        = $worksheet->getCell("E" . $x)->getValue();
                                        $KD_TARIF     = $worksheet->getCell("F" . $x)->getValue();
                                        $KD_SAT_TARIF = $worksheet->getCell("G" . $x)->getValue();
                                        $JML_SAT      = $worksheet->getCell("H" . $x)->getValue();
                                        $TARIF        = $worksheet->getCell("I" . $x)->getValue();

                                        if($KD_PUNGUTAN != "")
                                        {

                                            $array_detil_pungutan = array(

                                                "REF_HEADER"    => $REF_HEADER_TAMPUNG,
                                                "REF_DETIL"     => $REF_DETIL_TAMPUNG,
                                                "KD_PUNGUTAN"   => $KD_PUNGUTAN,
                                                "NILAI"         => $NILAI,
                                                "KD_TARIF"      => $KD_TARIF,
                                                "KD_SAT_TARIF"  => $KD_SAT_TARIF,
                                                "JML_SAT"       => $JML_SAT,
                                                "TARIF"         => $TARIF

                                            );

                                            $execute_detil_pungutan = $this->actioncontrolDetilPungutan(array("add" , "files" , $time , $key , $companyID) , $array_detil_pungutan);


                                        }

                                    }

                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }

                         
                        }
                
                        // $convert_json = json_encode($datas);

                        // print_r($convert_json);
                        // Redirect ke halaman lain atau tampilkan pesan sukses

                        $this->headerLoc("/barang-kiriman/master/$refMaster");

                        exit;
                    } else {
                        // Tampilkan pesan jika file yang diunggah bukan file Excel
                        echo "File yang diunggah harus berupa file Excel (.xlsx)";
                    }

                    break;
                
                default:
                    # code...
                    break;
            }
          
            

        }

    }

    public function actioncontrolDetilPungutan($data = [] , $content = "")
    {

        $datafrom  = $data[1];
        $time      = $data[2];
        $key       = $data[3];
        $companyID = $data[4];

        ## sqlite directory 

        $directory   = $this->site_setting('rootDirectory');
        $company     = $this->getData("company")->get(array("by_id",array($companyID)));
        $dbName      = "$directory/core/serverbase/userbase/$company[rootdir]/$company[rootdir].db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));
 
        $datenow     = $this->datesetting("datetime");
 
        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

            ## check detil 


            if($datafrom == "files")
            {

                $REF_HEADER   = $this->formatCL($content['REF_HEADER']);
                $REF_DETIL    = $this->formatCL($content['REF_DETIL']);
                $KD_PUNGUTAN  = $this->formatCL($content['KD_PUNGUTAN']);
                $NILAI        = $this->formatCL($content['NILAI']);
                $KD_TARIF     = $this->formatCL($content['KD_TARIF']);
                $KD_SAT_TARIF = $this->formatCL($content['KD_SAT_TARIF']);
                $JML_SAT      = $this->formatCL($content['JML_SAT']);
                $TARIF        = $this->formatCL($content['TARIF']);


            }elseif($datafrom == "form")
            {

                if($data[0] != "delete"):

                $REF_HEADER   = $this->form_scan(array("pro" , $data[6]));
                $REF_DETIL    = $this->form_scan(array("pro" , $data[7]));
                $KD_PUNGUTAN  = $this->hashId("dec" , $_POST['KD_PUNGUTAN']);
                $NILAI        = $this->form_scan(array("pro" , $_POST['NILAI']));
                $KD_TARIF     = $this->hashId("dec" , $_POST['KD_TARIF']);
                $KD_SAT_TARIF = $this->form_scan(array("pro" , $_POST['KD_SAT_TARIF']));
                $JML_SAT      = $this->form_scan(array("pro" , $_POST['JML_SAT']));
                $TARIF        = $this->form_scan(array("pro" , $_POST['TARIF']));

                endif;
            }

            if($data[0] != "delete"):
            $check_detail = $this->getData("CN_PIBK_DETIL")->get(array("by_refid" , array($companyID , $REF_DETIL)));
            endif;

            switch ($data[0]) {
                case 'add':

                    if(!empty($check_detail))
                    {

                        $array_detil_pungutan = array(

                            "MASTER_ID"     => $check_detail['MASTER_ID'],
                            "HEADER_ID"     => $check_detail['HEADER_ID'],
                            "DETIL_ID"      => $check_detail['DETIL_ID'],
                            "KD_PUNGUTAN"   => $KD_PUNGUTAN,
                            "NILAI"         => $NILAI,
                            "KD_TARIF"      => $KD_TARIF,
                            "KD_SAT_TARIF"  => $KD_SAT_TARIF,
                            "JML_SAT"       => $JML_SAT,
                            "TARIF"         => $TARIF

                        );

                        $execute = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL_PUNGUTAN" , "insert" , $array_detil_pungutan , "");

                        if($execute[0] == "true")
                        {

                            if($datafrom == "form")
                            {
                                ## direct loc
                                $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");

                            }

                        }

                    }

                    break;

                case 'update' :

                    if($datafrom == "form")
                    {
                        $DETIL_PUNGUTAN_ID    = $this->form_scan(array("pro" , $data[5]));

                        $array_detil_pungutan = array(

                            "KD_PUNGUTAN"   => $KD_PUNGUTAN,
                            "NILAI"         => $NILAI,
                            "KD_TARIF"      => $KD_TARIF,
                            "KD_SAT_TARIF"  => $KD_SAT_TARIF,
                            "JML_SAT"       => $JML_SAT,
                            "TARIF"         => $TARIF

                        );

                        $param_detil_pungutan = array(

                            "DETIL_PUNGUTAN_ID" => $DETIL_PUNGUTAN_ID

                        );

                        $execute = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL_PUNGUTAN" , "update" , $array_detil_pungutan , $param_detil_pungutan);
                        if($execute[0] == "true")
                        {
                            if($datafrom == "form")
                            {
                                $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");
                            }

                        }

                    }

                    break;


                case 'delete' :

                    if($datafrom == "form")
                    {

                        $ID = $this->hashId("dec",$_POST['contentID']);


                        if($datafrom == "form")
                        {

                            $param = array(

                                "DETIL_PUNGUTAN_ID"   => $ID

                            );

                            $execute = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL_PUNGUTAN" , "delete" , "" , $param);

                            if($execute[0] == "true")
                            {
                              echo "true";                                
                            }

                        }

                    }

                    break;
                
                default:
                    # code...
                    break;
            }

        }


    }


    public function actioncontrolDetil($data = [] , $content = "")
    {

        $datafrom  = $data[1];
        $time      = $data[2];
        $key       = $data[3];
        $companyID = $data[4];

        ## sqlite directory 

        $directory   = $this->site_setting('rootDirectory');
        $company     = $this->getData("company")->get(array("by_id",array($companyID)));
        $dbName      = "$directory/core/serverbase/userbase/$company[rootdir]/$company[rootdir].db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));
 
        $datenow     = $this->datesetting("datetime");
 
        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

            if($datafrom == "files")
            {

                $REF_HEADER     = $this->formatCL($content['REF_HEADER']);
                $REF_DETIL      = $this->formatCL($content['REF_DETIL']);
                $SERI_BRG       = $this->formatCL($content['SERI_BRG']);
                $HS_CODE        = $this->formatCL($content['HS_CODE']);
                $UR_BRG         = $this->formatCL($content['UR_BRG']);
                $KD_NEG_ASAL    = $this->formatCL($content['KD_NEG_ASAL']);
                $JML_KMS        = $this->formatCL($content['JML_KMS']);
                $JNS_KMS        = $this->formatCL($content['JNS_KMS']);
                $CIF            = $this->formatCL($content['CIF']);
                $KD_SAT_HRG     = $this->formatCL($content['KD_SAT_HRG']);
                $JML_SAT_HRG    = $this->formatCL($content['JML_SAT_HRG']);
                $FL_BEBAS       = $this->formatCL($content['FL_BEBAS']);
                $NO_SKEP        = $this->formatCL($content['NO_SKEP']);
                $GET_TGL_SKEP   = str_replace("/", "-", $content['TGL_SKEP']);
                $TGL_SKEP       = $this->formatCL($GET_TGL_SKEP);

            }elseif($datafrom == "form")
            {
                if($data[0] != "delete"):

                $REF_HEADER  = $this->form_scan(array("pro" , $data[6]));
                $REF_DETIL   = $this->generateReff($companyID , "pro");
                $SERI_BRG    = $this->form_scan(array("pro" , $_POST['SERI_BRG']));
                $HS_CODE     = $this->form_scan(array("pro" , $_POST['HS_CODE']));
                $UR_BRG      = $this->form_scan(array("pro" , $_POST['UR_BRG']));
                $KD_NEG_ASAL = $this->form_scan(array("pro" , $_POST['KD_NEG_ASAL']));
                $JML_KMS     = $this->form_scan(array("pro" , $_POST['JML_KMS']));
                $JNS_KMS     = $this->form_scan(array("pro" , $_POST['JNS_KMS']));
                $CIF         = $this->form_scan(array("pro" , $_POST['CIF']));
                $KD_SAT_HRG  = $this->form_scan(array("pro" , $_POST['KD_SAT_HRG']));
                $JML_SAT_HRG = $this->form_scan(array("pro" , $_POST['JML_SAT_HRG']));
                $FL_BEBAS    = $this->form_scan(array("pro" , $_POST['FL_BEBAS']));
                $NO_SKEP     = $this->form_scan(array("pro" , $_POST['NO_SKEP']));
                $TGL_SKEP    = $_POST['TGL_SKEP'];

                endif;

            }

            ## check header 
            if($data[0] != "delete"):
            $check_header = $this->getData("CN_PIBK_HEADER")->get(array("by_refid" , array($companyID , $REF_HEADER)));
            endif;

            switch ($data[0]) {
                case 'add':
                    
                    if(!empty($check_header))
                    {

                        $HEADER_ID = $check_header['HEADER_ID'];
                        $MASTER_ID = $check_header['MASTER_ID'];

                        $array_detil = array(

                            "REFID"              => $REF_DETIL,
                            "MASTER_ID"          => $MASTER_ID,
                            "HEADER_ID"          => $HEADER_ID,
                            "SERI_BRG"           => $SERI_BRG,
                            "HS_CODE"            => $HS_CODE,
                            "UR_BRG"             => $UR_BRG,
                            "KD_NEG_ASAL"        => $KD_NEG_ASAL,
                            "JML_KMS"            => $JML_KMS,
                            "JNS_KMS"            => $JNS_KMS,
                            "CIF"                => $CIF,
                            "KD_SAT_HRG"         => $KD_SAT_HRG,
                            "JML_SAT_HRG"        => $JML_SAT_HRG,
                            "FL_BEBAS"           => $FL_BEBAS,
                            "NO_SKEP"            => $NO_SKEP,
                            "TGL_SKEP"           => $TGL_SKEP

                        );

                        $execute = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL" , "insert" , $array_detil , "");

                        if($execute[0] == "true")
                        {
                            if($datafrom == "form")
                            {
                                ## direct loc
                                $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");

                            }

                        }

                    }

                    break;

                case 'update' :

                    if($datafrom == "form")
                    {

                        $REF_HEADER  = $this->form_scan(array("pro" , $data[6]));
                        $DETIL_ID    = $this->form_scan(array("pro" , $data[5]));

                        $array_detil = array(

                          
                            "SERI_BRG"           => $SERI_BRG,
                            "HS_CODE"            => $HS_CODE,
                            "UR_BRG"             => $UR_BRG,
                            "KD_NEG_ASAL"        => $KD_NEG_ASAL,
                            "JML_KMS"            => $JML_KMS,
                            "JNS_KMS"            => $JNS_KMS,
                            "CIF"                => $CIF,
                            "KD_SAT_HRG"         => $KD_SAT_HRG,
                            "JML_SAT_HRG"        => $JML_SAT_HRG,
                            "FL_BEBAS"           => $FL_BEBAS,
                            "NO_SKEP"            => $NO_SKEP,
                            "TGL_SKEP"           => $TGL_SKEP

                        );

                        $param_detil = array(

                            "DETIL_ID"  => $DETIL_ID

                        );

                        $execute = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL" , "update" , $array_detil , $param_detil);

                        if($execute[0] == "true")
                        {
                            if($datafrom == "form")
                            {
                                ## direct loc
                                $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");

                            }

                        }


                    }

                    break;

                case 'delete' :

                    if($datafrom == "form")
                    {

                        $ID = $this->hashId("dec",$_POST['contentID']);


                        if($datafrom == "form")
                        {

                            $param = array(

                                "DETIL_ID"   => $ID

                            );

                            $execute = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL" , "delete" , "" , $param);

                            if($execute[0] == "true")
                            {

                              $execute_dp = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL_PUNGUTAN" , "delete" , "" , $param);

                              echo "true";
                                
                            }

                        }

                    }


                    break;
                
                default:
                    # code...
                    break;
            }

        }

    }

    public function actioncontrolHeaderPungutan($data = [] , $content = "")
    {

        $datafrom  = $data[1];
        $time      = $data[2];
        $key       = $data[3];
        $companyID = $data[4];

        ## sqlite directory 

        $directory   = $this->site_setting('rootDirectory');
        $company     = $this->getData("company")->get(array("by_id",array($companyID)));
        $dbName      = "$directory/core/serverbase/userbase/$company[rootdir]/$company[rootdir].db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));
 
        $datenow     = $this->datesetting("datetime");
 
        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {   

            switch ($data[0]) {
                case 'add':

                    ##

                    if($datafrom == "files")
                    {
                        $REF_HEADER  = $this->formatCL($content['REF_HEADER']);
                        $KD_PUNGUTAN = $this->formatCL($content['KD_PUNGUTAN']);
                        $NILAI       = $this->formatCL($content['NILAI']);

                    }elseif($datafrom == "form")
                    {

                        $REF_HEADER  = $this->form_scan(array("pro" , $data[6]));
                        $KD_PUNGUTAN = $this->hashId("dec" , $_POST['KD_PUNGUTAN']);
                        $NILAI       = $this->form_scan(array("pro" , $_POST['NILAI']));

                    }

                    $check_header = $this->getData("CN_PIBK_HEADER")->get(array("by_refid" , array($companyID , $REF_HEADER)));
                    
                    if(!empty($check_header))
                    {

                        $MASTER_ID = $check_header['MASTER_ID'];
                        $HEADER_ID = $check_header['HEADER_ID'];

                        ## insert to database

                        $validation = $this->form_validation(array("$REF_HEADER" , "$KD_PUNGUTAN" , "$NILAI"));

                        if($validation == "true")
                        {

                            $array_header_pungutan = array(

                                "MASTER_ID"     => $MASTER_ID,
                                "HEADER_ID"     => $HEADER_ID,
                                "KD_PUNGUTAN"   => $KD_PUNGUTAN,
                                "NILAI"         => $NILAI
                            );
    
                            $execute = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER_PUNGUTAN" , "insert" , $array_header_pungutan , "");
    
                            if($execute[0] == "true")
                            {
                                if($datafrom == "form")
                                {
                                    ## direct loc
    
                                    $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");
                                }
    
                            }

                        }

                    }

                    ##
                    
                    break;

                case 'update' :

                    if($datafrom == "form")
                    {

                        $REF_HEADER  = $this->form_scan(array("pro" , $data[6]));
                        $KD_PUNGUTAN = $this->hashId("dec" , $_POST['KD_PUNGUTAN']);
                        $NILAI       = $this->form_scan(array("pro" , $_POST['NILAI']));
                        $PUNGUTAN_ID = $this->form_scan(array("pro" , $data[5]));

                        $validation = $this->form_validation(array("$REF_HEADER" , "$KD_PUNGUTAN" , "$NILAI" , "$PUNGUTAN_ID"));

                        if($validation == "true")
                        {

                            $array_header_pungutan = array(
                                "KD_PUNGUTAN"   => $KD_PUNGUTAN,
                                "NILAI"         => $NILAI
                            );
    
                            $param_header_pungutan = array(
                                "PUNGUTAN_ID"    => $PUNGUTAN_ID
                            );
    
                            $execute = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER_PUNGUTAN" , "update" , $array_header_pungutan , $param_header_pungutan);
    
                            if($execute[0] == "true")
                            {
                                $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");
    
                            }

                        }

                    }

                    break;

                case 'delete' :


                    if($datafrom == "form")
                    {

                        $ID = $this->hashId("dec",$_POST['contentID']);


                        if($datafrom == "form")
                        {

                            $param = array(

                                "PUNGUTAN_ID"   => $ID

                            );

                            $execute = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER_PUNGUTAN" , "delete" , "" , $param);

                            if($execute[0] == "true")
                            {
                                echo "true";
                            }

                        }

                    }

                    break;
                
                default:
                    # code...
                    break;
            }

            

        }

    }

    public function actioncontrolHeader($data=[] ,  $content = "")
    {
        $datafrom  = $data[1];
        $time      = $data[2];
        $key       = $data[3];
        $companyID = $data[4];


        ## sqlite directory 

        $directory   = $this->site_setting('rootDirectory');
        $company     = $this->getData("company")->get(array("by_id",array($companyID)));
        $dbName      = "$directory/core/serverbase/userbase/$company[rootdir]/$company[rootdir].db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $datenow   = $this->datesetting("datetime");

        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

            if($datafrom == "files")
            {

                $REF_MASTER            = $this->formatCL($content['REF_MASTER']);
                $REF_HEADER            = $this->formatCL($content['REF_HEADER']);
                $JNS_AJU               = $this->formatCL($content['JNS_AJU']);
                $KD_JNS_PIBK           = $this->formatCL($content['KD_JNS_PIBK']);
                $NO_BARANG             = $this->formatCL($content['NO_BARANG']);
                $KD_KANTOR             = $this->formatCL($content['KD_KANTOR']);
                $KD_JNS_ANGKUT         = $this->formatCL($content['KD_JNS_ANGKUT']);
                $NM_PENGANGKUT         = $this->formatCL($content['NM_PENGANGKUT']);
                $NO_FLIGHT             = $this->formatCL($content['NO_FLIGHT']);
                $KD_PEL_MUAT           = $this->formatCL($content['KD_PEL_MUAT']);
                $KD_PEL_BONGKAR        = $this->formatCL($content['KD_PEL_BONGKAR']);
                $KD_GUDANG             = $this->formatCL($content['KD_GUDANG']);
                $NO_INVOICE            = $this->formatCL($content['NO_INVOICE']);

                $TGL_INVOICE_GET       = str_replace("/", "-", $content['TGL_INVOICE']);
                $TGL_INVOICE           = $this->formatCL($TGL_INVOICE_GET);

                $KD_NEGARA_ASAL        = $this->formatCL($content['KD_NEGARA_ASAL']);
                $JML_BRG               = $this->formatCL($content['JML_BRG']);
                $NO_BC11               = $this->formatCL($content['NO_BC11']);

                $TGL_BC11_GET          = str_replace("/", "-", $content['TGL_BC11']);
                $TGL_BC11              = $this->formatCL($TGL_BC11_GET);

                $NO_POS_BC11           = $this->formatCL($content['NO_POS_BC11']);
                $NO_SUBPOS_BC11        = $this->formatCL($content['NO_SUBPOS_BC11']);
                $NO_SUBSUBPOS_BC11     = $this->formatCL($content['NO_SUBSUBPOS_BC11']);
                $NO_MASTER_BLAWB       = $this->formatCL($content['NO_MASTER_BLAWB']);

                $TGL_MASTER_BLAWB_GET  = str_replace("/", "-", $content['TGL_MASTER_BLAWB']);
                $TGL_MASTER_BLAWB      = $this->formatCL($TGL_MASTER_BLAWB_GET);

                $NO_HOUSE_BLAWB        = $this->formatCL($content['NO_HOUSE_BLAWB']);

                $TGL_HOUSE_BLAWB_GET   = str_replace("/", "-", $content['TGL_HOUSE_BLAWB']);
                $TGL_HOUSE_BLAWB       = $this->formatCL($TGL_HOUSE_BLAWB_GET);


                $KD_NEG_PENGIRIM       = $this->formatCL($content['KD_NEG_PENGIRIM']);
                $NM_PENGIRIM           = $this->formatCL($content['NM_PENGIRIM']);
                $AL_PENGIRIM           = $this->formatCL($content['AL_PENGIRIM']);
                $JNS_ID_PENERIMA       = $this->formatCL($content['JNS_ID_PENERIMA']);
                $NO_ID_PENERIMA        = $this->formatCL($content['NO_ID_PENERIMA']);
                $NM_PENERIMA           = $this->formatCL($content['NM_PENERIMA']);
                $AL_PENERIMA           = $this->formatCL($content['AL_PENERIMA']);
                $TELP_PENERIMA         = $this->formatCL($content['TELP_PENERIMA']);
                $JNS_ID_PEMBERITAHU    = $this->formatCL($content['JNS_ID_PEMBERITAHU']);
                $NO_ID_PEMBERITAHU     = $this->formatCL($content['NO_ID_PEMBERITAHU']);
                $NM_PEMBERITAHU        = $this->formatCL($content['NM_PEMBERITAHU']);
                $AL_PEMBERITAHU        = $this->formatCL($content['AL_PEMBERITAHU']);
                $NO_IZIN_PEMBERITAHU   = $this->formatCL($content['NO_IZIN_PEMBERITAHU']);

                $TGL_IZIN_PEMBERITAHU_GET  = str_replace("/", "-", $content['TGL_IZIN_PEMBERITAHU']);
                $TGL_IZIN_PEMBERITAHU      = $this->formatCL($TGL_IZIN_PEMBERITAHU_GET);

                $KD_VAL                = $this->formatCL($content['KD_VAL']);
                $NDPBM                 = $this->formatCL($content['NDPBM']);
                $FOB                   = $this->formatCL($content['FOB']);
                $ASURANSI              = $this->formatCL($content['ASURANSI']);
                $FREIGHT               = $this->formatCL($content['FREIGHT']);
                $CIF                   = $this->formatCL($content['CIF']);
                $NETTO                 = $this->formatCL($content['NETTO']);
                $BRUTO                 = $this->formatCL($content['BRUTO']);
                $TOT_DIBAYAR           = $this->formatCL($content['TOT_DIBAYAR']);
                $NPWP_BILLING          = $this->formatCL($content['NPWP_BILLING']);
                $NAMA_BILLING          = $this->formatCL($content['NAMA_BILLING']);


            }elseif($datafrom == "form")
            {

                if($data[0] == "add"):

                $REF_MASTER            = $this->generateReff($companyID , "basic");
                $REF_HEADER            = $this->generateReff($companyID , "pro");

                endif;

                if($data[0] == "update"):
                $REF_HEADER            = $content['REFID'];
                endif;

                $JNS_AJU               = $this->hashId("dec" , $_POST['JNS_AJU']);
                $KD_JNS_PIBK           = $this->hashId("dec" , $_POST['KD_JNS_PIBK']);
                $NO_BARANG             = $this->form_scan(array("pro" , $_POST['NO_BARANG']));
                $KD_KANTOR             = $this->form_scan(array("pro" , $_POST['KD_KANTOR']));
                $KD_JNS_ANGKUT         = $this->form_scan(array("pro" , $_POST['KD_JNS_ANGKUT']));
                $NM_PENGANGKUT         = $this->form_scan(array("pro" , $_POST['NM_PENGANGKUT']));
                $NO_FLIGHT             = $this->form_scan(array("pro" , $_POST['NO_FLIGHT']));
                $KD_PEL_MUAT           = $this->form_scan(array("pro" , $_POST['KD_PEL_MUAT']));
                $KD_PEL_BONGKAR        = $this->form_scan(array("pro" , $_POST['KD_PEL_BONGKAR']));
                $KD_GUDANG             = $this->form_scan(array("pro" , $_POST['KD_GUDANG']));
                $NO_INVOICE            = $this->form_scan(array("pro" , $_POST['NO_INVOICE']));
                $TGL_INVOICE           = $this->form_scan(array("pro" , $_POST['TGL_INVOICE']));
                $KD_NEGARA_ASAL        = $this->form_scan(array("pro" , $_POST['KD_NEGARA_ASAL']));
                $JML_BRG               = $this->form_scan(array("pro" , $_POST['JML_BRG']));
                $NO_BC11               = $this->form_scan(array("pro" , $_POST['NO_BC11']));
                $TGL_BC11              = $this->form_scan(array("pro" , $_POST['TGL_BC11']));
                $NO_POS_BC11           = $this->form_scan(array("pro" , $_POST['NO_POS_BC11']));
                $NO_SUBPOS_BC11        = $this->form_scan(array("pro" , $_POST['NO_SUBPOS_BC11']));
                $NO_SUBSUBPOS_BC11     = $this->form_scan(array("pro" , $_POST['NO_SUBSUBPOS_BC11']));
                $NO_MASTER_BLAWB       = $this->form_scan(array("pro" , $_POST['NO_MASTER_BLAWB']));
                $TGL_MASTER_BLAWB      = $this->form_scan(array("pro" , $_POST['TGL_MASTER_BLAWB']));
                $NO_HOUSE_BLAWB        = $this->form_scan(array("pro" , $_POST['NO_HOUSE_BLAWB']));
                $TGL_HOUSE_BLAWB       = $this->form_scan(array("pro" , $_POST['TGL_HOUSE_BLAWB']));
                $KD_NEG_PENGIRIM       = $this->form_scan(array("pro" , $_POST['KD_NEG_PENGIRIM']));
                $NM_PENGIRIM           = $this->form_scan(array("pro" , $_POST['NM_PENGIRIM']));
                $AL_PENGIRIM           = $this->form_scan(array("pro" , $_POST['AL_PENGIRIM']));
                $JNS_ID_PENERIMA       = $this->form_scan(array("pro" , $_POST['JNS_ID_PENERIMA']));
                $NO_ID_PENERIMA        = $this->form_scan(array("pro" , $_POST['NO_ID_PENERIMA']));
                $NM_PENERIMA           = $this->form_scan(array("pro" , $_POST['NM_PENERIMA']));
                $AL_PENERIMA           = $this->form_scan(array("pro" , $_POST['AL_PENERIMA']));
                $TELP_PENERIMA         = $this->form_scan(array("pro" , $_POST['TELP_PENERIMA']));
                $JNS_ID_PEMBERITAHU    = $this->form_scan(array("pro" , $_POST['JNS_ID_PEMBERITAHU']));
                $NO_ID_PEMBERITAHU     = $this->form_scan(array("pro" , $_POST['NO_ID_PEMBERITAHU']));
                $NM_PEMBERITAHU        = $this->form_scan(array("pro" , $_POST['NM_PEMBERITAHU']));
                $AL_PEMBERITAHU        = $this->form_scan(array("pro" , $_POST['AL_PEMBERITAHU']));
                $NO_IZIN_PEMBERITAHU   = $this->form_scan(array("pro" , $_POST['NO_IZIN_PEMBERITAHU']));
                $TGL_IZIN_PEMBERITAHU  = $this->form_scan(array("pro" , $_POST['TGL_IZIN_PEMBERITAHU']));
                $KD_VAL                = $this->form_scan(array("pro" , $_POST['KD_VAL']));
                $NDPBM                 = $this->form_scan(array("pro" , $_POST['NDPBM']));
                $FOB                   = $this->form_scan(array("pro" , $_POST['FOB']));
                $ASURANSI              = $this->form_scan(array("pro" , $_POST['ASURANSI']));
                $FREIGHT               = $this->form_scan(array("pro" , $_POST['FREIGHT']));
                $CIF                   = $this->form_scan(array("pro" , $_POST['CIF']));
                $NETTO                 = $this->form_scan(array("pro" , $_POST['NETTO']));
                $BRUTO                 = $this->form_scan(array("pro" , $_POST['BRUTO']));
                $TOT_DIBAYAR           = $this->form_scan(array("pro" , $_POST['TOT_DIBAYAR']));
                $NPWP_BILLING          = $this->form_scan(array("pro" , $_POST['NPWP_BILLING']));
                $NAMA_BILLING          = $this->form_scan(array("pro" , $_POST['NAMA_BILLING']));

            }

            switch ($data[0]) {

                case 'add':

                    $masterID = 0;
                    ## check master 

                    if($datafrom == "files"):
                    $check_master = $this->getData("CN_PIBK_MASTER")->get(array("by_refid" , array($companyID , $REF_MASTER)));
                    endif;

                    if($datafrom == "form"):
                    $check_master = $this->getData("CN_PIBK_HEADER")->get(array("by_nomaster" , array($companyID , $NO_MASTER_BLAWB)));
                    endif;

                    if(empty($check_master))
                    {

                        ## create master 
                        $array_master = array(
                            "REFID"             => $REF_MASTER,
                            "NO_MASTER_BLAWB"   => $NO_MASTER_BLAWB,
                            "TGL_MASTER_BLAWB"  => $TGL_MASTER_BLAWB,
                            "INPUT_DATE"        => $datenow
                        );

                        $execute_master = $sqlite_conn->crud($dbName , "CN_PIBK_MASTER" , "insert" , $array_master , "");

                        if($execute_master[0] == "true")
                        {
                        $masterID = $execute_master[1];
                        }
                        
                    }elseif(!empty($check_master))
                    {
                        $masterID = $check_master['MASTER_ID'];
                    }


                    ## insert into datbaase header 
                    if($masterID != 0)
                    {

                        $array_header = array(
                           
                            "MASTER_ID"              => $masterID,
                            "REFID"                  => $REF_HEADER,
                            "JNS_AJU"                => $JNS_AJU,
                            "KD_JNS_PIBK"            => $KD_JNS_PIBK,
                            "NO_BARANG"              => $NO_BARANG,
                            "KD_KANTOR"              => $KD_KANTOR,
                            "KD_JNS_ANGKUT"          => $KD_JNS_ANGKUT,
                            "NM_PENGANGKUT"          => $NM_PENGANGKUT,
                            "NO_FLIGHT"              => $NO_FLIGHT,
                            "KD_PEL_MUAT"            => $KD_PEL_MUAT,
                            "KD_PEL_BONGKAR"         => $KD_PEL_BONGKAR,
                            "KD_GUDANG"              => $KD_GUDANG,
                            "NO_INVOICE"             => $NO_INVOICE,
                            "TGL_INVOICE"            => $TGL_INVOICE,
                            "KD_NEGARA_ASAL"         => $KD_NEGARA_ASAL,
                            "JML_BRG"                => $JML_BRG,
                            "NO_BC11"                => $NO_BC11,
                            "TGL_BC11"               => $TGL_BC11,
                            "NO_POS_BC11"            => $NO_POS_BC11,
                            "NO_SUBPOS_BC11"         => $NO_SUBPOS_BC11,
                            "NO_SUBSUBPOS_BC11"      => $NO_SUBSUBPOS_BC11,
                            "NO_MASTER_BLAWB"        => $NO_MASTER_BLAWB,
                            "TGL_MASTER_BLAWB"       => $TGL_MASTER_BLAWB,
                            "NO_HOUSE_BLAWB"         => $NO_HOUSE_BLAWB,
                            "TGL_HOUSE_BLAWB"        => $TGL_HOUSE_BLAWB,
                            "KD_NEG_PENGIRIM"        => $KD_NEG_PENGIRIM,
                            "NM_PENGIRIM"            => $NM_PENGIRIM,
                            "AL_PENGIRIM"            => $AL_PENGIRIM,
                            "JNS_ID_PENERIMA"        => $JNS_ID_PENERIMA,
                            "NO_ID_PENERIMA"         => $NO_ID_PENERIMA,
                            "NM_PENERIMA"            => $NM_PENERIMA,
                            "AL_PENERIMA"            => $AL_PENERIMA,
                            "TELP_PENERIMA"          => $TELP_PENERIMA,
                            "JNS_ID_PEMBERITAHU"     => $JNS_ID_PEMBERITAHU,
                            "NO_ID_PEMBERITAHU"      => $NO_ID_PEMBERITAHU,
                            "NM_PEMBERITAHU"         => $NM_PEMBERITAHU,
                            "AL_PEMBERITAHU"         => $AL_PEMBERITAHU,
                            "NO_IZIN_PEMBERITAHU"    => $NO_IZIN_PEMBERITAHU,
                            "TGL_IZIN_PEMBERITAHU"   => $TGL_IZIN_PEMBERITAHU,
                            "KD_VAL"                 => $KD_VAL,
                            "NDPBM"                  => $NDPBM,
                            "FOB"                    => $FOB,
                            "ASURANSI"               => $ASURANSI,
                            "FREIGHT"                => $FREIGHT,
                            "CIF"                    => $CIF,
                            "NETTO"                  => $NETTO,
                            "BRUTO"                  => $BRUTO,
                            "TOT_DIBAYAR"            => $TOT_DIBAYAR,
                            "NPWP_BILLING"           => $NPWP_BILLING,
                            "NAMA_BILLING"           => $NAMA_BILLING,
                            "INPUT_DATE"             => $datenow,
                            "SENDING_STATUS"         => "0"

                        );

                        $execute_header = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER" , "insert" , $array_header , "");

                        if($datafrom == "form")
                        {

                            ## direct loc
                            $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");


                        }

                    }

                    break;

                case 'update' :

                    if($datafrom == "form")
                    {

                        $HEADER_ID    = $data[5];
                        $array_header = array(

                            "JNS_AJU"                => $JNS_AJU,
                            "KD_JNS_PIBK"            => $KD_JNS_PIBK,
                            "NO_BARANG"              => $NO_BARANG,
                            "KD_KANTOR"              => $KD_KANTOR,
                            "KD_JNS_ANGKUT"          => $KD_JNS_ANGKUT,
                            "NM_PENGANGKUT"          => $NM_PENGANGKUT,
                            "NO_FLIGHT"              => $NO_FLIGHT,
                            "KD_PEL_MUAT"            => $KD_PEL_MUAT,
                            "KD_PEL_BONGKAR"         => $KD_PEL_BONGKAR,
                            "KD_GUDANG"              => $KD_GUDANG,
                            "NO_INVOICE"             => $NO_INVOICE,
                            "TGL_INVOICE"            => $TGL_INVOICE,
                            "KD_NEGARA_ASAL"         => $KD_NEGARA_ASAL,
                            "JML_BRG"                => $JML_BRG,
                            "NO_BC11"                => $NO_BC11,
                            "TGL_BC11"               => $TGL_BC11,
                            "NO_POS_BC11"            => $NO_POS_BC11,
                            "NO_SUBPOS_BC11"         => $NO_SUBPOS_BC11,
                            "NO_SUBSUBPOS_BC11"      => $NO_SUBSUBPOS_BC11,
                            "NO_MASTER_BLAWB"        => $NO_MASTER_BLAWB,
                            "TGL_MASTER_BLAWB"       => $TGL_MASTER_BLAWB,
                            "NO_HOUSE_BLAWB"         => $NO_HOUSE_BLAWB,
                            "TGL_HOUSE_BLAWB"        => $TGL_HOUSE_BLAWB,
                            "KD_NEG_PENGIRIM"        => $KD_NEG_PENGIRIM,
                            "NM_PENGIRIM"            => $NM_PENGIRIM,
                            "AL_PENGIRIM"            => $AL_PENGIRIM,
                            "JNS_ID_PENERIMA"        => $JNS_ID_PENERIMA,
                            "NO_ID_PENERIMA"         => $NO_ID_PENERIMA,
                            "NM_PENERIMA"            => $NM_PENERIMA,
                            "AL_PENERIMA"            => $AL_PENERIMA,
                            "TELP_PENERIMA"          => $TELP_PENERIMA,
                            "JNS_ID_PEMBERITAHU"     => $JNS_ID_PEMBERITAHU,
                            "NO_ID_PEMBERITAHU"      => $NO_ID_PEMBERITAHU,
                            "NM_PEMBERITAHU"         => $NM_PEMBERITAHU,
                            "AL_PEMBERITAHU"         => $AL_PEMBERITAHU,
                            "NO_IZIN_PEMBERITAHU"    => $NO_IZIN_PEMBERITAHU,
                            "TGL_IZIN_PEMBERITAHU"   => $TGL_IZIN_PEMBERITAHU,
                            "KD_VAL"                 => $KD_VAL,
                            "NDPBM"                  => $NDPBM,
                            "FOB"                    => $FOB,
                            "ASURANSI"               => $ASURANSI,
                            "FREIGHT"                => $FREIGHT,
                            "CIF"                    => $CIF,
                            "NETTO"                  => $NETTO,
                            "BRUTO"                  => $BRUTO,
                            "TOT_DIBAYAR"            => $TOT_DIBAYAR,
                            "NPWP_BILLING"           => $NPWP_BILLING,
                            "NAMA_BILLING"           => $NAMA_BILLING

                        );

                        $param_header = array(
                            "HEADER_ID" => $HEADER_ID
                        );

                        $execute = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER" , "update" , $array_header , $param_header);
                        
                        if($execute[0] == "true")
                        {

                            if($datafrom == "form")
                            {
                                $this->headerLoc("/barang-kiriman/header/$REF_HEADER?res=true");

                            }

                        }


                    }

                    break;

                case 'delete' :

                    if($datafrom == "form")
                    {
                        $ID = $this->hashId("dec",$_POST['contentID']);
                        
                            $param = array(
                                "HEADER_ID"   => $ID
                            );

                            $execute = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER" , "delete" , "" , $param);

                            if($execute[0] == "true")
                            {

                                // delete header_pungutan 
                                $execute_header_pungutan = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER_PUNGUTAN" , "delete" , "" , $param);
                                $execute_detil           = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL" , "delete" , "" , $param);
                                $execute_detil_pungutan  = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL_PUNGUTAN" , "delete" , "" , $param);

                                echo "true";
                            }

                        

                    }

                    break;
                
                default:
                    # code...
                    break;
            }

        }   

    }

    public function actioncontrolMaster($data=[] ,  $content = "")
    {

        $datafrom  = $data[1];
        $time      = $data[2];
        $key       = $data[3];
        $companyID = $data[4];


        ## sqlite directory 

        $directory   = $this->site_setting('rootDirectory');
        $company     = $this->getData("company")->get(array("by_id",array($companyID)));
        $dbName      = "$directory/core/serverbase/userbase/$company[rootdir]/$company[rootdir].db";
        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

        $datenow     = $this->datesetting("datetime");

        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

            switch ($data[0]) {
                case 'delete':
                    
                    if($datafrom == "form")
                    {
                        $ID = $this->hashId("dec",$_POST['contentID']);
                        
                            $param = array(
                                "MASTER_ID"   => $ID
                            );

                            $execute = $sqlite_conn->crud($dbName , "CN_PIBK_MASTER" , "delete" , "" , $param);

                            if($execute[0] == "true")
                            {
                                $execute_header          = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER" , "delete" , "" , $param);
                                $execute_header_pungutan = $sqlite_conn->crud($dbName , "CN_PIBK_HEADER_PUNGUTAN" , "delete" , "" , $param);
                                $execute_detil           = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL" , "delete" , "" , $param);
                                $execute_detil_pungutan  = $sqlite_conn->crud($dbName , "CN_PIBK_DETIL_PUNGUTAN" , "delete" , "" , $param);
                                echo "true";
                            }

                    }

                    break;
                
                default:
                    return;
                    break;
            }

        }

    }

}

?>