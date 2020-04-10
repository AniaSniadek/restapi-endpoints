<!-- Reading all user data from the database -->
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once './connect.php';
include_once './user.php';

$database = new Database();
$db = $database->getConnection();

$users = new User($db);

$stmt = $users->read();
$userCount = $stmt->rowCount();

if ($userCount > 0) {

    $users_arr['records'] = array();

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

    http_response_code(200);
    echo json_encode($users_arr);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "No data found.")
    );
}
