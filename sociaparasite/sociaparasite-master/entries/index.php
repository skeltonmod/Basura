<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername,$username,$password,"socialparasite");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Parasite</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css" type="text/css">
</head>
<body>
<div class="container" style="margin-bottom: 20px">
    <!--First Article-->
    <span>Social Parasite</span>
    <span style="display: block; font-size: 8px">forever a disappointment to everyone</span>
    <span style="display: block; font-size: 8px">leeching of everyone from their time, bothersome</span>


    <span class="index-name">Blog Index</span>
    <a href="../index.php"><span class="index-name nav-entry" style="font-size: 9px">Home</span></a>

    <ul>
        <?php
            $sql = "SELECT * FROM entries";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    echo '<li>'.$row['entry_date'].'– <a href="'.$row['filepath'].'"><span class="blog_entry">'.$row['title'].'</span></a> </li>';
                }
            }else{
                echo '<li><span>NO ENTRIES</span> </li>';
            }
        ?>
    </ul>


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
