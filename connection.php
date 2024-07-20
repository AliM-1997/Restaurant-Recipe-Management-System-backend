<?php

$servername="localhost";
$user="root";
$password="";
$db_name="restaurant _db";


$conn = new mysqli($servername,$user,$password,$db_name);

if ($conn->connect_error){
    echo json_encode(["message"=>"failed to connect"]);
}else{
    echo json_encode(["message"=>"connect succesfully"]);
}

$conn->close();

