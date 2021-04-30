<?php include "db_config.php";

include "dbhelper.php";
$key = $_POST['key'];
$dbhelper = new dbhelper("root","restaurant","","localhost");
if(isset($key)){
    switch ($key){
        case "insert":
            $price = $_POST['price'];
            $description = $_POST['description'];
            $name = $_POST['name'];
            $stock = $_POST['stock'];
            $status = $_POST['status'];
            $dbhelper->setFields("name","description","price","stocks","status");
            $dbhelper->pushDB("menu",$name,$description,$price,$stock,$status);
            break;
        case "fetch":
            $content = '';
            $data = array();
            $data = $dbhelper->getData("menu","id","name","status","description","stocks","price");
            foreach ($data as $index){
                $badge = "badge-success";
                switch ($index['status']){
                    case 'Available':
                        $badge = "badge-success";
                        break;
                    case 'Un-Available':
                        $badge = "badge-danger";
                        break;
                }
                $content .= '
                <div class="media border rounded border-primary my-3">
                    <svg class="bd-placeholder-img align-self-start mx-3 my-1" width="64" height="64" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 64x64"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">64x64</text></svg>
                    <div class="media-body">
                        <h5 class="mt-0">'.$index['name'].'</h5>
                        <p>'.$index['description'].'</p>
                        <span class="badge badge-success my-2">'.$index['price'].'</span>
                    </div>

                </div>
                ';
            }
            echo $content;
            break;
    }
}