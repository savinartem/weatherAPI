<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/weather.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new weather($db);

    $stmt = $items->getWeather();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(

                "name" => $name,
                "temp" => $temp,
                "description" => $description,
                "wind" => $wind,
                "atmp" => $atmp,
                "icon"=>$icon,
                "humidity"=>$humidity

            );

            array_push($employeeArr["body"], $e);
        }
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
