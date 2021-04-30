<?php
require '../../vendor/autoload.php';
include 'db_config.php';
$key = $_GET['key'];


if (isset($key)) {
    $stmt = "SELECT (transaction.id), CONCAT(customer.fname,' ',customer.lname) AS 'Customer Name', 
CONCAT(employee.fname,' ',employee.lname) AS 'Customer Name',transaction.tid AS 'Transaction ID',employee.branch AS 'Branch', 
inventory.pname AS 'Item Name',inventory.pcode AS 'Product Code',
inventory.price AS 'Price',transaction.status AS 'Status',transaction.tp AS 'Total Payables', transaction.amount AS 'Amount Paid',transaction.type AS 'Type',
transaction.tdate AS 'Transaction Date'
        FROM transaction
        INNER JOIN customer ON customer.id = transaction.cid
        INNER JOIN employee ON employee.id = transaction.eid
        INNER JOIN inventory ON inventory.id = transaction.pid";
    $output = '';
    $filename = 'record_owner.xls';

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
