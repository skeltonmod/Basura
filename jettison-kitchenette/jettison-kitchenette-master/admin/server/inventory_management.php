<?php
include "db_config.php";
include "tables.php";
include "dbhelper.php";
$key = $_POST['key'];
$dbhelper = new dbhelper("root","restaurant","","localhost");

if(isset($key)){
    switch ($key){
        case "insert":
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $description = $_POST['description'];
            $name = $_POST['name'];
            $status = $_POST['status'];
            $dbhelper->setFields('name','description','stocks','price','status');
            $dbhelper->pushDB("inventory",$name,$description,$stock,$price,$status);
            break;
        case "fetch":
            $content = '';
            $data = array();
            $data = $dbhelper->getData("inventory","id","name","status","description","stocks","price");
            foreach ($data as $index){
                $badge = "badge-success";
                switch ($index['status']){
                    case 'Available':
                        $badge = "badge-success";
                        break;
                    case 'Out of Stock':
                        $badge = "badge-danger";
                        break;
                }
                $content .= "<li class='media my-4' value='1' id='list_".$index['id']."'>
                    <h2 class='mr-3'>".$index['stocks']."</h2>
                    <div class='media-body'>
                        <h5 class='mt-0 mb-1'>".$index['name']."</h5>
                        <p>".$index['description']."</p>
                        <span class='badge badge-success'>Php ".$index['price']."</span>
                        <span class='badge ".$badge."'>".$index['status']."</span>
                        <button type='button' onclick='deleteData(".$index['id'].")' class='btn btn-danger btn-sm'>Delete</button>
                        <button type='button' class='btn btn-warning btn-sm'>Edit</button>
                    </div>
                </li>";
            }
            echo $content;
            break;

        case "delete":
            $id = $_POST['id'];
            $dbhelper->deleteData("inventory",$id);
            break;

    }
}