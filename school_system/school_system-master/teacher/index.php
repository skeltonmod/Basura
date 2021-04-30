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
</head>

<body>


  <div class="container">
    <div class="card" style="margin-top: 2em; margin-bottom: 2em">
      <div class="card-header">
        Teacher Information
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
            <label for="lbl_course">Course</label>
            <select class="form-control" id="courseSelect">
              <option value="1">BS Information Technology</option>
              <option value="2">BS Computer Science</option>
              <option value="3">BS Computer Engineering</option>
              <option value="4">Assoc Computer Technology</option>
            </select>
          </div>
          <button type="button" class="btn btn-outline-success float-right" onclick="editData($('#saveChanges').val())" id="saveChanges" value="1" data-dismiss="modal">Save Changes</button>

        </form>
      </div>
    </div>
  </div>
<script>
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
    let teacher_id = "<?php echo $_SESSION['id']?>"
    $.ajax({
      url: '../admin/server/get_instructor.php',
      dataType: 'json',
      method: 'post',
      data:{
        id: teacher_id,
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
        phone.val(data.number)
        birthday.val(data.birthday)
        $("input[value='" + data.year_level + "']").prop('checked', true)
        course.val(data.department)
        this.year_level = data.year_level
        if(data.image !== ""){
          $("#id_image").attr("src","../img/"+data.image)
        }else{
          $("#id_image").attr("src","../img/download.svg")
        }
        $("#saveChanges").val(data.student_id);
      }

    })
  }
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
    let teacher_id = "<?php echo $_SESSION['id']?>"
    $.ajax({
      url: '../admin/server/insertData.php',
      method: 'POST',
      dataType: 'text',
      data: {
        key: "editCredentials",
        id: teacher_id,
        usertype: "teacher",
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
        department: course.val(),
        email: email.val()
      },
      success: function (response) {
        alert(response)
      }
    });
  }
  $(document).ready(function () {
    // $.fn.dataTableExt.errMode = 'ignore';
    fetchStudent()
  })

</script>
</body>

</html>
