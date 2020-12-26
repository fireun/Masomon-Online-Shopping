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

  <title>Seller View All Auction Product</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Sweet Alert JS  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   
  <!--Ajaxx-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>


  <style>
        section.range-slider {
            position: relative;
            width: 160px;
            height: 35px;
            text-align: center;
        }

        section.range-slider input {
            pointer-events: none;
            position: absolute;
            overflow: hidden;
            left: 0;
            top: 15px;
            width: 175px;
            outline: none;
            height: 18px;
            margin: 0;
            padding: 0;
        }

        section.range-slider input::-webkit-slider-thumb {
            pointer-events: all;
            position: relative;
            z-index: 1;
            outline: 0;
        }

        section.range-slider input::-moz-range-thumb {
            pointer-events: all;
            position: relative;
            z-index: 10;
            -moz-appearance: none;
            width: 9px;
        }

        input[type="range"]{
          background:blue;
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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>View Product</span>
        </a>
        <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="viewAllProduct.php">Product</a>
            <a class="collapse-item active" href="viewAllAuctionProduct.php">Auction Product</a>
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
            <h1 class="h3 mb-0 text-gray-800">View All Auction Product</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View All Auction Product</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->
          <div class="row">

                <!-- Left Column -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Auction Product Table</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <!-- <th>Current High Bid</th> -->
                                        <th>Due Date</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <!-- <th>Current High Bid</th> -->
                                        <th>Due date</th>
                                        <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="filterContent">
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>2011/04/25</td>
                                            <td>
                                                <button type="button" class="btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" value="">
                                                <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- <button type="button" class="btn-danger rounded" data-toggle="tooltip" data-placement="top" title="Remove Product" value="">
                                                <i class="far fa-trash-alt"></i>
                                                </button> -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>2011/07/25</td>
                                            <td>
                                                <button type="button" class="btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" value="">
                                                <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- <button type="button" class="btn-danger rounded" data-toggle="tooltip" data-placement="top" title="Remove Product" value="">
                                                <i class="far fa-trash-alt"></i>
                                                </button> -->
                                            </td>
                                        </tr>
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

                <!-- Right Column -->
                <div class="col-lg-4">
                    <div class="card shadow mb-4"> 
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Search Filter</h6>
                        </div>

                        <div class="card-body">
                            <!-- Search - Fileter Product Name -->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                    Name: 
                                    </div>
                                    <div class="col-md-8">
                                      <input type="text" id="searchName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Price -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    Price: 
                                    </div>
                                    <div class="col-md-8">
                                        <section class="range-slider">
                                        <span class="rangeValues"></span>
                                        <input value="0" min="0" max="99998.5" step="0.5" type="range">
                                        <input value="99999" min="0.5" max="99999" step="0.5" type="range">
                                        <input type="hidden" id="searchMinPrice">
                                        <input type="hidden" id="searchMaxPrice">
                                      </section>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Name -->
                            <!-- <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    Current High Bid: 
                                    </div>
                                    <div class="col-md-8">
                                      <select class="custom-select" id="searchBid" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
                                        <option selected value="ASC">Low To High</option>
                                        <option value="DESC">High To Low</option>
                                      </select>
                                    </div>
                                </div>
                            </div> -->
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Name -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                    Due Date: 
                                    </div>
                                    <div class="col-md-8">
                                    <input type="date" id="searchDueDate" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product rowData -->
                          <div class="col-md-12 mt-3">
                              <div class="row">
                                  <div class="col-md-4">
                                    Show Row: 
                                  </div>
                                  <div class="col-md-8">
                                      <select class="custom-select" id="searchShowRow" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
                                        <option selected value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="all">* All</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <!-- End Search - Fileter Product rowData -->

                            <!-- Search - Fileter Product Name -->
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
                            <!-- End Search - Fileter Product Name -->

                        </div>
                        <!-- End card body -->
                    </div>
                    <!-- End card -->
                </div>
                <!--End Right Column--->

        </div>
        <!--End Content Row -->

        <!--  Cotent Row - auctiuon Product -->
        <div class="row">
          <div class="col-lg-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - auctiuon Product -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Auction Product  - Record</h6>
                </a>
                <!-- Card Content - auctiuon Product -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">username</th>
                            <th scope="col">Bid</th>
                            <th scope="col">Update Date</th>
                          </tr>
                        </thead>
                        <tbody id="auctionRecordShowContent">
                          <!-- <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>

                          <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                          </tr> -->

                          <tr class="text-center">
                            <td colspan="4">No Found Result</td>
                          </tr>
                        </tbody>
                    </table>
                    </div><!--End table responsiove-->
                  </div><!--End card body-->
                </div><!--End card content-->
              </div><!--End Card-->
          </div>
        </div>
        <!-- End Cotent Row -->

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

  <!-- Sweet Alert JS  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   
  <!--Ajaxx-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
 
  <script>
    //for lastest order tooltip
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();     
    });

    //auto filter & get table
    $(document).ready(function(){
      showActionProduct(1); 

      function showActionProduct(page, name, minPrice, maxPrice, searchDate, rowData){
          // var orderId = orderId.value;
          $.ajax({
              url:"../database/seller/AllAuctionProduct.php",
              method:"POST",
              data:{
                page:page,
                filterName:name,
                filterMinPrice:minPrice,
                filterMaxPrice:maxPrice,
                // filterBid:bid,
                filterDueDate:searchDate,
                filterRowData:rowData
              }, //this is what data send between hyperlink
              success:function(data)
              {
              $('#filterContent').html(data); //show in this dynaimic_content place
              }
          }); 
      }

    //filter
    $('#filterBtn').click(function(){
          // showProduct();
          var name = $('#searchName').val();
          var minPrice = $('#searchMinPrice').val();
          var maxPrice = $('#searchMaxPrice').val();
          // var bid = $('#searchBid').val();
          var searchDate = $('#searchDueDate').val();
          var showRow = $('#searchShowRow').val();

          showActionProduct(1,name,minPrice,maxPrice,searchDate,showRow);
          
      });

      //reset
      $('#resetBtn').click(function(){
        location.reload();
      });

    });


    //check auction record
    function checkAuctionRecord(recordId){
      var id = $(recordId).val();
      console.log(id);
      $.ajax({
          url:"../database/seller/productAction.php",
          method:"POST",
          data:{
            action:"viewAuctioRecord",
            auctionId:id
          }, //this is what data send between hyperlink
          success:function(data)
          {
            $('#auctionRecordShowContent').html(data); //show in this dynaimic_content place
          }
      }); 
    }

    //slider range price
    function getVals(){
      // Get slider values
      var parent = this.parentNode;
      var slides = parent.getElementsByTagName("input");
        var slide1 = parseFloat( slides[0].value );
        var slide2 = parseFloat( slides[1].value );
      // Neither slider will clip the other, so make sure we determine which is larger
      if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }
      
      var displayElement = parent.getElementsByClassName("rangeValues")[0];
          displayElement.innerHTML = slide1 + " - " + slide2;
          $("#searchMinPrice").val(slide1); // sets first handle (index 0) to 50
          $("#searchMaxPrice").val(slide2); // sets second handle (index 1) to 80
    }

    window.onload = function(){
      // Initialize Sliders
      var sliderSections = document.getElementsByClassName("range-slider");
          for( var x = 0; x < sliderSections.length; x++ ){
            var sliders = sliderSections[x].getElementsByTagName("input");
            for( var y = 0; y < sliders.length; y++ ){
              if( sliders[y].type ==="range" ){
                sliders[y].oninput = getVals;
                // Manually trigger event first time to display values
                sliders[y].oninput();
              }
            }
          }
    }
  </script>
</body>

</html>
