<?php
include "./server/db_config.php";
require_once './server/pdf.php';
$output = '';
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
if (isset($_GET['key'])) {
  $pdf = new Pdf();
  $id = $_GET['student_id'];
  $query = "SELECT * FROM student
            INNER JOIN course ON course.id = student.course
            WHERE student.id = $id";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
      $output .= '<style>
    @page { margin: 20px; }

    </style>
    <p>&nbsp;</p>
    <h3 align="center">Attendance Report</h3><br /><br />
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
             <h3 align="center">Attendance Details</h3>
            </td>
           </tr>
           <tr>
            <td colspan="2">
             <table width="100%" border="1" cellpadding="5" cellspacing="0">
              <tr>
               <td><b>Attendance Date</b></td>
               <td><b>Attendance Status</b></td>
              </tr>


    ';
    }
  }
  $query = "SELECT * FROM attendance
            INNER JOIN student
            ON attendance.student_id = student.id
            WHERE student.id = 1 AND (attendance.attendance_date BETWEEN '$from_date' AND '$to_date')
            ORDER BY attendance_date ASC";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $output .= '
        <tr>
       <td>' . $row["attendance_date"] . '</td>
       <td>' . $row["attendance_status"] . '</td>
      </tr>';
    }
    $output .= '</table>';

  }
  $filename = "Attendance Report.pdf";
  $pdf->loadHtml($output);
  $pdf->render();
  $pdf->stream($filename, array("Attachment" => false));
  exit(0);
}
