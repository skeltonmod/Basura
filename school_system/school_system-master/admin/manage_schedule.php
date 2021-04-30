<?php include "../navbar.php" ?>
<html>
<head>
  <meta charset="utf-8">
  <title>Mulondo NHS</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/main.css">
  <script src="../js/vendor/modernizr-3.11.2.min.js"></script>
  <script src="../js/plugins.js"></script>
  <script src="../js/main.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</head>


<body>
<div class="container">
  <ul class="nav nav-tabs" id="subjectTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="addTab" data-toggle="tab" role="tab" href="#add" aria-controls="add" aria-selected="true">
        Add Schedule
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="manageTab" data-toggle="tab" href="#manage" role="tab" aria-controls="add" aria-selected="false">
        Manage
      </a>
    </li>
  </ul>

  <div class="tab-content" id="scheduleTabContent">
    <div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="addTab">
      <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="headerName"> Get Student </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="studentTable">
                <thead class="thead-dark" style="width: 100%">
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Course</th>
                <th scope="col">Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="headerName"> Get Subject </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="subjectTable">
                <thead class="thead-dark" style="width: 100%">
                <th scope="col">#</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Subject Code</th>
                <th scope="col">Action</th>
                </thead>
                <tbody>

                </tbody>
              </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
          </div>
        </div>
      </div>
      <form>
        <br>
        <label>Student Information</label>
        <div class="form-row">

          <div class="form-group col-md-2">
            <input type="text" class="form-control" id="studentName" placeholder="Student Name" readonly>
          </div>
          <div class="form-group col-md-2">
            <input type="text" class="form-control" id="studentCode" placeholder="Student Code" readonly>
          </div>
          <div class="form-group col-md-6">
            <input type="text" class="form-control" id="studentCourse" placeholder="Subject Course" readonly>
          </div>
          <div class="form-group col-md-2">
            <button type="button" onclick="showModal('#studentModal')" class="btn btn-outline-warning btn-md btn-block"> Get Student </button>
          </div>
        </div>
        <label>Subject Information</label>
        <div class="form-row">

          <div class="form-group col-md-2">
            <input type="text" class="form-control" id="subjectID" placeholder="Subject ID" readonly>
          </div>
          <div class="form-group col-md-2">
            <input type="text" class="form-control" id="subjectCode" placeholder="Subject Code" readonly>
          </div>
          <div class="form-group col-md-6">
            <input type="text" class="form-control" id="subjectName" placeholder="Subject Name" readonly>
          </div>
          <div class="form-group col-md-2">
            <button type="button" onclick="showModal('#subjectModal')" class="btn btn-outline-warning btn-md btn-block"> Get Subject </button>
          </div>
        </div>
        <label>Instructor Information</label>
        <div class="form-row">

          <div class="form-group col-md-2">
            <input type="text" class="form-control" id="instructorID" placeholder="Instructor ID" readonly>
          </div>
          <div class="form-group col-md-4">
            <input type="text" class="form-control" id="instructorName" placeholder="Instructor Name" readonly>
          </div>
        </div>
        <label>Date, Time and Room</label>
        <div class="form-row">
          <div class="form-group col-md-2">
            <label class="sr-only" for="yearStart"></label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="startDay" placeholder="Start Day">
          </div>
          <div class="form-group col-md-2">
            <label class="sr-only" for="yearEnd"></label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">-</div>
              </div>

              <input type="text" class="form-control" id="endDay" placeholder="End Day">
            </div>
          </div>

        </div>
        <div class="form-row">
          <div class="form-group col-md-2">
            <label class="sr-only" for="yearStart"></label>
            <input type="number" class="form-control mb-2 mr-sm-2" id="startTime" placeholder="Start Time">
          </div>
          <div class="form-group col-md-2">
            <label class="sr-only" for="yearEnd"></label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">-</div>
              </div>

              <input type="number" class="form-control" id="endTime" placeholder="End Time">
            </div>
          </div>



        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <input type="text" class="form-control" id="roomName" placeholder="Room Name">
          </div>
        </div>
        <button type="button" onclick="insertData()" class="btn btn-outline-primary btn-lg btn-block"> Submit </button>
      </form>
    </div>
    <div class="tab-pane fade" id="manage" role="tabpanel" aria-labelledby="manageTab">
      <br>
      <table class="table table-bordered" id="scheduleTable">
        <thead>
        <th scope="col">#</th>
        <th scope="col">Subject Name</th>
        <th scope="col">Subject Code</th>
        <th scope="col">Student Name</th>
        <th scope="col">Student Course</th>
        <th scope="col">Instructor</th>
        <th scope="col">Start Time</th>
        <th scope="col">End Time</th>
        <th scope="col">Start Day</th>
        <th scope="col">End Day</th>
        <th scope="col">Room Name</th>
        <th scope="col">Action</th>
        </thead>
        <tbody>

        </tbody>
      </table>

    </div>
  </div>

