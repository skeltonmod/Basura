<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
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
            <div class="col-md-9 col-md-offset-3">
                <div class="posts">
                        <div class="posts-inner" id="articles">

                        </div>
                </div>
            </div>
    </section>


</div>
<script>
    function viewpost(id) {
        loadpage("viewpost.php");
    }
    $(document).ready(function () {


        let limit = 3;
        let start = 0;
        let action = 'inactive';

        getSession();

        function getSession(){
            $.ajax({
                url: "../php/getsession.php",
                data: {
                    key: 'id'

                },
                type: "POST",
                dataType: "json",
                cache: false,
                success: function (response) {
                }

            })

        }


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