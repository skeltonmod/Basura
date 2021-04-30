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
    <style>
        body{
            text-align: justify !important;
            text-justify: inter-word !important;

        }

    </style>
</head>
<body>

<div class="container" id="page-wrap">
    <?php include "navbar.php"?>
    <section class="content" id="main-content">
        <div class="col-md-9 col-md-offset-3">
            <div class="posts">
                <div class="posts-inner" id="articles">
                    <article class="post" style="text-align: center !important;">
                        <div class="post-header">
                            <h2 class="title" id="title"><span></span></h2>

                            <!-- Post Details -->
                            <div class="post-details">
                                <div class="post-cat">
                                    <a href="#" id="category"></a>
                                </div>
                                <a href="#" class="post-date" id="date"><span></span></a>
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
                            Written by  <a id="author"></a>
                        </div>


                    </article>

                </div>
                <div class="shortlabel">
                    <label style="position:relative; width: 100px !important;">Comments</label>
                </div>
                <div class="comment-container" id="comment-container">

            </div>

                <?php
                if(!empty($_SESSION['id'])){
                    echo "<div class=\"comment-form\">
                    <textarea name=\"comment\" id=\"comments\"></textarea>
                    <br>
                    <button type=\"submit\" name=\"btn-save\" id=\"submit\"style=\"position:relative; left: -50px\" onclick=\"addcomment()\">
                        <span class=\"\"></span>   Add Comment
                    </button>
                </div>";
                }
                ?>
        </div>


    </section>


</div>
</body>
<script src="../js/const.js"></script>
<script>
    let getSessionID = "";
    let getSessionName = "";

    function getday(){
        let today = new Date();
        let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        let dateTime = date;

        return dateTime;
    }
    function gethash() {
        var x = location.hash;
        var string = x.split("#")[1];
        return string;
    }

    function addcomment(){
        let comment = $("#comments");
        let author = getSessionName;
        let id = getSessionID;
        let postid = gethash();
        let date = getday();
        $("#comment-container").append(`<div class="comments-inner">
                        <ul class="comment-list">
                            <li class="comment">
                                <div class="comment-body">
                                    <div class="comment-head">
                                        <div class="comment-avatar">
                                            <h5 >${author}</h5>
                                        </div>
                                        <div class="comment-info">
                                            <span class="comment-date">${date}</span>
                                        </div>
                                    </div>
                                    <div class="comment-context">
                                        <p>${comment.val()}</p>
                                    </div>
                                </div>
                </div>`);
        insertcomment(id,postid)
    }

    function insertcomment(id,postid){
        let comment = $("#comments");
        $.ajax({
            url: "../php/comment.php",
            method: "POST",
            dataType: "json",
            data:{
                comment: comment.val(),
                id: id,
                postid: postid,
                key: 'addcomment',
                date: getday()
            },
            success: function (response) {
                window.alert(response);
            }
        });

        comment.val("");
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

    function getSesstion(key) {
        $.ajax({
            url: "../php/getsession.php",
            method: "POST",
            dataType: "json",
            data:{
                key: key
            },
            success: function (response) {
                getSessionID = response.id;
                getSessionName = response.username;
            }
        });
    }


    $(document).ready(function () {
        let getid = gethash();
        let postid = gethash();
        //populate the comments
        viewpost(getid);
        populate();
        getSesstion('id')
        function populate() {
            $.ajax({
                url: "../php/comment.php",
                method: "POST",
                data:{
                    postid: postid,
                    key: 'populate'
                },
                success: function (response) {
                    if(response != ""){
                        $("#comment-container").append(response);
                    }
                }

            });
        }

    });

</script>

</html>