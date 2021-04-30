<?php include "db_config.php";
$key = $_POST['key'];


if(isset($key)){
  switch ($key){
    case "viewCustomer":
      $sql = "SELECT * FROM customer WHERE status = 'Active'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $data[] = array(
            "customer_id"=>$row['id'],
            "account_name"=>$row['account_name'],
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "status"=>$row['status']
          );

        }
      }
      $response = array(
        "data"=>$data
      );
      echo json_encode($response);
      break;

    case "fetchCredentials":
      $id = $_POST['id'];
      $sql = "SELECT * FROM `customer` WHERE id = '$id'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $data[] = array(
            "customer_id"=>$row['id'],
            "account_name"=>$row['account_name'],
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "address"=>$row['address'],
            "second_address"=>$row['second_address'],
            "city"=>$row['city'],
            "province"=>$row['province'],
            "region"=>$row['region'],
            "zip"=>$row['zip'],
            "email"=>$row['email'],
            "phone"=>$row['phone'],
            "birthday"=>$row['birthday'],
            "occupation"=>$row['occupation'],
            "account_status"=>$row['account_status'],
            "image"=>$row['image'],
            "status"=>$row['status']
          );

        }
      }
      $response = array(
        "data"=>$data
      );
      echo json_encode($response);
      break;

    case "editCustomer":
      $id = $_POST['id'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $address = $_POST['address'];
      $second_address = $_POST['second_address'];
      $city = $_POST['city'];
      $province = $_POST['province'];
      $region = $_POST['region'];
      $zip = $_POST['zip'];
      $bday = $_POST['bday'];
      $number = $_POST['number'];
      $occupation = $_POST['occupation'];
      $email = $_POST['email'];
      $stmt = $conn->prepare("UPDATE `customer` SET
                      `fname` = ?, `lname` = ?, `address` = ?,
                      `second_address` = ?, `city` = ?, `province` = ?,
                      `region` = ?, `zip` = ?,
                      `email` = ?, `phone` = ?, `birthday` = ?,
                      `occupation` = ? WHERE `customer`.`id` = ?");
      $stmt->bind_param("ssssssssssssi",$fname,$lname,$address,$second_address,$city,$province,$region,$zip,
                        $email,$number,$bday,$occupation,$id);
      if ($stmt->execute() === TRUE) {
        echo "Success";
      } else {
        echo $stmt->error;
      }
      break;

    case "removeCustomer":
      $id = $_POST['id'];
      $stmt = $conn->prepare("UPDATE `customer` SET `status` = 'Inactive' WHERE `customer`.`id` = ?");
      $stmt->bind_param("i",$id);
      if ($stmt->execute() === TRUE) {
        echo "Success";
      } else {
        echo $stmt->error;
      }
      break;

  }

}
