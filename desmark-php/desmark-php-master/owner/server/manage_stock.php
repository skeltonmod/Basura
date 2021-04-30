<?php include "db_config.php";

$key = $_POST['key'];


if(isset($key)){
  switch ($key){
    case "viewProduct":
        $branch = explode(' ',$_SESSION['branch']);
      $sql = "SELECT * FROM inventory WHERE status = 'Active' AND branch = '$branch[1]'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $data[] = array(
            "product_id"=>$row['id'],
            "pname"=>$row['pname'],
            "pcode"=>$row['pcode'],
            "bname"=>$row['bname'],
            "price"=>$row['price'],
            "branch"=>$row['branch'],
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

    case "changeBranch":
            $quantity = $_POST['quantity'];
            $stocks = $_POST['stocks'];
            $branch = $_POST['branch'];
            $id = $_POST['id'];
            $product_id = $_POST['product_id'];
            deductInventory($id,$stocks);
            transferBranch($id,$quantity,$branch);
          break;
  }

}
function deductInventory($id,$stock){
    include "db_config.php";
    $sql = "UPDATE inventory SET stock = '$stock' WHERE inventory.id = '$id'";
    $conn->query($sql);
}

function transferBranch($id,$quantity,$branch){
    include "db_config.php";
    $sql = "SELECT * FROM inventory WHERE id =".$id;

    $stmt = $conn->prepare("INSERT INTO `inventory` (`pname`, `pcode`, `stock`, `description`, `price`, `bname`, `mname`, `myear`, `status`,`branch`)
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, 'Active',?)");
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()){
            $new_stock = $quantity;
            $new_pcode = $row['pcode'];
            $new_branch = $branch;
            $stmt->bind_param("ssisdssis",$row['pname'],$new_pcode,$new_stock,$row['description'],$row['price'],$row['bname'],$row['mname'],$row['myear'],$new_branch);
        }
    }

    if($stmt->execute() === TRUE){
        return true;
    }else{
        return false;
    }
}
