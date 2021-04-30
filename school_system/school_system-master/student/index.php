<!doctype html>
<?php include "../navbar.php" ?>
<html class="no-js" lang="">

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
  <div class="card" style="margin-top: 2em">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item"><a class="nav-link active" id="nav-dashboard-tab" data-toggle="tab" role="tab" aria-controls="nav-dashboard" aria-selected="true" href="#dashboard">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link " id="nav-grades-tab" data-toggle="tab" role="tab" aria-controls="nav-grades" aria-selected="false" href="#grades">Grades</a></li>
        <li class="nav-item"><a class="nav-link " id="nav-attendance-tab" data-toggle="tab" role="tab" aria-controls="nav-attendance" aria-selected="false" href="#attendance">Attendance</a></li>
        <li class="nav-item"><a class="nav-link " id="nav-schedule-tab" data-toggle="tab" role="tab" aria-controls="nav-schedules" aria-selected="false" href="#schedule">Schedule</a></li>
      </ul>
    </div>
    <div class="card-body">
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="nav-dashboard-tab">
            <div class="card">
              <div class="card-header" id="status">
                Student Profile
              </div>
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-4 ">

                      <img src="../img/download.svg" class="rounded mx-auto d-block float-left" width="200" height="200" id="id_image" alt="...">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="lbl_firstname">First Name</label>
                      <input type="text" class="form-control" id="inputFirstname" placeholder="Enter your first name">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="lbl_firstname">Middle Name</label>
                      <input type="text" class="form-control" id="inputMiddlename" placeholder="Enter your middle name">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="lbl_lastname">Last Name</label>
                      <input type="text" class="form-control" id="inputLastname" placeholder="Enter your last name">
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="lbl_email">Email</label>
                    <input type="text" class="form-control" id="inputEmail" placeholder="Enter your email">
                  </div>
                  <div class="form-group">
                    <label for="lbl_address">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Street Name">

                  </div>
                  <div class="form-group">
                    <label for="lbl_address">Second Address</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, floor or barangay">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="lbl_address">City</label>
                      <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="lbl_address">Province</label>
                      <input type="text" class="form-control" id="inputProvince">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="lbl_address">Region</label>
                      <input type="text" class="form-control" id="inputRegion">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="lbl_address">Zip</label>
                      <input type="text" class="form-control" id="inputZip">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lbl_address">Birthday</label>
                      <input type="date" class="form-control" id="inputBday">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lbl_number">Phone Number</label>
                    <input type="number" class="form-control" id="inputNumber" placeholder="+639">
                  </div>
                  <div class="form-group">
                    <label>Year Level: </label>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input class="custom-control-input" id="chkbox1" name="ylevel" type="radio" value="1">
                      <label class="custom-control-label" for="chkbox1">1</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input class="custom-control-input" id="chkbox2" name="ylevel" type="radio" value="2">
                      <label class="custom-control-label" for="chkbox2">2</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input class="custom-control-input" id="chkbox3" name="ylevel" type="radio" value="3">
                      <label class="custom-control-label" for="chkbox3">3</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input class="custom-control-input" id="chkbox4" name="ylevel" type="radio" value="4">
                      <label class="custom-control-label" for="chkbox4">4</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lbl_course">Course</label>
                    <select class="form-control" id="courseSelect">
                      <option value="1">BS Information Technology</option>
                      <option value="2">BS Computer Science</option>
                      <option value="3">BS Computer Engineering</option>
                      <option value="4">Assoc Computer Technology</option>
                    </select>
                  </div>
                </form>
                <button type="button" class="btn btn-outline-success float-right" onclick="editData($('#saveChanges').val())" id="saveChanges" value="1" data-dismiss="modal">Save Changes</button>
              </div>
            </div>

          </div>
          <div class="tab-pane fade" id="grades" role="tabpanel" aria-labelledby="nav-grades-tab"><div class="card">
              <div class="card-header">
                View Grade
              </div>
              <div class="card-body">
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
            </div></div>
          <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="nav-attendance-tab">
            <div class="card">
              <div class="card-header">
                Attendance Log
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered" id="attendanceTable">
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
          <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="nav-schedule-tab">
            <div class="card">
              <div class="card-header">
                View Schedule
              </div>
              <div class="card-body">
                <table class="table table-bordered" id="scheduleTable">
                  <thead class="thead-dark" style="width: 100%">
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
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
  </div>

