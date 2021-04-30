<?php
include "db_config.php";

$key = $_POST['key'];

if(isset($key)){
  switch ($key){

    case "populateTable":
      $sql = "SELECT subjects.id, CONCAT(teacher.fname,' ',teacher.lname) AS instructor,subjects.subject_name,subjects.subject_code FROM subjects,teacher WHERE subjects.teacher_id = teacher.id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "subjectID" => $row['id'],
            "instructor" => $row['instructor'],
            "subject_name" => $row['subject_name'],
            "subject_code" => $row['subject_code'],
          );
        }
      }else{
        //if no records found
        $data[] = array(
          "subjectID" => null
        );
      }

      $response = array(
        "data" => @$data
      );

      echo json_encode($response);
      break;
    case "fetchSubject":
      $sql = "SELECT subjects.id,subjects.subject_name,subjects.subject_code FROM subjects";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "subjectID" => $row['id'],
            "subject_name" => $row['subject_name'],
            "subject_code" => $row['subject_code'],
          );
        }
      }else{
        //if no records found
        $data[] = array(
          "subjectID" => null
        );
      }

      $response = array(
        "data" => @$data
      );

      echo json_encode($response);
      break;
    case "assignSubject":
      $id = $_POST['id'];
      $sql = "SELECT subjects.id AS subjectID,teacher.id AS teacherID, CONCAT(teacher.fname,' ',teacher.lname) AS instructor,subjects.subject_name,subjects.subject_code
            FROM subjects,teacher
            WHERE subjects.teacher_id = teacher.id AND subjects.id = '$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "subjectID" => $row['subjectID'],
            "teacherID" => $row['teacherID'],
            "subject_name" => $row['subject_name'],
            "subject_code" => $row['subject_code'],
            "teacher_name"=>$row['instructor']
          );
        }
      }else{
        //if no records found
        $data[] = array(
          "subjectID" => null
        );
      }

      $response = array(
        "data" => @$data
      );

      echo json_encode($response);
      break;

  }

}
