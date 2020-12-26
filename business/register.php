<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  // echo date('d-m-Y H:i:s'); //Returns IST
  $date =  date("Y-m-d h:i:s");

  //create account
  if(isset($_POST['register'])){
    $create_seller_id = uniqid();
    $create_seller_name = mysqli_real_escape_string($conn,$_POST['username']);
    $create_seller_phone = mysqli_real_escape_string($conn,$_POST['phoneNo']);
    $create_seller_email = mysqli_real_escape_string($conn,$_POST['email']);
    $create_seller_password = mysqli_real_escape_string($conn,$_POST['password1']);    
    $create_seller_password1 = mysqli_real_escape_string($conn,$_POST['password2']); 
    
    if($create_seller_password == $create_seller_password1){
      $checkValidname = "SELECT sellerName FROM seller WHERE sellerName = '$create_seller_name' or email = '$create_seller_email'";
      $resultCheckValid = $conn->query($checkValidname);

      //check valid seller
      if($resultCheckValid ->num_rows == '0'){
          
        //make insert new seller
        $newPassword = password_hash("$create_seller_password" , PASSWORD_DEFAULT);
        $newPassword2 = password_hash("$create_seller_password1" , PASSWORD_DEFAULT);

        $insertNewSeller = "INSERT INTO `seller`(`sellerId`, `sellerName`, `email`, `phoneNo`, `gender`, `image`, `address`, `city`, `state`, `postalCode`, `businessType`, `bankName`, `accountNo`, `password`, `created_time`, `lastLogin`) VALUES ('$create_seller_id','$create_seller_name','$create_seller_email','$create_seller_phone','','','','','','','','','','$newPassword','$date','$date')";
        $resultInsertNewSeller = $conn->query($insertNewSeller);

        if($resultInsertNewSeller == true){
          $_SESSION['sellerId']=$create_seller_id;
          $_SESSION['sellerName']=$create_seller_name;
          $_SESSION['m'] = "seller-create-new-account-success-notic-01";
          $_SESSION['m_last_action'] = time();
          header("location: ./dashboard.php");
        }

      }else{
        $_SESSION['m'] = "Username-or-email-valid-in-data-notic-01";
        $_SESSION['m_last_action'] = time();
      }

    }else{
      $_SESSION['m'] = "Password-no-match-notic-01";
      $_SESSION['m_last_action'] = time();
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Seller - Register</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-info">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"  style="background:url(../images/sellerLogin.jpg);"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>

              <form action="register.php" method="POST" class="needs-validation user" novalidate>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="username" class="form-control form-control-user" id="exampleFirstName" placeholder="Username" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="phoneNo" class="form-control form-control-user" id="exampleLastName" placeholder="Phone Number" onkeypress="return isNumber(event)" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" required>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                </div>
                <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
                <hr>
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
              </form>
              <hr> -->
              <!-- <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div> -->
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php 
    if(isset($_SESSION['m'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
  <?php } ?>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Sweet Alert JS  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>

  var flashdata = $('.flash-data').data('flashdata');
    if(flashdata == "Password-no-match-notic-01"){
        Swal.fire({
            icon: 'warning',
            title: 'Password no match',
            text: 'Please input correct password!'
        })
    }else if(flashdata == "Username-or-email-valid-in-data-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Register Faild',
            text: 'Username or email already exists!'
        })
    }

    
    //validation phone number
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    // Disable form submissions if there are invalid fields -- form validation
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
  </script>
</body>

</html>
