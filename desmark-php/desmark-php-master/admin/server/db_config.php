<?php

/*
 * @var mysqli $conn
 * */

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "desmarkdb";
$conn = new mysqli($hostname,$username,$password,$db_name);
if(!$conn){
  die("Connection failed: ". $conn->connect_error);
}
session_start();
