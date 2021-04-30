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
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="headerName"> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        <label for="">Product Information</label>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputProductName" hidden></label>
                                <input type="text" class="form-control" id="inputProductName" placeholder="Product Name" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pcode" hidden></label>
                                <input type="text" class="form-control" id="inputProductCode" placeholder="Product Code" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputStock" hidden></label>
                                <input type="number" class="form-control" id="inputStock" placeholder="Stock" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputDesc" hidden></label>
                                <textarea class="form-control" id="inputDesc" rows="3" cols="10" placeholder="Description " readonly></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPeso" hidden></label>
                                <input type="number" class="form-control position-static " id="inputPeso" placeholder="Peso" readonly>
                            </div>
                        </div>
                        <label>Brand Information</label>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputBrandName" hidden></label>
                                <input type="text" class="form-control position-static " id="inputBrandName" placeholder="Brand Name" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputModelName" hidden></label>
                                <input type="text" class="form-control position-static " id="inputModelName" placeholder="Model Name" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputModelYear" hidden></label>
                                <input type="number" class="form-control position-static " id="inputModelYear" placeholder="Model Year" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="branchSelect">Branch</label>
                                        <select class="custom-select" id="branchSelect">
                                            <option selected value="Carmen">Carmen</option>
                                            <option value="Cogon">Cogon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="quantity" hidden></label>
                                <input type="number" class="form-control position-static " id="quantity" placeholder="Quantity">
                            </div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-block btn-outline-primary" onclick="changeBranch($('#saveChanges').val())">Transfer</button>
                            </div>

                        </div>
                        <button class="btn btn-outline-primary btn-lg btn-block" onclick="insertData($('#saveChanges').val())">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-success" onclick="editData($('#saveChanges').val())" id="saveChanges" value="1" data-dismiss="modal">Save Changes</button>

                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top: 2em">
    <div class="card-header">
      Stock Management
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="stocks" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="add-tab" data-toggle="tab" href="#add_stocks" role="tab" aria-controls="add" aria-selected="true">Add Stocks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="manage-tab" data-toggle="tab" href="#manage_stocks" role="tab" aria-controls="manage">Manage Stocks</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="add_stocks" role="tabpanel" aria-labelledby="add-tab">
                <div class="card" style="margin: 2em">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form id="form">
                            <label for="">Product Information</label>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputProductName" hidden></label>
                                    <input type="text" class="form-control" id="pname" placeholder="Product Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputProductCode" hidden></label>
                                    <input type="text" class="form-control" id="pcode" placeholder="Product Code" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputStock" hidden></label>
                                    <input type="number" class="form-control" id="stock" placeholder="Stock">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDesc" hidden></label>
                                    <textarea class="form-control" id="desc" rows="3" cols="10" placeholder="Description "></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputPeso" hidden></label>
                                    <input type="number" class="form-control position-static " id="peso" placeholder="Peso">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="inputCentavo" hidden></label>
                                    <input type="number" class="form-control position-static " id="centavo" placeholder="Centavo">
                                </div>
                            </div>
                            <label>Brand Information</label>
                            <div class="form-row">

                                <div class="form-group col-md-2">
                                    <label for="inputBrandName" hidden></label>
                                    <input type="text" class="form-control position-static " id="brandname" placeholder="Brand Name">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputModelName" hidden></label>
                                    <input type="text" class="form-control position-static " id="modelname" placeholder="Model Name">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputModelYear" hidden></label>
                                    <input type="number" class="form-control position-static " id="modelyear" placeholder="Model Year">
                                </div>
                            </div>
                            <button class="btn btn-outline-primary btn-lg btn-block" onclick="insertData()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="manage_stocks" role="tabpanel" aria-labelledby="manage-tab">
                <div class="card" style="margin-top: 2em">
                    <div class="card-header">
                        Manage Stocks
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="itemTable">
                            <thead class="thead-dark" style="width: 100%">
                            <th scope="col">#</th>
                            <th scope="col">Product Code</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
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
<script>
  $(document).ready(function () {
    fetchData()
    $("#pcode").val(Math.floor(Math.random() * 999))

    $("#quantity").on('change', function (){
        // do client side subtraction
        let stock = $("#inputStock")
        let remainingStock =   stock.val() - $("#quantity").val()
        stock.val(remainingStock)
        if(stock.val() < 0){
            stock.val(0)
        }
    })
  })


  function insertData(){
    alert("insertdata")
    //file upload
    let formData = new FormData(document.getElementById("form"))
    let productName = $("#pname").val();
    let productCode = $("#pcode").val();
    let stock = $("#stock").val()
    let description = $("#desc").val();
    let price = $("#peso").val() + "."+$("#centavo").val();
    let brandName = $("#brandname").val();
    let modelName = $("#modelname").val();
    let modelYear = $("#modelyear").val();
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
          $("#pcode").val(Math.floor(Math.random() * 999))
        }
      }
    })

  }

  function fetchData(){
      $("#itemTable").DataTable({
          "paging": true,
          "processing": true,
          "serverMethod": "post",
          "ajax":{
              "url": "./server/manage_stock.php",
              "data":{
                  "key":"viewProduct"
              }
          },
          "columns":[
              {data: "product_id"},
              {data: "pcode",
                  render: function (data) {
                      return `<a>ITM-${data}</a>`
                  }},
              {data:"pname"},
              {data:"bname"},
              {data:"branch"},
              {data:"status"},
              {data: "product_id",
                  render: function (data) {
                      return `<button type="button" onclick="showModal(${data})" class="btn btn-outline-info">View</button>` + `
                           <button type="button" onclick="removeEntry(${data})" class="btn btn-outline-danger">Remove</button>`
                  }
              }]
      })
  }

  function showModal(id){
      let productName = $("#inputProductName");
      let productCode = $("#inputProductCode");
      let stock = $("#inputStock");
      let description = $("#inputDesc");
      let price = $("#inputPeso");
      let price2 = $("#inputCentavo")
      let brandName = $("#inputBrandName");
      let modelName = $("#inputModelName");
      let modelYear = $("#inputModelYear");
      $.ajax({
          url: "./server/manage_stock.php",
          method: "POST",
          dataType: 'json',
          data: {
              key: "fetchInformation",
              id: id
          },
          success: function (response) {
              $("#viewModal").modal()
              let data = response.data[0]
              productName.val(data.pname);
              productCode.val(data.pcode);
              stock.val(data.stock);
              price.val(data.price)
              description.val(data.description)
              brandName.val(data.bname)
              modelName.val(data.mname)
              modelYear.val(data.myear)
              $("#saveChanges").val(data.product_id)
          }
      })




  }

  function editData(id){
      let formData = new FormData(document.getElementById("form"))
      let productName = $("#inputProductName").val();
      let productCode = $("#inputProductCode").val();
      let stock = $("#inputStock").val()
      let description = $("#inputDesc").val();
      let price = $("#inputPeso").val() + "."+$("#inputCentavo").val();
      let brandName = $("#inputBrandName").val();
      let modelName = $("#inputModelName").val();
      let modelYear = $("#inputModelYear").val();
      formData.append("key","editItem")
      formData.append("id",id)
      formData.append("pname",productName)
      formData.append("pcode",productCode)
      formData.append("stock",stock)
      formData.append("description",description)
      formData.append("price",price)
      formData.append("bname",brandName)
      formData.append("mname",modelName)
      formData.append("myear",modelYear)
      $.ajax({
          url: './server/manage_stock.php',
          method: 'post',
          dataType: 'text',
          contentType: false,
          processData: false,
          data: formData,
          success: function (response) {
              alert(response)
              $("#itemTable").DataTable().ajax.reload()
          }
      })

  }

  function removeEntry(id){
      $.ajax({
          url: './server/manage_stock.php',
          method: 'post',
          dataType: 'text',
          data: {
              key: "removeProduct",
              id: id,
          },
          success: function (response) {
              alert(response)
              $("#itemTable").DataTable().ajax.reload()
          }
      })

  }

  function changeBranch(id){
        let product_id = Number(Math.floor(Math.random() * 999))
        let formData = new FormData(document.getElementById("form"))
        formData.append("key","changeBranch")
        formData.append("stocks",$("#inputStock").val())
        formData.append("quantity",$("#quantity").val())
        formData.append("branch",$("#branchSelect").val())
        formData.append("id",id)
        formData.append("product_id",$("#inputProductID").val())
        $.ajax({
            url: './server/manage_stock.php',
            method: 'post',
            dataType: 'text',
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                alert(response)
                $("#itemTable").DataTable().ajax.reload()
            }
        })
  }
</script>

</body>
</html>


