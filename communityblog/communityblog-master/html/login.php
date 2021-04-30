<head>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Community</title>
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:400,700%7CCrete+Round' type='text/css' media='all' />
    <script src="https://use.fontawesome.com/574f62f66e.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='../js/libs/jquery-1.12.4.min.js'></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
</head>
<body>
<div class="container" id="page-wrap">
    <?php include "navbar.php"?>
    <section class="content" id="main-content">
        <article class="post">
            <div class="post-header">
                <h2 class="title"><span>Login</span></h2>
            </div>
            <div class="panel panel-login">
                <form method="post" class="form-signin" id="signupForm"style="display: none;" >
                    <div class="form-group">
                        <label class="removable">Firstname</label>
                        <input  value="" class="form-control" type="text" hint="Firstname" id="firstname" name="firstname"><br>
                        <label class="removable">Lastname</label>
                        <input  value="" class="form-control removable" type="text" id="lastname" name="lastname"><br>
                        <label >Username</label>
                        <input  value="" class="form-control " type="text" id="username" name="username"><br>
                        <label>Password</label>
                        <input  value="" class="form-control removable"type="password" id="password" name="password"><br>
                        <label class="removable">Repeat Password</label>
                        <input  value="" class="form-control" type="password" id="repassword" name="repassword"><br>
                        <label class="removable">Email</label>
                        <input  value="" class="form-control removable" type="email" id="email" name="email"><br>
                    </div>
                    <button type="submit" class="btn btn-default" name="btn-save" id="submit">
                        <span class=""></span>   <a id="signup"> Sign In</a>
                    </button>

                </form>

                <form method="post" class="form-signin" id="loginForm" style="display: block;">
                    <div class="form-group">
                        <label >Username</label>
                        <input  value="" class="form-control " type="text" id="susername" name="susername"><br>
                        <label>Password</label>
                        <input  value="" class="form-control removable"type="password" id="spassword" name="spassword"><br>

                    </div>
                    <button  class="btn btn-default" name="btn-save" id="signin">
                        <span class=""><a id="login"> Sign In</a></span>
                    </button>
                </form>
                <div >
                    <div class="col-xs-6">
                        <a href="#" class="login-headers" class="active" id="login-form-link"style="display: inline-block">Login</a>
                        <a href="#" class="login-headers" id="register-form-link"style="display: inline-block">Register</a>
                    </div>
                </div>

            </div>
        </article>
    </section
</div>
</body>

<script>
    //there should be a script here
    function login(){}
    function createaccount(){}


    function createaccount() {
        let key = 'create';
        let firstname = $("#firstname");
        let lastname = $("#lastname");
        let username = $("#username");
        let email = $("#email");
        let password = $("#password");
        let repassword = $("#repassword");

        $.ajax({
            url: "../php/register.php",
            type: 'POST',
            beforeSend: function(response){
                document.getElementById("signup").innerHTML = "Please Wait..."
            },
            data: {
                key:key,
                username: username.val(),
                firstname: firstname.val(),
                lastname: lastname.val(),
                email: email.val(),
                password: password.val(),
            },
            success: function (response) {
                if(response == 'success'){
                    window.alert("User Created!");
                    firstname.val("");
                    lastname.val("");
                    username.val("");
                    password.val("");
                    repassword.val("");
                    email.val("");
                    window.location.href = "login.php";
                }else{
                    window.alert(response);
                }
            }
        });
    }

    function login(){
        let key = 'login';
        let username = $("#susername");
        let password = $("#spassword");
        $.ajax({
            method: "POST",
            url:"../php/login.php",
            beforeSend: function(response){
                document.getElementById("login").innerHTML = "Loading!"
            },
            data: {
                key: key,
                username: username.val(),
                password: password.val(),
            },
            cache: false,
            success: function (response) {
                if(response == 1){
                    window.alert("Login Successful");
                    window.location.href = "index.php";
                }else {
                    window.alert("Login Failed!");
                }
            }
        })
    }
    $(document).ready(function () {
        $("#loginForm").validate({
            rules:{
                spassword: {required: true}, susername:{required: true},
            },
            messages:{
                spassword: {required:"Please Enter a Password!"},
                susername: {required:"Please Enter a Username!"},
            },
            submitHandler: login

        });


        $("#signupForm").validate({
            rules:{
                firstname:{required: true},
                lastname: {required: true},
                username:{
                    required: true,
                    minlength: 2,
                    maxlength: 15,
                },
                password:{
                    required: true,
                    minlength: 2
                },
                repassword:{
                    required: true,
                    minlength: 2,
                    equalTo: "#password"
                },
                email:{
                    required: true,
                    email: true
                },
            },
            messages:{
                firstname: {required:"You must enter your firstname"},
                lastname:{required:"You must enter your lastname"},
                username: {
                    required:"You must enter a username",
                    minlength: "Your username must consist of 6 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters"
                },
                repassword: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters",
                    equalTo: "Password does not match"
                },
                email:{
                    required: "Please enter an Email",
                    email: "Please provide a valid email address"
                }

            },
            submitHandler: createaccount
        });

        $('#login-form-link').click(function(e) {
            $("#loginForm").delay(100).fadeIn(100);
            $("#signupForm").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(".title").text("Login")
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
            $("#signupForm").delay(100).fadeIn(100);
            $("#loginForm").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(".title").text("Register")
            $(this).addClass('active');

            e.preventDefault();
        });
    });
</script>
