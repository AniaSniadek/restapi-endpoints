<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './connect.php';
include_once './users.php';

$database = new Database();
$db = $database->getConnection();

$users = new User($db);

$stmt = $users->read();
$userCount = $stmt->rowCount();

if ($userCount > 0) {

    if (!empty($_POST["name"])) {

        $users_arr['records'] = array();
        $logName = $_POST["name"];
        $logPassword = $_POST["password"];
        $loged_user['user'] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $users_item = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "password" => $password
            );

            array_push($users_arr['records'], $users_item);
        }
        foreach ($users_arr['records'] as $element) {
            if ($element["name"] == $logName && $element["password"] == $logPassword) {
                array_push($loged_user['user'], $element);
                $isLoged = true;
            }
        }
        if ($isLoged) {
            http_response_code(200);
            echo json_encode($loged_user);
        } else {
            http_response_code(400);
        }
    }
} else {
    http_response_code(400);
}
