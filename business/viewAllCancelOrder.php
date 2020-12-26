<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  // echo date('d-m-Y H:i:s'); //Returns IST
  $date =  date("Y-m-d");// current year-month-days hours:minut:seconts
  $first_day_of_month = date('Y-m-01', strtotime($date));// First day of the month.
  $last_day_of_month = date('Y-m-t', strtotime($date));// Last day of the month.
  $sellerId = $_SESSION['sellerId'];

  $cancelOrderMontlyNum = 0;
  $cancelOrderMontlyAmount =  0;
  $cancelOrderNum =  0;
  $cancelOrderAmount =  0;

  //calculate monthly total
  $calMontlyOrderCancel = "SELECT COUNT(cartintegration.cartIntegrationId) AS 'cancelTotalMontly', SUM(cartintegration.quantity * product.price) AS 'cancelTotalAmountMontly' FROM `actioncenter` LEFT JOIN cartintegration ON actioncenter.cartIntegrationId = cartintegration.cartIntegrationId LEFT JOIN product ON cartintegration.productId = product.id WHERE cartintegration.sellerId = '$sellerId' AND (actioncenter.created_time >= '$first_day_of_month' AND actioncenter.created_time <= '$last_day_of_month') AND actioncenter.action = 'cancel'";
  $resultCalMontlyTotal = $conn->query($calMontlyOrderCancel);
  if($resultCalMontlyTotal->num_rows > 0){
    while($row = $resultCalMontlyTotal->fetch_assoc()){
        $cancelOrderMontlyNum = $row['cancelTotalMontly'];
        $cancelOrderMontlyAmount = $row['cancelTotalAmountMontly'];

        if($cancelOrderMontlyAmount == NULL){
          $cancelOrderMontlyAmount = 0;
        }
      }
  }

  //calculate all total
  $calAllCancelOrder = "SELECT COUNT(actioncenter.actionId) AS 'cancelTotal', SUM(cartintegration.quantity * product.price) AS 'cancelTotalAmount' FROM `actioncenter` LEFT JOIN cartintegration ON actioncenter.cartIntegrationId = cartintegration.cartIntegrationId LEFT JOIN product ON cartintegration.productId = product.id WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel'";
  $resultCalTotal = $conn->query($calAllCancelOrder);
  if($resultCalTotal->num_rows > 0){
    while($row = $resultCalTotal->fetch_assoc()){
        $cancelOrderNum = $row['cancelTotal'];
        $cancelOrderAmount = $row['cancelTotalAmount'];

        if($cancelOrderAmount == NULL){
          $cancelOrderAmount = 0;
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

  <title>Seller View All Cancel Order</title>
  
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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-shopping-cart"></i>
          <span>View Order</span>
        </a>
        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Order Components:</h6>
            <a class="collapse-item" href="viewAllOrder.php">All Order</a>
            <a class="collapse-item active" href="viewAllCancelOrder.php">Cancel Order</a>
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
            <h1 class="h3 mb-0 text-gray-800">View All Cancel Order</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View All Cancel Order</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!--End Carts Short Tabs Row -->
          <div class="row">

                 <!-- Cancel Order Monthly (Monthly) -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cancel Order Total (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cancelOrderMontlyNum;?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                 <!-- End Cancel Order Monthly (Monthly) -->

                <!-- Cancel Order Amount (Monthly) -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cancel Total Amount (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">RM <?php echo $cancelOrderMontlyAmount;?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End Cancel Order Amount (Monthly) -->

                 <!-- Cancel Order All -->
                 <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Cancel Order Total</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cancelOrderNum;?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                 <!-- End All Cancel Order Monthly -->

                <!-- All Cancel Order Amount-->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">All Cancel Total Amount</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">RM <?php echo $cancelOrderAmount;?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End All Cancel Order Amount -->

          </div>
          <!--End Carts Short Tabs Row -->

          <!-- Content Row -->
          <div class="row">

                <!-- Left Column -->
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 col-12" style="display: inline-flex;">
                            <div class="col-md-6 col-6">
                                <h6 class="m-0 font-weight-bold text-primary">All Cancel Order Table</h6>
                                <span>* All statuses that are not 'packging' approve cancel directly</span>
                            </div>
                            <!-- generate report -->
                            <div class="col-md-6 col-6 ">
                                <a href="../database/seller/exportFile.php?action=exportAllCancelOrder" class="btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Order Detail</th>
                                          <th>Cancel Reason</th>
                                          <th>Additional Reason</th>
                                          <th>Cancel Date</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>Order Detail</th>
                                          <th>Cancel Reason</th>
                                          <th>Additional Reason</th>
                                          <th>Cancel Date</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php 
                                          $showCancelOrder = "SELECT *, actioncenter.created_time AS 'cancelDate', orderlist.orderId FROM `cartintegration` LEFT JOIN `actioncenter` ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId LEFT JOIN `product` ON cartintegration.productId = product.id LEFT JOIN `orderlist` ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' ORDER BY actioncenter.created_Time DESC";
                                          $resultShowCancelOrder = $conn->query($showCancelOrder);

                                          if($resultShowCancelOrder->num_rows > 0){
                                            while($row = $resultShowCancelOrder->fetch_assoc()){
                                              $cancelDate = date('Y-m-d h:i:s a', strtotime($row['cancelDate']));// First day of the month.
                                      ?>

                                        <tr>
                                            <td style="width:30%">
                                                <span class="font-weight-bold"><?php echo $row['name'];?></span> <br>
                                                <span class="text-secondary"><?php echo $row['variation'];?></span> 
                                                <span class="text-secondary"> x <?php echo $row['quantity'];?></span> <br>
                                                <span class="text-secondary">RM <?php echo $row['quantity'] * $row['price'];?></span> 
                                            </td>
                                            <td><?php echo $row['actionReason'];?></td>
                                            <td><?php echo $row['actionAddtionalReason'];?></td>
                                            <td><?php echo $cancelDate;?></td>
                                            <td><?php echo $row['actionStatus'];?></td>
                                            <td>
                                              <div class="btn-group">
                                                <a href="orderDetail.php?orderId=<?php echo $row['orderId'];?>&cartIntegrationId=<?php echo $row['cartIntegrationId'];?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Detail" ><i class="fas fa-eye"></i></a>
                                      <?php
                                            if($row['actionStatus'] == "pending"){
                                      ?>
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuOrderPage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"></button>
                                                <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuOrderPage">
                                                  <button class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#changeOrderStatusModal" value="<?php echo $row['cartIntegrationId'];?>" onclick="updateOrderStatus(this)">Edit Status</button>
                                                </div>
                                      <?php
                                            }else{
                                            }
                                      ?>
                                                
                                              </div>
                                            </td>
                                        </tr>
                                      <?php
                                            }
                                          }else{
                                      ?>
                                        <tr>
                                            <td colspan="6" class="text-center"> No More Cancel Order Yet</td>
                                        </tr>
                                      <?php
                                          }
                                      ?>
                                        <!-- <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>Pending</td>
                                            <td>
                                                <a href="#" class=" btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" style="padding: 5px 8px;">
                                                  <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr> -->
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
                    <h6 class="m-0 font-weight-bold text-primary">Latest Cancel Order</h6>
                  </a>
                  <!-- Card Content - Collapse -->
                  <div class="collapse show" id="collapseLatestCancel">
                    <div class="card-body">
                      
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                                <th>Order Detail</th>
                                <th>Cancel Reason</th>
                                <th>Additional Reason</th>
                                <th>Cancel Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                $LastestshowCancelOrder = "SELECT *, actioncenter.created_time AS 'cancelDate' FROM `cartintegration` LEFT JOIN `actioncenter` ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId LEFT JOIN product ON cartintegration.productId = product.id LEFT JOIN `orderlist` ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' ORDER BY actioncenter.created_time DESC LIMIT 0,3";
                                $resultLatestShowCancelOrder = $conn->query($LastestshowCancelOrder);

                                if($resultLatestShowCancelOrder->num_rows > 0){
                                  while($row = $resultLatestShowCancelOrder->fetch_assoc()){
                                    $cancelDate = date('Y-m-d h:i:s a', strtotime($row['cancelDate']));
                            ?>
                              <tr>
                                  <td style="width:30%">
                                      <span class="font-weight-bold"><?php echo $row['name'];?></span> <br>
                                      <span class="text-secondary"><?php echo $row['variation'];?></span> 
                                      <span class="text-secondary"> x <?php echo $row['quantity'];?></span> <br>
                                      <span class="text-secondary">RM <?php echo $row['quantity'] * $row['price'];?></span> 
                                  </td>
                                  <td><?php echo $row['actionReason'];?></td>
                                  <td><?php echo $row['actionAddtionalReason'];?></td>
                                  <td><?php echo $cancelDate;?></td>
                                  <td><?php echo $row['actionStatus'];?></td>
                                  <td>
                                    <div class="btn-group">
                                      <a href="orderDetail.php?orderId=<?php echo $row['orderId'];?>&cartIntegrationId=<?php echo $row['cartIntegrationId'];?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Detail" ><i class="fas fa-eye"></i></a>
                            <?php
                                  if($row['actionStatus'] == "pending"){
                            ?>
                                      <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuOrderPage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"></button>
                                      <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuOrderPage">
                                        <button class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#changeOrderStatusModal" value="<?php echo $row['cartIntegrationId'];?>" onclick="updateOrderStatus(this)">Edit Status</button>
                                      </div>
                            <?php
                                  }else{
                                  }
                            ?>
                                      
                                    </div>
                                  </td>
                              </tr>
                            <?php
                                  }
                                }else{
                            ?>
                              <tr>
                                  <td colspan="6" class="text-center"> No More Cancel Order Yet</td>
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

  <!-- Modal Change Order Status -->
  <form action="../database/seller/productAction.php" method="POST">
  <div class="modal fade" id="changeOrderStatusModal" tabindex="-1" aria-labelledby="changeOrderStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeOrderStatusModalLabel">Updated Cancel Order Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-lg-12">
            <input type="hidden" name="cartIntegrationId" id="updateStatusOrderId"><!---update id-->
            <input type="hidden" name="actionMethod" id="actionMethod" value="cancel">
            <select class="custom-select" name="selectUpdateStatus" id="displayStatusContent" onchange="rejectShow(this)">
                <option selected disabled="true"> -- Choose One Option --</option>
                <option value="approve">Approve</option>
                <option value="reject">Reject</option>
            </select>
            <div class="mt-3" id="rejectBox" style="display:none">
                <h5>Reject Reason</h5>
                <input type="text" name="rejectReason" id="validationRejectReason" onblur="validate()" class="form-control" placeholder="Please Given A Reason ...">
            </div>
           
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="updateCancelStatus" id="reasonDisable" class="btn btn-primary">Save changes</button>
        </div> 
      </div>
    </div>
  </div>
  </form>
  <!-- End Modal Change Order Status -->

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
   
  <!--Ajaxx-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

  <script>
  //for lastest order tooltip
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();     
  });

  //update order sttaus
  function updateOrderStatus(CartIntegrationId){
    var id = $(CartIntegrationId).val();
    // console.log( $(CartIntegrationId).val() );
    $('#updateStatusOrderId').val(id);
  }

  //check selection\
  function rejectShow(result){
    var selectResult = $(result).val();

    if(selectResult == "reject"){
      $("#reasonDisable").attr("disabled", true);
      $('#rejectBox').css('display','block');

    }else{
      $("#reasonDisable").attr("disabled", false);
      $('#rejectBox').css('display','none');
    }
  }
  

  //check if select reject
  function validate() {
		
		var valid = true;
		valid = checkEmpty($("#validationRejectReason"));
		
		$("#reasonDisable").attr("disabled",true);
		if(valid) {
			$("#reasonDisable").attr("disabled",false);
		}	
  }
  
  //checkEmpty
	function checkEmpty(obj) {
		if($(obj).val() == "") {
			return false;
		}
		return true;	
  }
  
  var flashdata = $('.flash-data').data('flashdata');
    if(flashdata == "update-status-success-notic-01"){
        Swal.fire(
            'Update Success!',
            'This Status has been successfully updated!',
            'success'
        )
    }else if(flashdata == "update-status-failed-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Updated Status Failed',
            text: 'Please Try Again!'
        })
    }
  </script>
</body>

</html>
