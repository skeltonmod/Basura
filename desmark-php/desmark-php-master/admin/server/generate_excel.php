<?php
require '../../vendor/autoload.php';
include 'db_config.php';
$key = $_GET['key'];


if (isset($key)) {
    $stmt = "SELECT (owner_transaction.id), CONCAT(customer.fname,' ',customer.lname) AS 'Customer Name', 
CONCAT(employee.fname,' ',employee.lname) AS 'Customer Name',owner_transaction.tid AS 'Transaction ID',employee.branch AS 'Branch', 
inventory.pname AS 'Item Name',inventory.pcode AS 'Product Code',
inventory.price AS 'Price',owner_transaction.status AS 'Status',owner_transaction.tp AS 'Total Payables', owner_transaction.amount AS 'Amount Paid',owner_transaction.type AS 'Type',
owner_transaction.tdate AS 'Transaction Date'
        FROM owner_transaction
        INNER JOIN customer ON customer.id = owner_transaction.cid
        INNER JOIN employee ON employee.id = owner_transaction.eid
        INNER JOIN inventory ON inventory.id = owner_transaction.pid";
    $output = '';
    $filename = 'download.xls';

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Expires: 0");
    $result = $conn->query($stmt);
    if ($result->num_rows > 0) {
        $separator = "\t";
        $rows=$result->fetch_all(MYSQLI_ASSOC);
        if(!empty($rows)){

            //Dynamically print out the column names as the first row in the document.
            //This means that each Excel column will have a header.
            echo implode($separator, array_keys($rows[0])) . "\n";
            //Loop through the rows
            foreach($rows as $row){

                //Clean the data and remove any special characters that might conflict
                foreach($row as $k => $v){
                    $row[$k] = str_replace($separator . "$", "", $row[$k]);
                    $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
                    $row[$k] = trim($row[$k]);
                }

                //Implode and print the columns out using the
                //$separator as the glue parameter
                echo implode($separator, $row) . "\n";
            }
        }
    }
}
