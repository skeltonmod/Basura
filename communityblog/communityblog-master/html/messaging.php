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
    <title>Messaging</title>
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Lato:400,700%7CCrete+Round' type='text/css' media='all' />
    <script type='text/javascript' src='../js/libs/jquery-1.12.4.min.js'></script>
    <script src="https://use.fontawesome.com/574f62f66e.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

</head>
<body>
    <div class="container">
        <?php include "navbar.php";?>

        <div class="content">
           <div id="wrapper">
               <div id="menu">
                   <p class="welcome">Chatting as <b><?php echo $_SESSION['username']; ?></b></p>

                   <div id="chatbox">
                        <?php
                            if(file_exists("../php/log.html") && filesize("../php/log.html") > 0){
                                $handle = fopen("../php/log.html","r");
                                $contents = fread($handle,filesize("../php/log.html"));
                                fclose($handle);
                                echo $contents;
                            }

                        ?>

                   </div>


                   <form name="message" action="">
                       <input name="usermessage" type="text" id="msg" size="150" />
                       <button type="submit" class="btn btn-default" name="btn-save" id="submit">
                           <span class=""></span>  Send
                       </button>

                   </form>

               </div>

           </div>
        </div>
        <div id="activeusers" class="users" >
            <b>Notice!</b>
            <br>
            <b>Currently Work in Progress</b>
        </div>
    </div>
    <script>
        setInterval(loadMessage,100);


        function loadMessage(){
            let oldScrollHeight = $("#chatbox").attr("scrollHeight") - 20;
            $.ajax({
                url: "../php/log.html",
                cache: false,
                success: function (response) {

                    $("#chatbox").html(response);
                    let scrollheight = $("#chatbox").attr("scrollHeight");
                    if(scrollheight > oldScrollHeight){
                        $("#chatbox").animate({
                            scrollTop: scrollheight
                        })

                    }
                }

                });


        }

        $("#submit").on('click',function (e) {
            e.preventDefault();
        });
        $(document).ready(function () {
        });
        $("#submit").click(function () {
            let message = $("#msg").val();
            $.post("../php/messaging.php",{
                text: message
            });
            $("#msg").val("");
            return false
        });

    </script>
</body>
</html>