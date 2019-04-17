<?php
require('../server/models/client.php');

session_start();

if (isset($_SESSION['user'])) {
    $data["name"] = "'".$_POST["name"]."'";
    $data["cod"] = "'".$_POST["cod"]."'";
    $data["city_id"] = $_POST["city_id"];
    $data["id"] = $_POST["id"];

    if($data["name"]!="''" && $data["cod"]!="''" && $data["city_id"]!="" && $data["id"]!=""){
        
        $client = new Client();
        if($res = $client->update($data)){
            //$response["msg"] = $res;
            $response["msg"] = "OK";
        }else{
            $response["msg"] = "Error saving the new user";
        } 
        
    }
    
}else {
    $response['msg']= 'session';
}

echo json_encode($response);
?>