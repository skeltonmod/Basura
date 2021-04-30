<?php
include "db_config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
// Common Values
@$key = $_POST['key'];
@$fname = $_POST['fname'];
@$mname = $_POST['mname'];
@$lname = $_POST['lname'];
@$address = $_POST['address'];
@$second_address = $_POST['second_address'];
@$city = $_POST['city'];
@$province = $_POST['province'];
@$region = $_POST['region'];
@$zip = $_POST['zip'];
@$bday = $_POST['bday'];
@$number = $_POST['number'];
@$email = $_POST['email'];
@$image_file = $_FILES['image_file']['name'];

//Unique values
@$ylevel = $_POST['ylevel'];
@$sem = $_POST['sem'];
@$course = $_POST['course'];
@$enrollment_date = $_POST['enrollment_date'];
@$department = $_POST['department'];
@$usertype = $_POST['usertype'];

@$subject_name = $_POST['subject_name'];
@$subject_code = $_POST['subject_code'];
@$units = $_POST['units'];
@$description = $_POST['description'];
@$instructorID = $_POST['instructorID'];
@$ystart = $_POST['ystart'];
@$yend = $_POST['yend'];

if (isset($key)) {
  switch ($key) {
    case "insertTeacher":
      try {
        $uploaded_file = getImaage($image_file,$fname);
        $stmt = $conn->prepare("INSERT INTO `teacher` (`fname`, `mname`,`lname`, `email`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `birthday`, `number`, `department`, `image`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssis", $fname,$mname, $lname, $email, $address,
          $second_address, $city, $province, $region, $zip, $bday,
          $number, $department, $uploaded_file);

        if($result = $stmt->execute() === TRUE){
          if($result){
            createuser($conn->insert_id,$email,"Teacher");
          }
        }else{
          echo $stmt->error;
        }

      } catch (ErrorException $ex) {
        echo $ex;
      }
      break;
    case "insertStudent":
      $uploaded_file = getImaage($image_file,$fname);
      $stmt = $conn->prepare("INSERT INTO `student` (`fname`, `mname`,`lname`, `address`, `second_address`, `city`, `province`, `region`, `zip`, `email`, `phone`, `birthday`, `enrollment_date`, `year_level`, `semester`, `course`, `image`)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("sssssssssssssiiis",
        $fname,$mname, $lname, $address, $second_address, $city, $province, $region,
        $zip, $email, $number, $bday, $enrollment_date, $ylevel, $sem, $course, $uploaded_file);
      if($result = $stmt->execute() === TRUE){
        if($result){
          createuser($conn->insert_id,$email,"Student");
        }
      }else{
        echo $stmt->error;
      }
      break;
    case "insertSubject":


      $stmt = $conn->prepare("INSERT INTO `subjects` ( `subject_name`, `subject_code`, `units`, `description`, `teacher_id`, `start_year`, `end_year`)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssdsiii",$subject_name,$subject_code,$units,$description,$instructorID,$ystart,$yend);
      if($stmt->execute() === TRUE){
        echo "Success";
      }else{
        echo $stmt->error;
      }
      break;
    case "insertAttendance":
      $temp_id_list =$_POST['id_list'];
      $temp_status_list =$_POST['status_list'];
      $array_id = explode(",",$temp_id_list);
      $array_status = explode(",",$temp_status_list);
      $attendance_date = $_POST['attendance_date'];
      $teacher_id = 1;
      for($i = 0; $i < count($array_id); ++$i){
        $stmt = $conn->prepare("INSERT INTO `attendance` (`student_id`, `attendance_status`, `attendance_date`, `teacher_id`)
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi",$array_id[$i],$array_status[$i],$attendance_date,$teacher_id);
        if($stmt->execute() === TRUE){
          echo "Success";
        }else{
          echo $stmt->error;
        }

        //echo $array_id[$i]."->".$array_status[$i]."@".$attendance_date."\n";
      }
      break;
    case "editCredentials":
      if(isset($usertype)) {
        if ($usertype === "student") {
          $student_id = $_POST['id'];
          $image_string = $fname . '.png';
          $stmt = $conn->prepare("UPDATE `student`
                                        SET `fname` = ?, `lname` = ?, `address` = ?,`second_address` = ?, `city` = ?,
                                        `province` = ?, `region` = ?, `zip` = ?,
                                        `email` = ?, `phone` = ?,
                                        `birthday` = ?,`year_level` = ?,`course` = ?
                                        WHERE `student`.`id` = ?");

          $stmt->bind_param("sssssssssssiii", $fname, $lname, $address, $second_address, $city,
            $province, $region, $zip, $email, $number, $bday, $ylevel, $course, $student_id);
          if ($stmt->execute() === TRUE) {
            echo "Success";
          } else {
            echo $stmt->error;
          }
        }
        else if ($usertype === "teacher") {
          $teacher_id = $_POST['id'];
          $image_string = $fname . '.png';
          $stmt = $conn->prepare("UPDATE `teacher` SET `fname` = ?,
                                `lname` = ?, `email` = ?, `address` = ?,
                                `second_address` = ?, `city` = ?,
                                `province` = ?, `region` = ?, `zip` = ?,
                                `birthday` = ?, `number` = ?, `department` = ? WHERE `teacher`.`id` = ?");

          $stmt->bind_param("sssssssssssii",$fname,$lname,$email,$address,$second_address,$city,$province,$region
                            ,$zip,$bday,$number,$department,$teacher_id);
          if ($stmt->execute() === TRUE) {
            echo "Success";
          } else {
            echo $stmt->error;
          }
        }
      }
      break;
    case "insertSchedule":
      $studentname = $_POST['studentname'];
      $studentcode = $_POST['studentcode'];
      $studentcourse = $_POST['studentcourse'];
      $subject_id = $_POST['subject_id'];
      $subjectname = $_POST['subjectname'];
      $instructor_id = $_POST['instructor_id'];
      $instructorname = $_POST['instructorname'];
      $startday = $_POST['startday'];
      $endday = $_POST['endday'];
      $starttime = $_POST['starttime'];
      $endtime = $_POST['endtime'];
      $roomname = $_POST['roomname'];
      $stmt = $conn->prepare("INSERT INTO `schedule` (`subject_id`, `teacher_id`, `student_id`, `start_time`, `end_time`, `start_day`, `end_day`, `room_name`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiisssss",$subject_id,$instructor_id,$studentcode,$starttime,$endtime,$startday,$endday,$roomname);
      if($stmt->execute() === TRUE){
        echo "Success";
      }else{
        echo $stmt->error;
      }
      break;
    case "insertGrade":
      $student_id = $_POST['student_id'];
      $course_id = $_POST['course_id'];
      $year_level = $_POST['year_level'];
      $sem = $_POST['sem'];
      $subject_id = $_POST['subject_id'];
      $teacher_id  = $_POST['teacher_id'];
      $grade = $_POST['grade'];
      $description = $_POST['description'];
      $stmt = $conn->prepare("INSERT INTO `grades` (`student_id`, `teacher_id`, `subject_id`, `course_id`, `grade`, `year`, `semester`,`description`)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiidiis",$student_id,$teacher_id,$subject_id,$course_id,$grade,$year_level,$sem,$description);
      if($stmt->execute() === TRUE){
        echo "Success";
      }else{
        echo $stmt->error;
      }
      break;
  }
}

function getImaage($image,$filename){
  $uploadable = true;
  $imagefiletype = pathinfo($image,PATHINFO_EXTENSION);
  $basename = $filename.".".$imagefiletype;
  $location = "../../img/".$basename;

  // sanitize file
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
function createuser($user_id,$email,$user_type){
  include "db_config.php";
  $userpassword = generatePass();
  $sql = "INSERT INTO `user` (`user_id`, `email`, `password`, `user_type`) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isss",$user_id,$email,md5($userpassword),$user_type);
  if($stmt->execute() === TRUE){
    echo "Success";
    mailAccount($userpassword,$email);
  }else
  {
    echo $stmt->error;
  }
}
function generatePass(){
  $n = 20;
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }

  return $randomString;
}
function mailAccount($userpassword,$useremail){
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->Mailer = "smtp";
  $mail->SMTPDebug  = 1;
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.mailtrap.io";
  $mail->Username   = "f92d7c424eba35";
  $mail->Password   = "5d6317b9256a6b";
  $message = "<html>
   <head>
      <title>Good Day!</title>
   </head>
   <body>
      <p>An Admin has created an account with the credentials that you've provided</p>

      <p>You will need to enter the following upon signing in</p>
      <span>Email: ".$useremail."</span>
      <span>Password: ".$userpassword."</span><br>

      <span>(Warning: unsubscribing will permanently remove your ability to get any emails from us including forgotten passwords.)</span>
   </body>
</html>";
  $mail->IsHTML(true);
  $mail->AddAddress($useremail, "Student");
  $mail->SetFrom("webmaster@admin.com", "Webmaster");
  $mail->Subject = "Account Created!";
  $mail->MsgHTML($message);
  if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
  } else {
    echo "Email sent successfully";
  }
}
