<?php
include "initialize.php";


$tid = @$_POST['id'];
//rudimentary
$key = $_POST['key'];





if (isset($_POST['key'])) {
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    $statement = "SELECT 
    * 
    FROM 
    tbl_transaction 
    JOIN tbl_history ON tbl_transaction.tid = tbl_history.tid 
    WHERE 
    tbl_history.tid = '$tid' ORDER BY tbl_history.hid DESC";

    if ($_POST['key'] == 'view') {
        $sql = @$conn->query($statement);
        $data = @$sql->fetch_array();

        $jsonArray = array(
            'tid' => @$data['tid'],
            'fname' => @$data['fname'],
            'lname' => @$data['lname'],
            'address' => @$data['address'],
            'loaninterest' => @$data['loaninterest'],
            'amount' => @$data['amount'],
            'top' => @$data['top'],
            'tp' => @$data['tp'],
            'mp' => @$data['mp'],
            'dd' => @$data['dd'],
            'currentamount' => @$data['currentamount'],
            'penalty' => @$data['penalty'],
            'currentbalance' => @$data['currentbalance'],
        );

        exit(json_encode($jsonArray));
    }


    if($_POST['key'] == "getrows"){
        $statement = "SELECT * FROM tbl_transaction";
        $result = $conn->query($statement);

        if ($result->num_rows > 0) {
            echo $result->num_rows;

        } else {
            echo "0";
        }
    }

}


?>