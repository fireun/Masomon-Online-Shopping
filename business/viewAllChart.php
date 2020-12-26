<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $date =  date("Y-m-d");// current year-month-days hours:minut:seconts
  
  $sellerId = $_SESSION['sellerId'];

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
    $jsonstring = json_encode($json); //make to ["month",total]
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Seller View All Chart</title>

  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawCancelReasonPieChart);
    google.charts.setOnLoadCallback(drawReturnReasonPieChart);
    google.charts.setOnLoadCallback(drawAllEarningLineChart);

    function drawCancelReasonPieChart() {
        var data = google.visualization.arrayToDataTable([
          ['Reason', 'Total'],
          <?php
            // $result=$conn->query("Select actioncenter.actionReason, (Count(actioncenter.actionReason)* 100 / (Select Count(actioncenter.cartIntegrationId) From actioncenter)) as num From cartintegration LEFT JOIN actioncenter ON actioncenter.cartIntegrationId = cartintegration.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND cartintegration.cancelRequest = '1' Group By actioncenter.actionReason");
            // while($row=$result->fetch_assoc()){
            //   echo "['".$row['actionReason']."','".$row['num']."'],";
            // }
            $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' AND actioncenter.actionReason = 'Change Payment Method'");
            while($row=$result->fetch_assoc()){
              echo "['Change Payment Method',".$row['num']."],";
            }

            $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' AND actioncenter.actionReason = 'Change/Combine Order'");
            while($row=$result->fetch_assoc()){
              echo "['Change/Combine Order',".$row['num']."],";
            }

            $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' AND actioncenter.actionReason = 'Delivery Time Too Long'");
            while($row=$result->fetch_assoc()){
              echo "['Delivery Too Long',".$row['num']."],";
            }

            $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' AND actioncenter.actionReason = 'Duplicate Order'");
            while($row=$result->fetch_assoc()){
              echo "['Duplicate Order',".$row['num']."],";
            }
            
            $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' AND actioncenter.actionReason = 'Change Of Ship Address'");
            while($row=$result->fetch_assoc()){
              echo "['Change Of Ship Address',".$row['num']."],";
            }

            $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' AND actioncenter.actionReason = 'Change Of mind'");
            while($row=$result->fetch_assoc()){
              echo "['Change Of mind',".$row['num']."],";
            }
            
            $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'cancel' AND actioncenter.actionReason = 'Found cheaper elsewhere'");
            while($row=$result->fetch_assoc()){
              echo "['Found cheaper elsewhere',".$row['num']."],";
            }
          ?>
        ]);

        var options = {
          title: 'Total Cancel Reason',
          is3D: false,
        };

        var chart = new google.visualization.PieChart(document.getElementById('cancelChart_PieChart'));
        chart.draw(data, options);

        // Export PDF Image
        var cancelpieChart_area_pdf_export = document.getElementById('chart_div_Cancel_PieChart_pdf');
        var cancelpieChart_pdf = new google.visualization.PieChart(cancelpieChart_area_pdf_export);
          google.visualization.events.addListener(cancelpieChart_pdf, 'ready', function(){
            cancelpieChart_area_pdf_export.innerHTML = '<img src="' + cancelpieChart_pdf.getImageURI() + '" class="img-responsive" style="width:500;height:500">';
          });
          cancelpieChart_pdf.draw(data, options);
    }
    
    function drawReturnReasonPieChart() {
        // Create the data table.
        var data = google.visualization.arrayToDataTable([  
          ['REturn Reason', 'Number'], 

          <?php
           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Pictures do not match item'");
           while($row=$result->fetch_assoc()){
             echo "['Pictures do not match item',".$row['num']."],";
           }

           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Description does not match item'");
           while($row=$result->fetch_assoc()){
             echo "['Description does not match item',".$row['num']."],";
           }

           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Counterfeit item'");
           while($row=$result->fetch_assoc()){
             echo "['Counterfeit item',".$row['num']."],";
           }

           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Received wrong item'");
           while($row=$result->fetch_assoc()){
             echo "['Received wrong item',".$row['num']."],";
           }
           
           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Missing accessory/freebie'");
           while($row=$result->fetch_assoc()){
             echo "['Missing accessory/freebie',".$row['num']."],";
           }

           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Item does not work properly'");
           while($row=$result->fetch_assoc()){
             echo "['Item does not work properly',".$row['num']."],";
           }

           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Packaging is physically damaged'");
           while($row=$result->fetch_assoc()){
             echo "['Packaging is physically damaged',".$row['num']."],";
           }

           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Item is physically damaged'");
           while($row=$result->fetch_assoc()){
             echo "['Item is physically damaged',".$row['num']."],";
           }

           $result=$conn->query("SELECT COUNT(*) AS num FROM cartintegration LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId WHERE cartintegration.sellerId = '$sellerId' AND actioncenter.action = 'return' AND actioncenter.actionReason = 'Do not want the item or it doesn ot suit me'");
           while($row=$result->fetch_assoc()){
             echo "['Do not want the item or it doesn ot suit me',".$row['num']."],";
           }
          ?>
        ]);

        // Set chart options
        var options = {'title':'Percentage Of All Return Reason',
                      is3D: false,
                      legend:{'position':'left'},
                      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('returnChart_PieChart'));
        chart.draw(data, options);

        // Export PDF Image
        var returnpieChart_area_pdf_export = document.getElementById('chart_div_Return_PieChart_pdf');
        var returnpieChart_pdf = new google.visualization.PieChart(returnpieChart_area_pdf_export);
          google.visualization.events.addListener(returnpieChart_pdf, 'ready', function(){
            returnpieChart_area_pdf_export.innerHTML = '<img src="' + returnpieChart_pdf.getImageURI() + '" class="img-responsive" style="width:500;height:500">';
          });
          returnpieChart_pdf.draw(data, options);
    }


    function drawAllEarningLineChart() {
        var data = google.visualization.arrayToDataTable( 
          <?php echo $jsonstring ?>
          );

        var options = {
          title: 'Montly of Earnings',
        };

        var imgoptions = {
          title: 'Montly of Earnings',
          width:800,
          height:700
        };

        //make chart
        var lineChart = new google.visualization.LineChart(document.getElementById('allEarning_LineChart'));
        lineChart.draw(data, options);

        // Export PDF Image
        var earningChart_area_pdf_export = document.getElementById('chart_div_earning_PieChart_pdf');
        var earningpieChart_pdf = new google.visualization.LineChart(earningChart_area_pdf_export);
          google.visualization.events.addListener(earningpieChart_pdf, 'ready', function(){
            earningChart_area_pdf_export.innerHTML = '<img src="' + earningpieChart_pdf.getImageURI() + '" class="img-responsive style="width:800px;height:800px">';
          });
          earningpieChart_pdf.draw(data, imgoptions);
      }
        
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
      <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">View All Chart</h1>
            <button id="exportChartBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export All Diagram</button>
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View All Chart</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-6 col-lg-6">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#cancelReasonPieChart" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="cancelReasonPieChart">
                  <h6 class="m-0 font-weight-bold text-primary">Percentage of Cancel Reason</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="cancelReasonPieChart">
                  <div class="card-body">
                          <div id="cancelChart_PieChart" style="width: 100%;min-width:200"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#returnReasonPieChart" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="returnReasonPieChart">
                  <h6 class="m-0 font-weight-bold text-primary">Percentage of Return Reason</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="returnReasonPieChart">
                  <div class="card-body">
                        <div id="returnChart_PieChart" style="width: 100%;"></div>
                  </div>
                </div>
              </div>
            </div>
         
          </div>
          <!-- Content Row -->

          <!-- historgam content row -->
          <div class="row">
            <div class="col-xl-12 col-lg-12">
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#cancelReasonPieChart" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="cancelReasonPieChart">
                    <h6 class="m-0 font-weight-bold text-primary">Enarning All</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="cancelReasonPieChart">
                    <div class="card-body">
                            <div id="allEarning_LineChart" style="width: 100%;min-width:200"></div>
                    </div>
                    </div>
                </div>
                </div>
          </div>
          <!-- End content row -->


          <!-- Export PDF -->
          <form action="../database/seller/created_pdf.php" method="POST" id="MakeChartPDF">
            <input type="hidden" name="hidden_html" id="hidden_AllChart" /><!--store to input-->
            <div class="row d-none" id="hidde_content">
              <div class="col-xl-12">
                  <div class="col-md-6">
                    <div id="chart_div_Cancel_PieChart_pdf" style="width: 500px;"></div>
                  </div>
                  <div class="col-md-6">
                    <div id="chart_div_Return_PieChart_pdf" style="width: 500px;"></div>
                  </div>
              </div>
              <div class="col-xl-12">
                  <div id="chart_div_earning_PieChart_pdf" style="width: 100%"></div>
              </div>  
            </div>
          </form>
          <!-- End Export PDF -->

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

  //Export Chart 
  $(document).ready(function(){
    //displaye
    $('#exportChartBtn').click(function(){
      $('#hidden_AllChart').val($('#hidde_content').html());//title
      $('#MakeChartPDF').submit();
    });

  });
  </script>
</body>

</html>
