<?php
session_start();
ob_start();
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require_once '../core/init.php';
require_once '../core/engine/controller.php';
require_once '../core/controllers/templateController.php';

$controller  = new controller();
$route = new route();

?>