<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $date =  date("Y-m-d");// current year-month-days hours:minut:seconts
  if($_SESSION['sellerId']){

  $thisMonth_before = date('Y-m-01 00:00:00', strtotime($date));
  $thisMonth_after = date('Y-m-t 24:60:60', strtotime($date . '+ 1 days'));
  $thisYear_before = date('Y-01-01 00:00:00', strtotime($date));
  $thisYear_after = date('Y-m-d 24:60:60', strtotime($thisYear_before . '+ 365 days'));

  $sellerId = $_SESSION['sellerId'];
  $calThisMonthlySql = "SELECT SUM(cartintegration.quantity * product.price) AS 'totalOfMontly' FROM cartintegration LEFT JOIN product ON cartintegration.productId = product.id WHERE cartintegration.sellerId = '$sellerId' AND cartintegration.status = 'closed' AND ( cartintegration.created_time >= '$thisMonth_before' OR cartintegration.created_time <= '$thisMonth_after' )";
  $resultThisMontly = $conn->query($calThisMonthlySql);
  if($resultThisMontly->num_rows > 0){
    while($row = $resultThisMontly->fetch_assoc()){
        $totalAmountOfMontly = $row['totalOfMontly'];
    }
    if($totalAmountOfMontly == NULL){
      $totalAmountOfMontly = 0;
    }
  }else{
    $totalAmountOfMontly = 0;
  }

  $calThisYearSql = "SELECT SUM(cartintegration.quantity * product.price) AS 'totalOfYear' FROM cartintegration LEFT JOIN product ON cartintegration.productId = product.id WHERE cartintegration.sellerId = '$sellerId' AND cartintegration.status = 'closed' AND ( cartintegration.created_time >= '$thisYear_before' OR cartintegration.created_time <= '$thisYear_after' )";
  $resultThisYear = $conn->query($calThisYearSql);
  if($resultThisYear->num_rows > 0){
    while($row = $resultThisYear->fetch_assoc()){
        $totalAmountOfYear = $row['totalOfYear'];
    }
    if($totalAmountOfYear == NULL){
      $totalAmountOfYear = 0;
    }
  }else{
    $totalAmountOfYear = 0;
  }

  $percentageOfOrder = "SELECT (COUNT(cartIntegrationId) / (SELECT COUNT(cartIntegrationId) FROM cartintegration WHERE sellerId = '$sellerId' AND cancelRequest = '' AND returnRequest = '') * 100.0 ) AS percent FROM `cartintegration` WHERE sellerId = '$sellerId' AND cancelRequest = '' AND returnRequest = '' AND status != 'closed'";
  $resultThisPercent = $conn->query($percentageOfOrder);
  if($resultThisPercent->num_rows > 0){
    while($row = $resultThisPercent->fetch_assoc()){
        $percent = (int)$row['percent'];
    }
  }else{
    $percent = 0;
  }

  $calRequestTotal = "SELECT COUNT(cartintegration.cartIntegrationId) AS `pendingTotal` FROM `cartintegration` LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE (cartintegration.cancelRequest = '1' OR cartintegration.returnRequest = '1') AND cartintegration.sellerId = '$sellerId' AND cartintegration.status != 'closed' AND actioncenter.actionStatus = 'pending'";
  $resultThisRequest = $conn->query($calRequestTotal);
  if($resultThisRequest->num_rows > 0){
    while($row = $resultThisRequest->fetch_assoc()){
        $requestTotal = $row['pendingTotal'];
    }
  }else{
    $requestTotal = 0;
  }


  //make line chartt
  $json = array(
      ["Month","Total"]
  );
  for($montly = 1; $montly <= 12; $montly++){
    $getYear = date("Y");
    $lastDays = date("t");
    $newMontlyOfDay = date("d",strtotime($lastDays . '+1 day'));
    $setMonth_before = $getYear.'-'.$montly.'-01 00:00:00';
    $setMonth_after = $getYear.'-'.$montly.'-'.$lastDays.' 00:00:00';

    $sql = "SELECT SUM(product.price * cartintegration.quantity) AS 'total' FROM `cartintegration` LEFT JOIN `product` ON cartintegration.productId = product.id WHERE cartintegration.status = 'closed' AND cartintegration.cancelRequest = '0' AND cartintegration.returnRequest = '0' AND (cartintegration.update_time >= '$setMonth_before' AND cartintegration.update_time <= '$setMonth_after') AND cartintegration.sellerId = '$sellerId'";
    $result = $conn->query($sql);
    // $result=$conn->query("SELECT SUM(product.price * cartintegration.quantity) AS 'total' FROM `cartintegration` LEFT JOIN `product` ON cartintegration.productId = product.id WHERE cartintegration.status = 'closed' AND cartintegration.cancelRequest = '0' AND cartintegration.returnRequest = '0' AND (cartintegration.update_time >= '$setMonth_before' AND cartintegration.update_time <= '$setMonth_after') AND cartintegration.sellerId = '$sellerId'");
    while($row=$result->fetch_assoc()){
      $montly_format = date("F",strtotime($setMonth_before));
      $total= $row['total'];

      if($total == NULL){
        $total = 0;
      }
      
      // if($montly == 12){
      //   echo "['$montly_format','$total']";
      // }else{
      //   echo "['$montly_format','$total'],";
      // }
      $dataRow = array(
        $montly_format,
        $total
    );
    array_push($json, $dataRow); //put in array
      
    }
  }
  $jsonstring = json_encode($json); //make to ["month",total];
    
    }else{
  header('location:login.php');
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

  <title>Seller Dashboard</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawLineChart);
    
    function drawChart() {
        // Create the data table.
        var data = google.visualization.arrayToDataTable([  
          ['Order Status', 'Number'], 

          <?php
            $result=$conn->query("SELECT COUNT(*) AS Num FROM cartintegration WHERE status='submitted' AND sellerId ='$sellerId'");
            while($row=$result->fetch_assoc()){
              echo "['Submitted',".$row['Num']."],";
            }

            $result=$conn->query("SELECT COUNT(*) AS Num FROM cartintegration WHERE status='packging' AND sellerId ='$sellerId'");
            while($row=$result->fetch_assoc()){
              echo "['Packging',".$row['Num']."],";
            }

            $result=$conn->query("SELECT COUNT(*) AS Num FROM cartintegration WHERE status='shipping' AND sellerId ='$sellerId'");
            while($row=$result->fetch_assoc()){
              echo "['Shipping',".$row['Num']."],";
            }

            $result=$conn->query("SELECT COUNT(*) AS Num FROM cartintegration WHERE status='closed' AND sellerId ='$sellerId'");
            while($row=$result->fetch_assoc()){
              echo "['Closed',".$row['Num']."],";
            }
          ?>
        ]);

        // Set chart options
        var options = {'title':'All Order Current Status',
                      is3D: true,
                      width:425,
                      height:500
                      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_pieChart'));
        chart.draw(data, options);

        // Export PDF Image
        var pieChart_area_pdf_export = document.getElementById('chart_div_PieChart_pdf');
        var pieChart_pdf = new google.visualization.PieChart(pieChart_area_pdf_export);
          google.visualization.events.addListener(pieChart_pdf, 'ready', function(){
            pieChart_area_pdf_export.innerHTML = '<img src="' + pieChart_pdf.getImageURI() + '" class="img-responsive style="width:590;height:500">';
          });
          pieChart_pdf.draw(data, options);
    }

    function drawLineChart() {
        var data = google.visualization.arrayToDataTable( 
          <?php echo $jsonstring ?>
          );

        var options = {
          title: 'Montly of Earnings',
          width:590,
          height:500
        };

        //make chart
        var lineChart = new google.visualization.LineChart(document.getElementById('chart_div_lineChart'));
        
        lineChart.draw(data, options);

        // Export PDF Image
        var linechart_area_pdf_export = document.getElementById('chart_div_lineChart_pdf');
        var linechart_pdf = new google.visualization.LineChart(linechart_area_pdf_export);
          google.visualization.events.addListener(linechart_pdf, 'ready', function(){
            linechart_area_pdf_export.innerHTML = '<img src="' + linechart_pdf.getImageURI() + '" class="img-responsive">';
          });
        linechart_pdf.draw(data, options);
      }


      // $(window).resize(function(){
      //   drawLineChart();
      // });
        
  </script>
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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">RM <?php echo $totalAmountOfMontly;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">RM <?php echo $totalAmountOfYear;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">number of orders being processed</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $percent?>%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $percent;?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $requestTotal;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Line Chart -->
            <div class="col-xl-7 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" >Earnings Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <form action="../database/seller/created_pdf.php" method="POST" id="linkToLineChartPDF">
                          <!-- diagram -->
                          <div class="card-body d-none" id="lineChartHeader">
                              <h6 class="m-0 font-weight-bold text-primary" >Earnings Overview</h6>
                              <div id="chart_div_lineChart_pdf" style="width: 500px; height: 500px;"></div>
                          </div>
                          <input type="hidden" name="hidden_html" id="hidden_LineChart" /><!--store to input-->
                          <button type="button" class="dropdown-item" id="makeLineChartPDF">Export PDF File</button>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div id="chart_div_lineChart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
              </div>
            </div>
            <!--End line Chart-->

            <!-- Pie Chart -->
            <div class="col-xl-5 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Order Status</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <form action="../database/seller/created_pdf.php" method="POST" id="linkToPieChartPDF">
                            <!-- diagram -->
                            <div class="card-body d-none" id="PieChartContent">
                                <h6 class="m-0 font-weight-bold text-primary">All Order Status</h6>
                                <div id="chart_div_PieChart_pdf" style="width: 500px; height: 500px;"></div>
                            </div>
                            <input type="hidden" name="hidden_html" id="hidden_PieChart" /><!--store to input-->
                            <button type="button" class="dropdown-item" id="makePieChartPDF">Export PDF File</button>
                        </form>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    <div id="chart_div_pieChart" style="width: 100%; height: 500px;"></div>
                  </div>
                </div>
              </div>
            </div>
            <!--End Pie Chart-->
          </div>

          <!-- Content Row -- below Chart-->
          <div class="row">

            <!-- Content Column -- LEFT-->
            <div class="col-lg-6 mb-2">

               <!-- Latest Order -->
               <div class="card shadow mb-2">
                <!-- Card Header - Accordion -->
                <a href="#collapseLatestCancel" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseLatestCancel">
                  <h6 class="m-0 font-weight-bold text-primary">Pending Request (Cancel & Return)</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseLatestCancel">
                  <div class="card-body">
                    
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">OrderId</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $latestRequest = "SELECT cartintegration.*, actioncenter.*, orderlist.orderId, actioncenter.created_time AS 'requestDate' FROM `cartintegration` LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.actionStatus = 'pending' ORDER BY actioncenter.created_time DESC LIMIT 0,3";
                            $resultLatestRequest = $conn->query($latestRequest);
                            if($resultLatestRequest->num_rows > 0){
                              while($row = $resultLatestRequest->fetch_assoc()){
                                $requestDate = date('Y-m-d h:i:s a', strtotime($row['requestDate']));
                          ?>
                          <tr>
                            <td><?php echo $row['orderId'];?></td>
                            <td><?php echo $row['actionReason'];?></td>
                            <td><?php echo $row['actionStatus'];?></td>
                            <td><?php echo $requestDate;?></td>
                            <td>
                              <a class="btn btn-primary" href="orderDetail.php?orderId=<?php echo $row['orderId'] ?>&cartIntegrationId=<?php echo $row['cartIntegrationId'] ?>" data-toggle="tooltip" data-placement="top" title="View" role="button">
                                <i class="far fa-eye"></i>
                              </a>
                            </td>
                          </tr>
                          <?php
                              }
                            }else{
                          ?>
                            <tr>
                              <td  colspan="5"> No More Reqeust Result</td>
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

            <div class="col-lg-6 mb-2">
              <!-- Latest Order -->
              <div class="card shadow mb-2">
                <!-- Card Header - Accordion -->
                <a href="#collapseLatestOrder" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseLatestOrder">
                  <h6 class="m-0 font-weight-bold text-primary">Latest Order</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseLatestOrder">
                  <div class="card-body">
                    
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">OrderId</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $latestOrder = "SELECT cartintegration.*, cartintegration.status AS 'orderStatus',orderlist.*, orderlist.created_time AS 'orderDate' ,user.userName FROM `cartintegration` LEFT JOIN user ON cartintegration.userId = user.userId INNER JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.sellerId = '$sellerId' AND cartintegration.status = 'submitted' AND cartintegration.cancelRequest = '' AND cartintegration.returnRequest = '' ORDER BY orderlist.created_time DESC LIMIT 0,3";
                            $resultLatestOrder = $conn->query($latestOrder);
                            if($resultLatestOrder->num_rows > 0){
                              while($row = $resultLatestOrder->fetch_assoc()){
                                $orderDate = date('Y-m-d h:i:s a', strtotime($row['orderDate']));
                          ?>
                            <tr>
                              <td><?php echo $row['orderId']?></td>
                              <td><?php echo $row['userName'] ;?></td>
                              <td><?php echo $row['orderStatus'];?></td>
                              <td><?php echo $orderDate;?></td>
                              <td>
                                <a class="btn btn-primary" href="orderDetail.php?orderId=<?php echo $row['orderId'];?>&cartIntegrationId=<?php echo $row['cartIntegrationId'];?>" data-toggle="tooltip" data-placement="top" title="View" role="button">
                                  <i class="far fa-eye"></i>
                                </a>
                              </td>
                            </tr>
                          <?php
                              }
                            }else{
                          ?>
                            <tr>
                              <td  colspan="5"> No More New Order Result</td>
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
          <!---End Content Row-->

          <!--Quick Link-->
          <div class="row">
            <div class="col-xl-12">
              <div class="card shadow mb-2">
                  <!-- Card Header - Accordion -->
                  <a href="#collapseQuickLink" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseQuickLink">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Link</h6>
                  </a>
                  <!-- Card Content - Collapse -->
                  <div class="collapse show" id="collapseQuickLink">
                    <div class="card-body">

                      <div class="row">

                        <a href="createProduct.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              Create Product
                              <div class="text-white-50 small">Start Sell Your Product</div>
                            </div>
                          </div>
                        </a>

                        <a href="viewAllOrder.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              View Order
                              <div class="text-white-50 small">Check For New Order</div>
                            </div>
                          </div>
                        </a>

                        <a href="viewAllReview.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              View Review
                              <div class="text-white-50 small">Look at customer reviews</div>
                            </div>
                          </div>
                        </a>

                        <a href="viewAllReturnOrder.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              View Return
                              <div class="text-white-50 small">Check Customer Return Reason</div>
                            </div>
                          </div>
                        </a>

                      </div>
                    </div>
                  </div>
                  <!-- End Card Content - Collapse -->
                </div>
                  <!-- End Card Header - Accordion -->

            </div>
          </div>
          <!--End Quick Link-->

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
  if(flashdata == "seller-create-new-account-success-notic-01"){
      Swal.fire(
            'Create Account Successful!',
            'Welcome, Start You E-commece Now!',
            'success'
        )
  }else if(flashdata == "login-seller-account-success-notic-01"){
        Swal.fire(
            'Login Success!',
            'Welcome to Masomon Online Shopping Seller Page',
            'success'
        )
  }

  //for lastest order tooltip
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();     
  });

  //Export Chart 
    $(document).ready(function(){
        //Line Chart
        $('#makeLineChartPDF').click(function(){
          $('#hidden_LineChart').val($('#lineChartHeader').html());//title
          $('#linkToLineChartPDF').submit();
        });

        //Pie Chart
        $('#makePieChartPDF').click(function(){
          $('#hidden_PieChart').val($('#PieChartContent').html());//title
          $('#linkToPieChartPDF').submit();
        });
    });

  
  </script>
</body>

</html>
