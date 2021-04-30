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

 <div class="container" style="margin-top: 2em">
   <div class="modal fade" id="getEmployee" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           Get Employee
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="card">
             <div class="card-header"></div>
             <div class="card-body">
               <table class="table table-bordered" id="employeeTable">
                 <thead class="thead-dark" style="width: 100%">
                 <th scope="col">#</th>
                 <th scope="col">Employee ID</th>
                 <th scope="col">First Name</th>
                 <th scope="col">Last Name</th>
                 <th scope="col">Action</th>
                 </thead>
                 <tbody>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>
   <div class="modal fade" id="getCustomer" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
            <div class="card">
              <div class="card-header"></div>
              <div class="card-body">
                <table class="table table-bordered" id="customerTable">
                  <thead class="thead-dark" style="width: 100%">
                  <th scope="col">#</th>
                  <th scope="col">Account Name</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Action</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>

              </div>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>
   <div class="modal fade" id="getProduct" tabindex="-1" role="dialog" aria-labelledby="modalScroll" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           Get Product
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="card" style="margin-top: 2em">
             <div class="card-header">
             </div>
             <div class="card-body">
               <table class="table table-bordered" id="itemTable">
                 <thead class="thead-dark" style="width: 100%">
                 <th scope="col">#</th>
                 <th scope="col">Product Code</th>
                 <th scope="col">Product Name</th>
                 <th scope="col">Price</th>
                 <th scope="col">Action</th>
                 </thead>
                 <tbody>

                 </tbody>
               </table>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>

   <div class="card">
      <div class="card-header">
        Repo Transactions
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="transacts" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="installment-tab" data-toggle="tab" href="#installment" role="tab" aria-controls="installment" aria-selected="true">Installment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="full-tab" data-toggle="tab" href="#full" role="tab" aria-controls="full" aria-selected="true">Full Payment</a>
          </li>
        </ul>

        <div class="tab-content" style="margin: 2em">
          <div class="tab-pane fade show active" id="installment" role="tabpanel" aria-labelledby="installment-tab">
            <div class="card installment">
              <div class="card-header">Installment Plan</div>
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
                    <div class="form-group col-md-2">
                      <input type="text" class="form-control" id="inputEmployeeID" placeholder="Employee Roll #" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputEmployeeName" placeholder="Employee Name" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <button type="button" class="btn btn-outline-warning" onclick="showModal('#getEmployee')">Get Employee</button>
                    </div>
                  </div>
                  <label>Customer Information</label>
                  <div class="form-row">
                    <div class="form-group col-md-2">
                      <input type="text" class="form-control" id="inputCustomerID" placeholder="Customer Roll #" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputCustomerName" placeholder="Customer Name" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <button class="btn btn-outline-warning" type="button" onclick="showModal('#getCustomer')">Get Customer</button>
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
                    <div class="form-group col-md-4">
                      <button class="btn btn-outline-warning" type="button" onclick="showModal('#getProduct')">Get Product</button>
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
                    <div class="form-group col-md-2">
                      <input type="number" class="form-control cashinput" id="inputDownPayment" placeholder="Downpayment">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="number" class="form-control" id="inputTotalPaid" placeholder="Total Amount with Interest" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="number" class="form-control" id="inputMonthlyAmount" placeholder="Monthly Amount with Interest" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <input type="date" class="form-control" id="inputDueDate" placeholder="Due Date">
                    </div>
                  </div>

                  <button type="button" class="btn btn-outline-primary btn-block" onclick="insertData('installment')"> Submit</button>
                </form>
              </div>
            </div>

          </div>
          <div class="tab-pane fade" id="full" role="tabpanel" aria-labelledby="full-tab">
            <div class="card full">
              <div class="card-header">Full Payment Plan</div>
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
                    <div class="form-group col-md-2">
                      <input type="text" class="form-control" id="inputEmployeeID" placeholder="Employee Roll #" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputEmployeeName" placeholder="Employee Name" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <button type="button" class="btn btn-outline-warning" onclick="showModal('#getEmployee')">Get Employee</button>
                    </div>
                  </div>
                  <label>Customer Information</label>
                  <div class="form-row">
                    <div class="form-group col-md-2">
                      <input type="text" class="form-control" id="inputCustomerID" placeholder="Customer Roll #" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputCustomerName" placeholder="Customer Name" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <button class="btn btn-outline-warning" type="button" onclick="showModal('#getCustomer')">Get Customer</button>
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
                    <div class="form-group col-md-4">
                      <button class="btn btn-outline-warning" type="button" onclick="showModal('#getProduct')">Get Product</button>
                    </div>
                  </div>
                  <label>Payment Information</label>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="number" class="form-control cashinput" id="inputInitialAmount" placeholder="Initial Amount" readonly>
                    </div>
                  </div>

                  <button type="button" class="btn btn-outline-primary btn-block" onclick="insertData('full')"> Submit</button>
                </form>

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
 </div>
  <script>
    let full_tab
    let installment_tab

    $("#installment-tab").on("click",function (e) {
      e.preventDefault()
      let element = $(".full")[0]
      full_tab = element
      full_tab.parentNode.removeChild(element)
      $("#installment").append(installment_tab)
    })

    $("#full-tab").on("click",function (e) {
      e.preventDefault()
      let element = $(".installment")[0]
      installment_tab = element
      installment_tab.parentNode.removeChild(element)
      $("#full").append(full_tab)
      $("#inputTransactionID").val(Math.floor(Math.random() * 999))
      $("#inputDate").val(getDate())
    })


    $(document).ready(function () {
      $("#inputTransactionID").val(Math.floor(Math.random() * 999))
      $("#inputDate").val(getDate())
    })
    function getDate(){
      let today = new Date().toISOString().slice(0,10)
      return today
    }

    $('.modal').on("hide.bs.modal",function (e) {
      $('.table').DataTable().destroy()
    })


    function showModal(modal){
      $(modal).modal()

      switch (modal) {
        case "#getEmployee":
          fetchEmployees()
          break;
        case "#getCustomer":
          fetchCustomer()
          break;
        case "#getProduct":
          fetchStock()
          break;
      }

    }

    function fetchEmployees(){
      $("#employeeTable").DataTable({
        "paging": true,
        "processing": true,
        "serverMethod": "post",
        "ajax":{
          "url": "./server/manage_employee.php",
          "data":{
            "key":"viewEmployee"
          }
        },
        "columns":[
          {data: "rollnum"},
          {data: "employee_id",
            render: function (data) {
              return `<a>CUST-${data}</a>`
            }},
          {data:"fname"},
          {data:"lname"},
          {data: "rollnum",
            render: function (data) {
              return `<button type="button" onclick="assign(${data},'employee')" class="btn btn-outline-info">Assign</button>`
            }
          }]
      })
    }
    function fetchCustomer(){
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
          {data: "customer_id",
            render: function (data) {
              return `<button type="button" onclick="assign(${data},'customer')" class="btn btn-outline-info">Assign</button>`
            }
          }]
      })
    }
    function fetchStock(){
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
          {data:"price"},
          {data: "product_id",
            render: function (data) {
              return `<button type="button" onclick="assign(${data},'stock')" class="btn btn-outline-info">View</button>`
            }
          }]
      })
    }
    function assign(id,type){
      let key = ""
      if(type === 'employee' || type === 'customer'){
        key = "fetchCredentials"
      }else{
        key = "fetchInformation"
      }
      $.ajax({
        url: `./server/manage_${type}.php`,
        method: 'post',
        dataType:'json',
        data:{
          id: id,
          key: key
        },
        success: function (response) {
          let data = response.data[0]
          switch (type) {
            case "employee":
              $("#inputEmployeeID").val(data.rollnum)
              $("#inputEmployeeName").val(data.fname + " " + data.lname)
              break;
            case "customer":
              $("#inputCustomerID").val(data.customer_id)
              $("#inputCustomerName").val(data.fname + " " + data.lname)
              break;

            case "stock":
              $("#inputProductID").val(data.product_id)
              $("#inputProductName").val(data.pname)
              $("#inputProductPrice").val(data.price)
              $("#inputInitialAmount").val(data.price)
              $(".cashinput").trigger("input")
              break;
          }
        }
      })

    }

    function insertData(type){
      let formData = new FormData(document.getElementById("form"))
      let transactionID = $("#inputTransactionID").val()
      let transactiondate = $("#inputDate").val()
      let employee_id = $("#inputEmployeeID").val()
      let customer_id = $("#inputCustomerID").val()
      let product_id = $("#inputProductID").val()
      let loaninterest = $("#inputLoanInterest").val()
      let amount = $("#inputInitialAmount").val()
      let downpayment = $("#inputDownPayment").val()
      let termofpayment = $("#inputTOP").val()
      let totalpaid = $("#inputTotalPaid").val()
      let monthlyamount = $("#inputMonthlyAmount").val()
      let duedate = $("#inputDueDate").val()
      formData.append("key","insertTransaction")
      formData.append("type",type)
      formData.append("tid",transactionID)
      formData.append("tdate",transactiondate)
      formData.append("cid",customer_id)
      formData.append("eid",employee_id)
      formData.append("pid",product_id)
      formData.append("loaninterest",loaninterest)
      formData.append("amount",amount)
      formData.append("downpayment",downpayment)
      formData.append("top",termofpayment)
      formData.append("tp",totalpaid)
      formData.append("mp",monthlyamount)
      formData.append("dd",duedate)
      formData.append("status","Repo")

      $.ajax({
        url:"./server/insertdata.php",
        method: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
          if(response === "Success"){
            $('.form-control').val("")
            $("#inputTransactionID").val(Math.floor(Math.random() * 999))
            $("#inputLoanInterest").val(10)
            $("#inputDate").val(getDate())
            $("#inputTOP").val(1)
          }
        }
      })
    }



    // loan calculation
    $(".cashinput").on("input",function () {
      let amount = Number($("#inputInitialAmount").val())
      let interest = $("#inputLoanInterest").val()
      let termofpayment = $("#inputTOP").val()
      let downpayment = $("#inputDownPayment").val()
      let yearlyInterest = Number((amount * interest * termofpayment) /100)

      let total = amount + yearlyInterest - downpayment
      let emi = (amount + yearlyInterest)/(termofpayment * 12)
      if(total <= 0){
        $("#inputTotalPaid").val(Number(0).toFixed(2));
        $("#inputMonthlyAmount").val(Number(0).toFixed(2));
      }else{
        $("#inputTotalPaid").val(Number(total).toFixed(2))
        $("#inputMonthlyAmount").val(emi.toFixed(2))
      }
    })
  </script>
</body>
</html>
