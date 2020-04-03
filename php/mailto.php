<?php
include_once "config.php";

$mail_from='From:cookablog360@gmail.com';
$to =$_REQUEST["useremail"];
$subject ="Recovery of your password";

$sql="SELECT pass,email from users where email='$to'";
$stmt=$link->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$r=$stmt->fetch();
$message="Here is your password:".$r['pass'];


if(isset($to) && $to===$r['email']){
    $send_email=mail($to,$subject,$message,$mail_from);
    // Check, if message sent to your email
    if($send_email){
        echo "Your Message has been sent";
        }
    else {
        echo 'ERROR';
        }
}
else{
    echo 'no user with that email';
}
?>