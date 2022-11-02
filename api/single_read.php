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

    $item->name = isset($_GET['name']) ? $_GET['name'] : die();
  
    $item->getSingleWeather();

    if($item->temp != null){
        // create array
        $weather_arr = array(

            "name" => $item->name,
            "temp" => $item->temp,
            "wind" => $item->wind,
            "atmp" => $item->atmp,
            "description" => $item->description,
            "icon"=>$item->icon,
            "humidity"=>$item->humidity

        );
      
        http_response_code(200);
        echo json_encode($weather_arr);
    
    }  
    else{
        http_response_code(404);
        echo json_encode("Weather data not found.");
    }
?>
