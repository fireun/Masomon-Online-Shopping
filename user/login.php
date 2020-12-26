<?php

include("../config.php");
session_start();

$errorMessage = "";
//register
if(isset($_POST['login'])){
    $generateUserId = uniqid();
    $name=mysqli_real_escape_string($conn,$_POST['inputname']);
    $password=mysqli_real_escape_string($conn,$_POST['inputpass']);

	$verifySql = "select * from user where userName = '$name'";
	$result= $conn->query($verifySql) or die($conn->error.__LINE__);//sql
   	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$count = mysqli_num_rows($result);
	if($count == 1){//if have username and password  正确
		$userId = $row['userId'];
		$username = $row['userName'];
		$HashPassword = $row['password'];

		if (password_verify($password, $HashPassword)) {
			$_SESSION['userId'] = $userId;
			$_SESSION['username'] = $username;
			// $_SESSION['userpass'] = $Password;
			echo "<script>alert('login success !!!');
			window.history.go(-2);</script>";
		}
		else {
			echo "<script>alert('wrong password !');
			window.location.href= '../user/login.php';</script>";
		}  

	}else{//database 没有这个账户
		echo "<script>alert('unvalid username');
		window.location.href= '../user/login.php';</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/userlogin.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
	<link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/homestyle.css">
	
	<!-- header and footer link -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css"> -->

    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
<?php require '../user/header.php' ?>

<div class="login-form">
	
		<div class="login-container">
			<div class="img">

				<!-- <img src=""> -->
			</div>
			<div class="login-content">
				<form action="../user/login.php" method="post" id="login-form-content">
					<!-- <img src="img/avatar.svg"> -->
					<h2 class="title">Login</h2>
					<div class="input-div one">
					<div class="i">
							<i class="fas fa-user"></i>
					</div>
					<div class="div">
							<h5>Username</h5>
							<input type="text" name="inputname" class="input">
					</div>
					</div>
					<div class="input-div pass">
					<div class="i"> 
							<i class="fas fa-lock"></i>
					</div>
					<div class="div">
							<h5>Password</h5>
							<input type="password" name="inputpass" class="input">
					</div>
					</div>
					<a class="login-hyperlink" href="#">Forgot Password?</a>
					<a class="login-hyperlink" href="../user/register.php">Register Here</a>
					<input type="submit" class="btn" name="login" value="Login">
				</form>
			</div>
		</div>
</div>

<script src="../js/homescript.js"></script>
    <script>
    const inputs = document.querySelectorAll(".input");


    function addcl(){
        let parent = this.parentNode.parentNode;
        parent.classList.add("focus");
    }

    function remcl(){
        let parent = this.parentNode.parentNode;
        if(this.value == ""){
            parent.classList.remove("focus");
        }
    }


    inputs.forEach(input => {
        input.addEventListener("focus", addcl);
        input.addEventListener("blur", remcl);
    });
    </script>
</body>
</html>