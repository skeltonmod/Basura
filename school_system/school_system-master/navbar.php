<?php
session_start();
$current_file = getcwd();
if ($current_file == dirname(__FILE__) . DIRECTORY_SEPARATOR . "admin" && @$_SESSION['user_type'] != 'Admin') {
  header("Location:../404.html");
} elseif ($current_file == dirname(__FILE__) . DIRECTORY_SEPARATOR . "student" && @$_SESSION['user_type'] != 'Student') {
  header("Location:../404.html");
} elseif ($current_file == dirname(__FILE__) . DIRECTORY_SEPARATOR . "teacher" && @$_SESSION['user_type'] != 'Teacher') {
  header("Location:../404.html");
}
$filepath = "..".DIRECTORY_SEPARATOR."login.php";
//echo $filepath
?>

<html lang="eng">
<head>
  <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" crossorigin="anonymous"></script>
  <script>
    function logout(){
      $.ajax({
        url:'../admin/server/credentials.php',
        dataType: 'text',
        method: 'post',
        data:{
          key: 'logout'
        },
        success: function (response) {
          window.location.href = '../login.php'
        }
      })

    }</script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="http://192.168.1.5:8080/school_system/img/image.jpg" width="30px" height="30px" class="d-inline-block align-top" alt="">
    Mulando NHS
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">


        <!--- Hide the login screen --->
        <?php
        //href="'.$filepath.'"
        if(isset($_SESSION['user_type']) && isset($_SESSION['id'])){
          if($current_file == dirname(__FILE__).DIRECTORY_SEPARATOR.mb_strtolower($_SESSION['user_type'])){
            echo '<li class="nav-item">
          <a class="nav-link" href="./login.php">Home <span class="sr-only">(current)</span></a>
        </li>';
            echo '<li class="nav-item">
                  <a class="nav-link" href="#" onclick="logout()">Logout <span class="sr-only"></span></a>
                </li>';
            echo '
              <li class="nav-item">
                <a class="nav-link" href="./manage_attendance.php">Attendance <span class="sr-only">(current)</span></a>
              </li>';
          }
        }
        ?>

        <!--- TEACHER --->
        <?php
        if(isset($_SESSION['user_type'])){
          if($_SESSION['user_type'] === 'Teacher' || $_SESSION['user_type'] === 'Admin'){
            echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Teacher
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="./view_grade.php">Generate Report Card</a>
            <a class="dropdown-item" href="./manage_schedule.php">View/Edit Schedules</a>
            <a class="dropdown-item" href="./view_student.php">View/Edit Student</a>
            <a class="dropdown-item" href="./manage_grade.php">Manage Grade</a>
          </div>

        </li>';
          }
        }
        ?>

        <!--- ADMIN --->
        <?php
        if(isset($_SESSION['user_type'])){
          if($_SESSION['user_type'] === 'Admin'){
            echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Admin
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="./add_student.php">Add Student</a>
            <a class="dropdown-item" href="./add_teacher.php">Add Teacher</a>
            <a class="dropdown-item" href="./view_teacher.php">Edit Teacher</a>
            <a class="dropdown-item" href="./manage_subject.php">View/Edit Subject</a>
          </div>';
          }

        }


        ?>
        </li>

      </ul>

    </div>


  </nav>
</body>

</html>
