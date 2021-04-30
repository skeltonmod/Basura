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

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<div class="modal fade" tabindex="-1" role="dialog" id="menuModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"><h3>Inventory Management</h3></div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header"><h6>Manage Inventory</h6></div>
                    <div class="card-body">
                        <form id="form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" id="name" class="form-control" placeholder="Item Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <textarea type="text" id="description" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" id="stock" class="form-control" placeholder="Stock">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" id="initstatus">
                                            <option value="Available">Available</option>
                                            <option value="Taken">Taken</option>
                                            <option value="Reserved">Reserved</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="number" id="price" class="form-control" placeholder="Price">
                                    </div>
                                </div>

                            </div>
                            <button type="button" class="btn btn-block btn-primary" onclick="insertdata()">Add Menu</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

    <div class="container my-4">
        <div class="card">
            <div class="card-header"><span class="font-weight-bold">Menu</span>
            <button class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#menuModal">Add Menu</button>
            </div>
            <div class="card-body" id="list">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (){
            fetchData();

        })
        function fetchData(){
            $.ajax({
                url:'./server/menu_management.php',
                method: 'post',
                dataType: 'text',
                data: {
                    key: "fetch"
                },
                success: function (response){
                    $('#list').html(response)
                }

            })
        }
        function insertdata(){
            let form = $("#form")[0];
            let formdata = new FormData(form);
            formdata.append("key","insert")
            formdata.append("name",$("#name").val())
            formdata.append("price",$("#price").val())
            formdata.append("stock",$("#stock").val())
            formdata.append("status",$("#initstatus").val())
            formdata.append("description",$("#description").val())
            $.ajax({
                url:'./server/menu_management.php',
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
    </script>
</body>

</html>
