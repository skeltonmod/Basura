<?php
include "db_config.php";
include "tables.php";
include "dbhelper.php";
$key = $_POST['key'];
$dbhelper = new dbhelper("root","restaurant","","localhost");
if(isset($key)){
    switch ($key){
        case "insert":
            $name = $_POST['name'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $image = "LOL";
            $dbhelper->setFields("name","c_name","description","status","image");
            echo $dbhelper->pushDB("tables",$name,"Elijah",$description,$status,$image);
            break;
        case "fetch":
            $content = '';
            $data = array();
            $data = $dbhelper->getData("tables","name","status","description");
            foreach ($data as $index){
                $badge = "badge-success";
                switch ($index['status']){
                    case 'Available':
                        $badge = "badge-success";
                        break;
                    case 'Taken':
                        $badge = "badge-danger";
                        break;
                    case 'Reserved':
                        $badge = "badge-warning";
                        break;

                }
                $content .="<div class='col-lg-6 mb-4'>
                        <div class='card h-100'>
                            <a href='#'><img class='card-img-top' src='http://placehold.it/700x400' alt=''> </a>

                            <div class='card-body'>
                                <h4 class='card-title'><a href='#'>".$index["name"]."</a> </h4>
                                <span class='badge ".$badge."'>".$index["status"]."</span>
                            </div>
                        </div>
                    </div>";
            }
            echo $content;
            break;

        case "edit":
            $id = $_POST['tid'];
            $name = $_POST['name'];
            $cname = $_POST['cname'];
            $status = $_POST['status'];

            $dbhelper->setFields('name','c_name','status');
            $dbhelper->editData('tables',$id, $name,$cname,$status);
            break;
    }
}