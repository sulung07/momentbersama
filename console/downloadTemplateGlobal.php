<?php 

require_once '../core/engine/controller.php';
$controller = new controller();

$rootDir    = $controller->site_setting("rootDirectory");

require_once "$rootDir/core/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Membuat objek Spreadsheet
$spreadsheet = new Spreadsheet();

$no_master  = $_GET['no_master'];
$tgl_master = $_GET['tgl_master'];
$jml_row    = $_GET['jml_row'];
$rand       = rand();

$companyID = $controller->hashId("dec",$_GET['companyID']);



## change format date 
## $randomNumber = rand(1000, 9999);

$tgl_master_formater = str_replace("-", "/", $tgl_master);

## generate Ref Master 
$ref_master = $controller->generateReff($companyID , "basic");


// Sheet 1: Header
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('header');

## sheet 2: Header Pungutan

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('header_pungutan');

## sheet 3: Detil

$sheet3 = $spreadsheet->createSheet();
$sheet3->setTitle('detil');

## sheet 4: Detil Pungutan

$sheet4 = $spreadsheet->createSheet();
$sheet4->setTitle('detil_pungutan');

## Generate Column & Row

$sheet1->setCellValue('A1', 'REF_MASTER');
$sheet1->setCellValue('E1', 'NO_BARANG');


## sheet 2 Header Pungutan

$sheet2->setCellValue("A1", 'REF_HEADER');

## sheet 3 Detil
$sheet3->setCellValue("A1", 'REF_HEADER');
$sheet3->setCellValue("B1", 'REF_DETIL');

## sheet 4 Detil Pungutan
$sheet4->setCellValue("A1", 'REF_HEADER');
$sheet4->setCellValue("B1", 'REF_DETIL');
$sheet4->setCellValue("C1", 'NO');



for($x = 2; $x <= $jml_row + 1; $x++)
{
    $sheet1->setCellValue("A$x", "$ref_master");
}

$sheet1->setCellValue('B1', 'REF_HEADER');

$detailRow = 0;
$detailRow4 = 0;


for($x = 2; $x <= $jml_row + 1; $x++)
{
    ## generate Ref Header
    $ref_header = $controller->generateReff($companyID , "pro");

    ## generate no barang =        
    $NO_BRG  = $controller->generateReff($companyID , "item");


    $sheet1->setCellValue("B$x", "$ref_header");
    $sheet1->setCellValue("E$x", "$NO_BRG");


    ## sheet 2 header pungutan
    $sheet2->setCellValue("A$x", "$ref_header");

    ## shet 3 Detil
    for($y = 2; $y <= 5 + 1; $y++)
    {

        $ref_detil  = $controller->generateReff($companyID , "pro");


        $sheet3_row = $detailRow + $y;

        if($y === 2)
        {

            $sheet3->setCellValue("A$sheet3_row", "$ref_header");

        }else{

            $sheet3->setCellValue("A$sheet3_row", "-");

        }

        $sheet3->setCellValue("B$sheet3_row", "$ref_detil");


        $sheet4no = 0;

        for($z = 2; $z <= 5 + 1; $z++)
        {
            $sheet4no ++;

            $sheet4_row = $detailRow4 + $z;

            $sheet4->setCellValue("A$sheet4_row", "$ref_header");
            $sheet4->setCellValue("B$sheet4_row", "$ref_detil");


            if ($z === 2) {
                $sheet4->setCellValue("A$sheet4_row", "$ref_header");
                $sheet4->setCellValue("B$sheet4_row", "$ref_detil");
            } else {
                // Isi tanda "-" pada baris-baris selanjutnya
                $sheet4->setCellValue("A$sheet4_row", "-");
                $sheet4->setCellValue("B$sheet4_row", "-");
            }

            $sheet4->setCellValue("C$sheet4_row", "$sheet4no");

        }

        $detailRow4 += 5;



    }

  
    $detailRow += 5;
}

$sheet1->setCellValue('C1', 'JNS_AJU');
$sheet1->setCellValue('D1', 'KD_JNS_PIBK');
$sheet1->setCellValue('F1', 'KD_KANTOR');
$sheet1->setCellValue('G1', 'KD_JNS_ANGKUT');
$sheet1->setCellValue('H1', 'NM_PENGANGKUT');
$sheet1->setCellValue('I1', 'NO_FLIGHT');
$sheet1->setCellValue('J1', 'KD_PEL_MUAT');
$sheet1->setCellValue('K1', 'KD_PEL_BONGKAR');
$sheet1->setCellValue('L1', 'KD_GUDANG');
$sheet1->setCellValue('M1', 'NO_INVOICE');
$sheet1->setCellValue('N1', 'TGL_INVOICE');
$sheet1->setCellValue('O1', 'KD_NEGARA_ASAL');
$sheet1->setCellValue('P1', 'JML_BRG');
$sheet1->setCellValue('Q1', 'NO_BC11');
$sheet1->setCellValue('R1', 'TGL_BC11');
$sheet1->setCellValue('S1', 'NO_POS_BC11');
$sheet1->setCellValue('T1', 'NO_SUBPOS_BC11');
$sheet1->setCellValue('U1', 'NO_SUBSUBPOS_BC11');
$sheet1->setCellValue('V1', 'NO_MASTER_BLAWB');
for($x = 2; $x <= $jml_row + 1; $x++)
{
    $sheet1->setCellValue("V$x", "$no_master");
}

