<?php include "navbar.php";
if(isset($_SESSION['user_type'])){
  header("Location: ".DIRECTORY_SEPARATOR."school_system". DIRECTORY_SEPARATOR .mb_strtolower($_SESSION['user_type']).DIRECTORY_SEPARATOR);
}?>
<html>
<head>
  <meta charset="utf-8">
  <title>Mulondo NHS</title>
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
    <form id="form">
      <div class="form-group">
        <label for="emailAddress">Email</label>
        <input type="email" class="form-control" id="emailAddress" name="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password">
        <a href="#" onclick="forgotpass()">Forgot Password</a>
      </div>
      <button id="login" type="submit" class="btn btn-block btn-outline-primary" style="margin-top: 1.3rem">Login</button>
    </form>
  </div>
  </div>

</div>


<script>
  $(document).ready(function (){

  })
  $('form').on("submit",function (e) {
    $("#form").validate({
      rules:{
        email: {
          required:true,
          email: true
        },
        password: {
          required: true,
        }
      }

    })
    e.preventDefault()
    let email = $("#emailAddress").val();
    let password = $("#passwordInput").val()
    if($("#form").valid()){
      $.ajax({
        url: './admin/server/credentials.php',
        method: 'post',
        dataType: 'json',
        data:{
          email: email,
          password: password,
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
    }
  })
  function forgotpass(){
    $("#form").validate({
      rules:{
        email: {
          required:true,
          email: true
        },
      }

    })
    let email = $("#emailAddress").val();
    if($("#form").valid()){
      $.ajax({
        url: './admin/server/credentials.php',
        method: 'post',
        dataType: 'text',
        data:{
          email: email,
          key: 'forgotPass'
        },
        success: function (response) {
          alert("Please Check your Email!")
        }

      })
    }
  }

</script>
</body>

</html>

