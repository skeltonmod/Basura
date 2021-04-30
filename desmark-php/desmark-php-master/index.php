<?php include "navbar.php";
if(isset($_SESSION['user_type'])){
    header("Location: ".DIRECTORY_SEPARATOR."desmark-php". DIRECTORY_SEPARATOR .mb_strtolower($_SESSION['user_type']).DIRECTORY_SEPARATOR);
}?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/main.css">
  <script src="./js/vendor/modernizr-3.11.2.min.js"></script>
  <script src="./js/plugins.js"></script>
  <script src="./js/main.js"></script>

</head>


<body>
<div class="container">
  <div class="card" style="margin-top: 30px;">
    <div class="card-header text-center">
      <span>Login <?php echo @$_SESSION['user_type']?></span>
</div>
<div class="card-body">
    <form>
        <div class="form-group">
            <label for="emailAddress">Email</label>
            <input type="email" class="form-control" id="emailAddress" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="passwordInput">Password</label>
            <input type="password" class="form-control" id="passwordInput" placeholder="Password">
        </div>
        <button id="login" type="submit" class="btn btn-block btn-outline-primary" style="margin-top: 1.3rem">Login</button>
    </form>
</div>
</div>

</div>


<script>



    function getDate(){
        let today = new Date();
        return today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    }
    $('form').on("submit",function (e) {
        e.preventDefault()
        let email = $("#emailAddress").val();
        let password = $("#passwordInput").val()
        let getDay = getDate();
        $.ajax({
            url: './admin/server/credentials.php',
            method: 'post',
            dataType: 'json',
            data:{
                email: email,
                password: password,
                date: getDay,
                key: 'login'
            },
            success: function (response) {
                if(response.user_type !== "null"){
                    window.location.href = "./"+(response.user_type).toString().toLowerCase()
                }else {
                    alert("No such account exist")
                }
            }

        })
    })
</script>
</body>

</html>
