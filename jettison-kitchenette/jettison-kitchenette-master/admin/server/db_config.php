<?php
$db_username = "root";
$db_name = "restaurant";
$db_password = "";
$db_host = "localhost";


$conn = new mysqli($db_host,$db_username,$db_password,$db_name);

if($conn->connect_error){
    die($conn->connect_error);
}
