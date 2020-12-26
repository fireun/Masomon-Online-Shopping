<?php

include("../config.php");
session_start();

$errorMessage = "";
$_SESSION['errorMessage'] = "" ;

if($_SESSION['errorMessage']){
    $errorMessage = $_SESSION['errorMessage'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
    <!------ Include the above in your HEAD tag ---------->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
        @media screen and (max-width: 800px){
            body {overflow-y: auto;}
            .mobile-register-container {display: block!important;}
            .mobile-register-form {margin: 0% 0% 0% 1%;}
            .mobile-register-term {margin: 10% 0% 10% 1%;}
        }
    </style>
</head>
<body style="background-image:url(../images/registerbg.jpg);background-repeat:no-repeat;background-size:cover;">
<?php require '../user/header.php' ?>
<div class="container-fluid">
    <section class="container">
		<div class="container-page d-flex mobile-register-container" style="margin-top: 10%;">				
			<div class="col-md-6 mobile-register-form" style="border-radius: 25px;background: white;padding: 2%;">
                <h3 class="dark-grey">Registration</h3>
                
				<form action="../database/user/register-process.php" method="post" class="needs-validation" novalidate>
                    <div class="form-group col-lg-12 row">
                        <label>Username</label>
                        <input type="text" name="inputname" class="form-control" value="" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Password</label>
                            <input type="password" name="inputpassword" class="form-control" id="Password" value=""  onkeyup="checkPassword()" required>
                            <div id="ErrorPass" class="text-danger"><?php echo $errorMessage;?></div>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label>Repeat Password</label>
                            <input type="password" name="inputdoublepassword" class="form-control" id="Password1" value=""  onkeyup="checkPassword()" required>
                            <div id="ErrorPass2" class="text-danger"><?php echo $errorMessage;?></div>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Email Address</label>
                            <input type="email" name="inputemail" class="form-control" value="" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        
                        <!-- <div class="form-group col-lg-6">
                            <label>Repeat Email Address</label>
                            <input type="" name="" class="form-control" id="" value="">
                        </div>		 -->
                    </div>				
        
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="checkbox" class="checkbox" required/> Sign up for our newsletter
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Check this checkbox to continue.</div>
                        </div>

                        <!-- <div class="col-sm-6">
                            <input type="checkbox" class="checkbox" />Send notifications to this email
                        </div>		 -->
                    </div>			
                </div>
                			
		
			<div class="col-md-6 mobile-register-term" style="border-radius: 25px;background: white;padding: 2%;margin-left:3%">
				<h3 class="dark-grey">Terms and Conditions</h3>
				<p>
					By clicking on "Register" you agree to The Company's' Terms and Conditions
				</p>
				<p>
					While rare, prices are subject to change based on exchange rate fluctuations - 
					should such a fluctuation happen, we may request an additional payment. You have the option to request a full refund or to pay the new price. (Paragraph 13.5.8)
				</p>
				<p>
					Should there be an error in the description or pricing of a product, we will provide you with a full refund (Paragraph 13.5.6)
				</p>
				<p>
					Acceptance of an order by us is dependent on our suppliers ability to provide the product. (Paragraph 13.5.6)
				</p>
				
				<button type="submit" name="register" class="btn btn-primary">Register</button>
            </div>
            </form>

		</div>
	</section>
</div>

<?php 
    if(isset($_GET['create-account'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_GET['create-account'];?>"></div>
    <?php } ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script><!-- Sweet Alert JS  -->
<script src="../js/homescript.js"></script>
<script>
    // Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


const flashdata = $('.flash-data').data('flashdata')
         if(flashdata == "Password-Error404-E1-NoMatchPassword"){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Password Not Match!',
                footer: '<a href>Why do I have this issue?</a>'
            })
         }else if(flashdata == "omethingError404-RAF-R2-E2"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
            })

         }else if(flashdata == "Account-Notif-1-RS1-0001"){
            Swal.fire(
                'Thank You!',
                'Welcome Your Join to Masamon Online Shopping!',
                'success'
            )
         }

// function checkPassword(){
//     var pass1 = document.getElementById('Password').value;
//     var pass2 = document.getElementById('Password1').value;

//     var errorM = document.getElementById('ErrorPass');
//     var errorM2 = document.getElementById('ErrorPass2');

//     if(pass1 == pass2){
//         errorM = "";
//         errorM2 = "";
//     }else {
//         errorM.innerHTML = "No Match Password !";
//         errorM2.innerHTML = "No Match Password !";
//     }
//     // console.log(pass1+" "+pass2);
// }
</script>
</html>