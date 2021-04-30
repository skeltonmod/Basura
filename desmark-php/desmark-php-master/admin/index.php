<?php include "../navbar.php"?>

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
            <table class="table table-bordered" id="itemTable">
                <thead class="thead-dark" style="width: 100%">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
                <th scope="col">Date</th>
                <th scope="col">Branch</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </body>
    <script>
        function fetchData(){
            $("#itemTable").DataTable({
                "paging": true,
                "processing": true,
                "serverMethod": "post",
                "ajax":{
                    "url": "./server/manage_employee.php",
                    "data":{
                        "key":"getLogs"
                    }
                },
                "columns":[
                    {data: "id"},
                    {data: "name"},
                    {data:"action"},
                    {data:"date"},
                    {data:"branch"},
                    ]
            })
        }
        $(document).ready(function (){
            fetchData();
        })
    </script>
</html>
