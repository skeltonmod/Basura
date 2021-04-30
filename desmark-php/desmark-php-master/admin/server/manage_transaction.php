<?php include "db_config.php";

$key = $_POST['key'];

if (isset($key)) {
    switch ($key) {
        case "fetchData":
            $branch = $_SESSION['branch'];
            $sql = "SELECT (owner_transaction.id), CONCAT(customer.fname,' ',customer.lname) AS customer_name,
            CONCAT(employee.fname,' ',employee.lname) AS employee_name,owner_transaction.tid,employee.branch, inventory.pname,inventory.pcode,inventory.price,owner_transaction.status,owner_transaction.tp,owner_transaction.type
            FROM owner_transaction
            INNER JOIN customer ON customer.id = owner_transaction.cid
            INNER JOIN employee ON employee.id = owner_transaction.eid
            INNER JOIN inventory ON inventory.id = owner_transaction.pid
            WHERE employee.branch = '$branch'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = array(
                        "rollnum" => $row['id'],
                        "transaction_id" => $row['tid'],
                        "customer_name" => $row['customer_name'],
                        "employee_name" => $row['employee_name'],
                        "pname" => $row['pname'],
                        "branch" => $row['branch'],
                        "balance" => $row['tp'],
                        "type" => $row['type'],
                        "status" => $row['status']
                    );

                }
            }
            $response = array(
                "data" => $data
            );
            echo json_encode($response);
            break;

        case "viewTransaction":
            $id = $_POST['id'];
            $sql = "SELECT (transaction.id),transaction.tdate,inventory.id AS product_id, customer.fname,customer.lname,
       CONCAT(employee.fname,' ',employee.lname) AS employee_name,transaction.tid,transaction.eid,transaction.cid,
       inventory.pname,inventory.pcode,inventory.id AS product_id,inventory.price,transaction.tp,transaction.mp,transaction.dd,transaction.type FROM transaction
      INNER JOIN customer ON customer.id = transaction.cid
      INNER JOIN employee ON employee.id = transaction.eid
      INNER JOIN inventory ON inventory.id = transaction.pid
      WHERE transaction.id ='$id'";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = array(
                        "rollnum" => $row['id'],
                        "tid" => $row['tid'],
                        "cid" => $row['cid'],
                        "eid" => $row['eid'],
                        "tdate" => $row['tdate'],
                        "firstname" => $row['fname'],
                        "lastname" => $row['lname'],
                        "employee_name" => $row['employee_name'],
                        "product_id" => $row['product_id'],
                        "pname" => $row['pname'],
                        "pcode" => $row['pcode'],
                        "price" => $row['price'],
                        "tp" => $row['tp'],
                        "mp" => $row['mp'],
                        "dd" => $row['dd'],
                        "type" => $row['type']
                    );
                }
            }
            $response = array(
                "data" => $data
            );
            echo json_encode($response);
            break;

        case "editTransaction":
            $id = $_POST['id'];
            $tid = $_POST['tid'];
            $tdate = $_POST['tdate'];
            $cid = $_POST['cid'];
            $eid = $_POST['eid'];
            $pid = $_POST['pid'];
            $loaninterest = $_POST['loaninterest'];
            $amount = $_POST['amount'];
            $downpayment = $_POST['downpayment'];
            $top = $_POST['top'];
            $tp = $_POST['tp'];
            $mp = $_POST['mp'];
            $dd = $_POST['dd'];
            $type = ($tp <= 0 ? 'Full' : 'Installment');
            $status = $_POST['status'];

            $stmt = $conn->prepare("INSERT INTO `transaction` ( `tid`, `tdate`, `cid`, `eid`, `pid`, `loaninterest`, `amount`, `downpayment`, `top`, `tp`, `mp`, `dd`, `type`,`status`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiiiiddiddsss", $tid, $tdate, $cid, $eid, $pid, $loaninterest, $amount, $downpayment,
                $top, $tp, $mp, $dd, $type, $status);
            if ($stmt->execute() === TRUE) {
                echo "Success";
                createOwnerTransaction($id,$tid,$tdate,$amount,$tp);
            } else {
                echo $stmt->error;
            }
            break;



    }

}

function createOwnerTransaction($id,$tid,$tdate,$amount,$tp){
    include "db_config.php";
    $id = $_POST['id'];
    $tid = $_POST['tid'];
    $tdate = $_POST['tdate'];
    $amount = $_POST['amount'];
    $tp = $_POST['tp'];
    $type = ($tp <= 0.0 ? 'Full' : 'Installment');

    $stmt = $conn->prepare("UPDATE `owner_transaction`
                            SET `tid` = ?, `tdate` = ?, `amount` = ?, `tp` = ?, `type` = ?
                            WHERE `owner_transaction`.`id` = ?");
    $stmt->bind_param("isddsi",$tid,$tdate,$amount,$tp,$type,$id);
    if($stmt->execute() === TRUE){
        echo "Success";
    }else{
        echo $stmt->error;
    }
}
