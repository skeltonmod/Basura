<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['id'])){
    header('location: account.php');

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:400,700%7CCrete+Round' type='text/css'
          media='all'/>
    <script src="https://use.fontawesome.com/574f62f66e.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/libs/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <script src="../js/libs/jquery-1.12.4.min.js"></script>
    <script src="../js/libs/masonry.pkgd.min.js"></script>
    <script src="../js/libs/imagesloaded.pkgd.min.js"></script>

</head>
<?php
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

    <!-- Mobile Menu -->
    <div class="mobile">
        <div class="container">
            <!-- Mobile -->
            <div class="menu-mobile">
                <span class="item item-1"></span>
                <span class="item item-2"></span>
                <span class="item item-3"></span>
            </div>
            <!-- End Mobile -->

            <!-- Logo -->
            <div class="logo">
                <a href="main.php">
                    <img src="../img/logo.png" alt="Logo">
                </a>
            </div>
            <!-- End Logo -->
        </div>
    </div>
    <div class="hide-menu"></div>
    <!-- End Mobile Menu -->

    <div class="container">
        <div class="row">

            <div class="col-md-3" id="sidebar">

            </div>

            <div class="col-md-9 col-md-offset-3">
                <div class="posts">
                    <div class="posts-inner" id="articles">

                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrap">

                        <div class="older" hidden>
                            <a href="#">Older Posts <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <div class="newer" hidden>
                            <a href="#"><i class="fa fa-angle-double-left"></i> Newer Posts</a>
                        </div>
                    </div>
                    <!-- End Pagination -->
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
<script src="../js/libs/jquery-1.12.4.min.js"></script>
<script src="../js/libs/masonry.pkgd.min.js"></script>
<script src="../js/libs/imagesloaded.pkgd.min.js"></script>
<script src="../js/scripts.js"></script>
<script type="text/javascript">

    function viewpost(id) {
        localStorage.setItem("postid", id);
    }

    $(document).ready(function () {

        let limit = 3;
        let start = 0;
        let action = 'inactive';


        function loaddata(limit, start) {
            $.ajax({
                url: "../php/view.php",
                data:
                    {
                        limit: limit,
                        start: start
                    },
                type: "POST",
                cache: false,
                success: function (response) {
                    $("#articles").append(response);

                    if (response == '') {
                        action = 'active';
                    } else {
                        action = 'inactive';
                    }


                }
            });
        }

        if (action == 'inactive') {
            action = 'active';
            loaddata(limit, start);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#articles").height() && action == 'inactive') {
                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    loaddata(limit, start);
                }, 1000);

            }
        });
    });

</script>
</body>


</html>