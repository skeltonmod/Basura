<?php
include "initialize.php";
$id = $_POST['id'];
$key = $_POST['key'];
$lastname = $_POST['lname'];
$address = $_POST['address'];
$loaninterest = $_POST['loaninterest'];
$amount = $_POST['amount'];
$termofpayment = $_POST['termofpayment'];
$totalpaid = $_POST['totalpaid'];
$currentbalance = $_POST['currentbalance'];
$monthlypaid = $_POST['monthlypaid'];
$duedate = $_POST['duedate'];
$dop = $_POST['paymentdate'];
$penalty = $_POST['penaltypay'];

/*
 *
 * CREATE TABLE `db_lending`.`tbl_history` ( `pid` INT(7) NOT NULL AUTO_INCREMENT , `currentamount` DOUBLE(7,3) NOT NULL , `currentbalance` DOUBLE(7,3) NOT NULL , `penalty` INT(7) NOT NULL , `tid` INT NOT NULL , PRIMARY KEY (`pid`)) ENGINE = InnoDB;
 *
 * */




if(isset($key)){
    $conn = new mysqli($db_host,$db_username,$db_password,$db_name);
    if($_POST['key'] == "edit"){
        echo $key." at row ". $id. "<br>";

        $statement = "UPDATE tbl_transaction SET tp='$totalpaid', mp='$monthlypaid' WHERE tid='$id'";
        $statement2 = "INSERT INTO tbl_history(currentamount,currentbalance,penalty,dop,tid) VALUES ('$amount','$currentbalance','$penalty','$dop','$id')";
        if($conn->query($statement) === TRUE && $conn->query($statement2)){
            echo "Entry Updated <br>";
        }else{
            echo "Something went wrong ".$conn->error;
        }

    }

}


?>