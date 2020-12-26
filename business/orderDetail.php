<?php
  include("../config.php");
  include '../limitTimeSession.php';

  if($_GET['orderId']){
    $view_orderDetail_orderId = $_GET['orderId'];
    $sellerId = $_SESSION['sellerId'];
    

      if(isset($_GET['cartIntegrationId'])){
          $view_orderDetail_cartIntegrationId = $_GET['cartIntegrationId'];
        
          $showCartIntegration = "SELECT *, cartintegration.update_time AS 'modifiedDate', cartintegration.status AS 'cartStatus', payment.update_time AS 'paymentDate', orderlist.cartId AS 'CartID' FROM `cartintegration` LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId LEFT JOIN payment ON orderlist.orderId = payment.order_id LEFT JOIN product ON cartintegration.productId = product.id LEFT JOIN address_shipping ON orderlist.shipId = address_shipping.ship_id LEFT JOIN cart ON cartintegration.cartId = cart.cartId WHERE cartintegration.sellerId = '$sellerId' AND cartintegration.cartIntegrationId = '$view_orderDetail_cartIntegrationId'"; 
          $resultShowCartIntegration = $conn->query($showCartIntegration);

          if($resultShowCartIntegration->num_rows > 0){
            while($row = $resultShowCartIntegration->fetch_assoc()){
                  $view_orderDetail_cartId = $row['CartID'];
                  $view_orderDetail_productImage = $row['coverImage'];
                  $view_orderDetail_productName = $row['name'];
                  $view_orderDetail_variation = $row['variation'];
                  $view_orderDetail_quantity = $row['quantity'];
                  $view_orderDetail_cancelRequest = $row['cancelRequest'];
                  $view_orderDetail_returnRequest = $row['returnRequest'];
                  $view_orderDetail_productPrice = $row['price'];
                  $view_orderDetail_cartTotalPrice = $view_orderDetail_quantity*$view_orderDetail_productPrice;
                  $view_orderDetail_cartStatus = $row['cartStatus'];
                  $view_orderDetail_cartModifiedDate = $row['modifiedDate'];
                  $view_orderDetail_paymentMethod = $row['paymentMethod'];
                  $view_orderDetail_paymentDate = $row['paymentDate'];
                  $view_orderDetail_orderUnifiedDeliver = $row['unifiedDelivery'];
                  $view_orderDetail_receiverName = $row['recipient_name'];
                  $view_orderDetail_receiverPhone = $row['recipient_phone'];
                  $view_orderDetail_receiverAddress = $row['recipient_address'];
                  $view_orderDetail_receiverCity = $row['recipient_city'];
                  $view_orderDetail_receiverState = $row['recipient_state'];
                  $view_orderDetail_receiverPostalCode = $row['recipient_postalCode'];
                  $view_orderDetail_receiverCountry = $row['recipient_country'];

                  $view_orderDetail_cartModifiedDate = date('Y-m-d h:i:s a', strtotime($view_orderDetail_cartModifiedDate));
                  if($view_orderDetail_orderUnifiedDeliver == '0'){
                    $view_orderDetail_orderTotal = ($view_orderDetail_cartTotalPrice + 5) * 0.10;
                  }else if($view_orderDetail_orderUnifiedDeliver == '1'){
                    $view_orderDetail_orderTotal = ($view_orderDetail_cartTotalPrice + 5);
                  }

            }

            //get cancel & return
            $showAction = "SELECT actioncenter.*, cartintegration.*, actioncenter.created_time AS 'requestDate', actioncenter.update_time AS 'processDate' FROM `actioncenter` LEFT JOIN cartintegration ON actioncenter.cartIntegrationId = cartintegration.cartIntegrationId WHERE actioncenter.cartIntegrationId = '$view_orderDetail_cartIntegrationId'";
            $resultShowAction = $conn->query($showAction);

            if($resultShowAction->num_rows > 0){
              while($row = $resultShowAction->fetch_assoc()){
                $view_action_id = $row['actionId'];
                $view_action_reason = $row['actionReason'];
                $view_action_method = $row['action'];
                $view_action_addtinalReason = $row['actionAddtionalReason'];
                $view_action_actionStatus = $row['actionStatus'];
                $view_action_actionRejectReason = $row['actionSellerComment'];
                $view_action_actionSellerComment = $row['actionSellerComment'];
                $view_action_requestDate = $row['requestDate'];
                $view_action_processDate = $row['processDate'];
              }
                                  
              $view_action_requestDate = date('Y-m-d h:i:s a', strtotime($view_action_requestDate));
              $view_action_processDate = date('Y-m-d h:i:s a', strtotime($view_action_processDate));
            }else{
              $view_action_method=" ";
            }


          }else{
            header("location:404.php");
            die();
          }
      }
  }else{
    header("location:404.php");
    die();
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

  <title>Seller Order Detail</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    
    .post-container .post-detail{
      /* margin-left: 65px; */
      position: relative;
      width:100%;
    }

    .post-container .post-detail .post-text{
      line-height: 24px;
      margin: 0;
    }

    .post-container .post-detail .reaction{
      position: absolute;
      right: 0;
      top: 0;
    }

    .post-container .post-detail .post-comment{
      display: inline-flex;
      margin: 10px auto;
      width: 100%;
    }

    .post-container .post-detail .post-comment img.profile-photo-sm{
      margin-right: 10px;
    }

    .post-container .post-detail .post-comment .form-control{
      height: 36px;
      border: 1px solid #ccc;
      box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
      margin: 7px 0;
      min-width: 0;
    }

    img.profile-photo-md {
        height: 50px;
        width: 50px;
        border-radius: 50%;
    }

    img.profile-photo-sm {
        height: 40px;
        width: 40px;
        border-radius: 50%;
    }

    .text-green {
        color: #8dc63f;
    }

    .text-red {
        color: #ef4136;
    }

    .following {
        color: #8dc63f;
        font-size: 12px;
        margin-left: 20px;
    }

    .submitReplyPost {
        margin-top:10%;
    }

    #button-addon2{
      height:36px;
      margin-top:9%;
    }

    .checked {
      color: orange;
    }

    .tracking-detail {
        padding:3rem 0
    }

    #tracking {
        margin-bottom:1rem
    }
        [class*=tracking-status-] p {
        margin:0;
        font-size:1.1rem;
        color:#fff;
        text-transform:uppercase;
        text-align:center
    }
    [class*=tracking-status-] {
        padding:1.6rem 0
    }
    .tracking-status-intransit {
        background-color:#65aee0
    }
    .tracking-status-outfordelivery {
        background-color:#f5a551
    }
    .tracking-status-deliveryoffice {
        background-color:#f7dc6f
    }
    .tracking-status-delivered {
        background-color:#4cbb87
    }
    .tracking-status-attemptfail {
        background-color:#b789c7
    }
    .tracking-status-error,.tracking-status-exception {
        background-color:#d26759
    }
    .tracking-status-expired {
        background-color:#616e7d
    }
    .tracking-status-pending {
        background-color:#ccc
    }
    .tracking-status-inforeceived {
        background-color:#214977
    }
    .tracking-list {
        border:1px solid #e5e5e5
    }
    .tracking-item {
        border-left:1px solid #e5e5e5;
        position:relative;
        padding:2rem 1.5rem .5rem 2.5rem;
        font-size:.9rem;
        margin-left:3rem;
        min-height:5rem
    }
    .tracking-item:last-child {
        padding-bottom:4rem
    }
    .tracking-item .tracking-date {
        margin-bottom:.5rem
    }
    .tracking-item .tracking-date span {
        color:#888;
        font-size:85%;
        padding-left:.4rem
    }
    .tracking-item .tracking-content {
        padding:.5rem .8rem;
        background-color:#f4f4f4;
        border-radius:.5rem
    }
    .tracking-item .tracking-content span {
        display:block;
        color:#888;
        font-size:85%
    }
    .tracking-item .tracking-icon {
        line-height:2.6rem;
        position:absolute;
        left:-1.3rem;
        width:2.6rem;
        height:2.6rem;
        text-align:center;
        border-radius:50%;
        font-size:1.1rem;
        background-color:#fff;
        color:#fff
    }
    .tracking-item .tracking-icon.status-sponsored {
        background-color:#f68
    }
        .tracking-item .tracking-icon.status-delivered {
        background-color:#4cbb87
    }
    .tracking-item .tracking-icon.status-outfordelivery {
        background-color:#f5a551
    }
    .tracking-item .tracking-icon.status-deliveryoffice {
        background-color:#f7dc6f
    }
    .tracking-item .tracking-icon.status-attemptfail {
        background-color:#b789c7
    }
    .tracking-item .tracking-icon.status-exception {
        background-color:#d26759
    }
    .tracking-item .tracking-icon.status-inforeceived {
        background-color:#214977
    }
    .tracking-item .tracking-icon.status-intransit {
        color:#e5e5e5;
        border:1px solid #e5e5e5;
        font-size:.6rem
    }
    @media(min-width:992px) {
        .tracking-item {
        margin-left:10rem
    }
    .tracking-item .tracking-date {
        position:absolute;
        left:-10rem;
        width:7.5rem;
        text-align:right
    }
    .tracking-item .tracking-date span {
        display:block
    }
    .tracking-item .tracking-content {
        padding:0;
        background-color:transparent
    }
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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-shopping-cart"></i>
          <span>View Order</span>
        </a>
        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Order Components:</h6>
            <?php
              if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0')){
            ?>
                <a class="collapse-item active" href="viewAllOrder.php">All Order</a>
                <a class="collapse-item" href="viewAllCancelOrder.php">Cancel Order</a>
                <a class="collapse-item" href="viewAllReturnOrder.php">Return Order</a>
            <?php
              }else if( ($view_orderDetail_cancelRequest == '1') && ($view_orderDetail_returnRequest == '0')){
            ?>
                <a class="collapse-item" href="viewAllOrder.php">All Order</a>
                <a class="collapse-item active" href="viewAllCancelOrder.php">Cancel Order</a>
                <a class="collapse-item" href="viewAllReturnOrder.php">Return Order</a>
            <?php
              }else if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '1') ){
            ?>
                <a class="collapse-item" href="viewAllOrder.php">All Order</a>
                <a class="collapse-item" href="viewAllCancelOrder.php">Cancel Order</a>
                <a class="collapse-item active" href="viewAllReturnOrder.php">Return Order</a>
            <?php
              }
            ?>

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
            <?php
              if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0')){
            ?>
                <h1 class="h3 mb-0 text-gray-800">View Order Detail</h1>
            <?php
              }else if( ($view_orderDetail_cancelRequest == '1') && ($view_orderDetail_returnRequest == '0')){
            ?>
                <h1 class="h3 mb-0 text-gray-800">View Cancel Order Detail</h1>
            <?php
              }else if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '1') ){
            ?>
                <h1 class="h3 mb-0 text-gray-800">View Return Order Detail</h1>
            <?php
              }
            ?>
            
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <?php
                  if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0')){
                ?>
                     <li class="breadcrumb-item"><a href="viewAllOrder.php">View All Order</a></li>
                     <li class="breadcrumb-item active" aria-current="page">View Order Detail</li>
                <?php
                  }else if( ($view_orderDetail_cancelRequest == '1') && ($view_orderDetail_returnRequest == '0')){
                ?>
                     <li class="breadcrumb-item"><a href="viewAllCancelOrder.php">View All Cancel Order</a></li>
                     <li class="breadcrumb-item active" aria-current="page">View Cancel Order Detail</li> 
                <?php
                  }else if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '1') ){
                ?>
                     <li class="breadcrumb-item"><a href="viewAllReturnOrder.php">View All Return Order</a></li>
                     <li class="breadcrumb-item active" aria-current="page">View Return Order Detail</li>
                <?php
                  } 
                  if(isset($_GET['cartIntegrationId'])){
                ?>
                  <li class="breadcrumb-item active" aria-current="page">Order <?php echo $view_orderDetail_cartIntegrationId;?></li>
                <?php
                    }
                ?>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->
          <div class="row">

                <!-- Left Order Detail -->
                <div class="col-lg-5 mb-2">
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseOrderDetail" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseOrderDetail">
                            <h6 class="m-0 font-weight-bold text-primary">Order Detail</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseOrderDetail">
                            <div class="card-body" style="padding:0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width:10%">
                                                    <div class="btn btn-secondary w-100" data-toggle="tooltip" data-placement="top" title="Payment Method">
                                                        <i class="far fa-credit-card"></i>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                      if(isset($_GET['cartIntegrationId'])){
                                                        echo $view_orderDetail_paymentMethod;
                                                      }else{
                                                    ?>
                                                        Payment Method
                                                    <?php
                                                      }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:10%">
                                                    <div class="btn btn-secondary w-100" data-toggle="tooltip" data-placement="top" title="Payment Date">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                </td>
                                                <td>
                                                  <?php
                                                      if(isset($_GET['cartIntegrationId'])){
                                                        echo $view_orderDetail_paymentDate;
                                                      }else{
                                                    ?>
                                                       Payment Date 
                                                    <?php
                                                      }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:10%">
                                                    <div class="btn btn-secondary w-100" data-toggle="tooltip" data-placement="top" title="Unified Delivery">
                                                        <i class="fas fa-shipping-fast"></i>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                      if(isset($_GET['cartIntegrationId'])){
                                                        if($view_orderDetail_orderUnifiedDeliver == '0'){
                                                          echo "Agree";
                                                        }else if($view_orderDetail_orderUnifiedDeliver == '1'){
                                                          echo "Disagree";
                                                        }
                                                      }else{
                                                    ?>
                                                        Unified Delivery
                                                    <?php
                                                      }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:10%">
                                                    <div class="btn btn-secondary w-100" data-toggle="tooltip" data-placement="top" title="Total Amount">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </div>
                                                </td>
                                                <td>
                                                  <?php
                                                      if(isset($_GET['cartIntegrationId'])){
                                                        echo "RM ".$view_orderDetail_orderTotal;
                                                      }else{
                                                    ?>
                                                        Total Order
                                                    <?php
                                                      }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!--End table responsive-->
                            </div><!--End card Body-->
                        </div><!--End card conten-->
                    </div><!--End all card-->
                </div><!-- End Left Order Detail -->
                

                <!-- Right Order Shipping -->
                <div class="col-lg-7 mb-2">
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseOrderShipping" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseOrderShipping">
                            <h6 class="m-0 font-weight-bold text-primary">Shipping & Address</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseOrderShipping">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td style="width:10%">
                                                        <div class="btn btn-secondary w-100"  data-toggle="tooltip" data-placement="top" title="Receiver's Name">
                                                            <i class="fas fa-address-card"></i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <?php
                                                      if(isset($_GET['cartIntegrationId'])){
                                                        echo $view_orderDetail_receiverName;
                                                      }else{
                                                      ?>
                                                          Receiver's Name
                                                      <?php
                                                        }
                                                      ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:10%">
                                                        <div class="btn btn-secondary w-100"  data-toggle="tooltip" data-placement="top" title="Receiver's Phone">
                                                            <i class="fas fa-phone-square-alt"></i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                      <?php
                                                        if(isset($_GET['cartIntegrationId'])){
                                                          echo $view_orderDetail_receiverPhone;
                                                        }else{
                                                      ?>
                                                        Receiver's Phone  
                                                      <?php
                                                        }
                                                      ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:10%">
                                                        <div class="btn btn-secondary w-100"  data-toggle="tooltip" data-placement="top" title="Receiver's Address">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                      <?php
                                                        if(isset($_GET['cartIntegrationId'])){
                                                          echo $view_orderDetail_receiverAddress.", ".$view_orderDetail_receiverCity.", ".$view_orderDetail_receiverState.", ".$view_orderDetail_receiverPostalCode.", ".$view_orderDetail_receiverCountry;
                                                        }else{
                                                      ?>
                                                          Receiver's Address
                                                      <?php
                                                        }
                                                      ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div><!--End table responsive-->
                            </div><!--End card body-->
                        </div><!--End card content-->
                    </div><!--End card all-->
                </div><!-- End Right Order Shipping -->

          </div>
          <!-- Content Row -->

          <!--Content Row -- Order -->
          <div class="row">
                <div class="col-lg-12">
                    <!-- Default Card Example -->
                    <div class="card mb-4">
                        <div class="card-header">
                          <?php
                            if(isset($_GET['cartIntegrationId'])){
                              echo $view_orderDetail_orderId;
                            }else{
                          ?>
                              Order (Order Id)
                          <?php
                            }
                          ?>
                        </div><!--End card header--->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Product Image</th>
                                            <th scope="col" style="width:30%">Product Name</th>
                                            <th scope="col">Variaton</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Modified Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          if(isset($_GET['cartIntegrationId'])){
                                        ?>
                                          <tr>
                                              <?php
                                                if( ($view_orderDetail_cartStatus != 'closed') && ($view_orderDetail_cartStatus != 'shipping') && ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0')){
                                              ?>
                                                  <td>
                                                      <input type="checkbox" name="cartIntegration[]" value="<?php echo $view_orderDetail_cartIntegrationId;?>">
                                                  </td>
                                              <?php
                                                }else{
                                              ?>
                                                  <td> </td>
                                              <?php
                                                }
                                              ?>
                                              <td> <img src="../images/productImage/<?php echo $view_orderDetail_productImage;?>" width="70px" height="70px"></td>
                                              <td><?php echo $view_orderDetail_productName;?></td>
                                              <td><?php echo $view_orderDetail_variation;?></td>
                                              <td><?php echo $view_orderDetail_quantity;?></td>
                                              <td><?php echo $view_orderDetail_productPrice;?></td>
                                              <td><?php echo $view_orderDetail_cartTotalPrice;?></td>
                                              <td><?php echo $view_orderDetail_cartStatus;?></td>
                                              <td><?php echo $view_orderDetail_cartModifiedDate;?></td>
                                          </tr>
                                        <?php
                                          }else{
                                        ?>
                                          <tr>
                                            <td colspan="8" class="text-right">No More Result</td>
                                        </tr>
                                        <?php
                                          }
                                        ?>
                                    </tbody>
                                </table>
                            </div><!--End responsive table--->
                        </div><!--End Card Body--->

                        <div class="card-footer text-muted">
                          <div class="float-right">
                              <?php
                                if( ($view_orderDetail_cartStatus != 'closed') && ($view_orderDetail_cartStatus != 'shipping') && ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0')){
                              ?>
                                <button type="button" id="updateStatus" class="btn btn-success" data-toggle="modal" data-target="#changeOrderStatusModal">  
                                    <i class="fas fa-upload"></i>
                                </button>
                              <?php
                                }else{

                                }
                              ?>
                              
                          </div><!--End float-right--->
                        </div><!---End card footer-->

                    </div><!---End card-->
                </div><!--End col-lg-12--->
          </div>
          <!--End Content Row - Order -->

          
          <?php if( ($view_orderDetail_cartStatus == "shipping") || ($view_orderDetail_cartStatus == "closed")){
          ?>
          <!-- Content Row -->
          <div class="row">

                <!-- content 12 Detail -->
                <div class="col-xl-12">
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapsetrackDetail" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapsetrackDetail">
                            <h6 class="m-0 font-weight-bold text-primary">Track Order</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapsetrackDetail">
                            <div class="card-body" style="padding:0">
                            <div class="col-md-12 col-lg-12">
                              <?php
                                  if($view_orderDetail_orderUnifiedDeliver == "0"){
                                      $trackPackage = "SELECT *,trackhistory.created_time AS 'processTime', trackhistory.status AS 'processStatus' FROM `trackhistory` LEFT JOIN trackintegration ON trackhistory.trackCartIntegrationId = trackintegration.trackIntegrationId LEFT JOIN track ON track.orderId = trackintegration.orderId WHERE trackhistory.trackOrderId = '$view_orderDetail_orderId' GROUP BY trackhistory.status ORDER BY trackhistory.created_time DESC";
                                  }else if($view_orderDetail_orderUnifiedDeliver == "1"){
                                      $trackPackage = "SELECT *,trackhistory.created_time AS 'processTime', trackhistory.status AS 'processStatus' FROM track LEFT JOIN trackhistory ON track.trackId = trackhistory.trackCartIntegrationId WHERE track.trackIntegrationId = '$view_orderDetail_cartIntegrationId' GROUP BY trackhistory.status ORDER BY trackhistory.created_time DESC";
                                  }
                                  $resultTrackPackage = $conn->query($trackPackage);
                                  if($resultTrackPackage ->num_rows>0){
                                      while($row = $resultTrackPackage ->fetch_assoc()){
                                          $monthAndDay = date("M d",strtotime($row['processTime']));
                                          $year = date("Y",strtotime($row['processTime']));
                                          $time = date("h:i a",strtotime($row['processTime']));
                                          $packageStatus = $row['processStatus'];
                                          $currentLocation = $row['location'];    

                                          if($packageStatus == "In Transit"){
                            ?>
                              <div class="tracking-item">
                                  <div class="tracking-icon status-intransit bg-light ">
                                  <svg t="1607874081471" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3617" width="32" height="32"><path d="M592.895494 660.482272 818.174086 1011.20008C827.326029 1019.20003 838.781958 1023.680002 850.813882 1023.936 863.9338 1024.064 876.157724 1019.20003 884.79767 1010.688083 909.693514 973.504316 848.893894 734.46581 765.694414 487.683352L592.895494 660.482272 592.895494 660.482272ZM999.228955 26.886232C961.853188-10.617534 914.237486-6.713558 882.237686 25.158243L621.119318 285.252617C465.152293 235.588928 182.978056 139.653527 76.482722 139.653527 61.634815 139.653527 55.106856 141.317517 52.86687 142.021512 36.098974 160.261398 35.714977 188.229224 51.970875 206.789108L442.816432 462.787508 248.769645 656.0663C248.769645 656.0663 99.074581 625.218492 77.186718 622.33851 46.658908 618.370535 11.459128 645.122368 77.058718 678.594159 153.66624 717.569915 243.393679 762.881632 243.393679 762.881632 243.393679 762.881632 298.625334 870.33696 332.353123 929.53659 375.296854 1001.152143 400.512697 966.40036 395.392729 929.53659 390.33676 892.80082 373.120868 768.577596 373.120868 768.577596L557.695714 577.090793 738.750583 396.675921 996.412972 139.973525C1028.476772 108.101724 1036.476722 64.261998 999.228955 26.886232L999.228955 26.886232Z" p-id="3618" fill="#515151"></path></svg>
                                      <!-- <i class="fas fa-clipboard-list"></i> -->
                                  </div>
                                  <div class="tracking-date"><?php echo $monthAndDay;?>, <?php echo $year;?><span><?php echo $time;?></span></div>
                                  <div class="tracking-content">Shipment designated to <?php echo $view_orderDetail_receiverState;?> [<?php echo $view_orderDetail_receiverState;?> Warehouse]<span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
                              </div>
                            <?php
                                          }else if($packageStatus == "pending"){
                            ?>
                              <div class="tracking-item">
                                  <div class="tracking-icon status-intransit  bg-light">
                                  <svg t="1607873896985" class="icon" viewBox="0 0 1280 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1719" width="30" height="30"><path d="M1008 416H272c-44.2 0-80 35.8-80 80v496c0 17.6 14.4 32 32 32h32c17.6 0 32-14.4 32-32v-96h704v96c0 17.6 14.4 32 32 32h32c17.6 0 32-14.4 32-32V496c0-44.2-35.8-80-80-80z m-16 416H288v-128h704v128z m0-192H288v-128h704v128z m203.8-419.8L692.6 10.6c-34-14-71.4-14.2-105.2 0L84.2 220.2C33 241.4 0 291 0 346.4V992c0 17.6 14.4 32 32 32h32c17.6 0 32-14.4 32-32V346.4c0-16.6 9.8-31.4 25-37.6L624.4 99.2c10.2-4.2 21.2-4.2 31.4 0l503.2 209.6c15.2 6.4 25 21.2 25 37.6V992c0 17.6 14.4 32 32 32h32c17.6 0 32-14.4 32-32V346.4c0-55.4-33-105-84.2-126.2z" p-id="1720"></path></svg>
                                      <!-- <i class="fas fa-circle"></i> -->
                                  </div>
                                  <div class="tracking-date"><?php echo $monthAndDay;?>, <?php echo $year;?><span><?php echo $time;?></span></div>
                                  <div class="tracking-content">Shipment arrived at [<?php echo $view_orderDetail_receiverState;?> Warehouse] , MALAYSIA station.<span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
                              </div>
                            <?php
                                          }else if($packageStatus == "picked up"){
                            ?>
                              <div class="tracking-item">
                                  <div class="tracking-icon status-intransit  bg-light">
                                  <svg t="1607874404535" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4844" width="32" height="32"><path d="M832.00208 384.00736H268.808557v358.395878h563.193523V384.00736z m0-51.199411V204.809421a25.599706 25.599706 0 0 0-25.599706-25.599706H294.408262a25.599706 25.599706 0 0 0-25.599705 25.599706v127.998528h563.193523zM217.609146 742.403238V204.809421a76.799117 76.799117 0 0 1 76.799116-76.799117h511.994112a76.799117 76.799117 0 0 1 76.799117 76.799117v537.593817h84.479029a25.599706 25.599706 0 0 1 0 51.199412H218.812332a127.998528 127.998528 0 0 1-127.998528-127.998528V210.134159L14.936276 35.851364A25.599706 25.599706 0 1 1 61.886136 15.397199l77.976704 179.197939A25.599706 25.599706 0 0 1 142.013215 204.809421v460.794701A76.799117 76.799117 0 0 0 217.609146 742.403238z m153.598233 281.596762a102.398822 102.398822 0 1 1 0-204.797645 102.398822 102.398822 0 0 1 0 204.797645z m0-51.199411a51.199411 51.199411 0 1 0 0-102.398823 51.199411 51.199411 0 0 0 0 102.398823z m358.395879 51.199411a102.398822 102.398822 0 1 1 0-204.797645 102.398822 102.398822 0 0 1 0 204.797645z m0-51.199411a51.199411 51.199411 0 1 0 0-102.398823 51.199411 51.199411 0 0 0 0 102.398823z" p-id="4845" fill="#2c2c2c"></path></svg>
                                  </div>
                                  <div class="tracking-date"><?php echo $monthAndDay;?>, <?php echo $year;?><span><?php echo $time;?></span></div>
                                  <div class="tracking-content">Your parcel has been succesfully picked up by <?php echo $view_orderDetail_receiverState;?> Warehouse (Tracking ID: <?php echo $row['trackId'];?>)<span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
                              </div>
                            <?php
                                          }else if($packageStatus == "Out Of Delivery"){
                            ?>
                              <div class="tracking-item">
                                  <div class="tracking-icon status-intransit  bg-light">
                                  <svg t="1607874634565" class="icon" viewBox="0 0 1604 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5933" width="32" height="32"><path d="M989.866667 887.466667V170.666667A102.4 102.4 0 0 0 887.466667 68.266667H341.333333a102.4 102.4 0 0 0-102.4 102.4v32.768a34.133333 34.133333 0 0 1-68.266666 0V170.666667A170.666667 170.666667 0 0 1 341.333333 0h546.133334a170.666667 170.666667 0 0 1 170.666666 170.666667v750.933333a34.133333 34.133333 0 0 1-34.133333 34.133333H614.4a34.133333 34.133333 0 1 1 0-68.266666zM341.333333 887.466667a34.133333 34.133333 0 0 1 0 68.266666 170.666667 170.666667 0 0 1-170.666666-170.666666V682.666667a34.133333 34.133333 0 0 1 68.266666 0v102.4A102.4 102.4 0 0 0 341.333333 887.466667z" p-id="5934" fill="#2c2c2c"></path><path d="M1297.066667 512m34.133333 0l204.8 0q34.133333 0 34.133333 34.133333l0 0q0 34.133333-34.133333 34.133334l-204.8 0q-34.133333 0-34.133333-34.133334l0 0q0-34.133333 34.133333-34.133333Z" p-id="5935" fill="#2c2c2c"></path><path d="M1058.133333 887.466667H1160.533333a34.133333 34.133333 0 1 1 0 68.266666h-136.533333a34.133333 34.133333 0 0 1-34.133333-34.133333v-682.666667A34.133333 34.133333 0 0 1 1024 204.8h249.173333a170.666667 170.666667 0 0 1 129.706667 59.392l160.426667 187.050667a170.666667 170.666667 0 0 1 40.96 111.274666v290.816A102.4 102.4 0 0 1 1501.866667 955.733333h-68.266667a34.133333 34.133333 0 0 1 0-68.266666h68.266667a34.133333 34.133333 0 0 0 34.133333-34.133334V562.517333a102.4 102.4 0 0 0-24.576-68.266666L1350.314667 307.2a102.4 102.4 0 0 0-77.824-35.498667H1058.133333zM477.866667 1024a170.666667 170.666667 0 1 1 170.666666-170.666667A170.666667 170.666667 0 0 1 477.866667 1024z m0-68.266667a102.4 102.4 0 1 0-102.4-102.4A102.4 102.4 0 0 0 477.866667 955.733333z" p-id="5936" fill="#2c2c2c"></path><path d="M1297.066667 1024a170.666667 170.666667 0 1 1 170.666666-170.666667A170.666667 170.666667 0 0 1 1297.066667 1024z m0-68.266667a102.4 102.4 0 1 0-102.4-102.4A102.4 102.4 0 0 0 1297.066667 955.733333z" p-id="5937" fill="#2c2c2c"></path><path d="M0 307.2m34.133333 0l341.333334 0q34.133333 0 34.133333 34.133333l0 0q0 34.133333-34.133333 34.133334l-341.333334 0q-34.133333 0-34.133333-34.133334l0 0q0-34.133333 34.133333-34.133333Z" p-id="5938" fill="#2c2c2c"></path><path d="M68.266667 443.733333m34.133333 0l136.533333 0q34.133333 0 34.133334 34.133334l0 0q0 34.133333-34.133334 34.133333l-136.533333 0q-34.133333 0-34.133333-34.133333l0 0q0-34.133333 34.133333-34.133334Z" p-id="5939" fill="#2c2c2c"></path></svg>
                                  </div>
                                  <div class="tracking-date"><?php echo $monthAndDay;?>, <?php echo $year;?><span><?php echo $time;?></span></div>
                                  <div class="tracking-content">Your parcel is now out for delivery.<span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
                              </div>
                            <?php
                                          }else if($packageStatus == "Closed"){
                            ?>
                              <div class="tracking-item">
                                  <div class="tracking-icon status-intransit  bg-light">
                                  <svg t="1607874893545" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3000" width="32" height="32"><path d="M512 42.642286a469.357714 469.357714 0 1 1 0 938.715428A469.357714 469.357714 0 0 1 512 42.642286zM512 128a384 384 0 1 0 0 768 384 384 0 0 0 0-768z m191.853714 239.908571l60.342857 60.342858L462.482286 729.965714 276.187429 543.597714l60.342857-60.342857L462.482286 609.28l241.371428-241.371429z" fill="#2EA121" p-id="3001"></path></svg>
                                  </div>
                                  <div class="tracking-date"><?php echo $monthAndDay;?>, <?php echo $year;?><span><?php echo $time;?></span></div>
                                  <div class="tracking-content">Your parcel has been delivered succesfully.  You parcel received by [<?php echo $row['userReceiverName'];?>] <span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
                              </div>
                            <?php
                                          }
                                      }
                                  }
                            ?>
                            </div>
                            </div><!--End cart body-->
                        </div><!--End card content-->
                    </div><!--End cart-->
                </div><!--End content Detail-->
          
          </div><!--End row-->
          <?php }
          ?>

          <!--For cancel & return Order Content-->
          <div class="row">

               <!--cancel & return Orde--->
               <?php
                  if($view_action_method != " "){
                ?>
              <div class="col-xl-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <?php
                      if($view_action_method == 'cancel'){
                    ?>
                         <h6 class="m-0 font-weight-bold text-primary">Cancel Order Detail</h6>
                         <span>* All statuses that are not 'packging' approve cancel directly</span>
                    <?php
                      }else if($view_action_method == 'return') {
                    ?>
                          <h6 class="m-0 font-weight-bold text-primary">Return Order Detail</h6>
                    <?php
                      }
                    ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                              <tr>
                                  <td class="font-weight-bold" style="width:30%;">OrderDetail</td>
                                  <td class="">
                                    <h5><?php echo $view_orderDetail_productName;?></h5>
                                    <span><?php echo $view_orderDetail_variation;?></span>
                                    <span> x <?php echo $view_orderDetail_quantity;?></span> <br>
                                    <span>RM <?php echo $view_orderDetail_cartTotalPrice;?></span>
                                  </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width:30%;">Reason</td>
                                    <td><?php echo $view_action_reason;?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width:30%;">Addtional Reason</td>
                                    <td><?php echo $view_action_addtinalReason;?></td>
                                </tr>
                                <?php
                                  if($view_orderDetail_returnRequest == '1'){
                                ?>
                                <tr>
                                    <td class="font-weight-bold" style="width:30%;">Mutlimedia</td>
                                    <td>
                                      <?php
                                          $checkFeedBack = "SELECT * FROM `actioncenter` LEFT JOIN `feedback_image` ON actioncenter.actionId = feedback_sourceId WHERE actioncenter.cartIntegrationId = '$view_orderDetail_cartIntegrationId'";
                                          $resultCheckFeedBack = $conn->query($checkFeedBack);
                                          if($resultCheckFeedBack->num_rows > 0){
                                            while($row = $resultCheckFeedBack->fetch_assoc()){
                                              if($row['feedback_filetype'] == 'image'){
                                      ?>
                                            <img src="../images/feedback-images/<?php echo $row['feedback_location'];?>" alt="" width="150" height="150"> <br>
                                      <?php
                                              }else if($row['feedback_filetype'] == 'video'){
                                      ?>
                                              <video src="../images/feedback-images/<?php echo $row['feedback_location'];?>" controls width="300" height="200">       
                                      <?php
                                              }
                                            }
                                          }else{

                                          }
                                      ?>
                                    </td>
                                </tr>
                                <?php
                                  }
                                ?>
                                
                                <tr>
                                    <td class="font-weight-bold" style="width:30%;">Status</td>
                                    <td><?php echo $view_action_actionStatus;?></td>
                                </tr>
                                <?php
                                  if($view_action_actionStatus == 'reject'){
                                ?>
                                <tr>
                                    <td class="font-weight-bold" style="width:30%;">Reject Reason</td>
                                    <td><?php echo $view_action_actionRejectReason;?></td>
                                </tr>
                                <?php
                                  }
                                  if( ($view_action_method == "return") && !empty($view_action_actionSellerComment) ){
                                ?>
                                <tr>
                                    <td class="font-weight-bold" style="width:30%;">Return Address</td>
                                    <td><?php echo $view_action_actionRejectReason;?></td>
                                </tr>
                                <?php
                                  } 
                                ?>
                                
                                <tr>
                                    <?php
                                      if($view_action_method == 'cancel'){
                                    ?>
                                        <td class="font-weight-bold" style="width:30%;">Cancel Date</td>
                                    <?php
                                      }else if($view_action_method == 'return') {
                                    ?>
                                        <td class="font-weight-bold" style="width:30%;">Return Date</td>
                                    <?php
                                      }
                                    ?>
                                    <td><?php echo $view_action_requestDate;?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width:30%;">Last Modified Date</td>
                                    <td><?php echo $view_action_processDate;?></td>
                                </tr>
                                <?php
                                  if($view_action_actionStatus == 'pending'){
                                ?>
                                  <tr>
                                      <td class="font-weight-bold" style="width:30%;">Action</td>
                                      <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeOrderStatusModal" value="<?php echo $view_orderDetail_cartIntegrationId;?>" data-id="<?php echo $row['cartId'];?>" onclick="updateOrderStatus(this)">Update Status</button></td>
                                  </tr>
                                <?php
                                  }
                                ?>
                                
                            </tbody>
                        </table>
                    </div><!--End responsive table--->
                </div>
              </div><!--End cancel & return Orde Content--->
              </div>
              <?php
                  }
               ?>
          </div><!--End Row Cancel&Return Order--->


          <?php
              $checkReview = "SELECT rating.*, comment.*, cartintegration.*, user.userName, user.image, rating.created_time AS 'postDate' FROM `rating` LEFT JOIN `comment` ON rating.commentId = comment.commentId LEFT JOIN `cartintegration` ON rating.cartIntegrationId = cartintegration.cartIntegrationId LEFT JOIN `user` ON rating.userId = user.userId WHERE rating.cartIntegrationId = '$view_orderDetail_cartIntegrationId'";
              $resultCheckReview = $conn->query($checkReview);
              if($resultCheckReview->num_rows > 0){
                while($row = $resultCheckReview->fetch_assoc()){
                  $review_comment_reviewId = $row['ratingId'];
                  $review_commentId = $row['commentId'];
                  $review_comment_variation = $row['variation'];
                  $review_comment_quantity = $row['quantity'];
                  $review_comment_Date = date('Y-m-d h:i:s a',strtotime($row['postDate']));
          ?>
          <!-- review row -->
          <form action="../database/seller/productAction.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-xl-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Review Order (<?php echo $view_orderDetail_productName;?>)</h6>
                </a>
                <input type="hidden" name="ratingId" value="<?php echo $row['ratingId']?>">

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                        <div class="post-container shadow-sm p-3 bg-light rounded d-flex" >
                            <img src="../images/profileImage/<?php echo $row['image']?>" alt="<?php echo $row['image'] ?>" class="profile-photo-md pull-left bg-light">
                            <div class="post-detail">
                                <div class="user-info">
                                    <h5>
                                        <a class="profile-link text-primary col-sm-12 col-md-12"><?php echo $row['userName']?></a> 
                                        <?php
                                            for($x=0; $x<$row['ratingValue']; $x++){
                                        ?>
                                                <span class="fa fa-star displaystar checked"></span>
                                        <?php
                                            }
                                        ?>
                                    </h5>
                                    <p class="text-muted ml-3" style="font-size:13px">Published a post about <?php echo $review_comment_Date;?></p>
                                </div>
                                <div class="line-divider"></div>
                                <!-- comment Text -->
                                <div class="post-text ml-3">
                                    <p class="text-dark font-weight-bold">
                                       <?php echo $row['commentText'];?>
                                    </p>
                                </div>
                                <!-- End Commad Text -->
                                <?php
                                   $checkFeedBackImage = "SELECT * FROM `feedback_image` LEFT JOIN `comment` ON comment.commentId = feedback_image.feedback_sourceId WHERE comment.commentId = '$review_commentId'";
                                    $resultCheckFeedbackImage = $conn->query($checkFeedBackImage);
                                    if($resultCheckFeedbackImage->num_rows > 0){
                                ?>
                                  <div class="post-comment">
                                      <div class="row ml-2">
                                <?php
                                      while($row = $resultCheckFeedbackImage->fetch_assoc()){
                                        $review_comment_filetype = $row['feedback_filetype'];

                                        if($review_comment_filetype == "image"){
                                          $review_comment_filetype;
                                ?>
                                          <div class="mr-2 col-sm-12 col-md-3 col-lg-3">
                                              <img src="../images/feedback-images/<?php echo $row['feedback_location']; ?>" alt="<?php echo $row['feedback_location'];?>" class="w-100 h-100 mt-2">
                                          </div>
                                <?php
                                        }else if($review_comment_filetype == "video"){
                                ?>
                                          <div class="mr-2 col-sm-12 col-md-3 col-lg-3">
                                              <video src="../images/feedback-images/<?php echo $row['feedback_location']?>" controls width='100%' height='100%' >
                                          </div>
                                <?php
                                        } //end checkl
                                      }//end loop data
                                ?>
                                      </div>
                                  </div><!--End if review with media--->
                                <?php
                                    }//end if have media
                                ?>

                                <div class="post-comment ml-3">
                                  <span>Variation:<?php echo $review_comment_variation;?> &nbsp; x<?php echo $review_comment_quantity;?></span>
                                </div>
                                <div class="line-divider"></div>

                                <!-- get other comment -->
                                <?php
                                    $checkThisReviewComment = "SELECT comment.*, user.userName, user.image AS 'userImage', seller.sellerName, seller.image AS 'sellerImage', comment.update_time AS 'commentDate' FROM `comment` LEFT JOIN user ON comment.comment_personId = user.userId LEFT JOIN seller ON comment.comment_personId = seller.sellerId WHERE ratingId = '$review_comment_reviewId' AND comment.commentId != '$review_commentId' ORDER BY comment.created_time DESC";
                                    $resultReviewComment = $conn->query($checkThisReviewComment);
                                    if($resultReviewComment->num_rows > 0){
                                      while($row = $resultReviewComment->fetch_assoc()){
                                        $newcomment_commentID = $row['commentId'];

                                        $commantdate = date('Y-m-d h:i:s a',strtotime($row['commentDate']));

                                        if($row['userName'] == NULL){
                                            $source_name = $row['sellerName'];
                                            $source_image = $row['sellerImage'];

                                        }else if($row['sellerName'] == NULL){
                                            $source_name = $row['userName'];
                                            $source_image = $row['userImage'];
                                        }
                                ?>
                                    <div class="post-comment">
                                        <img src="../images/profileImage/<?php echo $source_image ;?>" alt="<?php echo $source_image;?>" class="profile-photo-sm">
                                        <p class="text-dark font-weight-bold">
                                          <a class="profile-link text-primary"><?php echo $source_name;?> </a>
                                          <span class="text-muted font-weight-normal pl-3" style="font-size:13px">Published a post about <?php echo $commantdate;?></span>
                                          <br>
                                         <?php echo $row['commentText'] ?>
                                        </p>
                                    </div>

                                    <?php
                                        $checkNewCommentMedia = "SELECT comment.*, feedback_image.* FROM `comment` LEFT JOIN `feedback_image` ON feedback_image.feedback_sourceId = comment.commentId WHERE comment.ratingId = '$review_comment_reviewId' AND feedback_image.feedback_sourceId = '$newcomment_commentID'";
                                        $resultCheckNewCommentMedia = $conn->query($checkNewCommentMedia);
                                        if($resultCheckNewCommentMedia->num_rows > 0){
                                ?>
                                        <div class="post-comment" style="margin-right:4%">
                                            <div class="row ml-2">
                                <?php
                                          while($row = $resultCheckNewCommentMedia->fetch_assoc()){
                                            
                                        if($row['feedback_filetype'] == "image"){
                                ?>
                                          <div class="mr-2 col-sm-12 col-md-3 col-lg-3">
                                              <img src="../images/feedback-images/<?php echo $row['feedback_location']; ?>" alt="<?php echo $row['feedback_location'];?>" class="w-100 h-100 mt-2">
                                          </div>
                                <?php
                                        }else if($row['feedback_filetype'] == "video"){
                                ?>
                                          <div class="mr-2 col-sm-12 col-md-3 col-lg-3">
                                              <video src="../images/feedback-images/<?php echo $row['feedback_location']?>" controls width='100%' height='100%' >
                                          </div>
                                <?php
                                          }//end check new commant media type
                                        }//end check loop 
                                ?>
                                          </div>
                                        </div>
                                <?php
                                      }//end check if
                                ?>
                                    <div class="line-divider"></div>
                                <?php
                                      }//end loop
                                    }//end if other commant
                                ?>

                                <!-- //new comment -->
                                <div class="post-comment input-group mb-3 ">
                                    <img src="../images/profileImage/<?php echo $_SESSION['sellerImage'];?>" alt="<?php echo $_SESSION['sellerImage'];?>" class="profile-photo-sm">
                                    <div class="input-group" style="width:90%">
                                      <input type="text" class="form-control" name="commentText" placeholder="Post A New Comment... ">
                                      <div class="input-group-append h-75" style="margin-top:0.4rem">
                                          <button type="submit" name="postNewComment" class="btn btn-outline-primary">Submit</button>
                                          <button type="button" id="openBrowser" class="btn btn-outline-primary"><i class="far fa-file-image"></i></button>
                                          <input type="file" name="commentFeedback[]" class="custom-file-input d-none" id="inputCommentFile"  max-file-size="6" multiple accept="image/*, video/*" onchange="return checkFile(this);">
                                      </div>
                                    </div>
                                </div>

                            </div><!--End post detail-->

                        </div><!--End post Container-->
                  </div><!--End card body-->
                </div><!--End content collapse-->

              </div><!--End card-->
            </div><!--End card body-->
          </div>
          <!-- End review row -->
          </form>
          <?php
                }//end outline loop data
              }//end outline if checkReview
          ?>
          


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


  <!-- Modal Change Cancel & Return Order Status -->
  <form action="../database/seller/productAction.php" method="POST">
  <div class="modal fade" id="changeOrderStatusModal" tabindex="-1" aria-labelledby="changeOrderStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeOrderStatusModalLabel">
            <?php
              if( ($view_action_method == 'cancel') && ($view_orderDetail_cancelRequest == '1') ){
            ?>
                Updated Cancel Order Status
            <?php
              }else if( ($view_action_method == 'return') && ($view_orderDetail_returnRequest == '1') ){
            ?>
                Updated Return Order Status
            <?php
              }else if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0') ){
            ?>
                Updated Order Status
            <?php
              }
            ?>
            
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-lg-12">
            <input type="hidden" name="cartIntegrationId" id="updateStatusOrderId"><!---update id-->
            <input type="hidden" name="cartId" value="<?php echo $view_orderDetail_cartId;?>">
            <?php
              if(($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0')){
                if($view_orderDetail_cartStatus == 'submitted'){
            ?>
                  <select class="custom-select" name="selectUpdateStatus" id="displayStatusContent">
                      <option selected disabled="true"> -- Choose One Option --</option>
                      <option value="packging">Packging</option>
                      <option value="shipping">Shipping</option>
                  </select>
            <?php
                }else if($view_orderDetail_cartStatus == 'packging'){
            ?>
                <select class="custom-select" name="selectUpdateStatus" id="displayStatusContent">
                    <option selected value="shipping">Shipping</option>
                </select>
            <?php
                }//end check cart status


              }else if( ($view_orderDetail_cancelRequest == '1') || ($view_orderDetail_returnRequest == '1') ){
            ?>
              <select class="custom-select" name="selectUpdateStatus" id="displayStatusContent" onchange="rejectShow(this)">
                  <option selected disabled="true"> -- Choose One Option --</option>
                  <option value="approve">Approve</option>
                  <option value="reject">Reject</option>
              </select>
              <?php
                if( ($view_action_method == 'return') && ($view_orderDetail_returnRequest == '1') ){
                  
              ?>
              <div class="mt-3" id="approveBox" style="display:none">
                  <h5>Ship Address</h5>
                  <input type="text" name="approveShip" id="validationApproveShip" onblur="validate(this)" class="form-control" placeholder="Please Fill In Address ...">
              </div>
              <div class="mt-3" id="rejectBox" style="display:none">
                  <h5>Reject Reason</h5>
                  <input type="text" name="rejectReason" id="validationRejectReason" onblur="validate(this)" class="form-control" placeholder="Please Given A Reason ...">
              </div>
              <?php
                }else if( ($view_action_method == 'cancel') && ($view_orderDetail_cancelRequest == '1')){
              ?>
              <div class="mt-3" id="rejectBox" style="display:none">
                  <h5>Reject Reason</h5>
                  <input type="text" name="rejectReason" id="validationRejectReason" onblur="validate(this)" class="form-control" placeholder="Please Given A Reason ...">
              </div>
              <?php
                }
              ?>
            <?php
              }
            ?>

           
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="actionMethod" id="actionMethod" value="<?php echo $view_action_method;?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php
            if( ($view_action_method == 'return') && ($view_orderDetail_returnRequest == '1') ){
          ?>
              <button type="submit" name="updateCancelStatus" id="reasonDisable" class="btn btn-primary">Save changes</button>
          <?php
            }else if( ($view_action_method == 'cancel') && ($view_orderDetail_cancelRequest == '1') ){
          ?>
              <button type="submit" name="updateCancelStatus" id="reasonDisable" class="btn btn-primary">Save changes</button>
          <?php
            }else if( ($view_orderDetail_cancelRequest == '0') && ($view_orderDetail_returnRequest == '0') ){
          ?>
              <button type="submit" name="updateCartIntegrationStatus" class="btn btn-primary">Save changes</button>
          <?php
            }
          ?>
        </div> 
      </div>
    </div>
  </div>
  </form>
  <!-- End Modal Change Cancel & Return Order Status -->

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
  //for lastest order tooltip
  $(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();     
  
    //get checked check box Id
    $('#updateStatus').click(function(){
        var searchIDs = $('input:checked').map(function(){
          return $(this).val();
        });
        $('#updateStatusOrderId').val(searchIDs.get()); //set to model
    });

    $("#updateStatus").attr("disabled", true);

    $('input[type=checkbox]').click(function(){
      $("#updateStatus").attr("disabled", false);
    });
  });

  //comment Open file
  $(document).ready(function(){
    $('#openBrowser').click(function(){
      $('#inputCommentFile').click();
    });
  });

  function checkFile(file){
     if ($("#inputCommentFile")[0].files.length <= 3) {
          return true;
      }else{
          Swal.fire({
              icon: 'error',
              title: 'Number Of File Error',
              text: 'Please Select Maximun 3 File!'
          })
          return false;
          $('#inputCommentFile').click();
      }
  }

  //update order sttaus
  function updateOrderStatus(CartIntegrationId){
      var id = $(CartIntegrationId).val();
     // console.log( $(CartIntegrationId).val() );
     $('#updateStatusOrderId').val(id);
    }

  //check selection\
  function rejectShow(result){
    var selectResult = $(result).val();
    var actionChek = $('#actionMethod').val();
    if(selectResult == "reject"){
      $("#reasonDisable").attr("disabled", true);
      $('#rejectBox').css('display','block');
      $('#approveBox').css('display','none');

    }else if(selectResult == "approve"){
      if(actionChek == "cancel"){
        $("#reasonDisable").attr("disabled", false);
      }else{
        $("#reasonDisable").attr("disabled", true);
      }
      $('#approveBox').css('display','block');
      $('#rejectBox').css('display','none');
    
    }else{
      $("#reasonDisable").attr("disabled", false);
      $('#rejectBox').css('display','none');
      $('#approveBox').css('display','none');
    }
  }
    

  //check if select reject
  function validate(inputValue) {
		
		var valid = true;
    valid = checkEmpty($(inputValue));
		
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
    }else if(flashdata == "insert-comment-success-notic-01"){
        Swal.fire(
            'Commant Success!',
            'Comment been successfully insert!',
            'success'
        )
    }else if(flashdata == "insert-comment-image-media-type-invalid-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Insert Comment Media Failed',
            text: 'Please Try Again!'
        })
    }
  </script>
</body>

</html>
