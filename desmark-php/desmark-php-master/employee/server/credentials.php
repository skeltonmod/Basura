<?php
include "db_config.php";

$key = $_POST['key'];

if(isset($key)){
    switch ($key){
        case 'login':
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $sql = "SELECT user_id,branch,user_type,id FROM `user` WHERE email = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss",$email,$password);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->bind_result($user_id,$branch,$user_type,$id);

                if($stmt->fetch()){
                    $response = array(
                        "user_type" => $user_type,
                        "id"=>$id,
                        "branch"=>$branch,
                        "user_id"=>$user_id,
                    );

                }
                $_SESSION['user_type'] = $user_type;
                $_SESSION['id'] = $user_id;
                $_SESSION['branch'] = $branch;
            }else{
                $response = array(
                    "user_type" => "null",
                    "id"=>"null",
                    "user_id"=>"null",
                );
            }
            echo json_encode($response);
            break;
        case "logout":
            if(!isset($_SESSION['user_type'])){
                echo "NO SESSION";
            }else{
                session_unset();
                session_destroy();
                echo "Logged Out";
            }

            break;

    }

}
