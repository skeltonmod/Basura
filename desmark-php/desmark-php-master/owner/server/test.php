<?php
function deductInventory($id){
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $db_name = "desmarkdb";
  $conn = new mysqli($hostname,$username,$password,$db_name);
  if(!$conn){
    die("Connection failed: ". $conn->connect_error);
  }
  $stock = 0;
  $sql = "SELECT stock FROM inventory WHERE inventory.id = '$id'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
      $stock = $row['stock'];
    }
  }
  $stock -= 1;
  $sql = "UPDATE inventory SET stock = '$stock' WHERE inventory.id = '$id'";
  $conn->query($sql);
  if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
      $stock = $row['stock'];
    }
  }
  return $stock;
}
echo "Inventory Stock ->". deductInventory(1);
