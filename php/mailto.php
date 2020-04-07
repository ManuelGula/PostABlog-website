<?php
include_once "config.php";
$to_err="";
$email_err="";
$password="";
if($_SERVER["REQUEST_METHOD"] == "POST"){

$to=$_POST["useremail"];
$mail_from='From:cookablog360@gmail.com';
if(empty($_POST["useremail"])){
    $to ="";
    $to_err="enter an email";
}
$subject ="Recovery of your password";

$sql="SELECT pass,email from users where email='$to'";
$stmt=$link->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$r=$stmt->fetch();
if($stmt->rowCount()==1){
    $password=$r['pass'];
}else{
    $email_err='no user with that email';
}
$message="Here is your password:".$password;
if(!empty($_POST["useremail"])){
    if(empty($email_err) && $to==$r['email']){
        $send_email=mail($to,$subject,$message,$mail_from);
        // Check, if message sent to your email
        if($send_email){
            $email_err= "Your password has been sent";
            }
        else {
            $email_err= 'ERROR sending email';
            }
    }
}else{

    $email_err=$to_err;
}}
?>