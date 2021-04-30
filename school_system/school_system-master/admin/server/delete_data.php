<?php
include "db_config.php";
$key = $_POST['key'];
$id = $_POST['id'];

if(isset($key)){
  switch ($key){
    case "deleteStudent":
      $sql ="DELETE student, grades FROM student INNER JOIN grades ON grades.student_id = student.id WHERE student.id = '$id';";
      if($conn->query($sql) === TRUE){
        echo "Success";
      }else{
        echo "Error";
      }
      break;
    case "reassignInstructor":
      $sql ="UPDATE teacher SET status = '0' WHERE teacher.id = '$id'";
      if($conn->query($sql) === TRUE){
        echo "Success";
      }else{
        echo "Error";
      }
      break;
    case "deleteSubject":
      $sql = "DELETE FROM `subjects` WHERE `subjects`.`id` = $id";
      if($conn->query($sql) === TRUE){
        echo "Success";
      }else{
        echo "Error";
      }
      break;

    case "dropStudent":
      $sql = "UPDATE `student` SET `status` = 'Drop' WHERE `student`.`id` = $id";
      if($conn->query($sql) === TRUE){
        echo "Success";
      }else{
        echo "Error";
      }
      break;



  }

}
