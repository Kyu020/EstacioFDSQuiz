<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, ");
header("Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type,");
header("Access-Control-Max-Age: 86400");
date_default_timezone_set("Asia/Manila");
set_time_limit(1000);

$rootpath = $_SERVER["DOCUMENT_ROOT"];
$apipath = $rootpath ."/FDSQuiz";

require_once($apipath .'/configs/dbconn.php');

require_once($apipath .'/models/try.model.php');
require_once($apipath .'/models/Global.model.php');

$db = new Conn();
$pdo = $db ->connect();

$global = new GlobalMethods();
$try = new Example($pdo, $global);

$req = [];
if (isset($_REQUEST['request']))
    $req = explode ('/', rtrim($_REQUEST['request'], '/'));
else $req = array("errorcatcher");

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if ($req[0] == 'getAllItem') {echo json_encode($try->getAll());return;}
        break;
    case 'POST':
        $data_input = json_decode(file_get_contents("php://input"));
        if($req[0]=='insert'){echo json_encode($try->insert($data_input)); return;}

}

