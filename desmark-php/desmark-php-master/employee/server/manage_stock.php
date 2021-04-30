<?php include "db_config.php";

$key = $_POST['key'];


if(isset($key)){
  switch ($key){
    case "viewProduct":
      $sql = "SELECT * FROM inventory WHERE status = 'Active'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $data[] = array(
            "product_id"=>$row['id'],
            "pname"=>$row['pname'],
            "pcode"=>$row['pcode'],
            "bname"=>$row['bname'],
            "price"=>$row['price'],
            "status"=>$row['status']
          );

        }
      }
      $response = array(
        "data"=>$data
      );
      echo json_encode($response);
      break;

    case "fetchInformation":
      $id = $_POST['id'];
      $sql = "SELECT * FROM `inventory` WHERE id = '$id'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $data[] = array(
            "product_id"=>$row['id'],
            "pname"=>$row['pname'],
            "pcode"=>$row['pcode'],
            "description"=>$row['description'],
            "stock"=>$row['stock'],
            "price"=>$row['price'],
            "bname"=>$row['bname'],
            "mname"=>$row['mname'],
            "myear"=>$row['myear'],
          );
        }
      }
      $response = array(
        "data"=>$data
      );
      echo json_encode($response);
      break;

    case "editItem":
      $id = $_POST['id'];
      $pname = $_POST['pname'];
      $pcode = $_POST['pcode'];
      $stock = $_POST['stock'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $bname = $_POST['bname'];
      $mname = $_POST['mname'];
      $myear = $_POST['myear'];

      $stmt = $conn->prepare("UPDATE `inventory` SET `pname` = ?, `pcode` = ?,
                       `stock` = ?, `description` = ?,
                       `price` = ?, `bname` = ?, `mname` = ?,
                       `myear` = ? WHERE `inventory`.`id` = ?");
      $stmt->bind_param("ssisdssii",$pname,$pcode,$stock,$description,$price,$bname,$mname,$myear,$id);
      if ($stmt->execute() === TRUE) {
        echo "Success";
      } else {
        echo $stmt->error;
      }
      break;

    case "removeProduct":
      $id = $_POST['id'];
      $stmt = $conn->prepare("UPDATE `inventory` SET `status` = 'Inactive' WHERE `inventory`.`id` = ?");
      $stmt->bind_param("i",$id);
      if ($stmt->execute() === TRUE) {
        echo "Success";
      } else {
        echo $stmt->error;
      }
      break;

  }

}
