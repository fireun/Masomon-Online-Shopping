<?php
  include("../config.php");
  include '../limitTimeSession.php';

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $date =  date("Y-m-d h:i:s");// current year-month-days hours:minut:seconts

  $today_before = date("Y-m-d 00:00:00",strtotime($date));
  $today_after = date("Y-m-d 00:00:00",strtotime($date .'+1 day'));
  $month_before =  date('Y-m-01 00:00:00', strtotime($date));
  $month_after = date('Y-m-t 24:60:60', strtotime($date . '+ 1 days'));

  if($_SESSION['warehouseAdminId']){
    $warehouseAdminId = $_SESSION['warehouseAdminId'];

    $todaySql = "SELECT COUNT(track.trackId) AS 'todayCount' FROM `track` WHERE status = 'In Transit' OR status = 'pending' AND (estimate_Arrived >= '$today_before' OR estimate_Arrived <= '$today_after')";
    $resultToday = $conn->query($todaySql);
    if($resultToday ->num_rows>0){
      while($row = $resultToday ->fetch_assoc()){
          $todayNum = $row['todayCount'];
      }
    }else{
      $todayNum = 0;
    }

    $monthSql = "SELECT COUNT(track.trackId) AS 'monthCount' FROM `track` WHERE status = 'In Transit' OR status = 'pending' AND (estimate_Arrived >= '$month_before' OR estimate_Arrived <= '$month_after')";
    $resultMonth = $conn->query($monthSql);
    if($resultMonth ->num_rows>0){
      while($row = $resultMonth ->fetch_assoc()){
          $MonNum = $row['monthCount'];
      }
    }else{
      $MonNum = 0;
    }

    $num = "SELECT (COUNT(trackId) / (SELECT COUNT(trackId) FROM track WHERE adminReceiveName = '$warehouseAdminId') * 100.0 ) AS percent FROM `track` WHERE adminReceiveName = '$warehouseAdminId' AND status = 'picked up' OR status = 'Out Of Delivery'";
    $resultNum = $conn->query($num);
    if($resultNum ->num_rows>0){
      while($row = $resultNum ->fetch_assoc()){
          $totalNum = (int)$row['percent'];
      }
    }else{
      $totalNum = 0;
    }


  //make line chartt
  $json = array(
      ["Day","Total"]
  );
  for($day = 0; $day <= 6; $day++){
    $count = $day+1;
    $todayDate_before = date("Y-m-d 00:00:00",strtotime($date . '+ '.$day.' day'));
    $todayDate_after = date("Y-m-d 00:00:00",strtotime($date . '+ '.$count.' day'));


    $sql = "SELECT COUNT(track.trackId) AS 'num' FROM `track` WHERE (track.status = 'In Transit' OR track.status = 'pending') AND (track.estimate_Arrived >= '$todayDate_before' OR track.estimate_Arrived <= '$todayDate_after') AND adminReceiveName = ''";
    $result = $conn->query($sql);
    // $result=$conn->query("SELECT SUM(product.price * cartintegration.quantity) AS 'total' FROM `cartintegration` LEFT JOIN `product` ON cartintegration.productId = product.id WHERE cartintegration.status = 'closed' AND cartintegration.cancelRequest = '0' AND cartintegration.returnRequest = '0' AND (cartintegration.update_time >= '$setMonth_before' AND cartintegration.update_time <= '$setMonth_after') AND cartintegration.sellerId = '$sellerId'");
    while($row=$result->fetch_assoc()){
      $day_format = date("l",strtotime($todayDate_before));
      $total= $row['num'];

      if($total == NULL){
        $total = 0;
      }
      
      $dataRow = array(
        $day_format,
        $total
    );
    array_push($json, $dataRow); //put in array
      
    }
  }
  $jsonstring = json_encode($json); //make to ["month",total]

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

  <title>Warehouse Dashboard</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(
          <?php echo $jsonstring ?>
          );

        var options = {
          title: 'Number Of Packages Arriving At The Warehouse Next Week',
          colors: ['#e7711c'],
          // histogram: { lastBucketPercentile: 5 },
          // vAxis: { scaleType: 'mirrorLog' }
        };

        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
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
      <li class="nav-item active">
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
        Packgage
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
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Estimated arrival at the warehouse today</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $todayNum;?></div>
                    </div>
                    <div class="col-auto">
                    <svg t="1607875957721" class="icon" viewBox="0 0 1051 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2122" width="32" height="32"><path d="M458.749769 1020.120443H120.886764a121.329572 121.329572 0 0 1-120.886763-121.495625V121.495625A121.329572 121.329572 0 0 1 120.886764 0h627.238462a121.329572 121.329572 0 0 1 120.859088 121.495625v219.743796h-21.47622V121.495625A99.770325 99.770325 0 0 0 748.125226 21.586922H120.886764A99.770325 99.770325 0 0 0 21.476221 121.495625v777.129193a99.770325 99.770325 0 0 0 99.410543 99.908703h337.863005v21.586922z m209.088713-724.545665H231.007742V273.987856h436.83074v21.586922zM361.691647 595.854399H231.007742v-21.586922h130.683905v21.586922zM772.341325 1023.995018A281.183497 281.183497 0 1 1 1051.864289 742.811521 280.740688 280.740688 0 0 1 772.341325 1023.995018z m0-540.780071a259.596575 259.596575 0 1 0 258.102095 259.596574 259.153766 259.153766 0 0 0-258.102095-259.596574z m141.892499 270.390035h-171.283924v-138.377705h21.47622v116.790783h149.807704v21.586922z" p-id="2123" fill="#cdcdcd"></path></svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Expected to arrive at the warehouse this month</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $MonNum;?></div>
                    </div>
                    <div class="col-auto">
                    <svg t="1607875828403" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1184" width="32" height="32"><path d="M128 384h768V298.666667a42.666667 42.666667 0 0 0-42.666667-42.666667h-85.333333V170.666667h128a85.333333 85.333333 0 0 1 85.333333 85.333333v597.333333a85.333333 85.333333 0 0 1-85.333333 85.333334H128a85.333333 85.333333 0 0 1-85.333333-85.333334V256a85.333333 85.333333 0 0 1 85.333333-85.333333h85.333333v85.333333H170.666667a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333z m0 85.333333v341.333334a42.666667 42.666667 0 0 0 42.666667 42.666666h682.666666a42.666667 42.666667 0 0 0 42.666667-42.666666v-341.333334H128z m256-298.666666h213.333333v85.333333H384V170.666667z m-170.666667 384h85.333334v85.333333H213.333333v-85.333333z m0 128h85.333334v85.333333H213.333333v-85.333333z m170.666667-128h85.333333v85.333333H384v-85.333333z m0 128h85.333333v85.333333H384v-85.333333z m170.666667 0h85.333333v85.333333h-85.333333v-85.333333z m0-128h85.333333v85.333333h-85.333333v-85.333333z m170.666666 0h85.333334v85.333333h-85.333334v-85.333333zM298.666667 85.333333a42.666667 42.666667 0 0 1 42.666666 42.666667v170.666667a42.666667 42.666667 0 1 1-85.333333 0V128a42.666667 42.666667 0 0 1 42.666667-42.666667z m384 0a42.666667 42.666667 0 0 1 42.666666 42.666667v170.666667a42.666667 42.666667 0 0 1-85.333333 0V128a42.666667 42.666667 0 0 1 42.666667-42.666667z" p-id="1185" fill="#bfbfbf"></path></svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Number of packages being processed</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalNum;?>%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $totalNum;?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
          </div>

          <!-- Chart -->
          <div class="row">
            <div class="col-xl-12">
              <div class="card shadow mb-2">
                  <!-- Card Header - Accordion -->
                  <a href="#collapseChart" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseChart">
                    <h6 class="m-0 font-weight-bold text-primary">Number Of Packages Arriving At The Warehouse Next Week </h6>
                  </a>
                  <!-- Card Content - Collapse -->
                  <div class="collapse show" id="collapseChart">
                    <div class="card-body">
                    <div id="chart_div" style="width: 900px; height: 500px;"></div>
                    </div>
                  </div>
              </div>
            </div>
          </div>

          
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

                        <a href="allPackage.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              All Package
                              <div class="text-white-50 small">Management All Package</div>
                            </div>
                          </div>
                        </a>

                        <a href="newPackage.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              Accept New Package
                              <div class="text-white-50 small">Check Available New Package</div>
                            </div>
                          </div>
                        </a>

                        <a href="searchPackage.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              Search Package
                              <div class="text-white-50 small">Quick Check And Edit Package Status</div>
                            </div>
                          </div>
                        </a>

                        <a href="deliveryPackage.php" class="col-lg-3 mb-2 text-decoration-none">
                          <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                              Out For Delivery
                              <div class="text-white-50 small">Managemnt Package Status Out For Delivery</div>
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
      <?php require 'footer.php';?>
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
  if(flashdata == "admin-create-new-account-success-notic-01"){
      Swal.fire(
            'Create Account Successful!',
            'Welcome Join To Masomon Admin!',
            'success'
        )
  }else if(flashdata == "login-account-success-notic-01"){
        Swal.fire(
            'Login Success!',
            'Welcome to Masomon Online Shopping Admin Page',
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
