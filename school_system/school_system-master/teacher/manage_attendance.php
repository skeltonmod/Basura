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
<div class="container" style="margin-top: 30px">
  <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="headerName"> Generate Report </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="form-group">
           <label for="fromDate">From</label>
           <input type="date" class="form-control" id="fromDate">
         </div>
          <div class="form-group">
            <label for="toDate">To</label>
            <input type="date" class="form-control" id="toDate">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Generate Report</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="headerName"> Add Attendance </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="studentForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="lbl_course">Course</label>
                <select class="form-control" id="courseSelect">
                  <option value="1">BS Information Technology</option>
                  <option value="2">BS Computer Science</option>
                  <option value="3">BS Computer Engineering</option>
                  <option value="4">Assoc Computer Technology</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="lbl_address">Attendance Date </label>
                <input type="date" class="form-control" id="inputAttendanceDate">
              </div>
            </div>

            <table class="table table-bordered modalTable" id="studentTable">
              <thead class="thead-dark" style="width: 100%">
              <th scope="col">#</th>
              <th scope="col">Student Name</th>
              <th scope="col">Course</th>
              <th scope="col">Present</th>
              <th scope="col">Absent</th>
              </thead>
              <tbody>

              </tbody>
            </table>

          </form>
        </div>
        <div class="modal-footer">

          <input type="submit" onclick="insertData()" class="btn btn-success" id="addAttendance" data-dismiss="modal" value="Add Attendance">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-9"> Attendance </div>
        <div class="col-md-3" align="right">
          <button type="button" onclick="showModal('#reportModal')" id="report" class="btn btn-outline-danger btn-sm">Report</button>
          <button type="button" onclick="showModal('#addModal')" id="add" class="btn btn-outline-info btn-sm">Add</button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered" id="dataTable">
        <thead  style="width: 100%">
        <th scope="col">#</th>
        <th scope="col">Student Name</th>
        <th scope="col">Course</th>
        <th scope="col">Attendance Status</th>
        <th scope="col">Attendance Date</th>

        </thead>
        <tbody>

        </tbody>
      </table>
    </div>

  </div>

</div>

<script>
  $(document).ready(function () {
    fetchData()
  })
  function insertData(){
    let student_id_list = []
    let student_status_list = []
    let inputs = document.querySelectorAll('input[type="radio"]:checked');
    let serial = $('#studentForm').serializeArray();
    let attendanceDate = $("#inputAttendanceDate").val()
    for(let i = 0; i < inputs.length; ++i){
      student_id_list.push(inputs[i].id)
      student_status_list.push(inputs[i].value)
    }
    serial.push({name:'key',value:'insertAttendance'})
    serial.push({name:'attendance_date',value:attendanceDate})
    serial.push({name:'id_list',value:student_id_list})
    serial.push({name:'status_list',value:student_status_list})
    //alert(serial)
    $.ajax({
      url: "../admin/server/insertData.php",
      method: "post",
      dataType: "text",
      data: serial,
      success: function (response,textStatus,xhr) {
        $("#dataTable").DataTable().ajax.reload()
      }
    })
  }
  $('.modal').on('hide.bs.modal',function () {
    $('.modalTable').DataTable().destroy()
  })
  $("#courseSelect").on('change',function (e) {
    let optionSelected = $("option:selected",this)
    let selectedValue = this.value
    sortStudent(selectedValue)
  })
  function sortStudent(id){
    $.ajax({
      url: "./server/get_attendance.php",
      method: "post",
      dataType: "json",
      data:{
        key:"sortStudent",
        id: id
      },
      success: function (response) {
        let data = response.data[0]
        if(data.student_id != "null"){
          $('#studentTable').DataTable().destroy();
          let table = $("#studentTable").DataTable({
            lengthChange: true,
            "paging": true,
            "processing": true,
            "serverMethod": "post",
            "ajax": {
              "url": "../admin/server/get_attendance.php",
              "data": {
                "key": "sortStudent",
                "id": id,
              }
            },
            "columns": [
              {
                data: "student_id",
                render: function (data, type, row) {
                  return '<td align="center">'+data+'</td>' + '<input type="hidden" name="student_id" value="'+data+'"/>'+
                    '<input type="hidden" name="key" value="insertAttendance">'
                }
              },
              {data: 'student_name'},
              {data: 'course'},
              {
                data: "student_id",
                render: function (data, type, row) {
                  return '<input id="'+ data  +'" name="attendance_status_'+data+'" type="radio" value="Present">'
                }
              },
              {
                data: "student_id",
                render: function (data, type, row) {
                  return '<input id="'+ data  +'" name="attendance_status_'+data+'" type="radio" value="Absent">'
                }
              }
            ],

            "columnDefs": [
              {"className": "dt-center", "targets": "_all"}
            ]
          })
        }else{
          alert("No Student Found")
        }
      }
    })
  }
  function fetchStudents(){
    let table = $("#studentTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_attendance.php",
        "data": {
          "key": "getStudentName"
        }
      },
      "columns": [
        {
          data: "student_id",
          render: function (data, type, row) {
            return '<td align="center">'+data+'</td>' + '<input type="hidden" name="student_id" value="'+data+'"/>'
          }
        },
        {data: 'student_name'},
        {data: 'course'},
        {
          data: "student_id",
          render: function (data, type, row) {
            return '<input id="'+ data  +'" name="attendance_status_'+data+'" type="radio" value="Present">'
          }
        },
        {
          data: "student_id",
          render: function (data, type, row) {
            return '<input id="'+ data  +'" name="attendance_status_'+data+'" type="radio" value="Absent">'
          }
        }
      ],
      "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ]
    })
  }
  function showModal(modalName){
    //alert(modalName)
    $(modalName).modal();
    switch (modalName) {
      case "#addModal":
          fetchStudents()
        break;
      //Todo fetchAttendance

    }

  }
  function fetchData(){
    let table = $("#dataTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_attendance.php",
        "data": {
          "key": "getAttendance",
        }
      },
      "columns": [
        {data: "student_id"},
        {data: 'student_name'},
        {data: 'course'},
        {
          data: "attendance_status",
          render: function (data, type, row) {
            if(data === "Present"){
              return '<span class="badge badge-success">Present</span>'
            }else{
              return '<span class="badge badge-danger">Absent</span>'
            }
          }
        },
        {data: "attendance_date"}
      ],

      "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ]
    })
  }


</script>
</body>

</html>
