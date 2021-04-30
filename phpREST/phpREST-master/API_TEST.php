<?php
require_once "DbConnector.php";
//We will upload files to this folder
//So one thing don't forget, also create a folder named uploads inside your project folder i.e. MyApi folder
define('UPLOAD_PATH', 'images/');

//connecting to database


//An array to display the response
$response = array();

//if the call is an api call
if (isset($_GET['apicall'])) {

//switching the api call
    switch ($_GET['apicall']) {

//if it is an upload call we will upload the image
        case 'uploadpic':

//first confirming that we have the image and tags in the request parameter
            if (isset($_FILES['image']['name']) && isset($_POST['tags'])) {

//uploading file and storing it to database as well
                try {
                    move_uploaded_file(@$_FILES['image']['tmp_name'], UPLOAD_PATH . @$_FILES['image']['name']);
                    $stmt = $conn->prepare("INSERT INTO images (image, tags) VALUES (?,?)");
                    $stmt->bind_param("ss", $_FILES['image']['name'], $_POST['tags']);
                    if ($stmt->execute()) {
                        $response['error'] = false;
                        $response['message'] = 'File uploaded successfully';
                    } else {
                        throw new Exception("Could not upload file");
                    }
                } catch (Exception $e) {
                    $response['error'] = true;
                    $response['message'] = 'Could not upload file';
                }

            } else {
                $response['error'] = true;
                $response['message'] = "Required params not available";
            }

            break;

//in this call we will fetch all the images
        case 'getpics':

            $server_ip = gethostbyname(gethostname());

            $stmt = $conn->prepare("SELECT id, image, tags FROM images");
            $stmt->execute();
            $stmt->bind_result($id, $image, $tags);

            $images = array();

            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['image'] = 'http://' . $server_ip . '/phpREST/' . UPLOAD_PATH . $image;
                $temp['tags'] = $tags;

                array_push($images, $temp);
            }

            $response['error'] = false;
            $response['images'] = $images;
            break;

        default:
            $response['error'] = true;
            $response['message'] = 'Invalid api call';
    }

} else {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}

//displaying the response in json
header('Content-Type: application/json');
echo json_encode($response);