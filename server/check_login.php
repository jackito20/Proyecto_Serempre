<?php
require('../server/models/user.php');

$data["name"] = $_POST["name"];
$data["pass"] = $_POST["password"];

if($data["name"]!="" && $data["pass"]!=""){
    $user = new User();
    if($user->findByName($data["name"])){
        if(password_verify($data["pass"], $user->getPassword())){
            $response["msg"] = "OK";
            session_start();
            $_SESSION["user"] = $user->getId();
        }else{
            $response["msg"] = "User name or password error";
        }
    }else{
        $response["msg"] = "User name or password error";
    }
}

echo json_encode($response);


 ?>
