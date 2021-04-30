<?php include "../navbar.php"; ?>

<html lang="en">
<head>

  <meta charset="utf-8">
  <title>Desmark</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
        Employee Detail
      </div>
      <div class="card-body">
        <form id="form" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="accountCode">Employee ID</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><a id="customerId">EMPL-</a></div>
                </div>
                <input type="text" class="form-control" id="accountCode" placeholder="Account Code" readonly>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputFirstname">First Name</label>
              <input type="text" class="form-control" id="inputFirstname" placeholder="Enter your first name">
            </div>
            <div class="form-group col-md-6">
              <label for="inputLastname">Last Name</label>
              <input type="text" class="form-control" id="inputLastname" placeholder="Enter your last name">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="text" class="form-control" id="inputEmail" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Street Name">

          </div>
          <div class="form-group">
            <label for="inputAddress2">Second Address</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, floor or barangay">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">City</label>
              <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
              <label for="inputProvince">Province</label>
              <input type="text" class="form-control" id="inputProvince">
            </div>
            <div class="form-group col-md-2">
              <label for="inputRegion">Region</label>
              <input type="text" class="form-control" id="inputRegion">
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Zip</label>
              <input type="text" class="form-control" id="inputZip">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-2">
              <label for="inputBday">Birthday</label>
              <input type="date" class="form-control" id="inputBday">
            </div>
          </div>
          <div class="form-group">
            <label for="courseSelect">Civil Status</label>
            <select class="form-control" id="civilstatus">
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Divorced">Divorced</option>
              <option value="Widow">Widow</option>
            </select>
          </div>
          <div class="form-group">
            <label for="courseSelect">Gender</label>
            <select class="form-control" id="gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputNumber">Phone Number</label>
            <input type="number" class="form-control" id="inputNumber" placeholder="+639">
          </div>
          <div class="form-group">
            <label for="inputOccupation">Occupation</label>
            <input type="text" class="form-control" id="inputOccupation" placeholder="Job title">
          </div>
          <div class="form-group">
            <label for="courseSelect">Branch</label>
            <select class="form-control" id="branch">
              <option value="Desmark Cogon">Desmark Cogon</option>
              <option value="Desmark Carmen">Desmark Carmen</option>
            </select>
          </div>

          <button type="button" id="submitbtn" onclick="insertData()" class="btn btn-outline-primary btn-lg btn-block"> Submit </button>
        </form>
      </div>
    </div>

  </div>

<script>
  $(document).ready(function () {
    $("#accountCode").val(Math.floor(Math.random() * 100))
  })
  function insertData(){
    alert("insertdata")
    let firstname = $("#inputFirstname").val();
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
    let occupation = $("#inputOccupation").val();
    let accountName = $("#accountCode").val();
    let civil_status = $("#civilstatus").val()
    let gender = $("#gender").val()
    let branch = $("#branch").val()

    //file upload
    let formData = new FormData(document.getElementById("form"))
    formData.append("accountname",accountName)
    formData.append("branch",branch);
    formData.append("gender",gender)
    formData.append("civil_status",civil_status)
    formData.append("key","insertEmployee")
    formData.append("fname",firstname)
    formData.append("lname",lastname)
    formData.append("address",address)
    formData.append("second_address",second_address)
    formData.append("city",city)
    formData.append("province",province)
    formData.append("region",region)
    formData.append("zip",zip)
    formData.append("bday",birthday)
    formData.append("number",phone)
    formData.append("occupation",occupation)
    formData.append("email",email)

    $.ajax({
      url: "./server/insertdata.php",
      method: "post",
      dataType: "text",
      contentType: false,
      processData: false,
      data: formData,
      success: function (response) {
        alert(response)
        if(response === "Success"){
          $(".form-control").val("")
        }
      }
    })

  }
</script>

</body>
</html>
