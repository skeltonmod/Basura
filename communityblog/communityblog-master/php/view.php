<?php

include "init.php";
$start = $_POST['start'];
$limit = $_POST['limit'];
$statement = "SELECT * FROM posts ORDER BY id DESC LIMIT $start,$limit";
$result = $conn->query($statement);
$title = 'title';
$id = 'id';
$date = 'date';
$category = 'category';
$content = 'content';



//<img src="http://localhost/images/brann.jpg" alt="Post">
function getExcerpt($str,$startPos=0,$maxLength=100){
    if(strlen($str) > $maxLength){
        $excerpt = substr($str,$startPos,$maxLength-3);
        $lastSpace = strrpos($excerpt,' ');
        $excerpt = substr($excerpt,0,$lastSpace);
        $excerpt .= '...';
    }else{
        $excerpt = $str;
    }
    return $excerpt;
}

if(isset($_POST["limit"], $_POST["start"])){
    if($result-> num_rows > 0){
        while($row = $result->fetch_assoc()){
            $excerptstring = getExcerpt($row[$content],0,350);
            $file = $row[$id].".html";
            echo "<article class=\"post\" id=\"article_$row[$id]\">
                            <div class=\"post-header\">
                                <h2 class=\"title\">
                                    <a>$row[$title]</a>
                                </h2>

                                <!-- Post Details -->
                                <div class=\"post-details\">
                                    <div class=\"post-cat\">
                                        <a href=\"#\">$row[$category]</a>
                                    </div>
                                    <a href=\"#\" class=\"post-date\"><span>$row[$date]</span></a>
                                </div>
                                <!-- End Post Details -->
                            </div>
                            <div class=\"post-media\" hidden>
                                <a href=\"single.php\">
                                    $row[$title]
                                </a>
                            </div>
                            <div class=\"post-content\">
                                <!-- The Content -->
                                <div class=\"the-excerpt\">
                                    <p>$excerptstring </p>
									</s>
                                </div>
                                <!-- End The Content -->
                            </div>

                            <div class=\"read-more\">
                                <a href=\"viewpost.php#$row[$id]\"  id=\"view\">Continue Reading ...</a>
                            </div>

                        </article>";

        }

    }
}


