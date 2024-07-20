<?php

require '../connection.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=$_POST["id"];
    $details=$_POST['details'];
    $name=$_POST["name"];

    if ($details !="" && $name !=""){   
    $stm=$conn->prepare("update recipes Set details = ?, name = ? WHERE id = ?");
    $stm->bind_param("ssi",$details,$name,$id);
    try {
        $stm->execute();
        echo json_encode(["message"=>"the recipe is updated","status"=>"success"]);
    } catch (Exception $e) {
        echo json_encode(["message"=>"cant update the recipe","status"=>"failure"]);
    }
}else{
    echo json_encode(["message"=>"can't update with empty value"]);
}   
}
else{
    echo json_encode(["message"=>"wrong request method"]);
}