<?php include "../navbar.php"?>

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
</head>
<body>
<div class="container">
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="headerName"> Name Goes Here </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
              <form id="form">
                <label>Transaction Information</label>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">TRANS-</div>
                      </div>
                      <input type="text" class="form-control" id="inputTransactionID" placeholder="Transaction ID" readonly>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="date" class="form-control" id="inputDate" readonly>
                  </div>
                </div>
                <label>Employee Information</label>
                <div class="form-row">

                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="inputEmployeeName" placeholder="Employee Name" readonly>
                  </div>
                </div>
                <label>Customer Information</label>
                <div class="form-row">

                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="inputCustomerName" placeholder="Customer Name" readonly>
                  </div>
                </div>

                <label>Product Information</label>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputProductID" placeholder="Product Roll #" readonly>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="inputProductName" placeholder="Product Name" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <input type="number" class="form-control" id="inputProductPrice" placeholder="Product Price" readonly>
                  </div>
                </div>
                <label>Payment Information</label>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <input type="number" class="form-control" id="inputLoanInterest" placeholder="Loan Interest (per year)" value="10">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control cashinput" id="inputInitialAmount" placeholder="Initial Amount" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <input type="number" class="form-control cashinput" id="inputTOP" placeholder="Term of Payment per year" value="1">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control" id="inputTotalPaid" placeholder="Previous Balance" readonly>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control" id="inputCurrentPaid" placeholder="Current Balance" readonly>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control" id="inputMonthlyAmount" placeholder="Monthly Amount with Interest" readonly>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control" id="inputPenalty" placeholder="Penalty" readonly>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="date" class="form-control" id="inputDueDate" placeholder="Due Date">
                  </div>
                </div>

              </form>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-success" onclick="editData($('#saveChanges').val())" id="saveChanges" value="1" data-dismiss="modal">Submit</button>

        </div>
      </div>
    </div>
  </div>

  <div class="card" style="margin-top: 2em">
    <div class="card-header">Pending Transactions</div>
    <div class="card-body">
      <table class="table table-bordered" id="transactionTable">
        <thead class="thead-dark" style="width: 100%">
        <th scope="col">#</th>
        <th scope="col">Transaction ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Employee Name</th>
        <th scope="col">Balance</th>
        <th scope="col">Status</th>
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
  <script>
    $(document).ready(function () {
      fetchData()
    })

    function fetchData(){
      let table = $("#transactionTable").DataTable({
        "paging": true,
        "processing": true,
        "serverMethod": "post",
        "ajax":{
          "url": "./server/manage_transaction.php",
          "data":{
            "key":"fetchData"
          }
        },
        "columns":[
          {data: "rollnum"},
          {data: "transaction_id"},
          {data:"customer_name"},
          {data:"employee_name"},
          {data:"balance"},
          {data:"type"},
          {data:"branch"},
          {data:"status"},
          {data: "rollnum",
            render: function (data) {
              return `<button type="button" onclick="showModal(${data})" class="btn btn-outline-info">View</button>`
            }
          }]
      })
    }
    function getDate(){
      let today = new Date().toISOString().slice(0,10)
      return today
    }

    function showModal(id){
      $.ajax({
        url: "./server/manage_transaction.php",
        method: 'post',
        dataType: 'json',
        data:{
          id: id,
          key: "viewTransaction"
        },
        success: function (response) {
          let data = response.data[0]
          $("#inputTransactionID").val(data.tid)
          $("#inputDate").val(getDate())
          $("#inputEmployeeName").val(data.employee_name)
          $("#inputCustomerName").val(data.customer_name)
          $("#inputProductID").val(data.product_id)
          $("#inputProductName").val(data.pname)
          $("#inputProductPrice").val(data.price)
          $("#inputTotalPaid").val(data.tp)
          $("#inputMonthlyAmount").val(data.mp)
          $("#inputDueDate").val(data.dd)
          $("#saveChanges").val(data.rollnum)
          $("#editBtn").val(data.rollnum)
          $("#inputCurrentPaid").val(data.tp)
          $(".cashinput").trigger("input")
        }
      })
      $("#viewModal").modal()

    }

    function getPenalty(date1,date2){
        let dt1 = new Date(date1);
        let dt2 = new Date(date2);
       return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24))
    }

    $(".cashinput").on("input",function () {
      let amount = Number($("#inputInitialAmount").val())
      let interest = $("#inputLoanInterest").val()
      let termofpayment = $("#inputTOP").val()
      let currentBalance = $("#inputTotalPaid").val()
      let yearlyInterest = Number((amount * interest * termofpayment) /100)
      let penaltydate = $("#inputDueDate")
      let penaltypay = $("#inputPenalty").val()
      let total = currentBalance + yearlyInterest
      let emi = total/(termofpayment * 12)

      if(penaltydate.val() > getDate()){
        $("#inputPenalty").val(Number(0))
        $("#inputCurrentPaid").val(Number(currentBalance).toFixed(2))
        $("#inputCurrentPaid").val(Number(currentBalance  - amount).toFixed(2))
      }else{
        $("#inputCurrentPaid").val(Number(currentBalance  - amount).toFixed(2))
      }



    })

    function editData(id){
      alert(id)
      let formData = new FormData(document.getElementById("form"))
      let totalpaid = $("#inputCurrentPaid").val()
      let amount = $("#inputInitialAmount").val()
      let transactionDate = $("#inputDate").val()
      let transactionID = $("#inputTransactionID").val()

      formData.append("key","editTransaction")
      formData.append("id",id)
      formData.append("amount",amount)
      formData.append('tp',totalpaid)
      formData.append("tdate",transactionDate)
      formData.append("tid",transactionID)
      $.ajax({
        url: './server/manage_transaction.php',
        method: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
          if(response === "Success"){
            $("#transactionTable").DataTable().ajax.reload()

          }
        }
      })
    }

  </script>

</body>
</html>
