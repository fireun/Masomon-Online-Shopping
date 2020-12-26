<?php
  include("../config.php");
  session_start();

  //login
  if(isset($_POST['login'])){
    $getInputName = mysqli_real_escape_string($conn,$_POST['uname']);
    $getInputPass = mysqli_real_escape_string($conn,$_POST['upass']);

    //verify account
    if($getInputName!="" && $getInputPass!=""){
      $sqlVerify = "select * from seller where sellerName='$getInputName' and password='$getInputPass'";
      $result= mysqli_query($conn,$sqlVerify);//sql
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);
      if($count == 1){//if have username and password  正确
        $_SESSION['sellerId']=$row['sellerId'];
        header("location:./sellerhome.php");
      }else{//database 没有这个账户
        echo'<script type=text/javascript>';//add myself
        echo 'window.alert("unvariable username and password")';
        echo '</script>';
      }
    }
  }
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seller Login Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/buttercake@3.0.0/dist/css/butterCake.min.css">
  
  <!-- STYLE -->
<style>
  .login-page {
    min-height: 100vh;
  }

  .login-page .avatar-icon img {
    margin-top: -80px;
    width: 128px;
    height: 128px;
  }
</style>

</head>
<body>
  

<!-- LOGIN CONTAINER -->
<section class="login-page flex-center-center py-5 bg-light">

  <!-- FORM -->
  <div class="w-100 mx-auto px-2" style="max-width: 400px">
    <form action="login.php" method="POST">

      <div class="text-center text-gray">
        <h2 class="weight-500 mb-1">Login</h2>
        <!-- <p class="h4 mb-2 weight-300">Please login to proceed</p> -->
      </div>

      <div class="card overflow-unset mt-9 mb-1">
        <div class="card-body">

          <!-- AVATAR -->
          <div class="avatar-icon text-center">
            <img src="../images/seller.png" alt="Avatar"
              class="img-circle img-cover card mb-2 ml-auto mr-auto p-1">
          </div>

          <!-- EMAIL -->
          <div class="group">
            <input type="text" class="input" name="uname" placeholder="Username">
          </div>

          <!-- PASSWORD -->
          <div class="group">            
            <input type="password" class="input" id="password-field" name="upass" placeholder="Password" onkeyup="validate();">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="float:right;left:-8px;margin-top:-27px;position:relative;z-index:2"></span>                    
            <div id="validation-txt" style="color:red; font-size:15px; width:300px"><!--warning text-->
            </div>
          </div>

          <!-- REMEMBER ME -->
          <div class="group">
            <div class="custom-checkbox">
              <input type="checkbox" value="remember me" id="rememberMe">
              <label for="rememberMe" class="text-gray">Remember Me</label>
            </div>
          </div>

          <!-- LOGIN -->
          <div class="group">
            <button class="btn primary block btn-lg weight-500" name="login">Login</button>
          </div>

        </div>
      </div>

      <!-- LINKS -->
      <div class="text-center weight-600 text-gray">
        <!-- <a href="" class="text-gray">Sign Up</a> ·  -->
        <a href="" class="text-gray">Forgot Password</a> · <a href=""
          class="text-gray">Need Help?</a>
      </div>
    </form>
  </div>

</section>

</body>
  <script>
    // function myFunction() {
    //   var x = document.getElementById("viewPass");
    //   if (x.type === "password") {
    //     x.type = "text";
    //   } else {
    //     x.type = "password";
    //   }
    // }

    function validate(){
      var  validationField = document.getElementById('validation-txt');
      var  password= document.getElementById('password-field');

      var content = password.value;
      var  errors = [];
      // console.log(content);
      if (content.length < 8) {
        errors.push("Your password must be at least 8 characters"); 
      }
      if (content.search(/[a-z]/i) < 0) {
        errors.push("Your password must contain at least one letter.");

      }
      if (content.search(/[0-9]/i) < 0) {
        errors.push("Your password must contain at least one digit."); 

      }
      if (errors.length > 0) {
        validationField.innerHTML = errors.join('');

        return false;
      }
        validationField.innerHTML = errors.join('');
        return true;

      }

      //view password /show
      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye-slash");
        var input = $($(this).attr("toggle"));//get input's password id
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
  </script>
</head>
