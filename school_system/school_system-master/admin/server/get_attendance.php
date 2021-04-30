<?php
include "db_config.php";

$key = $_POST['key'];

if(isset($key)){
  switch ($key){
    case "getStudentName":
      $sql = "SELECT student.id AS student_id, CONCAT(student.fname,' ', student.lname) AS student_name, student.course,course.course_name
              FROM student,course
              WHERE student.course = course.id ";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['student_id'],
            "student_name" => $row['student_name'],
            "course" => $row['course_name']
          );
        }
      }
      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;
    case "sortStudent":
      $id = $_POST['id'];
      $sql = "SELECT student.id AS student_id, CONCAT(student.fname,' ', student.lname) AS student_name, student.course,course.course_name
              FROM student,course
              WHERE student.course = course.id AND student.course = '$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['student_id'],
            "student_name" => $row['student_name'],
            "course" => $row['course_name']
          );
        }
      }else{
        //hacky way
        $data[] = array(
          "student_id" => "null",
          "student_name" => "",
          "course" => ""
        );
      }
      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;
    case "getAttendance":
      @$id = $_POST['id'];
      $sql = "SELECT student_id, CONCAT(student.fname,' ',student.lname) AS student_name,
		        course.course_name,attendance.attendance_status,attendance.attendance_date
            FROM  student,course,attendance
            WHERE attendance.student_id = student.id AND student.course = course.id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['student_id'],
            "student_name" => $row['student_name'],
            "course" => $row['course_name'],
            "attendance_status"=>$row['attendance_status'],
            "attendance_date"=>$row['attendance_date']
          );
        }
      }else{
        //hacky way
        $data[] = array(
          "student_id" => "null",
          "student_name" => "",
          "course" => ""
        );
      }
      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;

    case "getStudentAttendance":
      $id = $_POST['id'];
      $sql = "SELECT student_id, CONCAT(student.fname,' ', student.lname) AS student_name,
            course.course_name,attendance.attendance_status,attendance.attendance_date
            FROM student,course,attendance
            WHERE attendance.student_id = student.id AND student.course = course.id AND student.id = '$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['student_id'],
            "student_name" => $row['student_name'],
            "course" => $row['course_name'],
            "attendance_status"=>$row['attendance_status'],
            "attendance_date"=>$row['attendance_date']
          );
        }
      }else{
        //hacky way
        $data[] = array(
          "student_id" => "null",
          "student_name" => "",
          "course" => ""
        );
      }
      $response = array(
        "data" => $data,
      );
      echo json_encode($response);
      break;

  }

}
