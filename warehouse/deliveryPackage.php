<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $date =  date("Y-m-d");// current year-month-days hours:minut:seconts
  $warehouseAdminId = $_SESSION['warehouseAdminId'];

  $_SESSION['warehouseAdminId'];
  $_SESSION['warehouseAdminName'];
  $_SESSION['warehouseAdminImage'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Warehouse Dashboard</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
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
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="warehouseDashboard.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-home"></i>
          <!-- <img src="../images/seller.png" alt="masomonOnlineShopping" width="80" height="80"> -->
        </div>
        <!-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
        <?php
          if($_SESSION['warehouseAdminId']){
        ?>
            <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['warehouseAdminName'];?></div>
        <?php
          }else{
        ?>
            <div class="sidebar-brand-text mx-3">Admin Name</div>
        <?php
          }
        ?>
      </a>
      

      <!-- Divider - line -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
        <a class="nav-link" href="warehouseDashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider - line -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Profile -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-user-shield"></i>
          <span>Profile</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Package
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Package Managament</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Package Components:</h6>
            <a class="collapse-item" href="allPackage.php">All Package</a>
            <a class="collapse-item" href="newPackage.php">New Package</a>
            <a class="collapse-item" href="searchPackage.php"><i class="fas fa-search"></i> Search Package</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Process
      </div>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link" href="deliveryPackage.php">
          <i class="fas fa-wrench"></i>
          <span>Out For Delivery</span></a>
      </li>

      <!-- Divider - line -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Profile -->
      <li class="nav-item">
        <a class="nav-link" href="#">
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



    <!-- content -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require 'navbar.php';?>
        <!-- End of Topbar -->


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Management Out For Delivery Package</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Process</li>
                <li class="breadcrumb-item active" aria-current="page">Management Out For Delivery Package</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->
          <div class="row">
            <div class="col-xl-12">
             <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-dark">Out For Delivery</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Tracking Number</td>
                                    <td>Order Id</td>
                                    <td>Ship To (State)</td>
                                    <td>Unified Delivery</td>
                                    <td>Status</td>
                                    <td>Picked Up Date</td>
                                    <td>Last Modified</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>Tracking Number</td>
                                    <td>Order Id</td>
                                    <td>Ship To (State)</td>
                                    <td>Unified Delivery</td>
                                    <td>Status</td>
                                    <td>Picked Up Date</td>
                                    <td>Last Modified</td>
                                    <td>Action</td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                    $outOfDelivery = "SELECT *, track.status AS 'currentStatus', track.update_time AS 'trackDate' FROM `track` LEFT JOIN `address_shipping` ON address_shipping.ship_id = track.shipId WHERE track.status = 'Out Of Delivery' AND track.adminReceiveName = '$warehouseAdminId'";
                                    $result = $conn->query($outOfDelivery);
                                    
                                    if($result ->num_rows>0){
                                      while($row = $result ->fetch_assoc()){
                                        $pickDate = date("Y-m-d h:i:s a",strtotime($row['adminPickUpDate']));
                                        $trackDate = date("Y-m-d h:i:s a",strtotime($row['trackDate']));
                                ?>
                                <tr>
                                    <td><?php echo $row ['trackId'];?></td>
                                    <td><?php echo $row['orderId'];?></td>
                                    <td><?php echo $row['recipient_state'];?></td>
                                    <td><?php echo $row['unifiedDelivery'];?></td>
                                    <td><?php echo $row['currentStatus'];?></td>
                                    <td><?php echo $pickDate;?></td>
                                    <td><?php echo $trackDate;?></td>
                                    <td>
                                    <a href=".././warehouse/packageDetail.php?trackId=<?php echo $row['trackId'];?>"  class="btn btn-primary w-75 m-1" title="View Detail" ><i class="fas fa-info"></i></a>
                                        <button type="button" class="btn btn-success w-75 m-1" title="closed" data-order="<?php echo $row['orderId'];?>" data-track="<?php echo $row['trackId'];?>" data-status="closed" onclick="changeStatus(this)" data-toggle="modal" data-target="#updateTrack"><i class="far fa-times-circle"></i></button>
                                    </td>
                                </tr>
                                <?php
                                      }
                                    }else{
                                ?>
                                  <tr>
                                      <td colspan="8" class="text-center text-muted">No More Out Of Delivery Status's Package Yet</td>
                                  </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              </div>
          </div>
          <!-- End Content Row -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require 'footer.php';?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- change track status -->
  <?php require 'updateTrack.php';?>

  <?php 
    if(isset($_SESSION['m'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
  <?php } ?>

  <!-- Logout Modal & Scroll to Top Button-->
  <?php require 'logout.php';?>

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

  //sweet alert
  var flashdata = $('.flash-data').data('flashdata');
  if(flashdata == "closed-status-success-notic-01"){
      Swal.fire(
            'Updated Successful!',
            'The Package Will Be Closed Soon!',
            'success'
        )
  }else if(flashdata == "closed-status-failed-notic-01"){
      Swal.fire({
            icon: 'error',
            title: 'Update Status Failed',
            text: 'Please Try Later!'
        })
  }

  function changeStatus(elemet){
    var updateOrder = $(elemet).attr("data-order");
    var updateTrack = $(elemet).attr("data-track");
    var updateStatus = $(elemet).attr("data-status");

    $('#updateTrackId').val(updateTrack);
    $('#updateOrderId').val(updateOrder);
    // window.location.href = "../database/warehouse/actionProcess.php?updateTrack="+updateTrack+"&updateOrder="+updateOrder+"&updateStatus="+updateStatus;
  }
  </script>
</body>

</html>
