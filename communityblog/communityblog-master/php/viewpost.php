<?php
include 'init.php';
session_start();
$id = $_POST['id'];
if(isset($_POST['id'])){
    $conn = new mysqli($dbhost,$dbusername,$dbpass,$dbname);
    $statement = "SELECT
    posts.*,
    user.fname,
    user.lname
FROM
    posts
JOIN user ON posts.userid = user.id
WHERE
    posts.id = $id ";

    $sql = $conn->query($statement);
    $data = $sql->fetch_array();

    $jsonarray = array(
        'id' => $data['id'],
        'title'=>$data['title'],
        'category'=>$data['category'],
        'content'=>$data['content'],
        'date'=>$data['date'],
        'fname'=>$data['fname'],
        'lname'=>$data['lname']
    );
    exit(json_encode($jsonarray));
}
