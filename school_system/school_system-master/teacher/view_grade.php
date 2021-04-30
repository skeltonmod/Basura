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
  <div id="dataTableContainer">
    <!--- Modal --->

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="headerName"> Name Goes Here </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered" id="gradeTable">
              <thead class="thead-dark" style="width: 100%">
              <th scope="col">#</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Grade</th>
              <th scope="col">Subject Name</th>
              <th scope="col">Subject Code</th>
              </thead>
              <tbody id="tableBody">

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Save Changes</button>

          </div>
        </div>
      </div>
    </div>

    <table class="table table-bordered" id="dataTable">
      <thead class="thead-dark" style="width: 100%">
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Course</th>
      <th scope="col">Action</th>
      </thead>
      <tbody id="tableBody">

      </tbody>
    </table>

  </div>

</div>




</body>
<script>



  $(document).ready(function () {
    fetchdata()

  })
  function fetchdata(){
    let table = $("#dataTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
        "ajax": {
          "url": "../admin/server/get_students.php",
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
            return '<button type="button" onclick="showModal('+data+')" class="btn btn-outline-info">View</button>'
          }}
      ],
    });
  }
  function getGrade(id){
    let gradetable = $("#gradeTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_grades.php",
        "data":{
          "key": "fetchStudent",
          "student_id":id
        }
      },
      "columns":[
        {data: 'student_id'},
        {data: 'fname'},
        {data: 'lname'},
        {data: 'grade'},
        {data: 'subject_name'},
        {data: 'subject_code'},
      ],
    });
    $("#viewModal").modal()
    $("#viewModal").on("hidden.bs.modal",function () {
      gradetable.destroy()
    })
  }

  function showModal(id){

    $.ajax({
      url: '../admin/server/get_grades.php',
      method:'POST',
      dataType:'json',
      data:{
        student_id: id
      },
      success: function (response) {
        var data = response.data[0]
        if(data.student_id != null){
          getGrade(data.student_id)
        }else{
          alert("No Grades found!")
        }
        $("#headerName").html(data.fname + " " + data.lname);
      },
    }).done(function () {
    })


  }
</script>
</html>
