<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['id'])){
    header('location: login.php');

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:400,700%7CCrete+Round' type='text/css' media='all' />
    <script src="https://use.fontawesome.com/574f62f66e.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/libs/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<?php
include "navbar.php";
$session = $_SESSION['id'];
?>
<body class="single">

<!-- Wrapper Site -->
<div id="main-content">


    <div class="container">
        <div class="row">

            <div class="col-md-3" id="sidebar">

            </div>

            <div class="col-md-9 col-md-offset-3">
                <div class="posts">
                    <div class="posts-inner">
                        <article class="post">
                            <div class="post-header">
                                <h2 class="title"><span>Create Post</span></h2>

                                <!-- End Post Details -->
                            </div>

                            <div class="post-content">
                                <!-- The Content -->
                                <div class="the-excerpt">

                                    <form action="#" method="post" class="contact" style="margin-top: 10px;">
                                        <div class="contact-item">
                                            <label>Title</label>
                                            <input name="author" value="" type="text" id="title">
                                        </div>
                                        <div class="contact-item">
                                            <label>Date</label>
                                            <input name="email" value="" id="date" type="date">
                                        </div>
                                        <div class="contact-item">
                                            <label>Category</label>
                                            <select id="category">
                                                <option value="Travel">Travel</option>
                                                <option value="Mission">Mission</option>
                                                <option value="Church">Church</option>
                                                <option value="Journal">Journal</option>

                                            </select>
                                        </div>
                                        <div class="contact-item">
                                            <label>Content</label>
                                            <textarea name="comment" id="content"></textarea>
                                        </div>
                                        <div class="contact-item form-submit">
                                            <input type="submit" id="submit" class="submit" value="Submit" onclick="insertPost('insert')">
                                        </div>
                                    </form>
                                </div>
                                <!-- End The Content -->
                            </div>

                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Wrapper Site -->
<?php
include "../php/init.php";
?>

<!-- Scripts -->
<script src="../../js/libs/jquery-1.12.4.min.js"></script>
<script src="../../js/libs/masonry.pkgd.min.js"></script>
<script src="../../js/libs/imagesloaded.pkgd.min.js"></script>
<script src="../../js/scripts.js"></script>
<script src="../../js/loadstuff.js"></script>
<!-- End Scripts -->
<script>
    //this was edited
    $("#submit").on('click',function (e) {
       e.preventDefault();
    });
    function insertPost(key){
        //window.alert("handler clicked");
        let title = $("#title");
        let date = $("#date");
        let category = $("#category");
        let content = $("#content");
        let userid = <?php echo $session;?>;
        $.ajax({
            url: "../php/insert.php",
            method: "POST",
            dataType: "text",
            data:{
                key: key,
                title: title.val(),
                date: date.val(),
                category: category.val(),
                content: content.val(),
                userid: userid
            },
            success: function (response) {
                if(response != "success"){
                    window.alert(response);
                }else{
                    window.alert("Post added!");
                    window.location.href = "main.php"
                }
            }

        });

    }


</script>
</body>
</html>