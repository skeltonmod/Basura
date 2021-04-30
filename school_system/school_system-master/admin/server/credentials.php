<?php
include "db_config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
$key = $_POST['key'];
if(isset($key)){
  switch ($key){
    case "login":
      $password = md5($_POST['password']);
      //$password = $_POST['password'];
      $email = $_POST['email'];
      if(isset($password) && isset($email)){
        $stmt = $conn->prepare("SELECT id,user_id,email,password,user_type FROM user WHERE password=? AND email=?");
        $stmt->bind_param('ss',$password,$email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
          $stmt->bind_result($id,$user_id,$password,$email,$usertype);
          if($stmt->fetch()){
            $user = array(
              "id" => $id,
              "user_id"=>$user_id,
              "password"=>$password,
              "email"=>$email,
              "user_type"=>$usertype
            );
          }
          $_SESSION['id'] = $user_id;
          $_SESSION['user_type'] = $usertype;
        }else{
          $user = array(
            "id" => "null",
            "password"=>"null",
            "email"=>"null",
            "user_type"=>"null"
          );
        }
        echo json_encode($user);
      }
      break;
    case "logout":
      if(!isset($_SESSION['user_type'])){
        echo "NO SESSION";
      }else{
        session_unset();
        session_destroy();
        echo "Logged out";
      }
      break;
    case "forgotPass":
      $userpass = generatePass();
      $useremail = $_POST['email'];
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->Mailer = "smtp";
      $mail->SMTPDebug  = 1;
      $mail->SMTPAuth   = TRUE;
      $mail->SMTPSecure = "tls";
      $mail->Port       = 587;
      $mail->Host       = "smtp.mailtrap.io";
      $mail->Username   = "f92d7c424eba35";
      $mail->Password   = "5d6317b9256a6b";
      $message = "<html>
   <head>
      <title>Good Day!</title>
   </head>
   <body>
      <p>Here is your newly generated password</p>

      <p>Your auto generated password will be</p>
      <span>Password: ".$userpass."</span><br>
      <span>Please keep your password in a safe place!</span><br>

      <span>(Warning: unsubscribing will permanently remove your ability to get any emails from us including forgotten passwords.)</span>
   </body>
</html>";
      $mail->IsHTML(true);
      $mail->AddAddress($useremail, "Student");
      $mail->SetFrom("webmaster@admin.com", "Webmaster");
      $mail->Subject = "Account Created!";
      $mail->MsgHTML($message);
      if(!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
      } else {
        echo "Email sent successfully";
      }
      if(isset($useremail)){
        $autogenerate = md5($userpass);
        $stmt = $conn->prepare("UPDATE `user` SET `password` = ?  WHERE `user`.`email` = ?");
        $stmt->bind_param("ss",$autogenerate,$useremail);
        $stmt->execute();
      }
      break;
  }

}
function generatePass(){
  $n = 20;
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }

  return $randomString;
}
