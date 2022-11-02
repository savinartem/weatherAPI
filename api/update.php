<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/weather.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new weather($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->name = $data->name;
    
    // employee values
   // $item->name = $data->name;
    $item->temp = $data->temp;
    $item->wind = $data->wind;
    $item->atmp = $data->atmp;
    $item->description = $data->description;


    
    if($item->updateWeather()){
        echo json_encode("Weather record  updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>