<script>

  function editData(id){
    let year_level = $("input[name='ylevel']:checked");
    let firstname = $("#inputFirstname");
    let lastname = $("#inputLastname");
    let email = $("#inputEmail");
    let address = $("#inputAddress");
    let second_address = $("#inputAddress2");
    let city = $("#inputCity");
    let province = $("#inputProvince");
    let region = $("#inputRegion");
    let zip = $("#inputZip");
    let birthday = $("#inputBday");
    let phone = $("#inputNumber");
    let course = $("#courseSelect");
    let student_id = "<?php echo $_SESSION['id']?>"
    $.ajax({
      url: '../admin/server/insertData.php',
      method: 'POST',
      dataType: 'text',
      data: {
        key: "editCredentials",
        id: student_id,
        usertype: "student",
        fname: firstname.val(),
        lname: lastname.val(),
        address: address.val(),
        second_address: second_address.val(),
        city: city.val(),
        province: province.val(),
        region: region.val(),
        zip: zip.val(),
        bday: birthday.val(),
        number: phone.val(),
        ylevel: year_level.val(),
        course: course.val(),
        email: email.val()
      },
      success: function (response) {
        alert(response)
        $("#dataTable").DataTable().ajax.reload()
      }
    });
  }
  function fetchStudent(){
    let firstname = $("#inputFirstname");
    let middlename = $("#inputMiddlename");
    let lastname = $("#inputLastname");
    let email = $("#inputEmail");
    let address = $("#inputAddress");
    let second_address = $("#inputAddress2");
    let city = $("#inputCity");
    let province = $("#inputProvince");
    let region = $("#inputRegion");
    let zip = $("#inputZip");
    let birthday = $("#inputBday");
    let phone = $("#inputNumber");
    let course = $("#courseSelect");
    let student_id = "<?php echo $_SESSION['id']?>"
    $.ajax({
      url: '../admin/server/get_students.php',
      dataType: 'json',
      method: 'post',
      data:{
        id: student_id,
        key: 'fetchCredentials'
      },
      success: function (response) {
        let data = response.data[0];
        firstname.val(data.fname);
        middlename.val(data.mname);
        lastname.val(data.lname);
        email.val(data.email);
        address.val(data.address)
        second_address.val(data.second_address)
        city.val(data.city)
        province.val(data.province)
        region.val(data.region)
        zip.val(data.zip)
        phone.val(data.phone)
        birthday.val(data.birthday)
        $("input[value='" + data.year_level + "']").prop('checked', true)
        course.val(data.course)
        this.year_level = data.year_level
        if(data.image !== ""){
          $("#id_image").attr("src","../img/"+data.image)
        }else{
          $("#id_image").attr("src","../img/download.svg")
        }

        if(data.status === "Drop"){
          $('#status').append(`<span class="badge badge-danger">Dropped</span>`)
        }

        $("#saveChanges").val(data.student_id);
      }

    })

  }
  function fetchGrade(){
    let student_id = "<?php echo $_SESSION['id']?>"
    let gradetable = $("#gradeTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_grades.php",
        "data":{
          "key": "fetchStudent",
          "student_id":student_id
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

  }
  function fetchSchedule(){
    let student_id = "<?php echo $_SESSION['id']?>"
    let schedule = $("#scheduleTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_schedule.php",
        "data":{
          "key": "getStudentSchedule",
          "id":student_id
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
        {data: 'room_name'}
      ],
    });
  }
  function fetchAttendance(){
    let student_id = "<?php echo $_SESSION['id']?>"
    let table = $("#attendanceTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "../admin/server/get_attendance.php",
        "data": {
          "key": "getStudentAttendance",
          "id":student_id
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
  $(document).ready(function () {
    $.fn.dataTableExt.errMode = 'ignore';
    //fetch the datas
    fetchStudent()
    fetchGrade()
    fetchSchedule()
    fetchAttendance()
  })



</script>

</body>

</html>
