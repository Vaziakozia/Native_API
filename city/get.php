<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../models/city.php';

$database = new database();
$db = $database->getConnection();

$city = new city($db);


$stmt = $city->get();

$num = $stmt->rowCount();

if ($num > 0) {

    $city_arr = array();
    $city_arr["cities"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
        extract($row);

        $city_item = array(
            "id" => $id,
            "name" => $name,
        );

        $city_arr["cities"][] = $city_item;

    }

    http_response_code(200);

    echo json_encode($city_arr);

} else {
    http_response_code(404);

    echo json_encode(["message" => "Города не найдены."]);
}