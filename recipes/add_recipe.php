<?php

require "../connection.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $resturant_id=$_POST['resturant_id'];
    $name=$_POST['name'];
    $details=$_POST['details'];

    $stm=$conn->prepare("select * from recipes where name=?");
    $stm->bind_param("s",$name);
    $stm->execute();
    $result=$stm->get_result();
    if ( $result->num_rows>0){
        echo json_encode(["message"=>"the item is already exist with name $name"]);
    }
    else{
        $stm=$conn->prepare("insert into recipes (resturant_id,name,details) value (?,?,?)");
        $stm->bind_param("iss",$resturant_id,$name,$details);
        try {
            $stm->execute();
            echo json_encode(["message"=>"recipe added successfully","status"=>"success"]);
        } catch (Exception $e) {
            echo json_encode(["message"=>$stm->error,"status"=>"failure"]);
        }
    }

}else{
    echo json_encode(["message"=>"wrong request method"]);
}