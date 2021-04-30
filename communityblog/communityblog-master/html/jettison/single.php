
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" href="images/favicon.png" sizes="32x32" />
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:400,700%7CCrete+Round' type='text/css' media='all' />
    <script src="https://use.fontawesome.com/574f62f66e.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/libs/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/libs/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<?php
    session_start();
 include "navbar.php";
?>
<body class="single">

<!-- Wrapper Site -->
<div id="main-content">

    <!-- Preload -->
    <div id="preload">
        <div class="kd-bounce">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preload -->

    <div class="container">
        <div class="row">

            <div class="col-md-3" id="sidebar">
            </div>

            <div class="col-md-9 col-md-offset-3">
                <div class="posts">
                    <div class="posts-inner">
                        <article class="post">
                            <div class="post-header">
                                <h2 class="title" id="title"><span>$title</span></h2>

                                <!-- Post Details -->
                                <div class="post-details">
                                    <div class="post-cat">
                                        <a href="#" id="category">$category</a>
                                    </div>
                                    <a href="#" class="post-date" id="date"><span>$date</span></a>
                                </div>
                                <!-- End Post Details -->
                            </div>
                            <div class="post-content">

                                <!-- The Content -->
                                <div class="the-excerpt" id="content">
                                    $content
                                </div>
                            </div>
                            <div class="post-author">
                                Written by  <a id="author">{Placeholder}</a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Wrapper Site -->

<!-- Footer -->
<footer id="footer" class="footer">
</footer>
<!-- End Footer -->

<!-- Scripts -->

<script src="../../js/libs/jquery-1.12.4.min.js"></script>
<script src="../../js/libs/masonry.pkgd.min.js"></script>
<script src="../../js/libs/imagesloaded.pkgd.min.js"></script>
<script src="../../js/scripts.js"></script>
<script src="../../js/loadstuff.js"></script>
<script>
    $(document).ready(function () {
        var id = localStorage.getItem("postid");
        var getid = gethash();
        viewpost(getid);
    });

    function gethash() {
        var x = location.hash;
        var string = x.split("#")[1];
        return string;
    }

    function viewpost(id) {
        $.ajax({
            url: "../php/viewpost.php",
            method: "POST",
            dataType: "json",
            data:{
              id: id
            },
            success: function (response) {
                document.title = response.title;
                document.getElementById("category").innerHTML = response.category;
                document.getElementById("title").innerHTML = response.title;
                document.getElementById("content").innerHTML = response.content;
                document.getElementById("date").innerHTML = response.date;
                document.getElementById("author").innerHTML = response.fname + " "+response.lname;
            }
        });
    }

</script>
<!-- End Scripts -->
</body>
</html>