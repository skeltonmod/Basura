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
</head>

<body>
<div class="container">

  <h1> Instructor Details </h1>
  <form id="form">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="lbl_firstname">First Name <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputFirstname" name="firstname" placeholder="Enter your first name">
      </div>
      <div class="form-group col-md-4">
        <label for="lbl_firstname">Middle Name <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputMiddlename" name="middlename" placeholder="Enter your Middle name">
      </div>
      <div class="form-group col-md-4">
        <label for="lbl_lastname">Last Name <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputLastname" name="lastname" placeholder="Enter your last name">
      </div>
    </div>
    <div class="form-group">
      <label for="lbl_email">Email <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Enter your email">
    </div>
    <div class="form-group">
      <label for="lbl_address">Address <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Street Name">

    </div>
    <div class="form-group">
      <label for="lbl_address">Second Address <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="inputAddress2" name="adress2" placeholder="Apartment, floor or barangay">
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="lbl_address">City <span style="color: red">*</span></label>
        <input type="text" class="form-control" name="city" id="inputCity">
      </div>
      <div class="form-group col-md-4">
        <label for="lbl_address">Province <span style="color: red">*</span></label>
        <input type="text" class="form-control" name="province" id="inputProvince">
      </div>
      <div class="form-group col-md-2">
        <label for="lbl_address">Region <span style="color: red">*</span></label>
        <input type="text" class="form-control" name="region" id="inputRegion">
      </div>
      <div class="form-group col-md-2">
        <label for="lbl_address">Zip <span style="color: red">*</span></label>
        <input type="text" class="form-control" name="zip" id="inputZip">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="lbl_address">Birthday <span style="color: red">*</span></label>
        <input type="date" class="form-control" id="inputBday">
      </div>
    </div>
    <div class="form-group">
      <label for="lbl_number">Phone Number <span style="color: red">*</span></label>
      <input type="number" class="form-control" name="number" id="inputNumber" placeholder="+639">
    </div>
    <div class="form-group">
      <label for="lbl_course">Department <span style="color: red">*</span></label>
      <select class="form-control" id="courseSelect">
        <option value="1">BS Information Technology</option>
        <option value="2">BS Computer Science</option>
        <option value="3">BS Computer Engineering</option>
        <option value="4">Assoc Computer Technology</option>
      </select>
    </div>
    <div class="form-group">
      <label for="lbl_id2x2">Add ID Picture <span style="color: red">*</span></label>
      <input type="file" class="form-control-file" id="frmCtrlFile">
    </div>

    <button type="button" onclick="insertData()" class="btn btn-outline-primary btn-lg btn-block"> Submit </button>
  </form>
</div>
<script>
  function insertData() {
    let firstname = $("#inputFirstname").val();
    let middlename = $("#inputMiddlename").val();
    let lastname = $("#inputLastname").val();
    let email = $("#inputEmail").val();
    let address = $("#inputAddress").val();
    let second_address = $("#inputAddress2").val();
    let city = $("#inputCity").val();
    let province = $("#inputProvince").val();
    let region = $("#inputRegion").val();
    let zip = $("#inputZip").val();
    let birthday = $("#inputBday").val();
    let phone = $("#inputNumber").val();
    let department = $("#courseSelect").val();
    let formData = new FormData(document.getElementById("form"));
    let image_file = $("#frmCtrlFile")[0].files[0]
    formData.append("image_file",image_file)
    formData.append("key","insertTeacher")
    formData.append("fname",firstname)
    formData.append("mname",middlename)
    formData.append("lname",lastname)
    formData.append("address",address)
    formData.append("second_address",second_address)
    formData.append("city",city)
    formData.append("province",province)
    formData.append("region",region)
    formData.append("zip",zip)
    formData.append("bday",birthday)
    formData.append("number",phone)
    formData.append("department",department)
    formData.append("email",email)
    if($("#form").valid()){
      $.ajax({
        url: './server/insertData.php',
        method: 'POST',
        dataType:'text',
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
          alert(response)
          $(".form-control").val("");
        }
      });
    }


  }
  $(document).ready(function (){
    $("#form").validate({
    rules:{
      firstname: {
        required: true,
        minlength: 2
      },
      lastname: {
        required: true,
        minlength: 2
      },
      email:{
        email: true,
        required: true
      },
      number:{
        required: true,
        minlength:11,
        maxlength: 11
      },

    },
  })
  })
</script>
</body>


</html>
