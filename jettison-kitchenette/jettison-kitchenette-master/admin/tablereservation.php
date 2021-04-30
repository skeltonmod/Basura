<?php include "../navbar.php"?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<div class="modal fade" tabindex="-1" role="dialog" id="tableModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><h3>Table Management</h3></div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header"><h6>Manage Seats</h6></div>
                    <div class="card-body">
                        <form id="form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <textarea type="text" class="form-control" id="description" placeholder="Description"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" id="initstatus">
                                            <option value="Available">Available</option>
                                            <option value="Taken">Taken</option>
                                            <option value="Reserved">Reserved</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </form>
                        <button type="button" class="btn btn-primary btn-block" onclick="insertData()">Submit</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<div class="modal fade" tabindex="-1" role="dialog" id="manageTableModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><h3>Table Management</h3></div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header"><h6>Manage Seats</h6></div>
                    <div class="card-body">
                        <form id="managetables">
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-4">
                                        <input type="number" class="form-control" id="tid" placeholder="Table ID">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="tablename" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="fname" placeholder="Customer First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="lname" placeholder="Customer Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" id="updatestatus">
                                            <option value="Available">Available</option>
                                            <option value="Taken">Taken</option>
                                            <option value="Reserved">Reserved</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-block btn-outline-primary" onclick="editData()">Edit Table</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<div class="container my-4">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#tableModal">Add Table</button>
                <button class="btn btn-outline-warning" data-toggle="modal" data-target="#manageTableModal">Manage Table</button>
            </div>
            <div class="card-body">
                <div class="row" id="tablerow">
                    </div>
                </div>

            </div>
        </div>


</body>
<script>
    $(document).ready(function (){
        fetchData()
    })
    function fetchData(){
        $.ajax({
            url:'./server/table_management.php',
            method: 'post',
            dataType: 'text',
            data: {
                key: "fetch"
            },
            success: function (response){
                $('#tablerow').html(response)
            }

        })
    }
    function insertData(){
        let form = $("#form")[0];
        let formdata = new FormData(form);
        formdata.append("key","insert")
        formdata.append("name",$("#name").val())
        formdata.append("status",$("#initstatus").val())
        formdata.append("description",$("#description").val())
       $.ajax({
           url:'./server/table_management.php',
           method: 'post',
           data: formdata,
           processData: false,
           contentType: false,
           dataType: 'text',
           success: function (response){
                alert(response)
           },
       })
   }
    function editData(){
        let form = $("#managetables")[0];
        let formdata = new FormData(form);
        formdata.append("key","edit")
        formdata.append("tid",$("#tid").val())
        formdata.append("name",$("#tablename").val())
        formdata.append("cname",$("#fname").val() +" "+ $("#lname").val())
        formdata.append("status",$("#updatestatus").val())
        $.ajax({
            url:'./server/table_management.php',
            method: 'post',
            data: formdata,
            dataType: 'text',
            processData: false,
            contentType: false,
            success: function (response){
                alert(response)

            }

        })
        fetchData()
    }
</script>
</html>
