<?php
require('../server/models/client.php');

session_start();

if (isset($_SESSION['user'])) {
    $data["name"] = $_POST["name"];
    $data["cod"] = $_POST["cod"];
    $data["city_id"] = $_POST["city_id"];

    if($data["name"]!="" && $data["cod"]!="" && $data["city_id"]!=""){
        
        $client = new Client();
        if($client->save($data)){
            $response["msg"] = "OK";
        }else{
            $response["msg"] = "Error saving the new user";
        }
        
    }
    echo json_encode($response);
}else {
    $response['msg']= 'session';
}

 ?>
