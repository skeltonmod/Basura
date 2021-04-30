<?php
include "db_config.php";
$key = $_POST['key'];
if(isset($key)){

  switch ($key){
    case "fetchTeacher":
      $sql = "SELECT teacher.id ,teacher.fname, teacher.lname,course.course_name
            FROM teacher, course
            WHERE course.id = teacher.department AND status = 1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "teacher_id" => $row['id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "course" => $row['course_name']
          );
        }
      }

      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;
    case "assignTeacher":
      $id = $_POST['id'];
      $sql = "SELECT teacher.id ,teacher.fname, teacher.lname,course.course_name
            FROM teacher, course
            WHERE course.id = teacher.department AND teacher.id = '$id' AND status = 1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "teacher_id" => $row['id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "course" => $row['course_name']
          );
        }
      }

      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;
    case "fetchCredentials":
      $id = $_POST['id'];
      $sql = "SELECT * FROM teacher WHERE id = '$id' AND status = 1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['id'],
            "fname" => $row['fname'],
            "mname" => $row['mname'],
            "lname" => $row['lname'],
            "address"=>$row['address'],
            "second_address"=>$row['second_address'],
            "city"=>$row['city'],
            "province"=>$row['province'],
            "region"=>$row['region'],
            "zip"=>$row['zip'],
            "email"=>$row['email'],
            "number"=>$row['number'],
            "birthday"=>$row['birthday'],
            "department"=>$row['department'],
            "image"=>$row['image'],
          );
        }
      }

      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;
  }

}
