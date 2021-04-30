<?php
include "init.php";
session_start();
@$username = $_POST['username'];
@$password = md5( $_POST['password']);
if(isset($_POST['key'])){


    if(isset($_POST['key']) == 'login'){
        $statement = $conn->prepare("SELECT id,username,password FROM user WHERE username=? AND password=?");
        $statement->bind_param("ss",$username,$password);
        $statement->execute();
        $statement->store_result();

        if($statement->num_rows > 0){
            $statement->bind_result($id,$username,$password);
            if($statement->fetch()){
             $user=  array(
                   "id"=>$id,
                   "username"=>$username,
                    "password"=>$password,
                );
             $_SESSION['id'] = $id;
             $_SESSION['username'] = $username;
             echo 1;
            }

        }else{
            echo -1;
        }
    }



}