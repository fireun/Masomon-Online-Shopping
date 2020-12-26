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

  <title>Seller View All Order</title>
  
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
            <a class="collapse-item active" href="viewAllOrder.php">All Order</a>
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
            <h1 class="h3 mb-0 text-gray-800">View All Order</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View All Order</li>
              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->
          <div class="row">

                <!-- Left Column -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 col-12" style="display: inline-flex;">
                            <div class="col-md-6 col-6">
                                <h6 class="m-0 font-weight-bold text-primary">Order Table</h6>
                            </div>
                            <!-- generate report -->
                            <div class="col-md-6 col-6 ">
                                <a href="../database/seller/exportFile.php?action=exportAllOrder" class="btn btn-sm btn-primary shadow-sm float-right" id="generateReport"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th style="min-width:200px">Order Id</th>
                                          <th style="min-width:200px">Product Name</th>
                                          <th style="min-width:200px">Variation</th>
                                          <th style="min-width:50px">Quantity</th>
                                          <th style="min-width:130px">Total Price</th>
                                          <th style="min-width:250px">Order Date</th>
                                          <th style="min-width:200px">Status</th>
                                          <th style="min-width:100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th style="min-width:200px">Order Id</th>
                                          <th style="min-width:200px">Product Name</th>
                                          <th style="min-width:200px">Variation</th>
                                          <th style="min-width:50px">Quantity</th>
                                          <th style="min-width:130px">Total Price</th>
                                          <th style="min-width:250px">Order Date</th>
                                          <th style="min-width:200px">Status</th>
                                          <th style="min-width:100px">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="filterContent">
                                        <tr>
                                            <td>23124234324</td>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>Pending</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Detail" onclick="location.href='orderDetail.php';"><i class="fas fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuOrderPage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                      <!-- <span class="sr-only">Toggle Dropdown</span> -->
                                                    </button>
                                                    <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuOrderPage">
                                                      <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#changeOrderStatusModal">Edit Status</a>
                                                      <!-- <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Separated link</a> -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>213421423432</td>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>Pending</td>
                                            <td>
                                                <!-- <a href="orderDetail.php" class=" btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" style="padding: 5px 8px;">
                                                  <i class="fas fa-eye"></i>
                                                </a> -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="View Detail" onclick="location.href='orderDetail.php';"><i class="fas fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuOrderPage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                      <!-- <span class="sr-only">Toggle Dropdown</span> -->
                                                    </button>
                                                    <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuOrderPage">
                                                      <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#changeOrderStatusModal">Edit Status</a>
                                                      <!-- <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Separated link</a> -->
                                                    </div>
                                                </div>
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
                                    <div class="col-md-5 mt-1">
                                      <span class="text-gray-800 font-weight-bold">Order ID: </span>
                                    </div>
                                    <div class="col-md-7">
                                    <input type="text" id="searchOrderId" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Name -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <span class="text-gray-800 font-weight-bold">Name: </span>
                                    </div>
                                    <div class="col-md-7">
                                    <input type="text" id="searchName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Price -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="text-gray-800 font-weight-bold">Total Price: </span>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="custom-select" id="searchPrice" onmousedown="if(this.options.length>2){this.size=2;}"  onchange='this.size=0;' onblur="this.size=0;">
                                        <option selected value="normal">Normal</option>
                                        <option value="ASC">Low To High</option>
                                        <option value="DESC">High To Low</option>
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
                                        <option value="submitted">Submitted</option>
                                        <option value="packging">Packging</option>
                                        <option value="shipping">Shipping</option>
                                        <option value="closed">Completed</option>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search - Fileter Product Name -->

                            <!-- Search - Fileter Product Name -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="text-gray-800 font-weight-bold">Order Date: </span>
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
                                          <option value="60">60</option>
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
                        <!-- End card body -->
                    </div>
                    <!-- End card -->
                </div>
                <!--End Right Column--->

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
                    <h6 class="m-0 font-weight-bold text-primary">Today Order</h6>
                  </a>
                  <!-- Card Content - Collapse -->
                  <div class="collapse show" id="collapseLatestCancel">
                    <div class="card-body">
                      
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Product Name</th>
                              <th>Variation</th>
                              <th>Quantity</th>
                              <th>Total Price</th>
                              <th>Order Date</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                                  $sellerId = $_SESSION['sellerId'];
                                  $todayTime_before = date('Y-m-d 00:00:00');
                                  $todayTime_after = date('Y-m-d 00:00:00', strtotime($todayTime_before . ' + 1 days') );

                                  $getTodayOrder = "SELECT *,cartintegration.status AS 'cartStatus', orderlist.orderId FROM cartintegration LEFT JOIN product ON cartintegration.productId = product.id LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.sellerId = '$sellerId' AND cartintegration.status = 'submitted' AND (cartintegration.update_time >= '$todayTime_before' AND cartintegration.update_time <= '$todayTime_after')";
                                  $resultGetTodayOrder = $conn->query($getTodayOrder);

                                  if($resultGetTodayOrder->num_rows > 0){
                                    while($row = $resultGetTodayOrder->fetch_assoc()){
                            ?>
                              <tr>
                                  <td><?php echo $row['name'];?></td>
                                  <td><?php echo $row['variation'];?></td>
                                  <td><?php echo $row['quantity'];?></td>
                                  <td>RM <?php echo $row['quantity']*$row['price'];?></td>
                                  <td><?php echo $row['update_time'];?></td>
                                  <td><?php echo $row['cartStatus'];?></td>
                                  <td>
                                      <div class="btn-group">
                                          <a href="orderDetail.php?orderId=<?php echo $row['orderId'];?>&cartIntegrationId=<?php echo $row['cartIntegrationId'];?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Detail" ><i class="fas fa-eye"></i></a>
                                      <?php
                                          if( ($row['cartStatus'] != "closed") && ($row['cartStatus'] != "shipping") ){
                                      ?>
                                          <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuOrderPage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                          </button>
                                          <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuOrderPage">
                                            <button class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#changeOrderStatusModal" value="<?php echo $row['cartIntegrationId'];?>" data-id="<?php echo $row['cartId'];?>" onclick="updateOrderStatus(this)">Edit Status</button>
                                          </div>
                                      <?php 
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
                                  <td colspan="8" class="text-center">
                                        There Is No New Order Today
                                  </td>
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
  
  <?php 
    if(isset($_SESSION['m'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
  <?php } ?>

  <!-- Logout Modal & Scroll to Top Button-->
  <?php require 'logout.php';?>

  <!-- Modal Change Order Status -->
  <?php require 'changeOrderStatusModal.php';?>
  <!-- End Modal Change Order Status -->

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
      searchOrder(1); 

      function searchOrder(page, orderID, name, price, status, orderDate, showRow){
          // var orderId = orderId.value;
          $.ajax({
              url:"../database/seller/productAction.php",
              method:"POST",
              data:{
                action:"searchOrder",
                page:page,
                id:orderID,
                filterName:name,
                filterPrice:price,
                filterStatus:status,
                filterDate:orderDate,
                filterRowData:showRow
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
          var id = $('#searchOrderId').val();
          var name = $('#searchName').val();
          var price = $('#searchPrice').val();
          var status = $('#searchStatus').val();
          var orderDate = $('#searchDate').val();
          var showRow = $('#searchShowRow').val();
          // console.log(id);
          // console.log(name);
          // console.log(price);
          // console.log(status);
          // console.log(orderDate);

          searchOrder(1,id,name,price,status,orderDate,showRow);
          
      });


      //reset
      $('#resetBtn').click(function(){
        location.reload();
      });

      //delete btn
      // $(".del-btn").on('click',function(e){
      //       e.preventDefault();
      //       const href = "../database/seller/productAction.php?deleteId=" ;
      //       var id = $(this).val();

      //       Swal.fire({
      //         title: 'Are you sure?',
      //         text: "You won't be able to revert this!",
      //         icon: 'warning',
      //         showCancelButton: true,
      //         confirmButtonColor: '#3085d6',
      //         cancelButtonColor: '#d33',
      //         confirmButtonText: 'Yes, delete it!'
      //       }).then((result) => {
      //         if (result.isConfirmed) {
      //           document.location.href = href + id;

      //         }
      //       })
      // });

    });
  </script>

  <script>
        //view order detail
        // function viewOrderDetail(OrderId){
        //   console.log( $($OrderId).val() );
        // } 


      //update order sttaus
      function updateOrderStatus(CartIntegrationId){
          var id = $(CartIntegrationId).val();
          var id2 = $(CartIntegrationId).data("id");
          // console.log( $(CartIntegrationId).val() );
          $('#updateStatusOrderId').val(id);
          $('#updateStatusCartId').val(id2);
          
          $.ajax({
              url:"../database/seller/productAction.php",
              method:"POST",
              data:{
                action:"showCartIntegrationStatus",
                cartIntegrationId:id
              }, //this is what data send between hyperlink
              success:function(data)
              {
              $('#displayStatusContent').html(data); //show in this dynaimic_content place
              }
          }); 
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
