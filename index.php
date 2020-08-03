<?php



require(__DIR__ . '/vendor/autoload.php');
include('./config/constants.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db = new \Core\DB();
$request = new \Core\Request();
$router = new \Core\Router($request);
