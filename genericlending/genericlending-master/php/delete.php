<?php 
include 'initialize.php';
$tid = $_POST['id'];

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if (isset($_POST['key'])){
	if($_POST['key'] == 'delete'){
		$conn->query("DELETE FROM tbl_transaction WHERE tid='$tid'");
        $conn->query("DELETE FROM tbl_history WHERE tid='$tid'");
		echo "Entry Removed";
	}

}


?>