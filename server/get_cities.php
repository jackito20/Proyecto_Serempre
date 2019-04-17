<?php
require('../server/models/city.php');

    $cities = new City();
    $cities = $cities->findAll();
    if($cities){
        $response["msg"] = "OK";
        $response["cities"] = $cities;
    }else{
        $response["msg"] = "Error en cities";
    }
    //$response["msg"] = "OK";
        
echo json_encode($response);


 ?>