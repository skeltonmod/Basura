<?php
session_start();
$current_file = getcwd();
if ($current_file == dirname(__FILE__) . DIRECTORY_SEPARATOR . "admin" && @$_SESSION['user_type'] != 'admin') {
    header("Location:../404.html");
} elseif ($current_file == dirname(__FILE__) . DIRECTORY_SEPARATOR . "employee" && @$_SESSION['user_type'] != 'employee') {
    header("Location:../404.html");
} elseif ($current_file == dirname(__FILE__) . DIRECTORY_SEPARATOR . "owner" && @$_SESSION['user_type'] != 'owner') {
    header("Location:../404.html");
}
$filepath = "..".DIRECTORY_SEPARATOR."index.php";
?>
<html lang="en">
<head>
    <title><?php echo @$_SESSION['branch']?></title>
  <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
        function logout(){
            $.ajax({
                url:'../admin/server/credentials.php',
                dataType: 'text',
                method: 'post',
                data:{
                    key: 'logout'
                },
                success: function (response) {
                    window.location.href = "../index.php"
                }
            })

        }

    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-primary" style="background-color: #e3f2fd;">
  <a>Desmark</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!--- static navbar links for now --->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php
        if(isset($_SESSION['user_type']) && isset($_SESSION['id'])){
            if($_SESSION['user_type'] === 'owner'){
                echo '<li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span> </a>
                      </li>';
                echo '<li class="nav-item">
                  <a class="nav-link" href="#" onclick="logout()">Logout <span class="sr-only"></span></a>
                </li>';

            }

            else if($current_file == dirname(__FILE__).DIRECTORY_SEPARATOR.mb_strtolower($_SESSION['user_type'])){
                echo '<li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span> </a>
                      </li>';
                echo '<li class="nav-item">
                  <a class="nav-link" href="#" onclick="logout()">Logout <span class="sr-only"></span></a>
                </li>';

                echo '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Customer
            </a>
            <div class="dropdown-menu" aria-labelledby="customerDropdown">
                <a class="dropdown-item" href="add_customer.php">Add Customer</a>
                <a class="dropdown-item" href="manage_customer.php">View/Edit Customer</a>
            </div>
        </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Transaction
        </a>
        <div class="dropdown-menu" aria-labelledby="customerDropdown">
          <a class="dropdown-item" href="add_transaction.php">Add Transaction</a>
          <a class="dropdown-item" href="add_transaction_repo.php">Add Transaction Repo</a>
          <a class="dropdown-item" href="manage_transaction.php">View/Edit Transactions</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventory
        </a>
         <div class="dropdown-menu" aria-labelledby="customerDropdown">
          <a class="dropdown-item" href="manage_stock.php">View/Edit Stock</a>
          <a class="dropdown-item" href="add_stock.php">Add Stock</a>
        </div>
      </li>';

            }
        } ?>

        <?php
        if(isset($_SESSION['user_type']) && isset($_SESSION['id'])){
            if($_SESSION['user_type'] === 'admin'){
                echo '<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Employee
        </a>
        <div class="dropdown-menu" aria-labelledby="customerDropdown">
          <a class="dropdown-item" href="add_employee.php">Add Employee</a>
          <a class="dropdown-item" href="manage_employee.php">View/Edit Employee</a>
        </div>
      </li>
      ';
            }

        }
        ?>

    </ul>
  </div>
</nav>


</body>




</html>
