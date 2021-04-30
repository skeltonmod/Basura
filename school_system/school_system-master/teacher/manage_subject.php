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
<br>
  <div class="container">

   <ul class="nav nav-tabs" id="subjectTabs" role="tablist">
     <li class="nav-item">
       <a class="nav-link active" id="addTab" data-toggle="tab" role="tab" href="#add" aria-controls="add" aria-selected="true">
         Add Subject
       </a>
     </li>
     <li class="nav-item">
       <a class="nav-link" id="manageTab" data-toggle="tab" href="#manage" role="tab" aria-controls="add" aria-selected="false">
         Manage
       </a>
     </li>
   </ul>
<div class="tab-content" id="subjectTabContent">
  <div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="addTab">
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="headerName"> Get Instructor </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered" id="dataTable">
              <thead class="thead-dark" style="width: 100%">
              <th scope="col">#</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Department</th>
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
      <label>Basic Information</label>
      <div class="form-row">

        <div class="form-group col-md-6">
          <input type="text" class="form-control" id="subjectName" placeholder="Subject Name">
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control" id="subjectCode" placeholder="Subject Code">
        </div>
        <div class="form-group col-md-2">
          <input type="number" class="form-control" id="units" placeholder="units">
        </div>
      </div>
      <label>Additional Information</label>
      <div class="form-row">

        <div class="form-group col-md-2">
          <input type="text" class="form-control" id="instructorID" placeholder="Instructor ID" readonly>
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control" id="instructorName" placeholder="Instructor Name" readonly>
        </div>
        <div class="form-group col-md-2">
          <button type="button" onclick="showModal()" class="btn btn-outline-warning btn-md btn-block"> Get Instructor </button>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <textarea class="form-control" id="subjectDescription" rows="2" placeholder="Description"></textarea>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <input type="text" class="form-control" id="roomName" placeholder="Room Name">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <input type="text" class="form-control" id="preReq" placeholder="Pre Requisites">
        </div>
      </div>
      <label>School Year</label>
      <div class="form-row">
        <div class="form-group col-md-2">
          <label class="sr-only" for="yearStart"></label>
          <input type="number" class="form-control mb-2 mr-sm-2" id="yearStart" placeholder="Starting Year">
        </div>
        <div class="form-group col-md-2">
          <label class="sr-only" for="yearEnd"></label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">-</div>
            </div>

            <input type="number" class="form-control" id="yearEnd" placeholder="Ending Year">
          </div>
        </div>

        <button type="button" onclick="insertData()" class="btn btn-outline-primary btn-lg btn-block"> Submit </button>
      </div>

    </form>
  </div>
  <div class="tab-pane fade" id="manage" role="tabpanel" aria-labelledby="manageTab">
    <br>
    <table class="table table-bordered" id="subjectTable">
      <thead class="thead-dark" style="width: 100%">
      <th scope="col">#</th>
      <th scope="col">Subject Name</th>
      <th scope="col">Subject Code</th>
      <th scope="col">Instructor</th>
      <th scope="col">Action</th>
      </thead>
      <tbody>

      </tbody>
    </table>

  </div>
</div>


  </div>

<script>
  let instructor_id;
  let instructor_name;

  function insertData(){
    let subject_name = $("#subjectName").val()
    let subject_code = $("#subjectCode").val()
    let units = $("#units").val()
    let instructorID = $("#instructorID").val()
    let instructorName = $("#instructorName").val()
    let description = $("#subjectDescription").val()
    let ystart = $("#yearStart").val()
    let yend = $("#yearEnd").val()
    $.ajax({
      url: '../admin/server/insertData.php',
      method: 'POST',
      data: {
        key:"insertSubject",
        subject_name: subject_name,
        subject_code: subject_code,
        units: units,
        instructorID: instructorID,
        instructorName: instructorName,
        description: description,
        ystart: ystart,
        yend: yend
      },
      success: function (response) {
        alert("New Record Inserted!")
      }
    });
  }
  function showModal() {
    $("#viewModal").modal()
  }
  function fetchInstructor(){
    let table = $("#dataTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_instructor.php",
        "data":{
          "key": "fetchTeacher"
        }
      },
      "columns":[
        {data: 'teacher_id'},
        {data: 'fname'},
        {data: 'lname'},
        {data: 'course'},
        {data: "teacher_id",
          render:function (data,type,row) {
            return '<button type="button" onclick="assignInstructor('+data+')" class="btn btn-outline-info">Assign</button>'
          }
        },

      ],
    });
  }
  function assignInstructor(id){
    $.ajax({
      url: '../admin/server/get_instructor.php',
      method: 'POST',
      dataType:'json',
      data: {
        key:"assignTeacher",
        id: id
      },
      success: function (response) {
        let data = response.data[0];
        this.instructor_id = data.teacher_id
        this.instructor_name = data.fname + " " + data.lname
        $("#instructorName").val(this.instructor_name)
        $("#instructorID").val(this.instructor_id)
        alert("Instructor Assigned")
      }
    });
  }
  function fetchdata(){
    let stable = $("#subjectTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_subjects.php",
        "data":{
          "key": "populateTable"
        }
      },
      "columns":[
        {data: 'subjectID'},
        {data: 'subject_name'},
        {data: 'subject_code'},
        {data: 'instructor'},
        {data: "subjectID",
          render:function (data,type,row) {
            return /*'<button type="button" onclick="showModal('+data+')" class="btn btn-outline-info">View</button>'+*/' <button type="button" onclick="deleteData('+data+')" class="btn btn-outline-danger">Delete</button>'
          }}
      ],
    });
  }
  $(document).ready(function () {
    fetchdata();
    fetchInstructor()
  })
</script>

</body>


</html>
