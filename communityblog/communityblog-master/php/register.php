<?php
include 'init.php';

$username = $_POST['username'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$password = md5($_POST['password']);



if(isset($_POST['key'])){
    if($_POST['key'] == 'create'){
        $statement = $conn->prepare("SELECT id FROM user WHERE email = ? OR username = ?");
        $statement->bind_param("ss",$email,$username);
        $statement->execute();
        $statement->store_result();
        if($statement->num_rows > 0){
            echo "User already Registered";
            $statement->close();
        }else{
            $statement = $conn->prepare("INSERT INTO user(username,fname,lname,password,email,status) 
            VALUES(?,?,?,?,?,'1')");
            //$result = $conn->query($statement);

            $statement->bind_param("sssss",$username,$fname,$lname,$password,$email);

            if($statement->execute()){
                echo "success";
            }else{
                echo "failed";
            }
        }

    }

}


