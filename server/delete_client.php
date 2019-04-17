<?php
require('../server/models/client.php');

session_start();

if (isset($_SESSION['user'])) {
    $id = $_POST["id"];

    if($id!=""){
        $client = new Client();
        if($res = $client->delete($id)){
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