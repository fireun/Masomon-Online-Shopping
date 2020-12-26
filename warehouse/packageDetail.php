<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $date =  date("Y-m-d");// current year-month-days hours:minut:seconts
  $warehouseAdminId = $_SESSION['warehouseAdminId'];

  if($_GET['trackId']){
      $trackId = $_GET['trackId'];
      $sql = "SELECT *,COUNT(cartintegration.quantity) AS 'orderQty',track.created_time AS 'shipDate',track.update_time AS 'lastmodified', cartintegration.status AS 'orderStatus', track.status AS 'trackStatus' FROM `track` LEFT JOIN orderlist ON track.orderId = orderlist.orderId LEFT JOIN cartintegration ON cartintegration.cartId = orderlist.cartId LEFT JOIN address_shipping ON track.shipId = address_shipping.ship_id WHERE track.trackId = '$trackId'";
      $result = $conn->query($sql);
      if($result ->num_rows>0){
          while($row = $result ->fetch_assoc()){
            $orderId = $row['orderId'];
            $orderQuantity = $row['orderQty'];
            $orderUnifiedDelivery = $row['unifiedDelivery'];
            $orderTotal = $row['amount'];
            $orderStatus = $row['orderStatus'];
            $orderTrackStatus = $row['trackStatus'];
            $orderCurentLocation = $row['currentLocation'];
            $orderShipDate = date("Y-m-d h:i:s a",strtotime($row['shipDate']));
            $orderLastMofied = date("Y-m-d h:i:s a",strtotime($row['lastmodified']));
            $receiver_Name = $row['recipient_name'];
            $receiver_Phone = $row['recipient_phone'];
            $receiver_Address = $row['recipient_address'];
            $receiver_city = $row['recipient_city'];
            $receiver_state = $row['recipient_state'];
            $receiver_postalCode = $row['recipient_postalCode'];
            $receiver_country = $row['recipient_country'];
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

  <title>Warehouse Dashboard</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <style>
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
            <h1 class="h3 mb-0 text-gray-800">Package <small><?php echo $trackId;?></small></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Package Management</li>
                <li class="breadcrumb-item active" aria-current="page">All Package</li>
                <li class="breadcrumb-item active" aria-current="page">Trancking Id</li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $trackId; ?></li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->


          <!-- content search result -->
          <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tracking Information</h6>
                        </div>
                        <div class="card-body" id="print">

                            <!-- Shipping & order Detail -->
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tbody>
                                            <tr>
                                                <td colspan="2" class="text-center"><h6>Order Detail</h6></td>
                                            </tr>
                                            <tr>
                                                    <td>Order ID</td>
                                                    <td><?php echo $orderId?></td>
                                            </tr>
                                            <tr>
                                                    <td>Order Quantity</td>
                                                    <td><?php echo $orderQuantity;?></td>
                                            </tr>
                                            <tr>
                                                    <td>Order Total</td>
                                                    <td>RM <?php echo $orderTotal;?></td>
                                            </tr>
                                            <tr>
                                                    <td>Order Status</td>
                                                    <td><?php echo $orderStatus;?></td>
                                            </tr>
                                            <tr>
                                                    <td>Unified Delivery</td>
                                                    <td><?php echo $orderUnifiedDelivery;?></td>
                                            </tr>
                                            <tr>
                                                    <td>Shipping Date</td>
                                                    <td><?php echo $orderShipDate;?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered ">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="text-center"><h6>Shipping Address</h6></td>
                                                </tr>
                                                <tr>
                                                    <td>Receiver's Name</td>
                                                    <td><?php echo $receiver_Name ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Receiver's Phone</td>
                                                    <td><?php echo $receiver_Phone;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td><?php echo $receiver_Address;?></td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td><?php echo $receiver_city;?></td>
                                                </tr>
                                                <tr>
                                                    <td>State</td>
                                                    <td><?php echo $receiver_state;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Postal Code</td>
                                                    <td><?php echo $receiver_postalCode;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Country</td>
                                                    <td><?php echo $receiver_country;?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!--End Shipping & order Detail -->


                            <div class="row mt-2 mb-3">
                                <div class="col-xl-12">
                                    <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="font-weight-bold text-center" colspan="5">
                                                    <h6>Tracking History</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tracking Number</td>
                                                <td>Description</td>
                                                <td>Status</td>
                                                <td>Last Modified</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $trackId;?></td>
                                                <td><?php echo $orderCurentLocation;?></td>
                                                <td><?php echo $orderTrackStatus;?></td>
                                                <td><?php echo $orderLastMofied;?></td>
                                                <td>
                                                    <?php 
                                                        if($orderTrackStatus == "picked up"){
                                                    ?>        
                                                            <button type="button" class="btn btn-danger w-75 m-1" title="Out Of Delivery" data-order="<?php echo $orderId;?>" data-track="<?php echo $trackId;?>" data-status="Out Of Delivery" onclick="changeStatus(this)"><i class="fas fa-shipping-fast"></i></button>
                                                    
                                                    <?php
                                                        }else if($orderTrackStatus == "Out Of Delivery"){
                                                    ?>
                                                            <button type="button"  class="btn btn-success w-75 m-1" title="closed" data-order="<?php echo $orderId;?>" data-track="<?php echo $trackId;?>" onclick="closedStatus(this)" data-toggle="modal" data-target="#updateTrack"><i class="far fa-times-circle"></i></button>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>


          <div class="container-fuild">
            <div class="row">
                
                <div class="col-md-12 col-lg-12">
                    <div id="tracking-pre"></div>
                    <div id="tracking">
                        <div class="text-center tracking-status-intransit bg-primary">
                            <p class="tracking-status text-tight"><?php echo $orderTrackStatus;?></p>
                        </div>
                        <div class="tracking-list">
                           <?php
                                if($orderUnifiedDelivery == "Agree"){
                                    $trackPackage = "SELECT *,trackhistory.created_time AS 'processTime', trackhistory.status AS 'processStatus' FROM `trackhistory` LEFT JOIN trackintegration ON trackhistory.trackCartIntegrationId = trackintegration.trackIntegrationId LEFT JOIN track ON track.orderId = trackintegration.orderId WHERE trackhistory.trackOrderId = '$orderId' GROUP BY trackhistory.status ORDER BY trackhistory.created_time DESC";
                                }else if($orderUnifiedDelivery == "Disagree"){
                                    $trackPackage = "SELECT *,trackhistory.created_time AS 'processTime', trackhistory.status AS 'processStatus' FROM track LEFT JOIN trackhistory ON track.trackId = trackhistory.trackCartIntegrationId WHERE track.trackId = '$trackId' GROUP BY trackhistory.status ORDER BY trackhistory.created_time DESC";
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
                                <div class="tracking-content">Shipment designated to <?php echo $receiver_state;?> [<?php echo $receiver_state;?> Warehouse]<span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
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
                                <div class="tracking-content">Shipment arrived at [<?php echo $receiver_state;?> Warehouse] , MALAYSIA station.<span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
                            </div>
                          <?php
                                        }else if($packageStatus == "picked up"){
                          ?>
                            <div class="tracking-item">
                                <div class="tracking-icon status-intransit  bg-light">
                                <svg t="1607874404535" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4844" width="32" height="32"><path d="M832.00208 384.00736H268.808557v358.395878h563.193523V384.00736z m0-51.199411V204.809421a25.599706 25.599706 0 0 0-25.599706-25.599706H294.408262a25.599706 25.599706 0 0 0-25.599705 25.599706v127.998528h563.193523zM217.609146 742.403238V204.809421a76.799117 76.799117 0 0 1 76.799116-76.799117h511.994112a76.799117 76.799117 0 0 1 76.799117 76.799117v537.593817h84.479029a25.599706 25.599706 0 0 1 0 51.199412H218.812332a127.998528 127.998528 0 0 1-127.998528-127.998528V210.134159L14.936276 35.851364A25.599706 25.599706 0 1 1 61.886136 15.397199l77.976704 179.197939A25.599706 25.599706 0 0 1 142.013215 204.809421v460.794701A76.799117 76.799117 0 0 0 217.609146 742.403238z m153.598233 281.596762a102.398822 102.398822 0 1 1 0-204.797645 102.398822 102.398822 0 0 1 0 204.797645z m0-51.199411a51.199411 51.199411 0 1 0 0-102.398823 51.199411 51.199411 0 0 0 0 102.398823z m358.395879 51.199411a102.398822 102.398822 0 1 1 0-204.797645 102.398822 102.398822 0 0 1 0 204.797645z m0-51.199411a51.199411 51.199411 0 1 0 0-102.398823 51.199411 51.199411 0 0 0 0 102.398823z" p-id="4845" fill="#2c2c2c"></path></svg>
                                </div>
                                <div class="tracking-date"><?php echo $monthAndDay;?>, <?php echo $year;?><span><?php echo $time;?></span></div>
                                <div class="tracking-content">Your parcel has been succesfully picked up by <?php echo $receiver_state;?> Warehouse (Tracking ID: <?php echo $trackId;?>)<span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span></div>
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
                    </div>
                </div>
            </div>
            </div>

                    </div>
                </div>
              </div>
          </div>
          <!-- End content Search Result -->

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
  }else if(flashdata == "OutOfDelivery-status-success-notic-01"){
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
  }

  function changeStatus(elemet){
    var updateOrder = $(elemet).attr("data-order");
    var updateTrack = $(elemet).attr("data-track");
    var updateStatus = $(elemet).attr("data-status");

    window.location.href = "../database/warehouse/actionProcess.php?updateTrack="+updateTrack+"&updateOrder="+updateOrder+"&updateStatus="+updateStatus;
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
