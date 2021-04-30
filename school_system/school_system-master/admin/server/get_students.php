<?php

include "db_config.php";

$key = $_POST['key'];


if(isset($key)){

  switch ($key){
    case "fetchStudent":
      $sql = "SELECT student.id ,student.fname, student.lname,course.course_name
              FROM student, course
              WHERE course.id = student.course AND student.status = 'Enrolled'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['id'],
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
      $sql = "SELECT * FROM student WHERE id = '$id'";
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
            "phone"=>$row['phone'],
            "birthday"=>$row['birthday'],
            "year_level"=>$row['year_level'],
            "status"=>$row['status'],
            "sem"=>$row['semester'],
            "course"=>$row['course'],
            "image"=>$row['image'],
          );
        }
      }

      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;
    case "assignStudent":
      $id = $_POST['id'];
      $sql = "SELECT student.id,student.fname, student.lname,course.course_name,student.course,student.year_level,student.semester
            FROM student, course
            WHERE course.id = student.course AND student.id = '$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "course" => $row['course_name'],
            "course_id"=>$row['course'],
            "year_level"=>$row['year_level'],
            "semester"=>$row['semester']
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




