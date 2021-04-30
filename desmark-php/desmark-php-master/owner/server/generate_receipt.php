<?php
include "db_config.php";
require "pdf.php";

if(isset($_GET['key'])){
  $pdf = new Pdf();
  $tid = $_GET['tid'];
  $sql = "SELECT inventory.pname,inventory.pcode,inventory.price,inventory.bname,customer.account_name,CONCAT(employee.fname,' ',employee.lname) AS employee_name,
          CONCAT(customer.fname,' ',customer.lname) AS customer_name,transaction.tdate,employee.branch,transaction.downpayment,transaction.amount,transaction.type
          FROM transaction
          INNER JOIN customer on customer.id = transaction.cid
          INNER JOIN employee on employee.id = transaction.eid
          INNER JOIN inventory on inventory.id = transaction.pid
          WHERE transaction.tid = $tid ORDER BY transaction.id DESC";
  $result = $conn->query($sql);
  $output = '';
  if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
      $output .= '
          <style>
        @page { margin: 20px; }
        </style>
        <p>&nbsp;</p>
        <h3 align="center">Official Receipt</h3><br /><br />
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tr><td width="25%"><b>Customer Name</b></td>
            <td width="75%">' . $row["customer_name"].'</td>
        </tr>
        <tr>
               <td width="25%"><b>Account Number</b></td>
               <td width="75%">' . $row["account_name"] . '</td>
           </tr>
           <tr>
               <td width="25%"><b>Customer Name</b></td>
               <td width="75%">' . $row["customer_name"] . '</td>
           </tr>

           <tr>
               <td width="25%"><b>Employee Name</b></td>
               <td width="75%">' . $row["employee_name"] . '</td>
           </tr>
           <tr>
               <td width="25%"><b>Branch Name</b></td>
               <td width="75%">' . $row["branch"] . '</td>
           </tr>
           <tr>
               <td width="25%"><b>Total Payable</b></td>
               <td width="75%">' . $row["amount"] . '</td>
           </tr>
           <tr>
               <td width="25%"><b>Amount Paid</b></td>
               <td width="75%">' . $row["downpayment"] . '</td>
           </tr>
           <tr>
               <td width="25%"><b>Payment</b></td>
               <td width="75%">' . $row["type"] . '</td>
           </tr>
           <tr>
               <td width="25%"><b>Date of Transaction</b></td>
               <td width="75%">' . $row["tdate"] . '</td>
           </tr>
      ';
    }
  }
  $filename = "Attendance Report.pdf";
  $pdf->loadHtml($output);
  $pdf->render();
  $pdf->stream($filename, array("Attachment" => false));
}
