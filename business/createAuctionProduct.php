<?php
  include("../config.php");
  include '../limitTimeSession.php';

  if(isset($_GET['edit-auction-product-id'])){
    $edit_auction_product_id = $_GET['edit-auction-product-id'];

    //check status first
    $edit_check_product_sql = "SELECT * FROM product WHERE id = '$edit_auction_product_id' AND auctionStatus = 'yes' AND status = ''";
    $result_Edit_Check_Product = $conn->query($edit_check_product_sql);

    if($result_Edit_Check_Product->num_rows > 0){
      while($row = $result_Edit_Check_Product->fetch_assoc()){
          $edit_auction_product_name = $row['name'];
          $edit_auction_product_price = $row['price'];
          $edit_auction_product_category = $row['categoryId'];
          $edit_auction_product_description = $row['description'];
          $edit_auction_product_coverImage = $row['coverImage'];
          $edit_auction_product_color = $row['color'];
          $edit_auction_product_brand = $row['brand'];
          $edit_auction_product_material = $row['material'];
          $edit_auction_product_gender = $row['gender'];
          $edit_auction_product_uploadTime = $row['uploadTime'];
          $edit_auction_product_auctionDueDate = $row['auctionDueDate'];

          //get catgory type
          $edit_category = "SELECT * FROM category WHERE categoryId = '$edit_auction_product_category'";
          $result_Edit_Check_Category = $conn->query($edit_category);
          if($result_Edit_Check_Category->num_rows > 0){
              while($row = $result_Edit_Check_Category->fetch_assoc()){
                  $edit_auction_product_category_name = $row['categoryType'];
              }
          }
      }
    }else{
      header("Location: 404.php");
      die();
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

  <title>Seller Create Auction Product</title>
  
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon2.png"/>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">
  <link href="../kartik-v-bootstrap-fileinput-6e58108/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
  <link href="../kartik-v-bootstrap-fileinput-6e58108/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
  <style>
      .tox-statusbar__branding{
          display:none;
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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Create</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Create Components:</h6>
            <a class="collapse-item" href="createProduct.php">Create Product</a>
            <a class="collapse-item active" href="createAuctionProduct.php">Create Auction Product</a>
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
              <?php
                    if(isset($_GET['edit-auction-product-id'])){
              ?>
                    <h1 class="h3 mb-0 text-gray-800">Edit Auction Product</h1>
              <?php
                    }else{
              ?>
                    <h1 class="h3 mb-0 text-gray-800">Create Auction Product</h1>
              <?php
                    }
              ?>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!--Page Breadcrumb-->
          <div class="row ml-1">
            <nav aria-label="breadcrumb" class="float-left">
              <ol class="breadcrumb">
                <?php
                        if(isset($_GET['edit-auction-product-id'])){
                ?>
                         <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Edit Auction Product</li>
                         <li class="breadcrumb-item active" aria-current="page"><?php echo $edit_auction_product_name;?></li>
                <?php
                        }else{
                ?>
                         <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Create Auction Product</li>
                <?php
                        }
                ?>

              </ol>
            </nav>
          </div>
          <!--End Page Breadcrumb-->

          <!-- Content Row -->

          <div class="row">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4" style="min-width: 95%;margin:0% 2%">
                <div class="card-header py-3 inline-block">
                    <?php
                            if(isset($_GET['edit-auction-product-id'])){
                    ?>
                            <h6 class="m-0 font-weight-bold text-primary"><i class="far fa-edit"></i> Edit Auction Product</h6>
                    <?php
                            }else{
                    ?>
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder-plus"></i> Add Auction Product</h6>
                    <?php
                            }
                    ?>
                </div>
                <div class="card-body">
              <form action="../database/seller/createProductProcess.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <?php 
                        if(isset($_GET['edit-auction-product-id'])){
                    ?>
                        <input type="hidden" name="editProductId" value="<?php echo $edit_auction_product_id;?>">
                    <?php
                        }
                    ?>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="col-md-3 nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-cogs pr-3"></i> General</a>
                                <a class="col-md-3 nav-item nav-link" id="nav-dueDate-tab" data-toggle="tab" href="#nav-dueDate" role="tab" aria-controls="nav-dueDate" aria-selected="false"><i class="far fa-calendar-alt pr-3"></i> Due Date</a>
                                <a class="col-md-3 nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-ruler pr-3"></i> Variation</a>
                                <a class="col-md-3 nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="far fa-images pr-3"></i> Media</a>
                            </div>
                        </nav>


                        <div class="tab-content mt-3" id="nav-tabContent" >
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" >
                                
                                <!-- Product Name -->
                                <div class="col-md-12 mt-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Product Name</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="auctionProductName" id="" class="form-control" placeholder="Product Name" value="<?php if(isset($_GET['edit-auction-product-id'])){ echo $edit_auction_product_name; }?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Name -->

                                <!-- Product Price -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Strating Price</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" name="auctionProductPrice" class="textfield form-control" value="<?php if(isset($_GET['edit-auction-product-id'])){ echo $edit_auction_product_price; }?>" id="extra7"  step=".01" max="99999" onkeypress="return isNumber(event)" placeholder="Product Price( RM )" required <?php if(isset($_GET['edit-auction-product-id'])){ ?> readonly<?php }?>/>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Price -->

                                <!-- Product Category -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Category</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="custom-select" name="auctionProductCategory" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
                                                <?php 
                                                    if(isset($_GET['edit-auction-product-id'])){
                                                ?>
                                                        <option selected value="<?php echo $edit_auction_product_category;?>"><?php echo $edit_auction_product_category_name;?></option>
                                                <?php
                                                    }else{
                                                ?>
                                                        <option selected disabled>-- Select The Product Category --</option>
                                                <?php
                                                    }
                                                ?>
                                                <option value="9">Baby & Toys</option>
                                                <option value="6">Computer & Accessories</option>
                                                <option value="14">Fashion Accessories</option>
                                                <option value="7">Groceries & Pets</option>
                                                <option value="16">Games,Bookss & Hobbies</option>
                                                <option value="3">Health & Beauty</option>
                                                <option value="13">Home & Living</option>
                                                <option value="15">Home Appliances</option>
                                                <option value="0">Men's Clothing</option>
                                                <option value="5">Men's Bags & Wallets</option>
                                                <option value="12">Mes's Shoes</option>
                                                <option value="2">Mobile & Gadgets</option>
                                                <option value="18">Others</option>
                                                <option value="8">Sports & Outdoor</option>
                                                <option value="17">Women's Bags</option>                                    
                                                <option value="4">Women's Clothing</option>
                                                <option value="10">Women's Shoes</option>
                                                <option value="11">Watches</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Category -->
                                

                                <!-- Product Color -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Color</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="custom-select" name="auctionProductColor" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
                                                <?php 
                                                    if(isset($_GET['edit-auction-product-id'])){
                                                ?>
                                                        <option selected value="<?php echo $edit_auction_product_color;?>"><?php echo $edit_auction_product_color;?></option>
                                                <?php
                                                    }else{
                                                ?>
                                                        <option selected disabled>-- Select The Product Color --</option>
                                                <?php
                                                    }
                                                ?>
                                                <option value="Brown">Brown</option>
                                                <option value="Blue">Blue</option>
                                                <option value="Black">Black</option>
                                                <option value="cyan">Cyan</option>
                                                <option value="DarkBlue">DarkBlue</option>
                                                <option value="gray">gray</option>
                                                <option value="green">green</option>
                                                <option value="LightBlue">LightBlue</option>
                                                <option value="orange">orange</option>
                                                <option value="Purple">Purple</option>
                                                <option value="red">red</option>
                                                <option value="yellow">yellow</option>
                                                <option value="white">White</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Color -->

                                <!-- Product gender -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Gender</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="custom-select" name="auctionProductGender" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
                                                <?php 
                                                    if(isset($_GET['edit-auction-product-id'])){
                                                ?>
                                                        <option selected value="<?php echo $edit_auction_product_gender;?>"><?php echo $edit_auction_product_gender;?></option>
                                                <?php
                                                    }else{
                                                ?>
                                                        <option selected disabled>-- Select The Gender --</option>
                                                <?php
                                                    }
                                                ?>
                                                <option value="none">none</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product gender -->

                                <!-- Product Stock -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Product Stock</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" name="auctionProductStock" value="1" min="1" max="1" onkeypress="return isNumber(event)" class="form-control" placeholder="Auction Product Default Stock 1" required readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Stock -->

                                <!-- Product Brnad -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Product Brand</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="auctionProductBrand" class="form-control" placeholder="Product Brand" value="<?php if(isset($_GET['edit-auction-product-id'])){ echo $edit_auction_product_brand; }?>">   
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Brand -->

                                <!-- Product Material -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Product Material</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="auctionProductMaterial"  class="form-control" placeholder="Product Material" value="<?php  if(isset($_GET['edit-auction-product-id'])){ echo $edit_auction_product_material;} ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Stock -->

                                <!-- Product Description -->
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Product Description</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="auctionProductDescription" id="mytextarea" rows="10" cols="80">
                                                <?php 
                                                    if(isset($_GET['edit-auction-product-id'])){ 
                                                        echo $edit_auction_product_description;
                                                    }else{
                                                ?>
                                                    This is my textarea to be replaced with HTML editor.
                                                <?php
                                                    }
                                                ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Description -->
                            </div>

                            <!-- Due Date Setting -->
                            <div class="tab-pane fade" id="nav-dueDate" role="tabpanel" aria-labelledby="nav-dueDate-tab">
                                <div class="col-md-12 mt-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="ProductAuctionDueDate">Auction Due Date:</label>
                                        </div>
                                        <div class="col-md-8">
                                                <?php 
                                                    if(isset($_GET['edit-auction-product-id'])){ 
                                                ?>
                                                        <input type="text" name="auctionProductDueDate" class="form-control" value="<?php echo date("Y-m-d h:i:s a", strtotime($edit_auction_product_auctionDueDate));?>" readonly/>
                                                <?php
                                                    }else{
                                                ?>
                                                        <input type="datetime-local" name="auctionProductDueDate" id="ProductAuctionDueDate" class="form-control" required>
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">Please fill out this field.</div>
                                                <?php
                                                    }
                                                ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End Due Date Setting -->

                            <!-- Variation Tab -->
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="table-responsive">
                                    <h5>Product Variation</h5>
                                    <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    Variation
                                                </th>
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(isset($_GET['edit-auction-product-id'])){ 
                                                    $getVariation = "SELECT * FROM variation WHERE productId = '$edit_auction_product_id'";
                                                    $resultgetVariation=$conn->query($getVariation);
                                                    
                                                    if($resultgetVariation->num_rows > 0){
                                                        $countEachRow = 1;
                                                        while($row = $resultgetVariation->fetch_assoc()){
                                                            $edit_auction_product_variation_Id = $row['variationId'];
                                                            $edit_auction_product_size = $row['variation'];      
                                                            $countEachRow++;            
                                            ?>
                                                <!-- if have variation  -->
                                                <tr id="<?php echo 'addr',$countEachRow?>" data-id="0" class="hidden">
                                                    <td data-name="name">
                                                        <input type="text" name='EditvalueOfSize' placeholder='Product Variation' class="form-control" value="<?php echo $edit_auction_product_size;?>" readonly/>
                                                    </td>
                                                    <td data-name="del">
                                                        <button type="button"  class='btn btn-danger glyphicon glyphicon-remove row-remove deleteVariationBtn submitBtn' data-editId="<?php echo $edit_auction_product_id;?>" value="<?php echo $edit_auction_product_variation_Id;?>" onclick="deleteVariation(this);"> 
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php
                                                        }//end while
                                                    }//end if
                                                }
                                            ?>
                                            
                                            <!-- default mode or add row to product -->
                                            <tr id="addr0" data-id="0" class="hidden">
                                                <td data-name="name">
                                                    <?php 
                                                        if(isset($_GET['edit-auction-product-id'])){
                                                    ?>
                                                        <input type="text" name='editOfSize[]' placeholder='Product Variation' class="form-control"/>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <input type="text" name='valueOfSize[]' placeholder='Product Variation' class="form-control" required/>
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">Please fill out this field.</div>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                </td>
                                                <td data-name="del">
                                                    <button type="button"  name="del[]" class='btn btn-danger glyphicon glyphicon-remove row-remove submitBtn'>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr id="beforethisAddTr">
                                                <td></td>
                                                <td>
                                                    <button type="button" id="add_row" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div><!---End table respionsivve--->
                            </div>
                            <!-- End Variation -->
                            
                            <!-- image input -->
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <?php
                                        if(isset($_GET['edit-auction-product-id'])){ 
                                            $count_Edit_Avaiable_Image = 5;
                                            $count_row = 0;
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Media</th>
                                                <th scope="col">Media Type</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">0</th>
                                                    <td>
                                                        <img src="../images/productImage/<?php echo $edit_auction_product_coverImage; ?>" width="100" height="100">
                                                    </td>
                                                    <td>
                                                        image
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#EditNewCoverImageModal">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                    <?php
                                        $edit_Get_Media_Statement = "SELECT * FROM productmedia WHERE productId = '$edit_auction_product_id'";
                                        $resultEdit_Get_Media_Statement = $conn->query($edit_Get_Media_Statement);
                                        if($resultEdit_Get_Media_Statement->num_rows > 0){ 
                                            while($row = $resultEdit_Get_Media_Statement->fetch_assoc()){
                                                $edit_auction_Product_File_id = $row['mediaId'];
                                                $edit_auction_Product_File_Type = $row['fileType'];
                                                $count_Edit_Avaiable_Image = $count_Edit_Avaiable_Image - 1;
                                                $count_row ++;
                                            
                                                if($edit_auction_Product_File_Type == "image"){
                                    ?>
                                                <tr>
                                                    <th scope="row"><?php echo $count_row; ?></th>
                                                    <td>
                                                        <img src="../images/productImage/<?php echo $row['filePath']; ?>" width="100" height="100">
                                                    </td>
                                                    <td>
                                                        <?php echo $row['fileType']; ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" value="<?php echo $edit_auction_Product_File_id;?>" data-multiMediaId="<?php echo $edit_auction_product_id;?>" onclick="deleteMultimedia(this)">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                    <?php  
                                                }else if($edit_auction_Product_File_Type == "video"){
                                    ?>
                                                <tr>
                                                    <th scope="row"><?php echo $count_row; ?></th>
                                                    <td>
                                                        <video src='../images/productImage/<?php echo $row['filePath']; ?>'  controls width='200 ' height='130'>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['fileType']; ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" value="<?php echo $edit_auction_Product_File_id;?>" data-multiMediaId="<?php echo $edit_auction_product_id;?>" onclick="deleteMultimedia(this)">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                    <?php
                                                }//end check media file type
                                            }//end  while
                                        }//end if
                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                        <?php
                                            if($count_Edit_Avaiable_Image != 0){
                                        ?>
                                            <input type="hidden" id="imageInputNum" value="<?php echo $count_Edit_Avaiable_Image;?>">
                                            <div class="col-md-12 mt-3">
                                                <h5>Update New Media<small class="text-danger pl-2"> (Up to <strong><?php echo $count_Edit_Avaiable_Image;?></strong> can be updated/ maximun 5)</small></h5>
                                                <div class="file-loading">
                                                    <input id="editNewImage" name="editNewImage[]" type="file" multiple data-browse-on-zone-click="true" data-theme="fas">
                                                </div>
                                            </div>
                                        <?php
                                            }else{

                                            }//if full 5 media 
                                        }else { //row 603
                                    ?>
                                        <!-- default create product input image -->
                                        <div class="col-md-12">
                                            <h5>Cover Images <small class="text-danger font-weight-bold">( * One only )</small></h5>
                                            <div class="file-loading">
                                                <input id="coverImage" name="coverImage" type="file" multiple data-browse-on-zone-click="true" data-theme="fas">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <h5>Choose Maximun 5 Media <small class="text-danger font-weight-bold">( * One-Time Selection )</small></h5>
                                            <div class="file-loading">
                                                <input id="input-44" name="input44[]" type="file" multiple data-browse-on-zone-click="true" data-theme="fas">
                                            </div>
                                        </div> 
                                    <?php
                                        }
                                    ?>   
                            </div>
                            <!-- End image input -->

                        </div>
                    
                </div>

                <!-- button -submit / cancel / update -->
                <div class="card-footer text-muted">
                    <div class="float-right">
                            <?php
                                    if(isset($_GET['edit-auction-product-id'])){
                            ?>
                                    <button class="btn btn-success" name="updateAuctionProduct" data-toggle="tooltip" data-placement="top" title="Update" type="submit">
                                        <i class="fas fa-upload"></i>
                                    </button>
                            <?php
                                    }else{
                            ?>
                                    <button class="btn btn-success" name="createAuctionProduct" data-toggle="tooltip" data-placement="top" title="save" type="submit">
                                        <i class="far fa-save"></i>
                                    </button>
                            <?php
                                    }
                            ?>
                                    <button class="btn btn-danger" id="cancelBtn" data-toggle="tooltip" data-placement="top" title="cancel" type="button">
                                        <i class="fas fa-reply"></i>
                                    </button>
                    </div>
                </div>
            </form>

              </div><!---End Card Body-->
          </div><!--End Card-->

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

  <!-- Update New Cover Image Modal - for edit product-->
  <form action="../database/seller/productAction.php" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="EditNewCoverImageModal" tabindex="-1" role="dialog" aria-labelledby="EditNewCoverImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditNewCoverImageModalLabel">Change New Cover Image</h5>
                <input type="hidden" name="updateProductId" value="<?php echo $edit_auction_product_id;?>">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="pl-3">SELECT <span class="text-weight-bold">1</span> IMAGE </h5>
                <div class="col-lg-12">
                    <div class="file-loading">
                        <input id="newCoverImage" name="newCoverImage" type="file" data-browse-on-zone-click="true" data-theme="fas">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" name="updateNewCoverImage">Submit</button>
            </div>
            </div>
        </div>
    </div>
 </form>

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

  <!-- Text Area Tiny -->
  <script src="https://cdn.tiny.cloud/1/khji0id4oppd31p9wcvlopr2g2w2kenw8p2nwuixstvo7vj0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <!-- image input -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../kartik-v-bootstrap-fileinput-6e58108/js/fileinput.js"></script>
  <script src="../kartik-v-bootstrap-fileinput-6e58108/themes/fas/theme.js" type="text/javascript"></script>
  
  <!-- Sweet Alert JS  -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>

    $(document).ready(function() {

        $("#newCoverImage").fileinput({
            showUpload: false,  
            showRemove: true,
            maxFileCount: 1, //10 file
            showUpload: false,
            allowedFileExtensions: ["jpg", "gif", "png","jpeg"],
            maxFilePreviewSize: 10240
        });

        $("#coverImage").fileinput({
            showUpload: false,  
            showRemove: true,
            maxFileCount: 1, //10 file
            showUpload: false,
            allowedFileExtensions: ["jpg", "gif", "png","jpeg"],
            maxFilePreviewSize: 10240
        });

        $("#input-44").fileinput({
            showUpload: false,  
            showRemove: true,
            maxFileCount: 5, //10 file
            showUpload: false,
            allowedFileExtensions: ["jpg", "gif", "png","jpeg","mp4","mp3","avi","3gp","mov","mpeg","wma"],
            maxFilePreviewSize: 10240
        });
        // $('#input-44').fileinput('disable');

        $("#editNewImage").fileinput({
            showUpload: false,  
            showRemove: true,
            maxFileCount: $('#imageInputNum').val(), //10 file
            showUpload: false,
            allowedFileExtensions: ["jpg", "gif", "png","jpeg","mp4","mp3","avi","3gp","mov","mpeg","wma"],
            maxFilePreviewSize: 10240
        });
    });

    //text area
    tinymce.init({
      selector: '#mytextarea'
    });

    //for lastest order tooltip
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();     
    });

    //cancel button
    $('#cancelBtn').click(function(){
        window.history.back();
    });

    //validation product price
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    //delete variation
    function deleteVariation(removeId){
        const href = "../database/seller/productAction.php?deleteVariationId=" ;
        const href2 = "&editProduct=" ;
        
        var id = $(removeId).val();//this delete variation id
        var editProductid = $(removeId).attr("data-editId");//product id
        
        // console.log(id);
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
                document.location.href = href + id + href2 +editProductid;
              }//end file
            })
    }

    //delete variation
    function deleteMultimedia(mutlimediaId){
        const href = "../database/seller/productAction.php?deleteMultiMediaId=" ;
        const href2 = "&editProduct=" ;
        
        var id = $(mutlimediaId).val();
        var editProductid = $(mutlimediaId).attr("data-multiMediaId");

        // console.log(id);
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
                document.location.href = href + id + href2 +editProductid;
              }//end file
            })
    }

    //Product Variation Add & Delete Row
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            // Dynamic Rows Code
            
            // Get max row id and set new id
            var newid = 0;
            $.each($("#tab_logic tr"), function() {
                //data-id > 0
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;
            
            //new tr's id
            var tr = $("<tr></tr>", {
                id: "addr"+newid,
                "data-id": newid
            });
            
            // loop through each td and create new elements with name of newid
            $.each($("#tab_logic tbody #addr0 td"), function() {
                var td;
                var cur_td = $(this);//current td
                
                var children = cur_td.children();
                
                // add new td and element if it has a nane
                if ($(this).data("name") !== undefined) {
                    td = $("<td></td>", {
                        "data-name": $(cur_td).data("name")
                    });
                    
                    var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                    c.attr("valueOfSize[]"); //name1...
                    c.appendTo($(td));
                    td.appendTo($(tr));
                } else {
                    td = $("<td></td>", {
                        'text': $('#tab_logic tr').length
                    }).appendTo($(tr));
                }
            });
            
            // $('#addr0').after($(tr));
            $( "#beforethisAddTr" ).before( $(tr) );

            $(tr).find("td button.row-remove").on("click", function() {
                $(this).closest("tr").remove();
            });
        });

        // Sortable Code
        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
        
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            
            return $helper;
        };
    
        $(".table-sortable tbody").sortable({
            helper: fixHelperModified      
        }).disableSelection();

        $(".table-sortable thead").disableSelection();

        $("#add_row").trigger("click");
    });


    // Disable form submissions if there are invalid fields -- form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    var flashdata = $('.flash-data').data('flashdata');
    if(flashdata == "created-product-failed-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Create New Product Failed',
            text: 'Please Retry Insert Later!'
        })
    }else if(flashdata == "created-auction-product-failed-unlogin-loginFirst-notic-01"){
        Swal.fire({
            icon: 'warning',
            title: 'Unlogin',
            text: 'Please Login First!',
            footer: '<a href="login.php">Go Login First</a>'
        })
    }else if(flashdata == "created-product-stock-failed-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Stock Error',
            text: 'Please Retry Insert Later!'
        })
    }else if(flashdata == "created-product-variaiton-empty-notic-01"){
        Swal.fire({
            icon: 'warning',
            title: 'Variation Empty',
            text: 'Please Insert At Least One Variation!'
        })
    }else if(flashdata == "created-product-image-media-type-invalid-notic-01"){
        Swal.fire({
            icon: 'warning',
            title: 'Image Invalid File Type',
            text: 'Please Insert Correct File Type!'
        })
    }else if(flashdata == "created-product-variaiton-empty-notic-01"){
        Swal.fire({
            icon: 'warning',
            title: 'Variation Empty',
            text: 'Please Insert At Least One Variation!'
        })
    }else if(flashdata == "created-product-image-media-type-invalid-notic-01"){
        Swal.fire({
            icon: 'warning',
            title: 'Image Invalid File Type',
            text: 'Please Insert Correct File Type!'
        })
    }else if(flashdata == "delete-product-success-notic-01"){
        Swal.fire(
            'Delete Success!',
            'This Item has been successfully deleted!',
            'success'
        )
    }else if(flashdata == "delete-product-failed-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Delete Item Failed',
            text: 'Please Try Again!'
        })
    }else if(flashdata == "update-product-success-notic-01"){
        Swal.fire(
            'Update Success!',
            'This Item has been successfully updated!',
            'success'
        )
    }else if(flashdata == "update-product-failed-notic-01"){
        Swal.fire({
            icon: 'error',
            title: 'Updated Product Failed',
            text: 'Please Try Again!'
        })
    }

  </script>
</body>

</html>
