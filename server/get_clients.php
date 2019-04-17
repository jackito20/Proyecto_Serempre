<?php
require('../server/models/client.php');
include_once('../config.php');

session_start();

if (isset($_SESSION['user'])) {

    $clients = new Client();
    $cant = $clients->getCount();
    if($cant){
        $response["msg"] = "OK";
        $response["cant"] = $cant;

        if (isset($_GET["page"])) {
            $page = $_GET["page"];            
        }else{
            $start = 0;
            $page = 1;
        }
        $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
        $response["start"] = $start;
        $total_pages = ceil($response["cant"] / NUM_ITEMS_BY_PAGE);
        $response["total_pages"] = $total_pages;

        $clients = $clients->findFromTo($start, NUM_ITEMS_BY_PAGE);
        $response["clients"] = $clients;
    }else{
        $response["msg"] = "Error en clients";
    }
}else {
    $response['msg']= 'session';
}    
echo json_encode($response);


 ?>