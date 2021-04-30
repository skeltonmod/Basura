<?php include "db_config.php";

$key = $_POST['key'];

if(isset($key)){
  switch ($key){
    case "fetchData":
      $branch = $_SESSION['branch'];
      $sql = "SELECT (transaction.id), CONCAT(customer.fname,' ',customer.lname) AS customer_name,
            CONCAT(employee.fname,' ',employee.lname) AS employee_name,transaction.tid,employee.branch, inventory.pname,inventory.pcode,inventory.price,transaction.status,transaction.tp,transaction.type
            FROM transaction
            INNER JOIN customer ON customer.id = transaction.cid
            INNER JOIN employee ON employee.id = transaction.eid
            INNER JOIN inventory ON inventory.id = transaction.pid
            WHERE transaction.type = 'Installment' AND branch = '$branch'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $data[] = array(
            "rollnum"=>$row['id'],
            "transaction_id"=>$row['tid'],
            "customer_name"=>$row['customer_name'],
            "employee_name"=>$row['employee_name'],
            "pname"=>$row['pname'],
            "branch"=>$row['branch'],
            "balance"=>$row['tp'],
            "type"=>$row['type'],
            "status"=>$row['status']
          );

        }
      }
      $response = array(
        "data"=>$data
      );
      echo json_encode($response);
      break;

    case "viewTransaction":
      $id = $_POST['id'];
      $sql = "SELECT (transaction.id),transaction.tdate,inventory.id AS product_id, CONCAT(customer.fname,' ',customer.lname) AS customer_name,
       CONCAT(employee.fname,' ',employee.lname) AS employee_name,transaction.tid,
       inventory.pname,inventory.pcode,inventory.id AS product_id,inventory.price,transaction.tp,transaction.mp,transaction.dd,transaction.type FROM transaction
      INNER JOIN customer ON customer.id = transaction.cid
      INNER JOIN employee ON employee.id = transaction.eid
      INNER JOIN inventory ON inventory.id = transaction.pid
      WHERE transaction.id ='$id'";

      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $data[] = array(
            "rollnum"=>$row['id'],
            "tid"=>$row['tid'],
            "tdate"=>$row['tdate'],
            "customer_name"=>$row['customer_name'],
            "employee_name"=>$row['employee_name'],
            "product_id"=>$row['product_id'],
            "pname"=>$row['pname'],
            "pcode"=>$row['pcode'],
            "price"=>$row['price'],
            "tp"=>$row['tp'],
            "mp"=>$row['mp'],
            "dd"=>$row['dd'],
            "type"=>$row['type']
          );
        }
      }
      $response = array(
        "data"=>$data
      );
      echo json_encode($response);
      break;

    case "editTransaction":
      $id = $_POST['id'];
      $tid = $_POST['tid'];
      $tdate = $_POST['tdate'];
      $amount = $_POST['amount'];
      $tp = $_POST['tp'];
      $type = ($tp <= 0.0 ? 'Full' : 'Installment');

      $stmt = $conn->prepare("UPDATE `transaction`
                            SET `tid` = ?, `tdate` = ?, `amount` = ?, `tp` = ?, `type` = ?
                            WHERE `transaction`.`id` = ?");
      $stmt->bind_param("isddsi",$tid,$tdate,$amount,$tp,$type,$id);
      if($stmt->execute() === TRUE){
        echo "Success";
      }else{
        echo $stmt->error;
      }
      break;

  }

}
