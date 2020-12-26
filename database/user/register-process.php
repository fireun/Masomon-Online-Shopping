<?php

include("../../config.php");
session_start();

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$_SESSION['errorMessage'] = "";
//register
if(isset($_POST['register'])){
    $generateUserId = uniqid();
    $name=mysqli_real_escape_string($conn,$_POST['inputname']);
    $password=mysqli_real_escape_string($conn,$_POST['inputpassword']);
    $password1=mysqli_real_escape_string($conn,$_POST['inputdoublepassword']);
    $email=mysqli_real_escape_string($conn,$_POST['inputemail']);

    date_default_timezone_set("Asia/Kuala_Lumpur");
    // echo date('d-m-Y H:i:s'); //Returns IST
    $date =  date("Y-m-d h:i:s");

      if($password == $password1){
          
        $newPassword = password_hash("$password" , PASSWORD_DEFAULT);
        $newPassword2 = password_hash("$password1" , PASSWORD_DEFAULT);

        // if(isset($_POST['checkbox'])){   
           $registerSql="insert into user(userId,userName,firstName,lastName,email,phoneNo,gender,birthday,image,password,create_date,lastLogin) VALUES ('$generateUserId'
                        ,'$name','','','$email','','','','','$newPassword','$date','$date')";
           //step 6 : Run SQL 
           $registerResult=$conn->query($registerSql);
        
           if($registerResult == true) {
               $_SESSION['username'] = $name;
               $_SESSION['userId'] = $generateUserId;

            //    echo '<script>window.alert("You are registered successfully.")</script>';
            header('refresh:0; url=../../user/register.php?create-account=Account-Notif-1-RS1-0001');
           }else{
            header('refresh:0; url=../../user/register.php?create-account=SomethingError404-RAF-R2-E2');
            //   echo '<script>window.alert("You are registered failed!")</script>';
            //   echo '<script>window.history.back()</script>';
            //   echo "$previous = \"javascript:history.go(-1)\"";
                // if(isset($_SERVER['HTTP_REFERER'])) {
                //     $previous = $_SERVER['HTTP_REFERER'];
                // }
           }
      }else{
            header('refresh:0; url=../../user/register.php?create-account=Password-Error404-E1-NoMatchPassword');
            // $_SESSION['errorMessage'] = "Password no Match !";
        //    echo '<script>window.history.back()</script>';
      }
}