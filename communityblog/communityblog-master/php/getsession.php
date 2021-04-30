<?php
session_start();

if(isset($_POST['key'])){

    if($_POST['key'] == 'id'){
        if(!empty($_SESSION['id'])){
            $jsonarray = array(
                'id' => $_SESSION['id'],
                'username'=>$_SESSION['username']
            );
            exit(json_encode($jsonarray));
        }

    }


}