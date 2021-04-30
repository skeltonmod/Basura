<?php include "./server/db_config.php";
require_once './server/pdf.php';
if(isset($_GET['key'])){
  $pdf = new Pdf();
  $student_id = $_GET['student_id'];
  $sql = "SELECT * FROM student
            INNER JOIN course ON course.id = student.course
            WHERE student.id = $student_id";
  $result = $conn->query($sql);
  $output = '';
  if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
      $output .='<style>
    @page { margin: 20px; }

    </style>
    <p>&nbsp;</p>
    <h3 align="center">Average Grade Report</h3><br /><br />
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tr><td width="25%"><b>Student Name</b></td>
            <td width="75%">' . $row["fname"] . " " . $row['lname'] . '</td>
        </tr>
        <tr>
               <td width="25%"><b>Roll Number</b></td>
               <td width="75%">' . $row["id"] . '</td>
           </tr>
           <tr>
               <td width="25%"><b>Course</b></td>
               <td width="75%">' . $row["course_name"] . '</td>
           </tr>
           <tr>
            <td colspan="2" height="5">
             <h3 align="center">Grade Report</h3>
            </td>
           </tr>
           <tr>
            <td colspan="2">
             <table width="100%" border="1" cellpadding="5" cellspacing="0">
              <tr>
               <td><b>Subject Name</b></td>
               <td><b>Subject Code</b></td>
               <td><b>Description</b></td>
               <td><b>Grade</b></td>
              </tr>';
    }


  }



  $sql = "SELECT student.id, student.fname,student.lname,grades.grade,subjects.subject_name,subjects.subject_code,grades.description
            FROM student
            INNER JOIN grades ON (student.id = '$student_id' AND grades.student_id = '$student_id')
            INNER JOIN subjects ON (grades.subject_id = subjects.id)";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    $total_grade = 0;
    while($row = $result->fetch_assoc()){
      $output.='
      <tr>
       <td>' . $row["subject_name"] . '</td>
       <td>' . $row["subject_code"] . '</td>
       <td>' . $row["description"] . '</td>
       <td>' . $row["grade"] . '</td>
      </tr>
      ';
      $total_grade += $row['grade'];
    }
    $average_grade = 0;
    $output .= '</table>'.'<br>';
    $average_grade = $total_grade/$result->num_rows;
    $output .= '<b style="margin: 1rem">Average Grade: </b>'.$average_grade;
    if($average_grade >= 75){
      $output.='<b style="margin: 2em">Passed</b>';
    }else{
      $output.='<b>Failed</b>';
    }


  }
  $filename = "Attendance Report.pdf";
  $pdf->loadHtml($output);
  $pdf->render();
  $pdf->stream($filename, array("Attachment" => false));
}else{
  echo "No Key";
}
