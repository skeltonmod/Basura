<?php
include "initialize.php";

//declare them instead
$tid = 'tid';
$fname = 'fname';
$lname = 'lname';
$address = 'address';
$amount = 'amount';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
$statement = "SELECT * FROM tbl_transaction";
$result = $conn->query($statement);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td id=\"transaction_id_$row[$tid]\">$row[$tid]</td>";
        echo "<td id=\"transaction_fname_$row[$tid]\">$row[$fname]</td>";
        echo "<td id=\"transaction_lname_$row[$tid]\">$row[$lname]</td>";
        echo "<td id=\"transaction_address_$row[$tid]\">$row[$address]</td>";
        
        echo "<td>
                <button type=\"button\" data-target=\"modal1\"  class=\"waves-effect modal-trigger waves-light btn actionbutton\" onclick=\"viewData($row[$tid],'view')\" 
                id=\"btnView\">View</button>
                <button type=\"button\"  class=\"waves-effect waves-light btn actionbutton\" onclick=\"deleteData($row[$tid])\" 
                id=\"btnDelete\">Delete</button>
                
                </td>";
        echo "</tr>";
    }

} else {
    echo "0 results";
}


?>
