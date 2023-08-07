<?php
class actionGenerateXml extends controller{

    protected $connection;
    public function __construct($connection) {

        $db = $connection->getConnection();
        $this->crud = $connection;
        $this->pdo = $db;
     
    }


    public function actioncontrol($data = [])
    {

        $time = $data[1];
        $key  = $data[2];
        $ID   = $data[3];
        $companyID = $data[4];
        $type      = $data[5];

        $generateKey = $this->act_key($time);

        if($generateKey == $key)
        {

     
            switch ($data[0]) {
                case 'generate':


                        $validation = $this->form_validation(array("$ID"));
                        $company    = $this->getData("company")->get(array("by_id" , array($companyID)));

                        // check data 

                        switch ($type) {
                            case 'WSBarangKiriman':
                                

                                $uriNamespace = "CN_PIBK.xsd";

                                $master = $this->getData("CN_PIBK_MASTER")->get(array("by_id" , array($companyID , $ID)));
                                $header  = $this->getData("CN_PIBK_HEADER")->get(array("by_masterid" , array($companyID , $master['MASTER_ID'])));
                                

                                // Create a new XML document
                                $xmlDoc = new DOMDocument('1.0', 'utf-8');

                                $documentElement = $xmlDoc->createElementNS($uriNamespace, 'DOCUMENT');                               
                                $xmlDoc->appendChild($documentElement);

                             
                                $cnPibkElement = $xmlDoc->createElement('CN_PIBK');
                                $xmlDoc->appendChild($cnPibkElement);

                                

                                $headerChildElements = array();


                                if(!empty($header)){ foreach ($header as $key => $headerlist) {

                                    $headerElement = $xmlDoc->createElement('HEADER');
                                    $cnPibkElement->appendChild($headerElement);
                                    // Create the 'HEADER' element and its child elements


                                    $header_pungutan_data = $this->getData("CN_PIBK_HEADER_PUNGUTAN")->get(array("by_headerid" , array($companyID , $headerlist['HEADER_ID'])));
                                    $detil_data           = $this->getData("CN_PIBK_DETIL")->get(array("by_headerid" , array($companyID , $headerlist['HEADER_ID'])));


                                    $TGL_INVOICE          = str_replace("-", "/", $headerlist['TGL_INVOICE']);
                                    $TGL_BC11             = str_replace("-", "/", $headerlist['TGL_BC11']);
                                    $TGL_MASTER_BLAWB     = str_replace("-", "/", $headerlist['TGL_MASTER_BLAWB']);
                                    $TGL_HOUSE_BLAWB      = str_replace("-", "/", $headerlist['TGL_HOUSE_BLAWB']);
                                    $TGL_IZIN_PEMBERITAHU = str_replace("-", "/", $headerlist['TGL_IZIN_PEMBERITAHU']);

                                    $headerChildElements[] = array(
                                    
                                        "JNS_AJU"                => $headerlist['JNS_AJU'],
                                        "KD_JNS_PIBK"            => $headerlist['KD_JNS_PIBK'],
                                        "NO_BARANG"              => $headerlist['NO_BARANG'],
                                        "KD_KANTOR"              => $headerlist['KD_KANTOR'],
                                        "KD_JNS_ANGKUT"          => $headerlist['KD_JNS_ANGKUT'],
                                        "NM_PENGANGKUT"          => $headerlist['NM_PENGANGKUT'],
                                        "NO_FLIGHT"              => $headerlist['NO_FLIGHT'],
                                        "KD_PEL_MUAT"            => $headerlist['KD_PEL_MUAT'],
                                        "KD_PEL_BONGKAR"         => $headerlist['KD_PEL_BONGKAR'],
                                        "KD_GUDANG"              => $headerlist['KD_GUDANG'],
                                        "NO_INVOICE"             => $headerlist['NO_INVOICE'],
                                        "TGL_INVOICE"            => $TGL_INVOICE,
                                        "KD_NEGARA_ASAL"         => $headerlist['KD_NEGARA_ASAL'],
                                        "JML_BRG"                => $headerlist['JML_BRG'],
                                        "NO_BC11"                => $headerlist['NO_BC11'],
                                        "TGL_BC11"               => $TGL_BC11,
                                        "NO_POS_BC11"            => $headerlist['NO_POS_BC11'],
                                        "NO_SUBPOS_BC11"         => $headerlist['NO_SUBPOS_BC11'],
                                        "NO_SUBSUBPOS_BC11"      => $headerlist['NO_SUBSUBPOS_BC11'],
                                        "NO_MASTER_BLAWB"        => $headerlist['NO_MASTER_BLAWB'],
                                        "TGL_MASTER_BLAWB"       => $TGL_MASTER_BLAWB,
                                        "NO_HOUSE_BLAWB"         => $headerlist['NO_HOUSE_BLAWB'],
                                        "TGL_HOUSE_BLAWB"        => $TGL_HOUSE_BLAWB,
                                        "KD_NEG_PENGIRIM"        => $headerlist['KD_NEG_PENGIRIM'],
                                        "NM_PENGIRIM"            => $headerlist['NM_PENGIRIM'],
                                        "AL_PENGIRIM"            => $headerlist['AL_PENGIRIM'],
                                        "JNS_ID_PENERIMA"        => $headerlist['JNS_ID_PENERIMA'],
                                        "NO_ID_PENERIMA"         => $headerlist['NO_ID_PENERIMA'],
                                        "NM_PENERIMA"            => $headerlist['NM_PENERIMA'],
                                        "AL_PENERIMA"            => $headerlist['AL_PENERIMA'],
                                        "TELP_PENERIMA"          => $headerlist['TELP_PENERIMA'],
                                        "JNS_ID_PEMBERITAHU"     => $headerlist['JNS_ID_PEMBERITAHU'],
                                        "NO_ID_PEMBERITAHU"      => $headerlist['NO_ID_PEMBERITAHU'],
                                        "NM_PEMBERITAHU"         => $headerlist['NM_PEMBERITAHU'],
                                        "AL_PEMBERITAHU"         => $headerlist['AL_PEMBERITAHU'],
                                        "NO_IZIN_PEMBERITAHU"    => $headerlist['NO_IZIN_PEMBERITAHU'],
                                        "TGL_IZIN_PEMBERITAHU"   => $TGL_IZIN_PEMBERITAHU,
                                        "KD_VAL"                 => $headerlist['KD_VAL'],
                                        "NDPBM"                  => $headerlist['NDPBM'],
                                        "FOB"                    => $headerlist['FOB'],
                                        "ASURANSI"               => $headerlist['ASURANSI'],
                                        "FREIGHT"                => $headerlist['FREIGHT'],
                                        "CIF"                    => $headerlist['CIF'],
                                        "NETTO"                  => $headerlist['NETTO'],
                                        "BRUTO"                  => $headerlist['BRUTO'],
                                        "TOT_DIBAYAR"            => $headerlist['TOT_DIBAYAR'],
                                        "NPWP_BILLING"           => $headerlist['NPWP_BILLING']
                                    );



                                    foreach ($headerChildElements as $headerData) {
                                        foreach ($headerData as $key => $value) {
                                            $childElement = $xmlDoc->createElement($key, $value);
                                            $headerElement->appendChild($childElement);
                                        }
                                    }



                                    $headerPungutanElement = $xmlDoc->createElement('HEADER_PUNGUTAN');
                                    $headerElement->appendChild($headerPungutanElement);

                                    $hpChildElements = array();


                                    if(!empty($header_pungutan_data)){ foreach ($header_pungutan_data as $key_header_pungutan => $hp_list) {
                                        
                                        $hpChildElements[] = array(

                                            "KD_PUNGUTAN"   => $hp_list['KD_PUNGUTAN'],
                                            "NILAI"         => $hp_list['NILAI']
    
                                        );

                                    } }

                                    foreach ($hpChildElements as $pungutanData) {
                                        $pungutanTotalElement = $xmlDoc->createElement('PUNGUTAN_TOTAL');
                                        $headerPungutanElement->appendChild($pungutanTotalElement);
                            
                                        foreach ($pungutanData as $key => $value) {
                                            $childElement = $xmlDoc->createElement($key, $value);
                                            $pungutanTotalElement->appendChild($childElement);
                                        }
                                    }




                                    $detilElement = $xmlDoc->createElement('DETIL');
                                    $headerElement->appendChild($detilElement);



                                    $barangData = array();
                                    $barangPungutanData = array();

                                    if(!empty($detil_data)){ foreach ($detil_data as $keydetil => $listdetil) {

                                        $TGL_SKEP          = str_replace("-", "/", $listdetil['TGL_SKEP']);
                                        $detil_pungutan_data = $this->getData("CN_PIBK_DETIL_PUNGUTAN")->get(array("by_detailid" , array($companyID , $listdetil['DETIL_ID'])));

                                        $barangData[] = array(

                                            "SERI_BRG"           => $listdetil['SERI_BRG'],
                                            "HS_CODE"            => $listdetil['HS_CODE'],
                                            "UR_BRG"             => $listdetil['UR_BRG'],
                                            "KD_NEG_ASAL"        => $listdetil['KD_NEG_ASAL'],
                                            "JML_KMS"            => $listdetil['JML_KMS'],
                                            "JNS_KMS"            => $listdetil['JNS_KMS'],
                                            "CIF"                => $listdetil['CIF'],
                                            "KD_SAT_HRG"         => $listdetil['KD_SAT_HRG'],
                                            "JML_SAT_HRG"        => $listdetil['JML_SAT_HRG'],
                                            "FL_BEBAS"           => $listdetil['FL_BEBAS'],
                                            "NO_SKEP"            => $listdetil['NO_SKEP'],
                                            "TGL_SKEP"           => $TGL_SKEP

                                        );

                                    } }


                                    foreach ($barangData as $barang) {
                                        $barangElement = $xmlDoc->createElement('BARANG');
                                        $detilElement->appendChild($barangElement);
                            
                                        foreach ($barang as $key => $value) {
                                            $childElement = $xmlDoc->createElement($key, $value);
                                            $barangElement->appendChild($childElement);
                                        }


                                        // DETIL PUNGUTAN

                                     if(!empty($detil_pungutan_data)){ foreach ($detil_pungutan_data as $keydetilpungutan => $detilpungutanlist) {

                                        $barangPungutanData[] = array(

                                            "KD_PUNGUTAN"   => $detilpungutanlist['KD_PUNGUTAN'],
                                            "NILAI"         => $detilpungutanlist['NILAI'],
                                            "KD_TARIF"      => $detilpungutanlist['KD_TARIF'],
                                            "KD_SAT_TARIF"  => $detilpungutanlist['KD_SAT_TARIF'],
                                            "JML_SAT"       => $detilpungutanlist['JML_SAT'],
                                            "TARIF"         => $detilpungutanlist['TARIF']


                                        );

                                     } }


                                     foreach ($barangPungutanData as $detilPungutan) {
                                        $detilPungutanElement = $xmlDoc->createElement('DETIL_PUNGUTAN');
                                        $barangElement->appendChild($detilPungutanElement);
                        
                                        foreach ($detilPungutan as $key => $value) {
                                            $childElement = $xmlDoc->createElement($key, $value);
                                            $detilPungutanElement->appendChild($childElement);
                                        }
                                    }
                        


                                    }




                                    // ------------------------------------------------------

                                } }

                                

                                $cnPibkElement->appendChild($headerElement);
                                $documentElement->appendChild($cnPibkElement);
                                $xmlDoc->appendChild($documentElement);

                                $directory = $this->site_setting("rootDirectory");
                                // Specify the folder path to save the XML file
                                $folderPath = "$directory/public/data/xmlfiles/$company[rootdir]";


                                // Check if the folder exists
                                if (!is_dir($folderPath)) {
                                    // Create the folder if it doesn't exist
                                    mkdir($folderPath, 0777, true);
                                }

                                // Save the XML document to a file in the specified folder

                                $filename_xml = "$type$master[REFID].xml";
                                $filename = "$folderPath/$filename_xml";
                                $xmlDoc->formatOutput = true; // Optional: Format the output with indentation and line breaks
                                $xmlDoc->save($filename);

                                
                                break;

                            case 'PlpKms' :

                                


                                break;
                            
                            default:
                                # code...
                                break;
                        }


                        $dbName      = "$directory/core/serverbase/userbase/$company[rootdir]/$company[rootdir].db";
                        $sqlite_conn = $this->sqlite(array("Conn" , $dbName , "" , ""));

                  
                        if($validation == "true")
                        {

                            $generateDate = $this->datesetting("datetime");

                            $array = array(
                                "REFID"      => $master['REFID'],
                                "TYPE"       => "1",
                                "MASTER_ID"  => $master['MASTER_ID'],
                                "XML_PATH"   => $filename_xml,
            
                            );

                            // check exits files 

                            $sendinglog = $this->getData("XML_FILES")->get(array("by_refid" , array($companyID, $master['REFID'])));

                            if(empty($sendinglog))
                            {

                                $execute     = $sqlite_conn->crud($dbName , "XML_FILES" , "insert" , $array , "");
                                if($execute[0] ==  "true")
                                {
                                $this->directLoc("user_site" , "send-data/master/$master[REFID]?res=true");
                                }
    

                            }else{
                                $this->directLoc("user_site" , "send-data/master/$master[REFID]?res=true");
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