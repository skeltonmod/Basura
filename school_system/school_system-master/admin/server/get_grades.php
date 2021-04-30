<?php
include "db_config.php";
$key = $_POST['key'];


if(isset($key)){
  switch ($key){
    case "fetchStudent":
      $student_id = $_POST['student_id'];
      $sql = "SELECT student.id, student.fname,student.lname,grades.grade,subjects.subject_name,subjects.subject_code
            FROM student
            INNER JOIN grades ON (student.id = '$student_id' AND grades.student_id = '$student_id')
            INNER JOIN subjects ON (grades.subject_id = subjects.id)";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "grade" => $row['grade'],
            "subject_name" => $row['subject_name'],
            "subject_code" => $row['subject_code'],
          );
        }
      }else{
        //if no records found
        $data[] = array(
          "student_id" => null,
        );
      }
      $response = array(
        "data" => @$data
      );

      echo json_encode($response);

      break;
    case "fetchAll":
      $sql = "SELECT student.id, student.fname,student.lname,grades.grade,subjects.subject_name,subjects.subject_code, CONCAT(teacher.fname, ' ',teacher.lname) AS instructor
            FROM student
            INNER JOIN grades ON grades.student_id = student.id
            INNER JOIN subjects ON (grades.subject_id = subjects.id)
            INNER JOIN teacher ON grades.teacher_id = teacher.id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "student_id" => $row['id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "grade" => $row['grade'],
            "subject_name" => $row['subject_name'],
            "subject_code" => $row['subject_code'],
            "instructor" => $row['instructor'],
          );
        }
      }else{
        //if no records found
        $data[] = array(
          "student_id" => null,
        );
      }
      $response = array(
        "data" => @$data
      );

      echo json_encode($response);
      break;
  }

}
