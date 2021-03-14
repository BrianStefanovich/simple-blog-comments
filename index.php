<?php
require("model.php");

    header('Content-type: application/json');
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST");         
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $res = model::getComments($_GET["postName"]);
        $obj = array('response' => $res);
        echo json_encode($res);
        exit();
        break;
        
    case "POST":
        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);
        $res = model::setComment($_POST["postName"], $_POST["authName"], $_POST["authEmail"], $_POST["commentBody"]);
        echo json_encode($res);
        exit();
        break;
