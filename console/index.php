<?php
session_start();
ob_start();
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require_once '../core/init.php';
require_once '../core/engine/controller.php';
require_once '../core/controllers/templateControllerPanel.php';

$controller  = new controller();
if(isset($_SESSION['userID']))
{
  $userID = $_SESSION['userID'];

}else{
  $userID = "";
}

if($userID == ""){

  $direct = true;

  if(isset($_GET['url']))
  {

    $getUrl = $_GET['url'];
    $collect_url = explode("/", $getUrl);
    switch ($collect_url[0]) {
      case 'login':
        $direct = false;
        break;
      default:
        $direct = true;
        break;
    }
  }

  if($direct == true)
  {
  header("location:/login");
  }

}else{

  if(isset($_GET['url']))
  {

    $getUrl = $_GET['url'];
    $collect_url = explode("/", $getUrl);
    switch ($collect_url[0]) {
      case 'login':
        $access = false;
        break;
      default:
        $access = true;
        break;
    }
  }

  if($access == false){

    header("location:/home");


  }

}
$url  = $controller->site_setting('console-site');
$route = new route_userconsole();

?>