</div>

<script>

  $('.modal').on('hide.bs.modal',function () {
    $(".table-bordered").DataTable().destroy();
  })
  function assignStudent(id){
    $.ajax({
      url: './server/get_students.php',
      method: 'POST',
      dataType:'json',
      data: {
        key:"assignStudent",
        id: id
      },
      success: function (response) {
        let data = response.data[0];
        $("#studentName").val(data.fname + " " + data.lname)
        $("#studentCode").val(data.student_id)
        $("#studentCourse").val(data.course)
        alert("Instructor Assigned")
      }
    });
  }
  function assignSubject(id){
    alert(id)
    $.ajax({
      url: './server/get_subjects.php',
      method: 'POST',
      dataType:'json',
      data: {
        key:"assignSubject",
        id: id
      },
      success: function (response) {
        let data = response.data[0];
        $("#subjectName").val(data.subject_name)
        $("#subjectCode").val(data.subject_code)
        $("#subjectID").val(data.subjectID)
        $("#instructorName").val(data.teacher_name)
        $("#instructorID").val(data.teacherID)
        alert("Subject Assigned")
      }
    });
  }
  function fetchStudent(){
    let table = $("#studentTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "./server/get_students.php",
        "data":{
          "key": "fetchStudent"
        }
      },
      "columns":[
        {data: 'student_id'},
        {data: 'fname'},
        {data: 'lname'},
        {data: 'course'},
        {data: "student_id",
          render:function (data,type,row) {
            return '<button type="button" onclick="assignStudent('+data+')" class="btn btn-outline-info">Assign</button>'
          }
        },

      ],
    });
  }
  function fetchSubject(){
    let table = $("#subjectTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "./server/get_subjects.php",
        "data":{
          "key": "fetchSubject"
        }
      },
      "columns":[
        {data: 'subjectID'},
        {data: 'subject_name'},
        {data: 'subject_code'},
        {data: "subjectID",
          render:function (data,type,row) {
            return '<button type="button" onclick="assignSubject('+data+')" class="btn btn-outline-info">Assign</button>'
          }
        },

      ],
    });
  }
  function showModal(modal) {
    switch (modal) {
      case "#instructorModal":
        fetchInstructor();
        break;

      case "#studentModal":
        fetchStudent();
        break;
      case "#subjectModal":
        fetchSubject();
        break;
    }
    $(modal).modal()

  }
  function insertData(){
    let studentName = $("#studentName").val();
    let studentCode = $("#studentCode").val();
    let studentCourse = $("#studentCourse").val();
    let subjectID = $("#subjectID").val();
    let subjectName = $("#subjectName").val();
    let instructorID = $("#instructorID").val();
    let instructorName = $("#instructorName").val();
    let startDay = $("#startDay").val();
    let endDay = $("#endDay").val();
    let startTime = $("#startTime").val();
    let endTime = $("#endTime").val();
    let roomname = $("#roomName").val();

    $.ajax({
      url: './server/insertData.php',
      method: 'POST',
      dataType:'text',
      data: {
        key:"insertSchedule",
        studentname: studentName,
        studentcode: studentCode,
        studentcourse: studentCourse,
        subject_id: subjectID,
        subjectname: subjectName,
        instructor_id: instructorID,
        instructorname: instructorName,
        startday: startDay,
        endday: endDay,
        starttime: startTime,
        endtime: endTime,
        roomname: roomname
      },
      success: function (response) {
      },
      complete: function (xhr,textStatus) {
        if(xhr.status === 200){
          $('.form-control').val("");
        }
      }
    });

  }
  function fetchData(){
    let schedule = $("#scheduleTable").DataTable({
      responsive: true,
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "./server/get_schedule.php",
        "data":{
          "key": "fetchData"
        }
      },
      "columns":[
        {data: 'scheduleID'},
        {data: 'subject_name'},
        {data: 'subject_code'},
        {data: 'student_name'},
        {data: 'course_name'},
        {data: 'teacher_name'},
        {data: 'start_time'},
        {data: 'end_time'},
        {data: 'start_day'},
        {data: 'end_day'},
        {data: 'room_name'},
        {data: "scheduleID",
          render:function (data,type,row) {
            return /*'<button type="button" onclick="showModal('+data+')" class="btn btn-outline-info">View</button>'+*/' <button type="button" onclick="deleteData('+data+')" class="btn btn-outline-danger">Delete</button>'
          }}
      ],
    });
  }
  $(document).ready(function () {
    fetchData()
  })
</script>
</body>

</html>
