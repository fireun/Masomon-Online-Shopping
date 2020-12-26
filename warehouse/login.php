<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  // echo date('d-m-Y H:i:s'); //Returns IST
  $date =  date("Y-m-d h:i:s");

  //login
  if(isset($_POST['login'])){
    $getInputName = mysqli_real_escape_string($conn,$_POST['username']);
    $getInputPass = mysqli_real_escape_string($conn,$_POST['password']);

    //verify account
    if($getInputName!="" && $getInputPass!=""){
      $sqlVerify = "SELECT * FROM admin WHERE (adminName='$getInputName' OR adminEmail='$getInputName')";
      $result= mysqli_query($conn,$sqlVerify);//sql
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);
      if($count == 1){//if have username and password  正确
        $adminId=$row['adminId'];
        $adminName=$row['adminName'];
        $adminImage=$row['adminImage'];
        $HashPassword = $row['adminPassword'];
        $position = $row['adminPosition'];

        if (password_verify($getInputPass, $HashPassword)) {

          $_SESSION['m'] = "login-account-success-notic-01";
          $_SESSION['m_last_action'] = time();

          if($position == "warehouseAdmin"){
              $_SESSION['warehouseAdminId']=$adminId;
              $_SESSION['warehouseAdminName']=$adminName;
              $_SESSION['warehouseAdminImage']=$adminImage;
              header("location:./warehouseDashboard.php");
          }
          
        }else{//database 没有这个账户
          $_SESSION['m'] = "Wrong-Password-notic-01";
          $_SESSION['m_last_action'] = time();
        }

      }else{//database 没有这个账户
        $_SESSION['m'] = "Invalid-username-email-or-password-notic-01";
        $_SESSION['m_last_action'] = time();
      }

    }
  }

  //logout
  if(isset($_GET['logout'])){

    if(isset($_SESSION['warehouseAdminId'])){
      $warehouseAdminId = $_SESSION['warehouseAdminId'];
       $status = "offline";
      $udpatelastloginTime = "UPDATE admin SET status = '$status', lastLogin = '$date' WHERE adminId = '$warehouseAdminId'";
      $resultUpdateLastLogin = $conn->query($udpatelastloginTime);

      if($resultUpdateLastLogin == true){
          $_SESSION['m'] = "logout-success-notic-01";
          $_SESSION['m_last_action'] = time();
          session_destroy();
          header("location:./login.php");
      }

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

  <title>Warehouse Admin - Login</title>

  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image bg-light" style="background:url(../images/secure.png);background-size: cover;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                  </div>
                  
                  <form action="login.php" method="POST" class="needs-validation user" novalidate>
                      <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address or Username..." autofocus="" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input type="checkbox" class="custom-control-input" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                      </div>
                      <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                          Login
                      </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
                  </div>
                </div>
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

    var flashdata = $('.flash-data').data('flashdata');
    if(flashdata == "Invalid-username-email-or-password-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Invalid Username & password',
            text: 'Please input correct username & password!'
        })
    }else if(flashdata == "logout-success-notic-01"){
        Swal.fire(
            'Logout Success!',
            'success'
        )
    }else if(flashdata == "Wrong-Password-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Password wrong',
            text: 'Please input correct password!'
        })
    }

  </script>
</body>

</html>