$sheet1->setCellValue('W1', 'TGL_MASTER_BLAWB');
for($x = 2; $x <= $jml_row + 1; $x++)
{
    $sheet1->setCellValue("W$x", "$tgl_master_formater");
}
$sheet1->setCellValue('X1', 'NO_HOUSE_BLAWB');
$sheet1->setCellValue('Y1', 'TGL_HOUSE_BLAWB');
$sheet1->setCellValue('Z1', 'KD_NEG_PENGIRIM');
$sheet1->setCellValue('AA1', 'NM_PENGIRIM');
$sheet1->setCellValue('AB1', 'AL_PENGIRIM');
$sheet1->setCellValue('AC1', 'JNS_ID_PENERIMA');
$sheet1->setCellValue('AD1', 'NO_ID_PENERIMA');
$sheet1->setCellValue('AE1', 'NM_PENERIMA');
$sheet1->setCellValue('AF1', 'AL_PENERIMA');
$sheet1->setCellValue('AG1', 'TELP_PENERIMA');
$sheet1->setCellValue('AH1', 'JNS_ID_PEMBERITAHU');
$sheet1->setCellValue('AI1', 'NO_ID_PEMBERITAHU');
$sheet1->setCellValue('AJ1', 'NM_PEMBERITAHU');
$sheet1->setCellValue('AK1', 'AL_PEMBERITAHU');
$sheet1->setCellValue('AL1', 'NO_IZIN_PEMBERITAHU');
$sheet1->setCellValue('AM1', 'TGL_IZIN_PEMBERITAHU');
$sheet1->setCellValue('AN1', 'KD_VAL');
$sheet1->setCellValue('AO1', 'NDPBM');
$sheet1->setCellValue('AP1', 'FOB');
$sheet1->setCellValue('AQ1', 'ASURANSI');
$sheet1->setCellValue('AR1', 'FREIGHT');
$sheet1->setCellValue('AS1', 'CIF');
$sheet1->setCellValue('AT1', 'NETTO');
$sheet1->setCellValue('AU1', 'BRUTO');
$sheet1->setCellValue('AV1', 'TOT_DIBAYAR');
$sheet1->setCellValue('AW1', 'NPWP_BILLING');
$sheet1->setCellValue('AX1', 'NAMA_BILLING');


## sheet 2

$sheet2->setCellValue("B1", "BM");
$sheet2->setCellValue("C1", "PPH");
$sheet2->setCellValue("D1", "PPN");
$sheet2->setCellValue("E1", "PPNBM");


## sheet 3

$sheet3->setCellValue("C1", 'SERI_BRG');
$sheet3->setCellValue("D1", 'HS_CODE');
$sheet3->setCellValue("E1", 'UR_BRG');
$sheet3->setCellValue("F1", 'KD_NEG_ASAL');
$sheet3->setCellValue("G1", 'JML_KMS');
$sheet3->setCellValue("H1", 'JNS_KMS');
$sheet3->setCellValue("I1", 'CIF');
$sheet3->setCellValue("J1", 'KD_SAT_HRG');
$sheet3->setCellValue("K1", 'JML_SAT_HRG');
$sheet3->setCellValue("L1", 'FL_BEBAS');
$sheet3->setCellValue("M1", 'NO_SKEP');
$sheet3->setCellValue("N1", 'TGL_SKEP');

## sheet 4

$sheet4->setCellValue("D1", 'KD_PUNGUTAN');
$sheet4->setCellValue("E1", 'NILAI');
$sheet4->setCellValue("F1", 'KD_TARIF');
$sheet4->setCellValue("G1", 'KD_SAT_TARIF');
$sheet4->setCellValue("H1", 'JML_SAT');
$sheet4->setCellValue("I1", 'TARIF');


// Function to set format teks pada seluruh kolom dalam satu sheet
function setFormatTeks($worksheet) {
    foreach (range('A', $worksheet->getHighestColumn()) as $column) {
        $worksheet->getStyle($column . '2:' . $column . $worksheet->getHighestRow())
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
    }
}

// Set format teks untuk setiap sheet
setFormatTeks($sheet1);
setFormatTeks($sheet2);
setFormatTeks($sheet3);
setFormatTeks($sheet4);



// Membuat objek Writer
$writer = new Xlsx($spreadsheet);

// Mengaktifkan output buffering
ob_start();

// Menyimpan Spreadsheet ke dalam output buffer

// Mengambil konten dari output buffer
$fileContent = ob_get_clean();

// Menentukan header untuk respons unduhan
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $no_master . '-' . $rand . '.xlsx"');
header('Cache-Control: max-age=0');

// Mengirimkan konten file sebagai respons unduhan
$writer->save('php://output');
exit;

?>