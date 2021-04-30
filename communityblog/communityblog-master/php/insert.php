<?php
//the back end stuff
include "init.php";
$title = $_POST['title'];
$date = $_POST['date'];
$userid = $_POST['userid'];
$content =addslashes($_POST['content']);
$category = $_POST['category'];




//inserting data
if(isset($_POST['key'])){
    if($_POST['key'] == 'insert'){
        $statement = "INSERT INTO posts(title,category,content,date,userid) 
        VALUES('$title','$category','$content','$date','$userid')";
        $result = $conn->query($statement);
        if($result === TRUE){
            echo "success";
        }
        else{
            echo $conn->error;
        }
    }



}
