<?php
  include("../config.php");
  include '../limitTimeSession.php';
  
  $ratingAverage = 0;
  $ratingTotal = 0;
  $sellerId = $_SESSION['sellerId'];

  $ratingAgv = "SELECT CAST(AVG(ratingValue) AS DECIMAL(10,2)) AS 'ratingAvergae', COUNT(rating.ratingId) AS 'ratingTotal' FROM rating LEFT JOIN cartintegration ON rating.cartIntegrationId = cartintegration.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' GROUP BY rating.productId";
  $resultCalRating = $conn->query($ratingAgv);
  if($resultCalRating->num_rows > 0){
    while($row = $resultCalRating->fetch_assoc()){
        $ratingAverage = $row['ratingAvergae'];
        $ratingTotal = $row['ratingTotal'];
    }
    if($ratingAverage == NULL){
      $ratingAverage = 0;
    }
    if($ratingTotal == NULL){
      $ratingTotal = 0;
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

  <title>Seller View All Review</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    .checked {
      color: orange;
    }
  </style>
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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">View All Review</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View All Review</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!--End Carts Short Tabs Row -->
          <div class="row">

                 <!-- Review Average -->
                <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Review Average</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ratingAverage;?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                 <!-- End Review Order Monthly (Monthly) -->

                <!-- Review (Monthly) -->
                <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Number Of People Review</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ratingTotal;?></div>
                        </div>
                        <div class="col-auto">
                        <i class="far fa-grin fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Review (Monthly) -->

          </div>
          <!--End Carts Short Tabs Row -->

          <!-- Content Row -->
          <div class="row">

                <!-- Left Column - Latest Return Order -->
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 col-12" style="display: inline-flex;">
                            <!-- <div class="col-md-6 col-6"> -->
                                <h6 class="m-0 font-weight-bold text-primary">All Review Table</h6>
                            <!-- </div> -->
                            <!-- generate report -->
                            <!-- <div class="col-md-6 col-6 ">
                                <a href="#" class="btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            </div> -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Order Detail</th>
                                          <th>Customer Name</th>
                                          <th>Rating</th>
                                          <th>Comment</th>
                                          <th>Review Date</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>Order Detail</th>
                                          <th>Customer Name</th>
                                          <th>Rating</th>
                                          <th>Comment</th>
                                          <th>Review Date</th>
                                          <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $showReview = "SELECT rating.*, product.*, cartintegration.*, comment.*, user.userName, rating.created_time AS 'ratingDate', orderlist.orderId FROM `rating` LEFT JOIN `comment` ON rating.commentId = comment.commentId LEFT JOIN `user` ON rating.userId = user.userId LEFT JOIN cartintegration ON rating.cartIntegrationId = cartintegration.cartIntegrationId LEFT JOIN product ON cartintegration.productId = product.id LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.sellerId = '$sellerId' ORDER BY rating.ratingValue DESC";
                                            $resultShowReview = $conn->query($showReview);
                                            if($resultShowReview->num_rows > 0){
                                              while($row = $resultShowReview->fetch_assoc()){
                                                $ratingDate = date('Y-m-d h:i:s a', strtotime($row['ratingDate']));
                                        ?>
                                        <tr>
                                            <td style="width:30%">
                                                <span class="font-weight-bold"><?php echo $row['name'];?></span> <br>
                                                <span class="text-secondary"><?php echo $row['variation'];?></span> 
                                                <span class="text-secondary"> x <?php echo $row['quantity'];?></span> <br>
                                                <span class="text-secondary">RM <?php echo $row['quantity'] * $row['price'];?></span> 
                                            </td>
                                            <td><?php echo $row['userName']; ?></td>
                                            <td>
                                              <?php
                                                  for($x=0; $x<$row['ratingValue']; $x++){
                                              ?>
                                                      <span class="fa fa-star displaystar checked"></span>
                                              <?php
                                                  }
                                              ?>
                                            </td>
                                            <td><?php echo $row['commentText']; ?></td>
                                            <td><?php echo $ratingDate; ?></td>
                                            <td>
                                                <a href="orderDetail.php?orderId=<?php echo $row['orderId'];?>&cartIntegrationId=<?php echo $row['cartIntegrationId'];?>" class=" btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" style="padding: 5px 8px;">
                                                  <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                              }
                                            }else{
                                        ?>
                                            <td colspan="6" class="text-center"> No More Review Yet</td>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table Responsive -->
                        </div>
                        <!-- End Card Body -->
                    </div>
                    <!-- End Card -->
                </div>
                <!--End Left Column-->

                <!-- //Right Column//
                <div class="col-lg-4">
                    <div class="card shadow mb-4"> 
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Search Filter</h6>
                        </div>

                        <div class="card-body">
                            //Search - Fileter Product Name//
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                    Name: 
                                    </div>
                                    <div class="col-md-8">
                                    <input type="text" name="searchName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            //End Search - Fileter Product Name//

                            //Search - Fileter Product Price//
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    Total Price: 
                                    </div>
                                    <div class="col-md-8">
                                        <select class="custom-select" onmousedown="if(this.options.length>2){this.size=2;}"  onchange='this.size=0;' onblur="this.size=0;">
                                        <option selected>Normal</option>
                                        <option value="ASC">Low To High</option>
                                        <option value="DESC">High To Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            //End Search - Fileter Product Name//

                            //Search - Fileter Product Name//
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    Status: 
                                    </div>
                                    <div class="col-md-8">
                                      <select class="custom-select" onmousedown="if(this.options.length>3){this.size=3;}"  onchange='this.size=0;' onblur="this.size=0;">
                                        <option selected value="submitted">Pending</option>
                                        <option value="submitted">Submitted</option>
                                        <option value="packging">Packging</option>
                                        <option value="shipping">Shipping</option>
                                        <option value="closed">Completed</option>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            // End Search - Fileter Product Name//

                            //Search - Fileter Product Name//
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    Order Date: 
                                    </div>
                                    <div class="col-md-8">
                                    <input type="date" name="searchName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            //End Search - Fileter Product Name//

                            //Search - Fileter Product Name//
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    
                                    </div>
                                    <div class="col-md-8">
                                    <button type="button" class="btn btn-primary float-right">
                                        Filter
                                    </button>
                                    </div>
                                </div>
                            </div>
                            //End Search - Fileter Product Name//

                        </div>
                        //End card body//
                    </div>
                    //End card//
                </div>
                //End Right Column-// -->

          </div>
          <!--End Content Row -->

          <!-- Content Row -- Today Order-->
          <div class="row">

              <!-- Content Column -- LEFT-->
              <div class="col-lg-12 mb-2">

                <!-- Latest Order -->
                <div class="card shadow mb-2">
                  <!-- Card Header - Accordion -->
                  <a href="#collapseLatestCancel" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseLatestCancel">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Review</h6>
                  </a>
                  <!-- Card Content - Collapse -->
                  <div class="collapse show" id="collapseLatestCancel">
                    <div class="card-body">
                      
                      <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                  <th>Order Detail</th>
                                  <th>Customer Name</th>
                                  <th>Rating</th>
                                  <th>Comment</th>
                                  <th>Review Date</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $showReview = "SELECT rating.*, product.*, cartintegration.*, comment.*, user.userName, rating.created_time AS 'ratingDate', orderlist.orderId FROM `rating` LEFT JOIN `comment` ON rating.commentId = comment.commentId LEFT JOIN `user` ON rating.userId = user.userId LEFT JOIN cartintegration ON rating.cartIntegrationId = cartintegration.cartIntegrationId LEFT JOIN product ON cartintegration.productId = product.id LEFT JOIN orderlist ON cartIntegration.cartId = orderlist.cartId WHERE cartintegration.sellerId = '$sellerId' ORDER BY rating.created_time DESC LIMIT 0,3";
                                    $resultShowReview = $conn->query($showReview);
                                    if($resultShowReview->num_rows > 0){
                                      while($row = $resultShowReview->fetch_assoc()){
                                        $ratingDate = date('Y-m-d h:i:s a', strtotime($row['ratingDate']));
                                ?>
                                <tr>
                                    <td style="width:30%">
                                        <span class="font-weight-bold"><?php echo $row['name'];?></span> <br>
                                        <span class="text-secondary"><?php echo $row['variation'];?></span> 
                                        <span class="text-secondary"> x <?php echo $row['quantity'];?></span> <br>
                                        <span class="text-secondary">RM <?php echo $row['quantity'] * $row['price'];?></span> 
                                    </td>
                                    <td><?php echo $row['userName']; ?></td>
                                    <td>
                                        <?php
                                            for($x=0; $x<$row['ratingValue']; $x++){
                                        ?>
                                                <span class="fa fa-star displaystar checked"></span>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $row['commentText']; ?></td>
                                    <td><?php echo $ratingDate; ?></td>
                                    <td>
                                        <a href="orderDetail.php?orderId=<?php echo $row['orderId'];?>&cartIntegrationId=<?php echo $row['cartIntegrationId'];?>" class=" btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" style="padding: 5px 8px;">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                      }
                                    }else{
                                ?>
                                    <td colspan="6" class="text-center"> No More Review Yet</td>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                      </div>

                    </div>
                  </div>
                </div>
                <!--End cart -- Latest Order-->
              </div>

          </div>
          <!-- End Row Column Today Order -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require 'sellerFooter.php';?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->


  <!-- Logout Modal & Scroll to Top Button-->
  <?php require 'logout.php';?>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <script>
  //for lastest order tooltip
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();     
  });

  </script>
</body>

</html>
