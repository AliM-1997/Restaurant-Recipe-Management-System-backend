<?php
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $location = $_POST["location"];
    $cuisine_type = $_POST["cuisine_type"];
    // $id = $_POST["id"];
if ($name != "" && $location != "" && $cuisine_type != "") {
    $stmt = $conn->prepare("select * from resturants where name=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    // print_r($result);
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("insert into resturants (id, name, location, cuisine_type) values(?,?,?,?)");
        $stmt->bind_param("isss", $id, $name, $location, $cuisine_type);
    try {
        $stmt->execute();
        echo json_encode(["message"=>"Restaurant created successfully", "status"=>"Success"]);
    } catch (Exception $e) {
        echo json_encode(["error"=>"Restaurant could not be created", "status"=>"failure"]);
    }
    }
    else {
        echo json_encode(["message"=>"Resturant already exists"]);
    }}
    else {
        echo json_encode(["message"=>"Can't leave empty data"]);
    }
} else {
    echo json_encode(["message"=>"Wrong method."]);
}