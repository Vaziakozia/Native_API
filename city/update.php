<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");


include_once '../config/database.php';
include_once '../models/city.php';

$database = new database();
$db = $database->getConnection();

$city = new city($db);


parse_str(file_get_contents('php://input', TRUE), $_PUT);

if (!empty($_PUT['id'])) {
    $city->id = $_PUT['id'];
    $city->name = $_PUT['name'];

    if($city->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Город изменен."));

    }

    else{
        http_response_code(500);
        echo json_encode(array("message" => "Невозможно изменить город."));
    }

}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Город не изменен. Данные неполные"));
}