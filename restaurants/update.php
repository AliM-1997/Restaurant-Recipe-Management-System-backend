<?php
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $location = $_POST["location"];
    $cuisine_type = $_POST["cuisine_type"];
    $id = $_POST["id"];

    $stmt = $conn->prepare("update resturants set name=?, location=?, cuisine_type=? where id=?;");
    $stmt->bind_param("sssi", $name, $location, $cuisine_type, $id);
    try {
        $stmt->execute();
        echo json_encode(["message" => "restaurant of id $id got updated", "status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["error" => $stmt->error, "status" => "failure"]);
    }
} else {
    echo json_encode(["error" => "Wrong request method"]);
}