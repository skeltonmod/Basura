<?php
include "init.php";
@$comment = addslashes($_POST['comment']);
@$id = $_POST['id'];
@$postid = $_POST['postid'];
@$date = $_POST['date'];
$author = 'username';
$content = 'comment';
$day = 'date';


if(isset($_POST['key'])){
    if($_POST['key'] == 'addcomment'){
        $statement = "INSERT INTO comment(comment,postid,uid,date) 
        VALUES('$comment','$postid','$id','$date')";
        $result = $conn->query($statement);

        if($result === TRUE){
            echo "comment added";
        }

    }
    if($_POST['key'] == 'populate'){
        $statement = "SELECT
            comment.*,
            user.username
        FROM
            comment
        JOIN user ON comment.uid = user.id
        JOIN posts ON comment.postid = posts.id
        WHERE
            comment.postid = $postid";
        $result = $conn->query($statement);
        if($result-> num_rows > 0){
            while($row = $result->fetch_assoc()){

                echo "<div class=\"comments-inner\" >
                        <ul class=\"comment-list\">
                            <li class=\"comment\">
                                <div class=\"comment-body\">
                                    <div class=\"comment-head\">
                                        <div class=\"comment-avatar\">
                                            <h5 >$row[$author]</h5>
                                        </div>
                                        <div class=\"comment-info\">
                                            <span class=\"comment-date\">$row[$day]</span>
                                        </div>
                                    </div>
                                    <div class=\"comment-context\">
                                        <p>$row[$content]</p>
                                    </div>
                                </div>
                </div>";

            }

        }

    }

}


