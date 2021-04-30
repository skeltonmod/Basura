<?php
$sourcepath = $_FILES['image']['tmp_name'];
$targetpath = "../entry_images/".$_FILES['image']['name'];
if(move_uploaded_file($sourcepath,$targetpath)){
    echo $targetpath;

}else{
    echo "Something went wrong!";
}