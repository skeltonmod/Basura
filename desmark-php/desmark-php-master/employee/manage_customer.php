<?php include "../navbar.php"; ?>

<html>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
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
              <div class="form-group col-md-6">
                <label for="inputBday">Birthday</label>
                <input type="date" class="form-control" id="inputBday">
              </div>
            </div>
            <div class="form-group">
              <label for="inputNumber">Phone Number</label>
              <input type="number" class="form-control" id="inputNumber" placeholder="+639">
            </div>
            <div class="form-group">
              <label for="inputOccupation">Occupation</label>
              <input type="text" class="form-control" id="inputOccupation" placeholder="Job Title">
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

  <div class="card" style="margin-top: 3em">
    <div class="card-header">
      Customer Management and Information
    </div>
    <div class="card-body">
      <table class="table table-bordered" id="customerTable">
        <thead class="thead-dark" style="width: 100%">
        <th scope="col">#</th>
        <th scope="col">Account Name</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
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
  function fetchData() {
    let table = $("#customerTable").DataTable({
      "paging": true,
      "processing": true,
      "serverMethod": "post",
      "ajax":{
        "url": "./server/manage_customer.php",
        "data":{
          "key":"viewCustomer"
        }
      },
      "columns":[
        {data: "customer_id"},
        {data: "account_name",
        render: function (data) {
          return `<a>CUST-${data}</a>`
        }},
        {data:"fname"},
        {data:"lname"},
        {data:"status"},
        {data: "customer_id",
        render: function (data) {
          return `<button type="button" onclick="showModal(${data})" class="btn btn-outline-info">View</button>` + `
                <button type="button" onclick="removeEntry(${data})" class="btn btn-outline-danger">Remove</button>`
        }
        }]
    })
  }

  function showModal(id) {
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
    let occupation = $("#inputOccupation");

    $.ajax({
      url: "./server/manage_customer.php",
      method: "POST",
      dataType: 'json',
      data: {
        key: "fetchCredentials",
        id: id
      },
      success: function (response) {
        let data = response.data[0]
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
        occupation.val(data.occupation)
        $("#id_image").attr("src","../customerImage/"+data.image)
        $("#saveChanges").val(data.customer_id)
      }
    })


    $("#viewModal").modal()
  }
  function removeEntry(id){
    $.ajax({
      url: './server/manage_customer.php',
      method: 'post',
      dataType: 'text',
      data: {
        key: "removeCustomer",
        id: id,
      },
      success: function (response) {
        alert(response)
        $("#customerTable").DataTable().ajax.reload()
      }
    })
  }
  function editData(id){
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
    $.ajax({
      url: './server/manage_customer.php',
      method: 'post',
      dataType: 'text',
      data: {
        key: "editCustomer",
        id: id,
        fname: firstname,
        lname: lastname,
        address: address,
        second_address: second_address,
        city: city,
        province: province,
        region: region,
        zip: zip,
        bday: birthday,
        number: phone,
        email: email,
        occupation: occupation,
      },
      success: function (response) {
        alert(response)
        $("#customerTable").DataTable().ajax.reload()
      }
    })
  }
</script>
</body>
</html>
