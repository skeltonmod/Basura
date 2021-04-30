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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="headerName"> Name Goes Here </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-row">
                <div class="form-group col-md-4 ">

                  <img src="../img/download.svg" class="rounded mx-auto d-block float-left" width="200" height="200" id="id_image" alt="...">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="lbl_firstname">First Name</label>
                  <input type="text" class="form-control" id="inputFirstname" placeholder="Enter your first name">
                </div>

                <div class="form-group col-md-6">
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline-success" onclick="editData($('#saveChanges').val())" id="saveChanges" value="1" data-dismiss="modal">Save Changes</button>
            <button type="button" class="btn btn-outline-info" data-dismiss="modal">Print ID</button>

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
      <tbody>

      </tbody>
    </table>

  </div>

</div>
<script>
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

  $(document).ready(function () {
    fetchdata()
  })

  function fetchdata() {
    let table = $("#dataTable").DataTable({
      lengthChange: true,
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax": {
        "url": "./server/get_students.php",
        "data": {
          "key": "fetchStudent"
        }
      },
      "columns": [
        {data: 'student_id'},
        {data: 'fname'},
        {data: 'lname'},
        {data: 'course'},
        {
          data: "student_id",
          render: function (data, type, row) {
            return '<button type="button" onclick="showModal(' + data + ')" class="btn btn-outline-info">View</button>' +
              ' <button type="button" onclick="dropStudent(' + data + ')" class="btn btn-outline-warning">Drop</button>'+
              ' <button type="button" onclick="deleteData(' + data + ')" class="btn btn-outline-danger">Delete</button>'
          }
        }
      ],
    });
  }

  function showModal(id) {

    $.ajax({
      url: './server/get_students.php',
      method: 'POST',
      dataType: 'json',
      data: {
        key: "fetchCredentials",
        id: id
      },
      success: function (response) {
        let data = response.data[0];
        $("#headerName").html(data.fname + " " + data.lname);
        firstname.val(data.fname);
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
        $("#saveChanges").val(data.student_id)
      }
    });
    $("#viewModal").modal()
  }

  function deleteData(id) {
    alert("deleting: " + id)
    $.ajax({
      url: './server/delete_data.php',
      method: 'POST',
      dataType: 'text',
      data: {
        key: "deleteStudent",
        id: id
      },
      success: function (response) {
        alert(response)
        $("#dataTable").DataTable().ajax.reload()
      }
    });
  }

  function editData(id){
    let year_level = $("input[name='ylevel']:checked");
    $.ajax({
      url: './server/insertData.php',
      method: 'POST',
      dataType: 'text',
      data: {
        key: "editCredentials",
        id: id,
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

  function dropStudent(id){
    alert("Dropping: " + id)
    $.ajax({
      url: './server/delete_data.php',
      method: 'POST',
      dataType: 'text',
      data: {
        key: "dropStudent",
        id: id
      },
      success: function (response) {
        alert(response)
        $("#dataTable").DataTable().ajax.reload()
      }
    });
  }
</script>
</body>


</html>

