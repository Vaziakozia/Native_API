<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


include_once '../config/database.php';
include_once '../models/city.php';

$database = new database();
$db = $database->getConnection();

$city = new city($db);



if (!empty($_POST['name'])) {


    $city->name = $_POST['name'];




    if ($city->create()) {

        http_response_code(201);
        echo json_encode(array("message" => "Новый город добавлен."));
    }
    else {
        http_response_code(503);

        echo json_encode(["message" => "Невозможно добавить город."]);
    }
} else {

    http_response_code(400);

    echo json_encode(["message" => "Невозможно добавить город. Данные неполные."]);
}