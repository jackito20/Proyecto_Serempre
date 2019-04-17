<?php
require('../server/models/user.php');

session_start();

if (isset($_SESSION['user'])) {

    $data["pass"] = $_POST["newPassword"];
    $data["id"] = $_SESSION['user'];
    
    $passwordConfirm = $_POST["confirmPassword"];
    $actualPassword = $_POST["actualPassword"];

    if($actualPassword!="" && $data["pass"]!="" && $passwordConfirm!=""){
        if($data["pass"]==$passwordConfirm){
            $user = new User();
            if($res = $user->update($data)){
                $response["msg"] = "OK";
                //$response["msg"] = $res;
            }else{
                $response["msg"] = "Error saving the new user";
            }
            
        }
    }
}else {
    $response['msg']= 'session';
}

echo json_encode($response);


 ?>