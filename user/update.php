<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");


include_once '../config/database.php';
include_once '../models/user.php';

$database = new database();
$db = $database->getConnection();

$user = new user($db);


parse_str(file_get_contents('php://input', TRUE), $_PUT);

if (!empty($_PUT['id']) &&
    !empty($_PUT['name']) &&
    !empty($_PUT['username']) &&
    !empty($_PUT['city_id'])) {

    $user->id = $_PUT['id'];
    $user->name = $_PUT['name'];
    $user->username = $_PUT['username'];
    $user->city_id = $_PUT['city_id'];

    if($user->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Пользователь изменен."));

    }

    else{
        http_response_code(500);
        echo json_encode(array("message" => "Невозможно изменить пользователя."));
    }

}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно изменить пользователя. Данные неполные."));
}