<?php include "../navbar.php";?>

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
  <div class="card" style="margin-top: 2em">
    <div class="card-header">
      Stock Management
    </div>
    <div class="card-body">
      <form id="form">
        <label for="">Product Information</label>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputProductName" hidden></label>
            <input type="text" class="form-control" id="inputProductName" placeholder="Product Name">
          </div>
          <div class="form-group col-md-4">
            <label for="inputProductCode" hidden></label>
            <input type="text" class="form-control" id="inputProductCode" placeholder="Product Code" readonly>
          </div>
          <div class="form-group col-md-2">
            <label for="inputStock" hidden></label>
            <input type="number" class="form-control" id="inputStock" placeholder="Stock">
          </div>
          <div class="form-group col-md-4">
            <label for="inputDesc" hidden></label>
            <textarea class="form-control" id="inputDesc" rows="3" cols="10" placeholder="Description "></textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="inputPeso" hidden></label>
            <input type="number" class="form-control position-static " id="inputPeso" placeholder="Peso">
          </div>
          <div class="form-group col-md-1">
            <label for="inputCentavo" hidden></label>
            <input type="number" class="form-control position-static " id="inputCentavo" placeholder="Centavo">
          </div>
        </div>
        <label>Brand Information</label>
        <div class="form-row">

          <div class="form-group col-md-2">
            <label for="inputBrandName" hidden></label>
            <input type="text" class="form-control position-static " id="inputBrandName" placeholder="Brand Name">
          </div>
          <div class="form-group col-md-2">
            <label for="inputModelName" hidden></label>
            <input type="text" class="form-control position-static " id="inputModelName" placeholder="Model Name">
          </div>
          <div class="form-group col-md-2">
            <label for="inputModelYear" hidden></label>
            <input type="number" class="form-control position-static " id="inputModelYear" placeholder="Model Year">
          </div>
        </div>
        <button class="btn btn-outline-primary btn-lg btn-block" onclick="insertData()">Submit</button>
      </form>

    </div>
  </div>


</div>
<script>
  $(document).ready(function () {
    let centavo = $("#inputCentavo")
    let peso = $("#inputPeso")

    //limit the number of characters
    if(centavo && peso){
      centavo.keydown(function () {
        if(centavo.val().length > 1){
          centavo.val(centavo.val().substr(0,1))
        }
      })
      peso.keydown(function () {
        if(peso.val().length > 6){
          peso.val(peso.val().substr(0,6))
        }
      })
    }
    $("#inputProductCode").val(Math.floor(Math.random() * 999))
  })


  function insertData(){
    alert("insertdata")
    //file upload
    let formData = new FormData(document.getElementById("form"))
    let productName = $("#inputProductName").val();
    let productCode = $("#inputProductCode").val();
    let stock = $("#inputStock").val()
    let description = $("#inputDesc").val();
    let price = $("#inputPeso").val() + "."+$("#inputCentavo").val();
    let brandName = $("#inputBrandName").val();
    let modelName = $("#inputModelName").val();
    let modelYear = $("#inputModelYear").val();
    formData.append("key","insertProduct")
    formData.append("pname",productName)
    formData.append("pcode",productCode)
    formData.append("stock",stock)
    formData.append("description",description)
    formData.append("price",price)
    formData.append("bname",brandName)
    formData.append("mname",modelName)
    formData.append("myear",modelYear)
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
          $("#inputProductCode").val(Math.floor(Math.random() * 999))
        }
      }
    })

  }

</script>

</body>
</html>


