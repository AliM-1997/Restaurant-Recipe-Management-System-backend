<?php

require "../connection.php";

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    

}else{
    echo json_encode(["message"=>"wrong request method"]);
}