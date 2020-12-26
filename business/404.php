<?php
  include("../config.php");
  include '../limitTimeSession.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Seller - 404</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-home"></i>
                <!-- <img src="../images/seller.png" alt="masomonOnlineShopping" width="80" height="80"> -->
            </div>
            <!-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
            <?php
              if($_SESSION['sellerId']){
            ?>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['sellerName'];?></div>
            <?php
              }else{
            ?>
                <div class="sidebar-brand-text mx-3">Seller Name</div>
            <?php
              }
            ?>
            </a>


            <!-- Divider - line -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>

            <!-- Divider - line -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Profile -->
            <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-id-card"></i>
                <span>Profile</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Product
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Create</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Create Components:</h6>
                <a class="collapse-item" href="createProduct.php">Create Product</a>
                <a class="collapse-item" href="createAuctionProduct.php">Create Auction Product</a>
                </div>
            </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>View Product</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="viewAllProduct.php">Product</a>
                <a class="collapse-item" href="viewAllAuctionProduct.php">Auction Product</a>
                </div>
            </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Order
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-shopping-cart"></i>
                <span>View Order</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Order Components:</h6>
                <a class="collapse-item" href="viewAllOrder.php">All Order</a>
                <a class="collapse-item" href="viewAllCancelOrder.php">Cancel Order</a>
                <a class="collapse-item" href="viewAllReturnOrder.php">Return Order</a>
                </div>
            </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
            <a class="nav-link" href="viewAllReview.php">
            <i class="fas fa-comment-alt"></i>
                <span>View Review</span></a>
            </li>

            <!-- Divider - line -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Profile -->
            <li class="nav-item">
            <a class="nav-link" href="viewAllChart.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Chart</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require 'navbar.php';?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- 404 Error Text -->
          <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="dashboard.php">&larr; Back to Dashboard</a>
            <!-- <a role="button" onclick="window.history.back()">&larr; Back to previous page</a> -->
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal & Scroll to Top Button-->
  <?php require 'logout.php';?>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
