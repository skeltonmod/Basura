<?php
//getting the database connection
require_once 'DbConnector.php';
define('UPLOAD_PATH', 'images/');

$response = array();
//getting the values
@$firstname = $_POST['firstname'];
@$lastname = $_POST['lastname'];
@$middlename = $_POST['middlename'];
@$suffix = $_POST['suffix'];
@$email = $_POST['email'];
@$password = md5($_POST['password']);
@$gender = $_POST['gender'];
@$dob = $_POST['dob'];
@$pob = $_POST['pob'];
@$civilstatus = $_POST['civilstatus'];
@$educ = $_POST['educ'];
@$mobilenumber = $_POST['mobilenumber'];
@$nickname = $_POST['nickname'];
@$citizenship = $_POST['citizenship'];

//incident reports
@$image = $_FILES['image']['name'];
@$image_dummy = "";
@$informanttype = $_POST['informanttype'];
@$incidenttype = $_POST['incidenttype'];
@$date = $_POST['date'];
@$time = $_POST['time'];
@$latitude = $_POST['latitude'];
@$longitude = $_POST['longitude'];
@$city = $_POST['city'];
@$street = $_POST['street'];
@$informantname = $_POST['informantname'];
@$informantid = $_POST['informantid'];
@$status = $_POST['status'];

if(isset($_GET['apicall'])){

    switch($_GET['apicall']){

        case 'signup':
            //checking the parameters required are available or not
            if(isTheseParametersAvailable(array('firstname','email','password'))){



                //checking if the user is already exist with this username or email
                $stmt = $conn->prepare("SELECT id FROM users WHERE firstname = ? OR email = ?");
                $stmt->bind_param("ss", $firstname, $email);
                $stmt->execute();
                $stmt->store_result();

                //if the user already exist in the database
                if($stmt->num_rows > 0){
                    $response['error'] = true;
                    $response['message'] = 'User already registered';
                    $stmt->close();
                }else{

                    //if user is new creating an insert query
                    $stmt = $conn->prepare("INSERT INTO users (firstname, 
                                                suffix, 
                                                lastname, 
                                                middlename,
                                                email,
                                                password,
                                                citizenship,
                                                civilstatus,
                                                dob,
                                                educ,
                                                gender,
                                                mobilenumber,
                                                nickname,
                                                pob) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");
                    $stmt->bind_param("ssssssssssssss",
                        $firstname,
                        $suffix,
                        $lastname,
                        $middlename,
                        $email,
                        $password,
                        $citizenship,
                        $civilstatus,
                        $dob,
                        $educ,
                        $gender,
                        $mobilenumber,
                        $nickname,
                        $pob);

                    //if the user is successfully added to the database
                    if($stmt->execute()){

                        //fetching the user back
                        $stmt = $conn->prepare("SELECT id, id, firstname, email, password FROM users WHERE firstname = ?");
                        $stmt->bind_param("s",$firstname);
                        $stmt->execute();
                        $stmt->bind_result($userid,$id, $firstname,$email,$password);

                        $stmt->fetch();

                        $user = array(
                            'id'=>$id,
                            'firstname'=>$firstname,
                            'email'=>$email,
                            'password'=>$password,

                        );

                        $stmt->close();

                        //adding the user data in response
                        $response['error'] = false;
                        $response['message'] = 'User registered successfully';
                        $response['user'] = $user;
                    }
                }

            }else{
                $response['error'] = true;
                $response['message'] = 'required parameters are not available';
            }

            break;

        case 'login':
            //for login we need the username and password
            if(isTheseParametersAvailable(array('firstname', 'password'))){
                //getting values
                $firstname = $_POST['firstname'];
                $password = md5($_POST['password']);

                //creating the query
                $stmt = $conn->prepare("SELECT id, firstname, email FROM users WHERE firstname = ? AND password = ?");
                $stmt->bind_param("ss",$firstname, $password);

                $stmt->execute();

                $stmt->store_result();

                //if the user exist with given credentials
                if($stmt->num_rows > 0){

                    $stmt->bind_result($id, $firstname, $email);
                    $stmt->fetch();

                    $user = array(
                        'id'=>$id,
                        'firstname'=>$firstname,
                        'email'=>$email
                    );

                    $response['error'] = false;
                    $response['message'] = 'Login successful';
                    $response['user'] = $user;
                }else{
                    //if the user not found
                    $response['error'] = false;
                    $response['message'] = 'Invalid username or password';
                }
            }
            break;


        case 'sendreport':
            if(isset($image) && isset($informantname)){
                //uploading file and storing it to database as well
                try{
                    move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_PATH . $_FILES['image']['name']);
                    $stmt = $conn->prepare("INSERT INTO incidents (image,
                    incidenttype,
                    informanttype,
                    date,
                    time,
                    latitude,
                    longitude,
                    city,
                    street,
                    informantname,
                    status,
                    informantid) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("sssssssssssi",$_FILES['image']['name'],
                        $incidenttype,
                        $informanttype,
                        $date,
                        $time,
                        $latitude,
                        $longitude,
                        $city,
                        $street,
                        $informantname,
                        $status,
                        $informantid);
                    if($stmt->execute()){
                        $response['error'] = false;
                        $response['message'] = 'Incident reported successfully';
                    }else{
                        throw new Exception("Something went Wrong");
                    }
                }catch(Exception $e){
                    $response['error'] = true;
                    $response['message'] = 'Something went Wrong '.$stmt->error;
                }

            }else{
                $response['error'] = true;
                $response['message'] = "Required params not available";
            }

            break;

        case 'getincident':
            $server_ip = gethostbyname(gethostname());
            $stmt = $conn->prepare("SELECT id, image, incidenttype,time,date,status FROM incidents");
            $stmt->execute();
            $stmt->bind_result($id, $image, $incidenttype,$time,$date,$status);

            $incident = array();

            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['image'] = 'http://' . $server_ip . '/phpREST/' . UPLOAD_PATH . $image;
                $temp['incidenttype'] = $incidenttype;
                $temp['time'] = $time;
                $temp['date'] = $date;
                $temp['status'] = $status;
                array_push($incident, $temp);
            }

            //$response['error'] = false;
            //$response['incident'] = $incident;
            echo json_encode($incident);
            break;
            break;
        default:
            $response['error'] = true;
            $response['message'] = 'Invalid api call';
    }

}else{

    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}

//displaying the response in json structure
echo json_encode($response);

	function isTheseParametersAvailable($params){

        foreach($params as $param){
            if(!isset($_POST[$param])){
                //return false
                return false;
            }
        }
        //return true if every param is available
        return true;
    }