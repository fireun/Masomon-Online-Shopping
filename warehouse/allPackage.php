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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Package Managament</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Package Components:</h6>
            <a class="collapse-item active" href="allPackage.php">All Package</a>
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
      <li class="nav-item">
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
            <h1 class="h3 mb-0 text-gray-800">View All Package</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Package Management</li>
                <li class="breadcrumb-item active" aria-current="page">View All Package</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->
          <div class="row">

            <!-- Table -->
            <div class="col-xl-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Package</h6>
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
                            <tbody id="filterContent">
                                <tr>
                                    <td>12</td>
                                    <td>434</td>
                                    <td>Johor</td>
                                    <td>Agree</td>
                                    <td>Pending</td>
                                    <td>2020-11-12</td>
                                    <td>2020-11-12</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" title="View Detail"><i class="fas fa-info"></i></button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuTrackPage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"></button>
                                            <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuTrackPage">
                                                <button class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#updateTrack">Edit Status</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>12</td>
                                    <td>434</td>
                                    <td>Johor</td>
                                    <td>Agree</td>
                                    <td>Pending</td>
                                    <td>2020-11-12</td>
                                    <td>2020-11-12</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary w-75 m-1" title="View Detail"><i class="fas fa-info"></i></button>
                                        <button type="button" class="btn btn-danger w-75 m-1" title="Out Of Delivery"><i class="fas fa-shipping-fast"></i></button>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->

            <!-- Filter -->
            <div class="col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Filter Package</h6>
                    </div>
                    <div class="card-body">
                        <!-- Search - Fileter Product Name -->
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                      <span class="text-gray-800 font-weight-bold">Tracking ID: </span>
                                    </div>
                                    <div class="col-md-7">
                                    <input type="text" id="searchTrackId" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Name -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <span class="text-gray-800 font-weight-bold">Order ID: </span>
                                    </div>
                                    <div class="col-md-7">
                                    <input type="text" id="searchOrderId" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Price -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="text-gray-800 font-weight-bold">Unified: </span>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="custom-select" id="searchUnified" onmousedown="if(this.options.length>2){this.size=2;}"  onchange='this.size=0;' onblur="this.size=0;">
                                        <option selected value="all">All</option>
                                        <option value="Agree">Agree</option>
                                        <option value="Disagree">Disagree</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Name -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                      <span class="text-gray-800 font-weight-bold">Status: </span>
                                    </div>
                                    <div class="col-md-7">
                                      <select class="custom-select" id="searchStatus" onmousedown="if(this.options.length>3){this.size=3;}"  onchange='this.size=0;' onblur="this.size=0;">
                                        <option selected value="all">ALL</option>
                                        <option value="Picked Up">Picked Up</option>
                                        <option value="Out Of Delivery">Out Of Delivery</option>
                                        <option value="Closed">Completed</option>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Name -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="text-gray-800 font-weight-bold">Picked Up Date: </span>
                                    </div>
                                    <div class="col-md-7">
                                    <input type="date" id="searchDate" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            
                            <!-- Search - Fileter Product rowData -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="text-gray-800 font-weight-bold">Show Row: </span>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="custom-select" id="searchShowRow" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
                                          <option selected value="5">5</option>
                                          <option value="10">10</option>
                                          <option value="20">20</option>
                                          <option value="30">30</option>
                                          <option value="40">40</option>
                                          <option value="50">50</option>
                                          <option value="all">* All</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product rowData -->

                            <!-- Search - Fileter Button -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    
                                    </div>
                                    <div class="col-md-8">
                                        <button type="button" id="resetBtn" class="btn btn-primary ml-4">
                                          Reset
                                        </button>
                                        <button type="button" id="filterBtn" class="btn btn-primary float-right">
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Button -->
                    </div>
                </div>
            </div>
            
        
          </div>
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

  <!--Ajaxx-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>


<script>

  //sweet alert
  var flashdata = $('.flash-data').data('flashdata');
  if(flashdata == "OutOfDelivery-status-success-notic-01"){
        Swal.fire(
            'Updated Success!',
            'This Package has been successfully update!',
            'success'
        )
  }else if(flashdata == "OutOfDelivery-status-failed-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Update Status Failed',
            text: 'Please Try Later!'
        })
  }else if(flashdata == "closed-status-success-notic-01"){
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

  $(document).ready(function(){

    //reset
    $('#resetBtn').click(function(){
        location.reload();
    });
  

   showPackage(1); 

   function showPackage(page, trackId, orderId, unified, status, date, rowData){
       // var orderId = orderId.value;
       $.ajax({
           url:"../database/warehouse/actionProcess.php",
           method:"POST",
           data:{
             page:page,
             filterTrackId:trackId,
             filterOrderId:orderId,
             filterUnified:unified,
             filterStatus:status,
             filterDate:date,
             filterRowData:rowData,
             action:"filter"
           }, //this is what data send between hyperlink
           success:function(data)
           {
             $('#filterContent').html(data); //show in this dynaimic_content place
           }
       }); 
   }
  
    $('#filterBtn').click(function(){
        var track = $('#searchTrackId').val();
        var order = $('#searchOrderId').val();
        var u = $('#searchUnified').val();
        var s = $('#searchStatus').val();
        var pud = $('#searchDate').val();
        var row = $('#searchShowRow').val();

        showPackage(1, track, order, u, s, pud, row);
    });
  
  });


  function changeStatus(elemet){
    var updateOrder = $(elemet).attr("data-order");
    var updateTrack = $(elemet).attr("data-track");

    window.location.href = "../database/warehouse/actionProcess.php?updateTrack="+updateTrack+"&updateOrder="+updateOrder;
  }

  function closedStatus(closedId){
    var updateOrder = $(closedId).attr("data-order");
    var updateTrack = $(closedId).attr("data-track");

    $('#updateTrackId').val(updateTrack);
    $('#updateOrderId').val(updateOrder);
  }
  </script>
</body>

</html>
