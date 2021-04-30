<?php
include "initialize.php";
$tid = $_POST['tid'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$address = $_POST['address'];
$loaninterest = $_POST['loaninterest'];
$amount = $_POST['amount'];
$termofpayment = $_POST['termofpayment'];
$totalpaid = $_POST['totalpaid'];
$monthlypaid = $_POST['monthlypaid'];
$duedate = $_POST['duedate'];




$conn = new mysqli($db_host,$db_username,$db_password,$db_name);

if(isset($_POST['key'])){
    //insert operations
    if($_POST['key'] == 'insert'){
        $statement = "INSERT INTO tbl_transaction(tid, fname,lname,address,loaninterest,amount,top,tp,mp,dd) 
        VALUES ('$tid','$firstname','$lastname','$address','$loaninterest','$amount','$termofpayment','$totalpaid','$monthlypaid','$duedate')";
        $statement2 = "INSERT INTO tbl_history(currentamount,currentbalance,penalty,dop,tid) VALUES ('$amount','$totalpaid','','','$tid')";
        if($conn->query($statement) === TRUE && $conn->query($statement2) === TRUE ){
            echo "Insert Successful";
        }else{
            echo $conn->error;
        }
    }

}


?>
