<?php
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

        $stmt = $conn->prepare("select * from resturants where id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {

        $stmt = $conn->prepare("delete from resturants where id=?");
        $stmt->bind_param("i", $id);
        try {
            $stmt->execute();
            echo json_encode(["message"=>"Restaurant deleted successfully", "status"=>"Success"]);
        } catch (Exception $e) {
            echo json_encode(["error"=>"Restaurant could not be deleted", "status"=>"failure"]);
        }}
    else {
        echo json_encode(["message"=>"Restaurant doesn't exist"]);
    }
} else {
    echo json_encode(["message"=>"Wrong method"]);
}