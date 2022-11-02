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
    $city = json_decode(file_get_contents("php://input"));
    $data = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.$city.'&units=metric&appid=c58712822fb9f87479e3873994b19c8f'));

    $item->name = $data->name;
    $item->temp = $data->main->temp;
    $item->wind = $data->wind->speed;
    $item->atmp = $data->main->pressure;
    $item->description=$data->weather[0]->description;
    $item->icon=$data->weather[0]->icon;
    $item->humidity = $data->main->humidity;


if($item->createWeather()){
        echo 'Weather record created successfully.';
    } else{
        echo 'Weather record not be created.';
    }
?>
