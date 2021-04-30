<?php
$key = $_POST['key'];

if(isset($key)){
    switch ($key){
        case "writeHTML":
            $content = $_POST['content'];
            $temp_title = $_POST['temp_title'];
            $myfile = fopen("../entries/".$temp_title.".html","w");
            $html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Parasite</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css" type="text/css">
    <script src="../js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container" style="margin-bottom: 20px">
    <!--First Article-->
    <span>Social Parasite</span>
    <span style="display: block; font-size: 8px">forever a disappointment to everyone</span>
    <span style="display: block; font-size: 8px">leeching of everyone from their time, bothersome</span>
    <span style="display: block; font-size: 8px">therefore a parasite of society... just wanna be deep there</span>
    
    <div style="margin-top: 2em">
    '.$content .'
    </div>
    
    <hr>
    <div class="cat">
        <a>social links: </a>
        <a href="https://github.com/skeltonmod">
            <img src="../img/github.jpeg"  alt="GitHub" class="zoom"/>
        </a>
        <a href="https://twitter.com/realskeltonmod">
            <img src="../img/twitter.jpg"  alt="Twitter" class="zoom"/>
        </a>
        <a href="https://www.instagram.com/relsrc/">
            <img src="../img/instagram.jpg"  alt="Instagram" class="zoom"/>
        </a>
        <a href="mailto: r0guehaxx@gmail.com">
            <img src="../img/gmail.jpg"  alt="Gmail" class="zoom"/>
        </a>
    </div>
</div>
</body>
</html>
';
            fwrite($myfile,$html);
            fclose($myfile);

            echo "Write Success!";
            break;
        case "logDB":
            $filepath = $_POST['filepath'];
            $title = $_POST['title'];
            $custom_id = $_POST['custom_id'];
            $entry_date = $_POST['entry_date'];
            logDB($custom_id,$title,$filepath,$entry_date);
            break;
    }
}

function logDB($custom_id,$title,$filepath,$entry_date){
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername,$username,$password,"socialparasite");
    $stmt = $conn->prepare("INSERT INTO `entries` (`custom_entry_id`, `title`, `filepath`, `entry_date`) 
            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss",$custom_id,$title,$filepath,$entry_date);
    if($stmt->execute() === TRUE){
        echo "Success";
    }else{
        echo $stmt->error;
    }
}