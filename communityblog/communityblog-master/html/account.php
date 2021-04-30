<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up or Register</title>
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:400,700%7CCrete+Round' type='text/css' media='all' />
    <script src="https://use.fontawesome.com/574f62f66e.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/libs/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">


</head>
<?php
session_start();
include "navbar.php";
?>
<body class="single">
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-3">
                <div class="posts">
                    <div class="posts-inner">
                        <article class="post">
                            <div class="post-header">
                                <h2 class="title"><span>Login</span></h2>
                            </div>
                            <div class="post-content">
                                <div class="the-excerpt">
                                    <div id="error">
                                    </div>
                                    <div class="panel panel-login">
                                        <div class="panel-heading">
                                            <div class="col-xs-6">
                                                <a href="#" class="active" id="login-form-link">Login</a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="#" id="register-form-link">Register</a>
                                            </div>
                                            <hr>
                                        </div>
                                        <form method="post" class="form-signin" id="signupForm"style="display: none;" >
                                            <div class="form-group">
                                                <label class="removable">Firstname</label>
                                                <input  value="" class="form-control" type="text" hint="Firstname" id="firstname" name="firstname"><br>
                                                <label class="removable">Lastname</label>
                                                <input  value="" class="form-control removable" type="text" id="lastname" name="lastname"><br>
                                            </div>
                                            <div class="form-group">
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
                                                <span class=""></span>   Create Account
                                            </button>


                                        </form>
                                        <form method="post" class="form-signin" id="loginForm" style="display: block;">
                                                <div class="form-group">
                                                    <label >Username</label>
                                                    <input  value="" class="form-control " type="text" id="susername" name="susername"><br>
                                                </div>
                                                <div class="form-group">

                                                    <label>Password</label>
                                                    <input  value="" class="form-control removable"type="password" id="spassword" name="spassword"><br>

                                                </div>
                                                <button  class="btn btn-default" name="btn-save" id="signin">
                                                <span class=""></span>   Sign In
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src="../js/libs/masonry.pkgd.min.js"></script>
<script src="../js/libs/imagesloaded.pkgd.min.js"></script>
<script src="../js/scripts.js"></script>
<script>


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
            data: {
                key: key,
                username: username.val(),
                password: password.val(),
            },
            cache: false,
            success: function (response) {
                if(response == 1){
                    window.alert("Login Successful");
                    window.location.href = "main.php";
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

        $("#username").focus(function () {
            let firstname = $("#firstname");
            let lastname = $("#lastname");
            let username = $("#username");

            if(firstname.length && lastname.length){
                username.val(firstname.val()+"."+lastname.val());
            }
        })

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

</body>
</html>
