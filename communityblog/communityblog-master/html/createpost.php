<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['id'])){
    header('location: login.php');

}
$session = $_SESSION['id'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a Post</title>
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:400,700%7CCrete+Round' type='text/css' media='all' />
    <script type='text/javascript' src='../js/libs/jquery-1.12.4.min.js'></script>
    <script src="https://use.fontawesome.com/574f62f66e.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="https://cdn.rawgit.com/jackmu95/52b82e3ec79a2e2a30ddf37e71846711/raw/6e6ee157a7d1ca7c97d81de7d61a9ee2536a7d46/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
</head>
<body>

<div class="container" id="page-wrap">
    <?php include "navbar.php"?>
    <section class="content" id="main-content">
        <article class="post">
            <form method="post" class="form-signin" id="loginForm" style="display: block;">
                <div class="form-group">
                    <label>Title</label>
                    <input name="author" value="" type="text" id="title" name="validate_title"><br>
                    <label>Date</label>
                    <input name="email" value="" id="date" type="date"><br>
                    <label style="position: relative; left: -120px;">Category</label>
                    <select id="category" style="position: relative; left: -100px;">
                        <option value="Travel">Travel</option>
                        <option value="Mission">Mission</option>
                        <option value="Church">Church</option>
                        <option value="Journal">Journal</option>

                    </select><br>

                    <div id="editor-container" style="margin-top: 10px !important;">


                    </div>

                </div>


                <button type="submit" class="btn btn-default" name="btn-save" id="submit" onclick="insertPost('insert')" style="margin: 10px">
                    <span class="" id="spansubmit"> Create Post</span>
                </button>
            </form>
            <div class="progress" id="progress-text" hidden><span> Uploading... Please wait!</span></div>
        </article>
    </section>
    <script>

        function imagehandler(image,callback){
            let fdata = new FormData();
            fdata.append('image',image);
            $.ajax({
                url: "../php/imagehandler.php",
                beforeSend: function(response){
                    $("#progress-text").attr("hidden",false)
                },
                type: "POST",
                data:  fdata,
                contentType: false,
                cache: false,
                processData:false,
                success: function(response)
                {
                       callback(response);
                        $("#progress-text").attr("hidden",true)
                }
            });

            let reader = new FileReader();
            reader.onload = function (e) {
               callback(e.target.result);
            };
        }


        let quill = new Quill("#editor-container",{
           modules:{
               imageResize: {
                   displaySize: true
               },
             toolbar:[
                 [{header:[1,2,3,4,5,false] }],
                 ['bold','italic','strike'],
                 [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                 ['blockquote'],
                 ['image','code-block']
             ]

           },
            placeholder: "Compose a blog content",
            theme: 'snow',
            imageHandler: imagehandler
        });
        

        $("#submit").on('click',function (e) {
            e.preventDefault();
        });
        function insertPost(key){
            let getHTMLcontent = document.getElementById('editor-container');

            let title = $("#title");
            let date = $("#date");
            let category = $("#category");
            let content = $("#content");
            let userid = <?php echo $session;?>;
            let htmlcontent = quill.root.innerHTML;

            if(title.val() != ""){
                $.ajax({
                    url: "../php/insert.php",
                    method: "POST",
                    beforeSend: function(response){
                        document.getElementById("spansubmit").innerHTML = "Posting"
                    },
                    dataType: "text",
                    data:{
                        key: key,
                        title: title.val(),
                        date: date.val(),
                        category: category.val(),
                        content: getHTMLcontent.innerHTML = htmlcontent,
                        userid: userid
                    },
                    success: function (response) {
                        if(response != "success"){
                            window.alert(response);
                        }else{
                            window.alert("Post added!");
                            window.location.href = "index.php"
                        }
                    }

                });
            }else{
                alert("Please Write a title")
                window.location.href = "createpost.php"
            }



        }
    </script>
</div>
</body>

</html>