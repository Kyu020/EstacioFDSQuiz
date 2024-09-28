<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type,");
header("Access-Control-Max-Age: 86400");
date_default_timezone_set("Asia/Manila");
set_time_limit(1000);

$rootPath = $_SERVER["DOCUMENT_ROOT"];
$apiPath = $rootPath ."/FDSQuiz";

require_once($apiPath .'/configs/dbconn.php');

require_once($apiPath .'/models/try.model.php');
require_once($apiPath .'/models/Global.model.php');

$db = new Connection();
$pdo = $db->connect();

$global = new GlobalMethods();
$try = new Example($pdo, $global);

$req = [];
if (isset($_REQUEST['request']))
    $req = explode ('/', rtrim($_REQUEST['request'], '/'));
else $req = array("errorcatcher");

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if ($req[0] == 'getAllItem') {echo json_encode($try->getAll());return;}
        //if ($req[0] == 'get' && req[1]) {echo json_encode($try->getSingle());return;}
        break;
    case 'POST':
        $data_input = json_decode(file_get_contents("php://input"));
        if($req[0]=='insert'){echo json_encode($try->insert($data_input)); return;}
    case 'DELETE':
        $data_input = json_decode(file_get_contents("php://input"));
        $id = intval($data_input['id']);
        if ($req[0] =='delete'){echo json_encode($try->delete($id));return;}

        
    default:
        echo "Whatdak";
        http_response_code(403);
        break;
}

