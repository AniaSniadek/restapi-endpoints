<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once './connect.php';
include_once './users.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

$user->readOne();

if ($user->name != null) {

    $user_arr = array(
        "id" =>  $user->id,
        "name" => $user->name,
        "email" => $user->email,
        "password" => $user->password
    );

    http_response_code(200);
    echo json_encode($user_arr);
} else {

    http_response_code(404);
    echo json_encode(array("message" => "No data found"));
}
