<?php
require('../server/models/user.php');

$data["name"] = $_POST["name"];
$data["pass"] = $_POST["password"];
$passwordConfirm = $_POST["passwordConfirm"];

if($data["name"]!="" && $data["pass"]!="" && $passwordConfirm!=""){
    if($data["pass"]==$passwordConfirm){
        $user = new User();
        if($user->save($data)){
            $response["msg"] = "OK";
        }else{
            $response["msg"] = "Error saving the new user";
        }
    }
}

echo json_encode($response);


 ?>
