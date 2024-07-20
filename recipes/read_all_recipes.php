<?php


require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resturant_name = $_POST["name"];
    
    
    $stm = $conn->prepare("select * from resturants where name = ?");
    $stm->bind_param("s", $resturant_name);
    $stm->execute();
    $result = $stm->get_result();
    
    if ($result->num_rows > 0) {
        $stm = $conn->prepare("
        select rs.name as resturant_name,r.name as recipe_name,r.details as recipe_details
        from recipes r 
        join resturants rs on rs.id=r.resturant_id
        where rs.name=?");

        $stm->bind_param("s", $resturant_name);
        try {
            $stm->execute();
            $all_results = $stm->get_result();
            $recipes = [];
            if ($all_results->num_rows > 0) {
                while ($row = $all_results->fetch_assoc()) {
                    $recipes[] = $row;
                }
                echo json_encode(["recipes" => $recipes]);
            } else {
                echo json_encode(["message" => "No recipes found"]);
            }
        } catch (Exception $e) {
            echo json_encode(["message" => "Error occurred while fetching recipes"]);
        }
    } else {
        echo json_encode(["message" => "No restaurant found"]);
    }

} else {
    echo json_encode(["message" => "Wrong request method"]);
}
?>
