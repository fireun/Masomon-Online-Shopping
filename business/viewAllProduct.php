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

  <title>Seller View All Product</title>

  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  
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
            <a class="collapse-item active" href="viewAllProduct.php">Product</a>
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
            <h1 class="h3 mb-0 text-gray-800">View All Product</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View All Product</li>
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
                    <h6 class="m-0 font-weight-bold text-primary">Product Table</h6>
                  </div>

                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Sold Record</th>
                            <th style="width:13%">Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Sold Record</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody id="filterContent">
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>
                                <button type="button" class="btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" value="">
                                  <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn-danger rounded" data-toggle="tooltip" data-placement="top" title="Remove Product" value="">
                                  <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                          </tr>
                          <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>
                                <button type="button" class="btn-primary rounded" data-toggle="tooltip" data-placement="top" title="View Detail" value="">
                                  <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn-danger rounded" data-toggle="tooltip" data-placement="top" title="Remove Product" value="">
                                  <i class="far fa-trash-alt"></i>
                                </button>
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
                      <form id="filterForm">
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
                                  <!-- This block can be reused as many times as needed -->
                                  <section class="range-slider">
                                    <span class="rangeValues"></span>
                                    <input value="0" min="0" max="9998.5" step="0.5" type="range">
                                    <input value="9999" min="0.5" max="9999" step="0.5" type="range">
                                    <input type="hidden" id="searchMinPrice">
                                    <input type="hidden" id="searchMaxPrice">
                                  </section>
                                  <!-- <input type="text" name="searchPrice" class="form-control" onkeypress="return isNumber(event)"> -->
                                </div>
                            </div>
                        </div>
                        <!-- End Search - Fileter Product Price -->

                        <!-- Search - Fileter Product Stock -->
                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                  Stock: 
                                </div>
                                <div class="col-md-8">
                                  <input type="text" id="searchStock" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <!-- End Search - Fileter Product Stock -->

                        <!-- Search - Fileter Product SoldRecord -->
                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                  Sold Record: 
                                </div>
                                <div class="col-md-8">
                                    <select class="custom-select" id="searchSoldRecord" onmousedown="if(this.options.length>8){this.size=2;}"  onchange='this.size=0;' onblur="this.size=0;">
                                      <option value="ASC">Low To High</option>
                                      <option value="DESC">High To Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End Search - Fileter Product SoldRecord -->

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

                        <!-- Search - Fileter Product button -->
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
                        <!-- End Search - Fileter Product button -->
                      </form>
                    </div>
                    <!-- End card body -->
                </div>
                <!-- End card -->
              </div>
              <!--End Right Column--->

          </div>
          <!-- Content Row -->

          <!-- Cotent Row - remover table -->
          <div class="row">
            <div class="col-lg-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Recover Remove Product</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Stock</th>
                              <th>Remove Date</th>
                              <th style="width:13%">Action</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Stock</th>
                              <th>Remove Date</th>
                              <th>Action</th>
                            </tr>
                          </tfoot>
                          <tbody>
                            <?php
                              $sellerId = $_SESSION['sellerId'];
                              $showRemoveProduct = "SELECT product.*,inventory.totalStock FROM product LEFT JOIN inventory ON product.id = inventory.productId WHERE product.sellerId = '$sellerId' AND product.status='remove' AND product.auctionStatus = 'no'";
                              $resultShowRemoveProduct = $conn->query($showRemoveProduct);

                              if($resultShowRemoveProduct->num_rows > 0){ //over 1 database(record) so run
                                while($row = $resultShowRemoveProduct->fetch_assoc()){
                                    $remove_product_id = $row['id'];
                                    $remove_product_image = $row['coverImage'];
                                    $remove_product_name = $row['name'];  
                                    $remove_product_price = $row['price'];
                                    $remove_product_Stock = $row['totalStock'];
                                    $remove_product_date = $row['uploadTime'];      
                            ?>
                              <tr>
                                <td>
                                  <img src="../images/productImage/<?php echo $remove_product_image;?>" alt="" width="55" height="55">
                                </td>
                                <td><?php echo $remove_product_name;?></td>
                                <td><?php echo $remove_product_price;?></td>
                                <td><?php echo $remove_product_Stock;?></td>
                                <td><?php echo $remove_product_date;?></td>
                                <td>
                                    <button type="button" class="btn-primary rounded" data-toggle="tooltip" data-placement="top" title="Recover Product" onclick="location.href='../database/seller/productAction.php?recoverId=<?php echo $remove_product_id;?>'">
                                      <i class="fas fa-database"></i>
                                    </button>
                                    <button type="button" class="btn-danger rounded del-btn" data-toggle="tooltip" data-placement="top" title="Delete Product" value="<?php echo $remove_product_id;?>">
                                      <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                              </tr>
                            <?php
                                }
                              }else{
                            ?>
                              <tr>
                                <td colspan="6" class="text-center">
                                    No Record Found
                                </td>
                              </tr>

                              <!-- <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>
                                    <button type="button" class="btn-primary rounded" data-toggle="tooltip" data-placement="top" title="Recover Product" value="">
                                      <i class="fas fa-database"></i>
                                    </button>
                                </td>
                              </tr> -->
                            <?php
                              }
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- End Table Responsive -->
                  </div> <!-- End Card Body -->
                </div> <!-- End Card Content - Collapse -->
              </div><!-- End Card -->
            </div><!-- End lg box -->
          </div>
          <!-- End Cotent Row -remover table -->

          <!-- Content Row - Stock Table -->
          <div class="card shadow mb-4">
            <a href="#stockShortage" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="stockShortage">
                  <h6 class="m-0 font-weight-bold text-danger">* Stock Shortage</h6>
            </a>
            <div class="collapse show" id="stockShortage">
            <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>Product Image</th>
                          <th>Product Name</th>
                          <th>Stock Available</th>
                          <th>Last Modified</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Product Image</th>
                          <th>Product Name</th>
                          <th>Stock Available</th>
                          <th>Last Modified</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php
                          $checkStock = "SELECT * FROM `product` LEFT JOIN `inventory` ON product.id = inventory.productId WHERE inventory.totalStock <= '20' AND product.sellerId = '$sellerId' AND product.status = '' AND product.auctionStatus = 'no'";
                          $resultCheckStock = $conn->query($checkStock);
                          if($resultCheckStock->num_rows > 0){
                            while($row = $resultCheckStock->fetch_assoc()){
                        ?>
                        <tr>
                          <td>
                            <img src="../images/productImage/<?php echo $row['coverImage'];?>" alt="" width="55" height="55">
                          </td>
                          <td><?php echo $row['name'];?></td>
                          <td><?php echo $row['totalStock'];?></td>
                          <td><?php echo $row['recordDate']?></td>
                          <td>
                            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#updateStock" value="<?php echo $row['id'];?>" onclick="updateStock(this)">Update</button>
                          </td>
                        </tr>
                        <?php
                            }
                          }else{
                        ?>
                        <tr><td colspan="5">No Available Stock Shortage</td></tr>
                        <?php
                          }  
                        ?>
                      </tbody>
                    </table>
                  </div><!--End table responsive-->
            </div>
            </div>
          </div>
          
        </div>
        <!-- End Stock Table -->

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

  <!-- Modal Update Stock -->
  <!-- Modal -->
  <form action="../database/seller/productAction.php" method="POST">
  <div class="modal fade" id="updateStock" tabindex="-1" role="dialog" aria-labelledby="updateStockTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateStockTitle">Update Product Stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <input type="hidden" name="productId" id="productId">
        </div>
        <div class="modal-body" id="StockContent">
          <!-- <input type="number" name="productStock"  min="10" max="999" class="form-control"  onkeypress="return isNumber(event)" placeholder="Product Stock (miniman 10 & maximun 999)" value="" > -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="updateProductStock" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!-- End Modal Update Stock -->

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

    //sweet alert
    var flashdata = $('.flash-data').data('flashdata');
      if(flashdata == "created-product-successfully-notic-01"){
          Swal.fire(
              'Create Product Success!',
              'You successfully created a new product!',
              'success'
          )
      }else if(flashdata == "remove-product-success-notic-01"){
          Swal.fire(
              'Remove Product Success!',
              'If want recover back, Please click recover button',
              'success'
          )
      }else if(flashdata == "remove-product-failed-notic-01"){
          Swal.fire({
              icon: 'error',
              title: 'Remover Product Failed',
              text: 'Please Try Later!'
          })
      }else if(flashdata == "recover-product-success-notic-01"){
          Swal.fire(
              'Recover Product Success!',
              'This Item has been successfully recover!',
              'success'
          )
      }else if(flashdata == "recover-product-failed-notic-01"){
          Swal.fire({
              icon: 'error',
              title: 'Recover Product Failed',
              text: 'Please Try Later!'
          })
      }else if(flashdata == "delete-product-success-notic-01"){
          Swal.fire(
              'Delete Product Success!',
              'This Item has been successfully deleted!',
              'success'
          )
      }else if(flashdata == "delete-product-failed-notic-01"){
          Swal.fire({
              icon: 'error',
              title: 'Delete Product Failed',
              text: 'Please Try Later!'
          })
      }else if(flashdata == "update-stock-success-notic-01"){
          Swal.fire(
              'Update Stock Success!',
              'This Stock has been successfully update!',
              'success'
          )
      }else if(flashdata == "update-stock-failed-notic-01"){
          Swal.fire({
              icon: 'error',
              title: 'Update Product Stock Failed',
              text: 'Please Try Later!'
          })
      }


    
    
    //validation product price
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    
      //update order sttaus
    function updateStock(productId){
      var id = $(productId).val();
      $('#productId').val(id);

         $.ajax({
              url:"../database/seller/productAction.php",
              method:"POST",
              data:{
                productId:id,
                action:"showStockContent"
              }, //this is what data send between hyperlink
              success:function(data)
              {
                $('#StockContent').html(data); //show in this dynaimic_content place
              }
         }); 
    }

    //auto filter & get table
    $(document).ready(function(){
      showProduct(1); 

      function showProduct(page, name, minPrice, maxPrice, stock, soldRecord, rowData){
          // var orderId = orderId.value;
          $.ajax({
              url:"../database/seller/AllProduct.php",
              method:"POST",
              data:{
                page:page,
                filterName:name,
                filterMinPrice:minPrice,
                filterMaxPrice:maxPrice,
                filterStock:stock,
                filterSoldRecord:soldRecord,
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
          var stock = $('#searchStock').val();
          var soldRecord = $('#searchSoldRecord').val();
          var showRow = $('#searchShowRow').val();
          
          showProduct(1,name,minPrice,maxPrice,stock,soldRecord,showRow);
          
      });


      //reset
      $('#resetBtn').click(function(){
        location.reload();
      });

      //delete btn
      $(".del-btn").on('click',function(e){
            e.preventDefault();
            const href = "../database/seller/productAction.php?deleteId=" ;
            var id = $(this).val();

            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                document.location.href = href + id;

              }
            })
      });

    });
    </script>
    <script>

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
