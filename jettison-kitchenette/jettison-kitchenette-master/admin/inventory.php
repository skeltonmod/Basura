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
<div class="container my-4">
    <div class="modal fade" tabindex="-1" role="dialog" id="inventoryModal">
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
                                            <select class="form-control" id="status">
                                                <option selected>Available</option>
                                                <option>Out of Stock</option>
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
                                <button type="button" class="btn btn-block btn-primary" onclick="insertdata()">Add Inventory</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#inventoryModal">Manage Inventory</button>
        </div>
        <div class="card-body">
            <ul class="list-unstyled" id="list">


            </ul>

        </div>

    </div>

</div>
    <script>
        $(document).ready(function (){
            fetchData()
        })
        function fetchData(){
            $.ajax({
                url:'./server/inventory_management.php',
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
            let formData = new FormData(form);
            formData.append("key","insert");
            formData.append("name",$("#name").val())
            formData.append("status",$("#status").val())
            formData.append("description",$("#description").val())
            formData.append("stock",$("#stock").val())
            formData.append("price",$("#price").val())
            $.ajax({
                url: './server/inventory_management.php',
                method: 'post',
                processData: false,
                contentType: false,
                dataType: 'text',
                data: formData,
                success: function (response){
                    alert(response)
                },

            })

        }
        function deleteData(id){
            $("#list_"+id).remove()
            $.ajax({
                url:'./server/inventory_management.php',
                method: 'post',
                dataType: 'text',
                data:{
                    key: "delete",
                    id: id
                },
                success: function (response){
                    alert(response)
                }
            })
        }
    </script>
</body>

</html>
