<?php
include "db_config.php";

$key = $_POST['key'];

if(isset($key)){
  switch ($key){
    case "fetchData":
      $sql = "SELECT schedule.id AS scheduleID, subjects.subject_name,subjects.subject_code,CONCAT(student.fname,\" \",student.lname) AS student_name,\n"

        . "		course.course_name,CONCAT(teacher.fname,\" \",teacher.lname) AS instructor, schedule.start_time,schedule.end_time,\n"

        . "        schedule.start_day,schedule.end_day,schedule.room_name\n"

        . "FROM schedule\n"

        . "INNER JOIN teacher ON schedule.teacher_id = teacher.id\n"

        . "INNER JOIN subjects ON schedule.subject_id = subjects.id\n"

        . "INNER JOIN student ON schedule.student_id = student.id\n"

        . "INNER JOIN course ON course.id = student.course";

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "scheduleID" => $row['scheduleID'],
            "subject_name" => $row['subject_name'],
            "subject_code" => $row['subject_code'],
            "student_name" => $row['student_name'],
            "course_name" => $row['course_name'],
            "teacher_name"=>$row['instructor'],
            "start_time"=>$row['start_time'],
            "end_time"=>$row['end_time'],
            "start_day"=>$row['start_day'],
            "end_day"=>$row['end_day'],
            "room_name"=>$row['room_name']
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
    case "getStudentSchedule":
      $id = $_POST['id'];
      $sql = "SELECT schedule.id AS scheduleID, subjects.subject_name, subjects.subject_code,
              CONCAT(student.fname,'', student.lname) AS student_name, course.course_name,
              CONCAT(teacher.fname,'', teacher.lname) AS instructor, schedule.start_time, schedule.end_time,
              schedule.start_day,schedule.end_day,schedule.room_name
              FROM schedule
              INNER JOIN teacher on schedule.teacher_id = teacher.id
              INNER JOIN subjects on schedule.subject_id = subjects.id
              INNER JOIN student ON schedule.student_id = student.id
              INNER JOIN course ON course.id = student.course WHERE student.id ='$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[] = array(
            "scheduleID" => $row['scheduleID'],
            "subject_name" => $row['subject_name'],
            "subject_code" => $row['subject_code'],
            "student_name" => $row['student_name'],
            "course_name" => $row['course_name'],
            "teacher_name"=>$row['instructor'],
            "start_time"=>$row['start_time'],
            "end_time"=>$row['end_time'],
            "start_day"=>$row['start_day'],
            "end_day"=>$row['end_day'],
            "room_name"=>$row['room_name']
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
