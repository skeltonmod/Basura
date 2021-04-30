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

  <h1> Student Details</h1>
  <form id="form" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="lbl_firstname">First Name  <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputFirstname" name="firstname" placeholder="Enter your first name" required>

      </div>
      <div class="form-group col-md-4">
        <label for="lbl_middlename">Middle Name <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputMiddleName" name="middlename" placeholder="Enter your Middlename name" required>

      </div>
      <div class="form-group col-md-4">
        <label for="lbl_lastname">Last Name  <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputLastname" name="lastname" placeholder="Enter your last name" required>
      </div>
    </div>
    <div class="form-group">
      <label for="lbl_email">Email  <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Enter your email" required>
    </div>
    <div class="form-group">
      <label for="lbl_address">Address  <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Street Name" required>

    </div>
    <div class="form-group">
      <label for="lbl_address">Second Address  <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="inputAddress2" name="adress2" placeholder="Apartment, floor or barangay" required>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="lbl_address">City  <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputCity" name="city" required>
      </div>
      <div class="form-group col-md-4">
        <label for="lbl_address">Province  <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputProvince" name="city" required>
      </div>
      <div class="form-group col-md-2">
        <label for="lbl_address">Region  <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputRegion" name="region" required>
      </div>
      <div class="form-group col-md-2">
        <label for="lbl_address">Zip  <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="inputZip" name="zip" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="lbl_address">Birthday  <span style="color: red">*</span></label>
        <input type="date" class="form-control" id="inputBday" name="bday" required>
      </div>
    </div>
    <div class="form-group">
      <label for="lbl_number">Phone Number  <span style="color: red">*</span></label>
      <input type="number" class="form-control" id="inputNumber" placeholder="+639" name="number"  required>
    </div>
    <div class="form-group">
      <label>Year Level:   <span style="color: red">*</span></label>
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input ylevel" id="chkbox1_ylevel" name="ylevel" type="radio" value="1" >
        <label class="custom-control-label" for="chkbox1_ylevel">1</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input ylevel" id="chkbox2_ylevel" name="ylevel" type="radio" value="2">
        <label class="custom-control-label ylevel" for="chkbox2_ylevel">2</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input ylevel" id="chkbox3_ylevel" name="ylevel" type="radio" value="3">
        <label class="custom-control-label" for="chkbox3_ylevel">3</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input ylevel" id="chkbox4_ylevel" name="ylevel" type="radio" value="4">
        <label class="custom-control-label" for="chkbox4_ylevel">4</label>
      </div>
    </div>
    <div class="form-group">
      <label>Semester:   <span style="color: red">*</span></label>
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input" id="chkbox1_sem" name="sem" type="radio" value="1">
        <label class="custom-control-label" for="chkbox1_sem">First</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input class="custom-control-input" id="chkbox2_sem" name="sem" type="radio" value="2">
        <label class="custom-control-label" for="chkbox2_sem">Second</label>
      </div>
    </div>
    <div class="form-group">
      <label for="lbl_course">Course  <span style="color: red">*</span></label>
      <select class="form-control" id="courseSelect">
        <option value="1">BS Information Technology</option>
        <option value="2">BS Computer Science</option>
        <option value="3">BS Computer Engineering</option>
        <option value="4">Assoc Computer Technology</option>
      </select>
    </div>
    <div class="form-group">
      <label for="lbl_id2x2">Add ID Picture  <span style="color: red">*</span></label>
      <input type="file" class="form-control-file" id="frmCtrlFile">
    </div>

    <button type="button" id="submitbtn" class="btn btn-outline-primary btn-lg btn-block"> Submit </button>
  </form>
</div>

<script>
  let formData
  function getDateToday(){
    let today = new Date();
    let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    return date
  }
  function insertData(form) {
    let firstname = $("#inputFirstname").val();
    let middlename = $("#inputMiddleName").val();
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
    let year_level = $("input[name='ylevel']:checked");
    let sem = $("input[name='sem']:checked");
    let course = $("#courseSelect").val();
    let enrollment_date = getDateToday();
    //image upload
    let formData = new FormData(document.getElementById("form"));
    let image_file = $("#frmCtrlFile")[0].files[0]

    formData.append("image_file",image_file)
    formData.append("key","insertStudent")
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
    formData.append("ylevel",year_level.val())
    formData.append("sem",sem.val())
    formData.append("course",course)
    formData.append("enrollment_date",enrollment_date)
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
          $("#courseSelect").val(1);
        }

      })
    }

  }

  $(document).ready(function () {
    $("#submitbtn").on("click",function (e) {
      e.preventDefault()
      insertData()
    })
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
