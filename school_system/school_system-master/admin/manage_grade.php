<?php include "../navbar.php"; ?>

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
  <div class="card" style="margin-top: 2em; margin-bottom: 2em">
    <div class="card-header">
      Grade Management
    </div>
    <div class="card-body">
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
              <div class="form-group col-md-2">
                <input type="text" class="form-control" id="studentYear" placeholder="Year" readonly>
              </div>
              <div class="form-group col-md-2">
                <input type="text" class="form-control" id="studentSem" placeholder="Sem" readonly>
              </div>

              <div class="form-group col-md-1">
                <input type="text" class="form-control" id="studentCourse_ID" placeholder="Course" readonly>
              </div>
              <div class="form-group col-md-2">
                <input type="text" class="form-control" id="studentCourse" placeholder="Student Course" readonly>
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

            <label>Grade</label>
            <div class="form-row">
              <div class="form-group col-md-5">
                <select class="form-control" id="inputDescription">
                  <option value="Exam">Exam</option>
                  <option value="Quiz">Quiz</option>
                  <option value="Assignment">Assignment</option>
                  <option value="Prelim Exam">Prelim Exam</option>
                  <option value="Prelim Quiz">Prelim Quiz</option>
                  <option value="Midterm Quiz">Midterm Quiz</option>
                  <option value="Midterm Quiz">Midterm Quiz</option>
                  <option value="Finals Quiz">Finals Quiz</option>
                  <option value="Finals Quiz">Finals Quiz</option>
                </select>
              </div>

            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="addon">Grade</span>
              </div>
              <input type="number" id="inputGrade" class="form-control col-md-5" placeholder="Average" aria-label="grade" aria-describedby="addon">

            </div>

            <button type="button" onclick="insertData()" class="btn btn-outline-primary btn-lg btn-block"> Submit </button>
          </form>
        </div>
        <div class="tab-pane fade" id="manage" role="tabpanel" aria-labelledby="manageTab">
          <br>
          <table class="table table-bordered" id="gradeTable">
            <thead class="thead-dark" style="width: 100%">
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Grade</th>
            <th scope="col">Instructor</th>
            <th scope="col">Subject Name</th>
            <th scope="col">Subject Code</th>
            </thead>
            <tbody id="tableBody">

            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

</div>
<script>

  $('.modal').on('hide.bs.modal',function () {
    $(".table-bordered").DataTable().destroy();
  })

  $(document).ready(function () {
    fetchData()
  })

  function fetchData(){
    let gradetable = $("#gradeTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "./server/get_grades.php",
        "data":{
          "key": "fetchAll",
        }
      },
      "columns":[
        {data: 'student_id'},
        {data: 'fname'},
        {data: 'lname'},
        {data: 'grade'},
        {data: 'instructor'},
        {data: 'subject_name'},
        {data: 'subject_code'},
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
            return `<button type="button" onclick="assign(${data},'subjects')" class="btn btn-outline-info">Assign</button>`
          }
        },

      ],
    });

  }


  function assign(id,key){
    switch(key){
      case "subjects":
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
            $("#addon").prepend(data.subject_name + " ")
            alert("Subject Assigned")
          }
        });
        break;
      case "students":
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
            $("#studentYear").val(data.year_level)
            $("#studentSem").val(data.semester)
            $("#studentCourse_ID").val(data.course_id)
            alert("Student Assigned")
          }
        });
        break;
    }

  }
  function insertData(){
    $.ajax({
      url: "./server/insertData.php",
      method: 'post',
      dataType: 'text',
      data:{
        key: 'insertGrade',
        student_id: $("#studentCode").val(),
        course_id: $("#studentCourse_ID").val(),
        year_level: $("#studentYear").val(),
        sem: $("#studentSem").val(),
        subject_id: $("#subjectID").val(),
        teacher_id: $("#instructorID").val(),
        grade: $("#inputGrade").val(),
        description: $("#inputDescription").val()
      },
      success: function (response) {
          alert(response)
      }
    })
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
            return `<button type="button" onclick="assign(${data},'students')" class="btn btn-outline-info">Assign</button>`
          }
        },

      ],
    });

  }
  function showModal(modal){
    switch (modal) {
      case "#studentModal":
        fetchStudent()
        break;
      case "#subjectModal":
        fetchSubject()
        break;
    }
    $(modal).modal()
  }

</script>

</body>

</html>
