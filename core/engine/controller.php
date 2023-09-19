<?php
  class controller{

    public $repository  = "public";
    public $device      = "mac";

    function site_setting($task)

    {
        $data = "";

        $repo   = $this->repository;
        $device = $this->device;

        if($repo == "public")
        {

            $rootDir = "/home/u7780352/public_html/momenbersama.com/wedding/momenbersama";

        }elseif($repo == "local")
        {

            switch ($device) {
                case 'mac':
                    $rootDir = "/usr/local/var/www/momentbersama";
                break;

                case 'linux':
                    $rootDir = "/var/www/html/momentbersama";
                break;

                case 'windows' :
                    $rootDir = "/";
                    break;
                    
            }

        }

        require_once "$rootDir/core/config/config.php";
        $database = new config();

        switch ($task) {

            case 'user-control-name' :
                $data = "CONSOLE s";
                break;

            case 'public_name' :
                $data = "The Wedding OF";
                break;

            case 'media_loc' :
                if($repo == "public"):
                $data = "/home/u7780352/public_html/momenbersama.com/wedding/momenbersama/public/assets";
                endif;
                if($repo == "local"):

                    switch ($device) {
                        case 'mac':
                            $data = "/usr/local/var/www/momentbersama/public/assets";
                            break;

                        case 'linux':
                            $data = "/var/www/html/momentbersama/public/assets";
                            break;
                        
                    }

                
                endif;
                break;

            case 'pubic-site' :

                if($repo == "public"):
                    $data = "https:/our.momenbersama.com";
                endif;
                if($repo == "local"):
                    $data = "http://dev-momenbersama.com";
                endif;
                    
                break;

            case 'console-site' :

                if($repo == "public"):
                $data = "https:/master.momenbersama.com";
                endif;
                if($repo == "local"):
                $data = "http://consoledev-momenbersama.com";
                endif;
                break;

         


            case 'rootDirectory' :
                if($repo == "public"):
                $data = "/home/u7780352/public_html/momenbersama.com/wedding/momenbersama";
                endif;
                if($repo == "local"):

                    switch ($device) {
                        case 'mac':
                            $data = "/usr/local/var/www/momentbersama";
                            break;

                        case 'linux':
                            $data = "/var/www/html/momentbersama";
                            break;
                        
                    }
                
                endif;



                break;
        }
        
        return $data;
    }

    function generateReff($companyID , $task)
    {
    
        // get data company 
        $company = $this->getData("company")->get(array("by_id" , array($companyID)));

        // tps_settig 

        $general = $this->getData("api_setting")->get(array("by_company_single" , array("$companyID")));

        $month_now = $this->datesetting("m");
        $year_now  = $this->datesetting("y");
        $day_now   = $this->datesetting("d");
        $his       = $this->datesetting("time_number");
        $prefix    = $general['ref_prefix'];

        // get last data from table 

        if($task == "basic")
        {

            $print_reff = "$prefix$year_now$month_now$day_now$his";


        }elseif($task == "pro")
        {   

            $randomNumber = rand(1000, 9999);
            $print_reff = "$prefix$year_now$month_now$day_now$his$randomNumber";

        }elseif($task == "item")
        {

            $max = 13;

            $characterCount  = strlen($prefix);

            $remainingDigits = $max - $characterCount;

            $randomDigits = mt_rand(0, pow(10, $remainingDigits) - 1);
            $randomDigits = str_pad($randomDigits, $remainingDigits, '0', STR_PAD_LEFT);

            // Concatenate the prefix and the random digits
            $print_reff = $prefix . $randomDigits;


        }

        return $print_reff;

    }

    function directLoc($root , $loc)
    {
        $rootLoc = $this->site_setting("$root");
        header("location:$rootLoc/$loc");

    }

    function headerLoc($loc)
    {
        header("location:$loc");
    }

    function formatCL($data)
    {

        if (strpos($data, "'") !== false) {
            // Jika nilai tanggal mengandung tanda petik, hapus tanda petik tersebut
            $data = str_replace("'", "", $data);
        }

        return $data;

    }

    function PaypallApi()
    {

        $ClientID = "-";
        $Secreat  = "-pO-H";

        $appClientID = "--";
        $appSecreat  = "";

    }

    public function api($task , $data = [] )
    {


        switch ($task) {
            case 'generateKey':

               $url = "";

                $data = array(
                    "userID" => ""
                );

                $format_data = json_encode($data);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);
                curl_close($ch);
                return $response;

                break;

            case 'getData' :


                $getkey = $this->api("generateKey");
                $key    = json_decode($getkey,TRUE);

                $url = '';

                $headers = array(
                    'Content-Type: application/json',
                    'X-Authorization-Token: '.$key['key']
                );

                $format_data = json_encode($data);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $response = curl_exec($ch);
                //json_encode($data)

                curl_close($ch);
                return $response;

                break;

            case 'reqPostFile' :

                $getkey = $this->api("generateKey");
                $key    = json_decode($getkey,TRUE);

                $url = '';

                $headers = array(
                    'Content-Type: application/json',
                    'X-Authorization-Token: '.$key['key']
                );

                // $data['access_key'] = "$key";

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $response = curl_exec($ch);

                curl_close($ch);
                return $response;



                break;

            case 'reqPostItem' :

                $getkey = $this->api("generateKey");
                $key    = json_decode($getkey,TRUE);

                $url = '';

                $headers = array(
                    'Content-Type: application/json',
                    'X-Authorization-Token: '.$key['key']
                );

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $response = curl_exec($ch);

                curl_close($ch);
                return $response;

                break;

            case 'generateUserApi' :

                $userApi    = strtoupper(substr($data[0], 0, 5));
                $angka_rand = rand(1000, 9999);

                $generateUserApi = "$userApi-$angka_rand";
                $generateUserKey = $this->key($generateUserApi);

                $prepare_res = array(

                    "userApi"   => $generateUserApi,
                    "userKey"   => $generateUserKey

                );

                $result = json_encode($prepare_res);
                return json_decode($result,TRUE);

                break;

            case 'allowedDomain' :


                return array('');


                break;

            default:
                # code...
                break;
        }

    }

    public function masterData($task , $id)
    {   

        switch ($task) {
            case 'jenis_aju':

                if($id == "all")
                {
                    $list = $this->getData("master_jenis_aju")->get(array("get_all"));
                }else{

                    $list = $this->getData("master_jenis_aju")->get(array("by_id" , array($id)));
                }

                break;

            case 'jenis_pibk' :

                if($id == "all")
                {
                    $list = $this->getData("master_jenis_pibk")->get(array("get_all"));
                }else{
                    $list = $this->getData("master_jenis_pibk")->get(array("by_id" , array($id)));
                }

                break;

            case 'jenis_pungutan' :

                if($id == "all")
                {
                    $list = $this->getData("master_jenis_pungutan")->get(array("get_all"));
                }else{
                    $list = $this->getData("master_jenis_pungutan")->get(array("by_id" , array($id)));
                }

                break;

            case 'jenis_tarif' :

                if($id == "all")
                {
                    $list = $this->getData("master_jenis_tarif")->get(array("get_all"));
                }else{
                    $list = $this->getData("master_jenis_tarif")->get(array("by_id" , array($id)));
                }

                break;

            default:
                return;
                break;
        }

        return $list;

    }


    function content_lang($data = [])
    {

        switch ($data[0]) {

            case 'home' :

                switch ($data[1]) {
                    case 'id':
                        $text = "Beranda";
                        break;
                    case 'en' :
                        $text = "Home";
                        break;
                }

                break;

          
            
            default:
                $text = "";
                break;
        }

        return $text;

    }

    function templateroot($data = [])
    {

        $modelsTemplate = $this->getData("template");
        $activeTemplate = $modelsTemplate->get(array("get_active"));
        $classTemplate  = $activeTemplate['template_class'];
        $url            = $this->site_setting('public_site');

        require_once ''.$this->site_setting('rootDirectory').'/web/template/'.$activeTemplate['locdir'].'/template.php';

        $template       = new $classTemplate();


        switch ($data[0]) {
            case 'head':
                return $template->head(array("$url" , $activeTemplate['locdir'] , $data[1]));
                break;

            case 'footer' :
                return $template->footer(array("$url" , $activeTemplate['locdir']));
                break;

            case 'navs' :
                return $template->navs(array($data[1]));
                break;
            
            default:
                return;
                break;
        }



    }


    function setpgCookie()
    {

        $randID = rand();
        $pgKey  = $this->key($randID);
        setcookie ("PgKey",$pgKey,time()+86400);
        return $pgKey;

    }

    function levelManage($data =[])
    {

        switch ($data[0]) {
            case 'services_category':
                
                    switch ($data[1]) {
                        case '0':
                            $return = "Main Level";
                            break;

                        case '1' :
                            $return = "Subs Category";
                            break;
                        
                        default:
                            $return = "-";
                            break;
                    }

                break;
            
            default:
                $return = "-";
                break;
        }


        return $return;

    }

    function iconStatus($data = [])
    {

        switch ($data[0]) {
            case 'global':
                
                if($data[1] == "1")
                {

                    $icon = "<i class='fas fa-check-circle text-success font-weight-bold'></i>";

                } 

                if($data[1] == "2")
                {

                    $icon = "<i class='fas fa-exclamation-circle text-danger font-weight-bold '></i>";

                }

                if($data[1] == "0")
                {

                    $icon = "<i class='fas fa-exclamation-circle text-warning font-weight-bold '></i>";

                }

                break;

            case 'content' :

                if($data[1] == 0)
                {
                    $icon = "<i class='fas fa-folder-minus  text-warning font-weight-bold mr-1 '></i> Draft";
                }

                if($data[1] == 1)
                {

                    $icon = "<i class='fas fa-check-circle text-success font-weight-bold mr-1'></i> Published";

                }

                break;

            case 'product' :

                if($data[1] == 0)
                {
                    $icon = "<i class='fas fa-exclamation-circle text-danger font-weight-bold mr-1 '></i> Draft";
                }

                if($data[1] == 1)
                {

                    $icon = "<i class='fas fa-check-circle text-success font-weight-bold mr-1'></i> Online";

                }

                break;
            
            default:
                $icon = "";
                break;
        }

        return $icon;

    }

    function UploadImage($uploadName , $locfile , $loc_name = "")
    {

        $uploaded_file = $_FILES["$loc_name"]['tmp_name']; 
        $upl_img_properties = getimagesize($uploaded_file);

        $mediaDir    = $this->site_setting("media_loc");
        $folder_path = "$mediaDir/$locfile/";
     
        $temp = explode(".", $_FILES["$loc_name"]["name"]);
        $newfilename = round(microtime(true)) .''; 
        
        $img_ext    = pathinfo($_FILES["$loc_name"]['name'], PATHINFO_EXTENSION);
        $image_type = $upl_img_properties[2];

        switch ($image_type) {
			//for PNG Image
            case IMAGETYPE_PNG:
                $image_type_id = imagecreatefrompng($uploaded_file); 
                $target_layer = $this->image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path. $newfilename. ".". $img_ext);
                break;
            //for GIF Image
            case IMAGETYPE_GIF:
                $image_type_id = imagecreatefromgif($uploaded_file); 
                $target_layer = $this->image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagegif($target_layer, $folder_path. $newfilename.".". $img_ext);
                break;
            //for JPEG Image
            case IMAGETYPE_JPEG:
                $image_type_id = imagecreatefromjpeg($uploaded_file); 
                $target_layer = $this->image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagejpeg($target_layer, $folder_path. $newfilename.".". $img_ext);
                break;

            case IMAGETYPE_WEBP:
                    $image_type_id = imagecreatefromwebp($uploaded_file); 
                    $target_layer = $this->image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                    imagewebp($target_layer, $folder_path . $newfilename . ".webp");
                    break;
            
            default:
                echo "Please select a 'PNG', 'GIF', 'JPEG', or 'WEBP' image";
                exit;
            break;

        }

        move_uploaded_file($uploaded_file, $folder_path. "real_".$newfilename.".". $img_ext);


    }


    function image_resize($image_type_id, $img_width, $img_height) {

        $target_width  = $img_width;
        $target_height = $img_height;
        $target_layer= imagecreatetruecolor($target_width, $target_height);
        imagecopyresampled($target_layer, $image_type_id,0,0,0,0, $target_width, $target_height, $img_width, $img_height);
        return $target_layer;
    }

    function UploadFile($uploadName , $locfile)
    {

        $msg = "false";

        $mediaDir   = $this->site_setting("media_loc");
        $direktori  = "$mediaDir/images/$locfile";
     
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp); 

        $ekstensi = $temp[1];
        $file               = $direktori.$uploadName;
        $file2              = $direktori.$newfilename;
        $realImagesName     = $_FILES['file']['tmp_name'];

        if(move_uploaded_file($_FILES["file"]["tmp_name"], $direktori."/" . $newfilename))
        {
            $msg = "true";
        }


        return $msg;

    }


    function alert($data = [])
    {

       switch ($data[0]) {
           case 'success':
               $msg = "<div class='alert alert-success' role='alert'>
               <i class='mdi mdi-check-all mr-2'></i><strong>$data[1]</strong> 
                </div>";
               break;

            case 'warning' :
                $msg = "
                <div class='alert alert-warning' role='alert'>
                <i class='mdi mdi-alert-outline mr-2'></i><strong>$data[1]</strong> 
                </div>
                ";
                break;

            case 'danger' :
                $msg = "
                <div class='alert alert-danger' role='alert'>
                <i class='mdi mdi-block-helper mr-2'></i> <strong>$data[1]</strong> 
                </div>
                ";
                break;
           
           default:
               return;
               break;
       } 


       return $msg;

    }

    function transNumber($code)
    {

        $dateTime = $this->datesetting('date_number');
        $randID   = $this->getRandNumber('3' , '9000');
        $getID    = "$code$dateTime$randID";
        return $getID;
        

    }


    function makeSeo($text, $limit=75)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

      // trim
      $text = trim($text, '-');

      // lowercase
      $text = strtolower($text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      if(strlen($text) > 70) {
        $text = substr($text, 0, 70);
      } 

      if (empty($text))
      {
        //return 'n-a';
        return time();
      }

      return $text;
    }


    function generateSeoURL($string){
        $separator = '-';
        // $wordLimit = 0;
        
            $wordArr = explode(' ', $string);
            $string = implode(' ', array_slice($wordArr));
            //$string = implode(' ', array_slice($wordArr, 0, $wordLimit));
        $quoteSeparator = preg_quote($separator, '#');
    
        $trans = array(
            '&.+?;'                  => '',
            '[^\w\d _-]'             => '',
            '\s+'                    => $separator,
            '('.$quoteSeparator.')+' => $separator
        );
    
        $string = strip_tags($string);
        foreach ($trans as $key => $val){
            $string = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $string);
        }
    
        $string = strtolower($string);
    
        return trim(trim($string, $separator));
    }

    
    function randomPrefix($length)
    {
    $random= "";
    srand((double)microtime()*1000000);
    
    $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
    $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
    $data .= "0FGH45OP89";
    
    for($i = 0; $i < $length; $i++)
    {
    $random .= substr($data, (rand()%(strlen($data))), 1);
    }
    
    return $random;
    }


    function getRandNumber($line , $limit){

        $x = $line; 
        $min = pow(10,$x);
        $max = pow(10,$x+1)-1;
        $value = rand($min, $max);

        if($value < $limit )
        {
            return $value;
            
        }else{

            $this->getRandNumber($line , $limit);

        }

    }

    function dateperiod($date , $period , $datePeriod)
    {
        $generatePeriod = date('Y-m-d', strtotime("+$period $datePeriod", strtotime($date)));
        return $generatePeriod;
    }

    function dateIndoHari($tanggal)
    {
        // Daftar nama hari dalam bahasa Indonesia
        $daftarHari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        );
    
        // Daftar nama bulan dalam bahasa Indonesia
        $daftarBulan = array(
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        );
    
        // Pecah tanggal menjadi tahun, bulan, dan hari
        $pecahTanggal = explode('-', $tanggal);
        $tahun = $pecahTanggal[0];
        $bulan = $pecahTanggal[1];
        $hari = $pecahTanggal[2];
    
        // Dapatkan nama hari dalam bahasa Indonesia
        $timestamp = mktime(0, 0, 0, $bulan, $hari, $tahun);
        $namaHari = $daftarHari[date('l', $timestamp)];
    
        // Ubah format tanggal menjadi "NamaHari, DD MMMM YYYY"
        $tanggalIndonesia = sprintf("%s, %02d %s %04d", $namaHari, $hari, $daftarBulan[date('F', $timestamp)], $tahun);
    
        return $tanggalIndonesia;


    }

    function dateIndo($tanggal)
    {
        // Daftar nama bulan dalam bahasa Indonesia
        $daftarBulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );

        // Pecah tanggal menjadi tahun, bulan, dan hari
        $pecahTanggal = explode('-', $tanggal);
        $tahun = $pecahTanggal[0];
        $bulan = (int)$pecahTanggal[1];
        $hari = $pecahTanggal[2];

        // Ubah format tanggal menjadi "DD MMMM YYYY"
        $tanggalIndonesia = sprintf("%02d %s %04d", $hari, $daftarBulan[$bulan], $tahun);

        return $tanggalIndonesia;
    }
    
    function datesetting($show , $data = []){

            date_default_timezone_set("Asia/Makassar");

                switch ($show) {
                    case 'd':
                        $data = date("d");
                        break;
        
                    case 'm' :
                        $data = date("m");
                        break;
        
                    case 'y' :
                        $data = date("y");
                        break;

                    case 'Y' :
                        $data = date("Y");
                        break;
        
                    case 'hour' :
                        $data = date("H");
                        break;
        
                    case 'date' :
                        $data = date("Y-m-d");
                        break;
        
                    case 'time' :
                        $data = date("H:i:s");
                        break;
        
                    case 'datetime' :
                        $data = date("Y-m-d H:i:s");
                        break;

                    case 'time_number' :
                        $data = date("His");
                        break;

                    case 'date_number' :
                        $data = date("YmdHis");
                        break;
        
    
                    case 'days' :
        
                        $time = date("D");
        
                        $data = $day_list[$time];
        
        
                        break;
        
                }
                return $data;
        
    }


    public function filegetcontent($data = []){

        $location = $data[0];
        $file     = $data[1];
        $getFile = file_get_contents("$location/$file");
        $dataFile = json_decode($getFile,true);
        return $dataFile;
    }


    

    function act_key($data){

        $date         = $this->datesetting("date");
        $get_key      = "$data-$date";
        $generate_key = $this->key($get_key);

        return $generate_key;

    }

    function hashId($action , $data)
    {

        //$generateID = str_replace($string, $key, $data);

        switch ($action) {
            case 'enc':


                $string = array("0","1","2","3","4","5","6","7","8","9");
                $key    = array("m","h","a","w","z","x","p","r","k","f");
        
                $generateID = str_replace($string, $key, $data);
                $hash       = $this->baseDecode("encode" , $generateID);

                break;

            case 'dec' :

                $dec = $this->baseDecode("decode" , $data);
                $string = array("m","h","a","w","z","x","p","r","k","f");
                $key    = array("0","1","2","3","4","5","6","7","8","9");

                $hash   = str_replace($string, $key, $dec);


                break;
            
            default:
                $hash = "not found";
                break;
        }

        
        return $hash;

    }

    function baseDecode($action , $data)
    {
        if($action == "encode"){
            return base64_encode($data);
        }

        elseif($action == "decode"){
            return base64_decode($data);
        }
    }

    function newKey($data)
    {

      $hash     = hash('sha256', $data);
      return $hash;

    }

    function key($data)
    
    {

        $string = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9","@","#","*","!","$","&");
        $key    = array("~","/","/|","]/","[/","%","^","|/","+|","(",")","_","-","+","=","|","}","{","[","]",";",":","?",">",".","<","az","aq","sx","sw","dc","de","fv","fr","gb","gt","hn","hy","jm","ju","ki","ko","kp","li","lo","lp","zq","zs","za","xw","xd","xs","bt","bh","bg","ny","nj","nh","mu","mk","mj","ki","ce","cf","cd","vr","vg","vf");
        $pasword = md5(str_replace($string, $key, $data));
        $key_a=substr($pasword,0,1);
        $v1=substr($pasword,1,15);
        $v2x=substr($pasword,16,30);
        $v2=substr($v2x,0,15);
        $key_b=substr($pasword,31,31);
        $xcode_a = md5($key_a);
        $xcode_b = md5($key_b);
        $passwordgenerate=$v2.$xcode_a.$xcode_b.$v1;
        $get_password= md5($passwordgenerate);

        return $get_password;


    }


   
    function sqlite($data = [])
    {

        if(file_exists('../core/config/config_sqlite.php'))
        {
            require_once '../core/config/config_sqlite.php';

        }else if(file_exists('../../core/config/config_sqlite.php')){

            require_once '../../core/config/config_sqlite.php';
        }

        $task       = $data[0];
        $db         = $data[1];
        $cmd        = $data[2];
        $service    = $data[3];

        $connection = new config_sqlite($db);

        switch ($task) {

            case 'Conn' :
                return $connection;
                break;

            case 'access' :
                $execute = $connection->accessDB($cmd , $db, $service);
                return $execute;
                break;

            case 'CreateDB':
                $execute = $connection->ManageDB($arr = array($cmd , $db , $service));
                return $execute;
                break;

            default:
                return;
                break;
        }

    }


    
    public function getDataSqlite($class , $location , $base){

        $database = $this->sqlite(array("Conn" , $base , "" , ""));

        if(file_exists(''.$this->site_setting('rootDirectory').'/core/models/'.$location.'/models.php'))
        {
            require_once ''.$this->site_setting('rootDirectory').'/core/models/'.$location.'/models.php';
        }

        return new $class($database);

    }


    public function getData($location){

        $database = new config();
        $class    = "Models_$location";

        if(file_exists(''.$this->site_setting('rootDirectory').'/core/models/'.$location.'/models.php'))
        {
            require_once ''.$this->site_setting('rootDirectory').'/core/models/'.$location.'/models.php';
        }

        return new $class($database);

    }

    function getAction($class , $location , $config = "" , $db = "")

    {
        if($config == ""):
            $database  = new config();
            $type      = "single";
        endif;

        if($config == "pos"):
            $database  = new config_pos();
            $type      = "single";
        endif;

        if($config == "sqlite_pos"):
            $database  = new config_pos_sqlite($db);
            $type      = "single";
            
        endif;

        if($config == "mysql_sqlite_pos"):

            $database  = new config_pos();
            $sqlite_db = new config_pos_sqlite($db);
            $type      = "multi";

        endif;
       
        if(file_exists(''.$this->site_setting('rootDirectory').'/core/config/actionControl/'.$location.'/action.php'))
        {
        require_once ''.$this->site_setting('rootDirectory').'/core/config/actionControl/'.$location.'/action.php';
        }

        if($type == "multi"):

            return new $class($database , $sqlite_db);

        endif;

        if($type == "single"):
        
            return new $class($database);

        endif;

    }


    public function view($file, $pages , $lang = "" , $view = [] , $value = [] )
    {

        if( file_exists(''.$this->site_setting('rootDirectory').'/core/views/'.$file.'.php'))
        {require_once ''.$this->site_setting('rootDirectory').'/core/views/'.$file.'.php';}

    }


    public function formatNumber($data , $s)
    {return number_format($data,$s,',','.');}

    public function formatNumberString($data)
    {return number_format($data,0,',','');}


    public function controllerForm($class , $location)
    {

        if(file_exists(''.$this->site_setting('rootDirectory').'/core/form/'.$location.'/form.php'))
        {require_once ''.$this->site_setting('rootDirectory').'/core/form/'.$location.'/form.php';}
        return new $class();

    }


    public function viewForm($class , $location , $base)
    
    {

        if( file_exists(''.$this->site_setting('rootDirectory').'/core/form/'.$base.'/'.$location.'/form.php') )
        {require_once ''.$this->site_setting('rootDirectory').'/core/form/'.$base.'/'.$location.'/form.php';}
        return new $class();

    }


    public function form_scan($data = [])
    {

        switch ($data[0]) {
            case 'pro':
                $scanning = trim($data['1']);
                $return   = strip_tags($scanning);
                break;

            case 'basic':
                $return = htmlspecialchars($data['1']);
                break;

            case 'whitespace' :
                $return = str_replace(' ', '', $data['1']);
                break;
            
            default:
                $return = "false";
                break;
        }

        return $return;


    }


    public function form_validation($data = [])
    {

        $count = 0;
        $count_data = count($data);

        $true = "true";
        $false = "false";

        for($x = 0; $x < $count_data; $x++)
        {if($data[$x] != ""){ $count = $count + 1;}}

        if($count == $count_data)
        {return $true;}

        else{return $false;}
        $count  = 0;

    }
    // get load data

    public function loadcontrol($class , $file , $data = []){

        require_once ''.$this->site_setting('rootDirectory').'core/views/load/'.$file.'.php' ;
        return new $class();

    }

    public function loadactioncontrol($class , $file , $data = []){


        if( file_exists(''.$this->site_setting('rootDirectory').'/core/views/load/'.$file.'.php'))
        {require_once ''.$this->site_setting('rootDirectory').'/core/views/load/'.$file.'.php';}

        return new $class();

    }


    public function modalAlert($data = [])
    {

        $task    = $data[0];
        $modalID = $data[1];
        $onclick = $data[2];

        switch ($task) {
            case 'danger':
                
                // 

                $modal = '
                <div id="'.$modalID.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content modal-filled bg-danger">
                            <div class="modal-body p-4">
                                <div class="text-center">
                                    <i class="dripicons-wrong h1 text-white"></i>
                                    <h4 class="mt-2 text-white">Warning !</h4>
                                    <p class="mt-3 text-white">Are you sure remove this item ?</p>
                                    <button type="button" class="btn btn-light my-2" onclick="'.$onclick.'" data-dismiss="modal">Continue</button>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
        

                // 

                break;


            case 'success' :

                $modal = '
                
                <div id="'.$modalID.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content modal-filled bg-success">
                            <div class="modal-body p-4">
                                <div class="text-center">
                                    <i class="dripicons-checkmark h1 text-white"></i>
                                    <h4 class="mt-2 text-white">Warning !</h4>
                                    <p class="mt-3 text-white">Are you sure to save this item ?</p>
                                    <button type="button" class="btn btn-light my-2" onclick="'.$onclick.'" data-dismiss="modal">Continue</button>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


                ';

                break;
            
            default:
                # code...
                break;
        }


        return $modal;



    }

}


class loadactions extends controller 
{
    public function crudControl($task , $id , $loadbase){$this->loadactioncontrol('loadaction' , 'loadbaseaction')->$loadbase($task , $id);}
    public function singoutControl(){$load = $this->loadactioncontrol('loadAction', 'loadbaseaction')->singoutUser();}
}

 ?>
