<?php include "db_config.php";
include "logger.php";
$key = $_POST['key'];
$currentdate = "";
if(isset($key)) {
    switch ($key) {
        case "insertCustomer":
            $accountName = $_POST['accountname'];
            $fname = $_POST['fname'];
            $gender = $_POST['gender'];
            $civil_status = $_POST['civil_status'];
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
            $image_file = $_FILES['image_file']['name'];
            $document = $_FILES['document']['name'];

            $image = getImage($image_file, $fname, 'image_file');
            $document = getFile($document, $fname, 'document');

            $stmt = $conn->prepare("INSERT INTO `customer` (`account_name`, `fname`, `lname`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `email`, `phone`, `birthday`, `occupation`, `image`, `document`, `account_status`, `status`,`civil_status`,`gender`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New', 'Active',?,?)");
            $stmt->bind_param("sssssssssssssssss",
                $accountName, $fname, $lname, $address, $second_address, $city, $province, $region,
                $zip, $email, $number, $bday, $occupation, $image, $document, $civil_status, $gender);
            if ($stmt->execute() === TRUE) {
                echo "Success";
            } else {
                echo $stmt->error;
            }
            break;
        case "insertEmployee":
            $accountName = $_POST['accountname'];
            $fname = $_POST['fname'];
            $gender = $_POST['gender'];
            $civil_status = $_POST['civil_status'];
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
            $branch = $_POST['branch'];
            $stmt = $conn->prepare("INSERT INTO `employee` ( `employee_id`, `fname`, `lname`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `email`, `phone`, `birthday`, `occupation`, `status`, `civil_status`, `gender`,`branch`)
                            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active', ?, ?, ?)");
            $stmt->bind_param("ssssssssssssssss",
                $accountName, $fname, $lname, $address, $second_address, $city, $province, $region,
                $zip, $email, $number, $bday, $occupation, $civil_status, $gender, $branch);
            if ($result = $stmt->execute() === TRUE) {
                if ($result) {
                    $result = createuser($conn->insert_id, $email, md5($number), $branch, "employee");
                }
            } else {
                echo $stmt->error;
            }

            break;
        case "insertProduct":
            $pname = $_POST['pname'];
            $pcode = $_POST['pcode'];
            $stock = $_POST['stock'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $bname = $_POST['bname'];
            $mname = $_POST['mname'];
            $myear = $_POST['myear'];
            $branch = explode(' ', $_SESSION['branch']);
            $stmt = $conn->prepare("INSERT INTO `inventory` (`pname`, `pcode`, `stock`, `description`, `price`, `bname`, `mname`, `myear`, `status`,`branch`)
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, 'Active',?)");
            $logger = new logger($conn);
            $stmt->bind_param("ssisdssis", $pname, $pcode, $stock, $description, $price, $bname, $mname, $myear,$branch[1]);
            if ($stmt->execute() === TRUE) {
                echo "Success";
                $logger->createlogs($_SESSION['email'],"Added ".$stock." ".$bname." to Inventory","2020-10-08",$_SESSION['branch']);
            } else {
                echo $stmt->error;
            }
            break;
        case "insertTransaction":
            $paymenttype = $_POST['type'];
            if ($paymenttype === "installment") {
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
                $logger = new logger($conn);
                $stmt->bind_param("isiiiiddiddsss", $tid, $tdate, $cid, $eid, $pid, $loaninterest, $amount, $downpayment,
                    $top, $tp, $mp, $dd, $type, $status);
                deductInventory($pid);
                if ($status === "Repo") {
                    createRepo($pid);
                }
                if ($stmt->execute() === TRUE) {
                    echo "Success";
                    $currentdate = $tdate;
                } else {
                    echo $stmt->error;
                }
                $stmt = $conn->prepare("INSERT INTO `owner_transaction` ( `tid`, `tdate`, `cid`, `eid`, `pid`, `loaninterest`, `amount`, `downpayment`, `top`, `tp`, `mp`, `dd`, `type`,`status`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bind_param("isiiiiddiddsss", $tid, $tdate, $cid, $eid, $pid, $loaninterest, $amount, $downpayment,
                    $top, $tp, $mp, $dd, $type, $status);
                if ($stmt->execute() === TRUE) {
                    echo "Success";
                } else {
                    echo $stmt->error;
                }
            } elseif ($paymenttype === "full") {
                $tid = $_POST['tid'];
                $tdate = $_POST['tdate'];
                $cid = $_POST['cid'];
                $eid = $_POST['eid'];
                $pid = $_POST['pid'];
                $loaninterest = 0.000;
                $amount = $_POST['amount'];
                $downpayment = 0.000;
                $top = 0.000;
                $tp = 0.000;
                $mp = 0.000;
                $dd = $_POST['tdate'];
                $type = ($tp <= 0 ? 'Full' : 'Installment');
                $status = $_POST['status'];

                $stmt = $conn->prepare("INSERT INTO `transaction` ( `tid`, `tdate`, `cid`, `eid`, `pid`, `loaninterest`, `amount`, `downpayment`, `top`, `tp`, `mp`, `dd`, `type`,`status`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bind_param("isiiiiddiddsss", $tid, $tdate, $cid, $eid, $pid, $loaninterest, $amount, $downpayment,
                    $top, $tp, $mp, $dd, $type, $status);
                deductInventory($pid);
                if ($status === "Repo") {
                    createRepo($pid);
                }
                if ($stmt->execute() === TRUE) {
                    echo "Success";
                } else {
                    echo $stmt->error;
                }

                $stmt = $conn->prepare("INSERT INTO `owner_transaction` ( `tid`, `tdate`, `cid`, `eid`, `pid`, `loaninterest`, `amount`, `downpayment`, `top`, `tp`, `mp`, `dd`, `type`,`status`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bind_param("isiiiiddiddsss", $tid, $tdate, $cid, $eid, $pid, $loaninterest, $amount, $downpayment,
                    $top, $tp, $mp, $dd, $type, $status);
                if ($stmt->execute() === TRUE) {
                    echo "Success";
                } else {
                    echo $stmt->error;
                }
            }

            break;
    }

}
function getImage($image,$filename){
  $imagefiletype = pathinfo($image,PATHINFO_EXTENSION);
  $basename = $filename.".".$imagefiletype;
  $location = "../../customerImage/".$basename;
  $check = getimagesize($_FILES["image_file"]["tmp_name"]);
  if($check !== false){
    $uploadable = true;
  }else{
    echo "File is not an Image: ";
    $uploadable = false;
  }

  if($uploadable === true && $filename != ""){
    if(move_uploaded_file($_FILES['image_file']['tmp_name'],$location)){
      echo "";
    }else{
      echo "OOPS! \n";
    }
  }else{
    echo "OOPS! \n";
  }
  return $basename;

}

function getFile($file,$filename,$postname){
  $documentfiletype = pathinfo($file,PATHINFO_EXTENSION);
  $basename = $filename.".".$documentfiletype;
  $location = "../../docs/".$basename;

  if($filename != ""){
    if(move_uploaded_file($_FILES[$postname]['tmp_name'],$location)){
      echo "";
    }else{
      echo "GetFile: OOPS! \n";
    }
  }else{
    echo "GetFile: OOPS! \n";
  }
  return $basename;
}

function deductInventory($id){
  include "db_config.php";
  $stock = 0;
  $sql = "SELECT stock FROM inventory WHERE inventory.id = '$id'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
      $stock = $row['stock'];
    }
  }
  $stock -= 1;
  $sql = "UPDATE inventory SET stock = '$stock' WHERE inventory.id = '$id'";
  $conn->query($sql);
  if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
      $stock = $row['stock'];
    }
  }
}

function createRepo($id){
  include "db_config.php";
  $sql = "SELECT * FROM inventory WHERE id =".$id;

  $stmt = $conn->prepare("INSERT INTO `inventory` (`pname`, `pcode`, `stock`, `description`, `price`, `bname`, `mname`, `myear`, `status`)
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, 'Repo')");
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
      $new_stock = ($row['stock'] - $row['stock']) + 1;
      $new_pcode = "REPO_".$row['pcode'];
      $stmt->bind_param("ssisdssi",$row['pname'],$new_pcode,$new_stock,$row['description'],$row['price'],$row['bname'],$row['mname'],$row['myear']);
    }
  }

  if($stmt->execute() === TRUE){
    return true;
  }else{
    return false;
  }
}

function createuser($user_id,$email,$pass,$branch,$usertype){
    include "db_config.php";
    $sql = "INSERT INTO `user` (`user_id`, `email`, `password`, `branch`, `user_type`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss",$user_id,$email,$pass,$branch,$usertype);
    if($stmt->execute() === TRUE){
        echo "Success";
    }else{
        echo $stmt->error;
    }
}
