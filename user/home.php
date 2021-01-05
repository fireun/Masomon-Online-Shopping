<?php
include("../config.php");
session_start();

if(isset($_POST['logout'])){
    // session_destroy();
    if($_SESSION['userId']){
        $userId = $_SESSION['userId'];
        echo $udpatelastloginTime = "UPDATE user SET lastLogin = '$date' WHERE userId = '$userId'";
        $resultUpdateLastLogin = $conn->query($udpatelastloginTime);
  
        if($resultUpdateLastLogin == true){
            unset($_SESSION['userId']);
            unset($_SESSION['username']);
            echo "<script>alert('logout success !!!');
            window.location.href= '../user/home.php';</script>"; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> -->

    <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css"> -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script><!--carousel slide-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!------ Include the above in your HEAD tag  (header) ---------->
    

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!--slide-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag  (footer) ---------->
    
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script><!--slide js-->
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/homestyle.css">
</head>
<body style="background:#f2f2f2">
   <!-- header -->
  <!-- <div class="header-box">
    <div id="flipkart-navbar">
            <div class="container">
                top row higher
                <div class="row row1">
                    <ul class="largenav pull-right">
                        <li class="upper-links"><a class="links" href="http://clashhacks.in/">Link 1</a></li>
                        <li class="upper-links"><a class="links" href="https://campusbox.org/">Link 2</a></li>
                        <li class="upper-links"><a class="links" href="http://clashhacks.in/">Link 3</a></li>
                        <li class="upper-links"><a class="links" href="http://clashhacks.in/">Link 4</a></li>
                        <li class="upper-links"><a class="links" href="http://clashhacks.in/">Link 5</a></li>
                        <li class="upper-links"><a class="links" href="http://clashhacks.in/">Link 6</a></li>
                        <li class="upper-links">
                            <a class="links" href="http://clashhacks.in/">
                                <svg class="" width="16px" height="12px" style="overflow: visible;">
                                    <path d="M8.037 17.546c1.487 0 2.417-.93 2.417-2.417H5.62c0 1.486.93 2.415 2.417 2.415m5.315-6.463v-2.97h-.005c-.044-3.266-1.67-5.46-4.337-5.98v-.81C9.01.622 8.436.05 7.735.05 7.033.05 6.46.624 6.46 1.325v.808c-2.667.52-4.294 2.716-4.338 5.98h-.005v2.972l-1.843 1.42v1.376h14.92v-1.375l-1.842-1.42z" fill="#fff"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="upper-links dropdown"><a class="links" href="http://clashhacks.in/">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li class="profile-li"><a class="profile-links" href="http://yazilife.com/">Link</a></li>
                                <li class="profile-li"><a class="profile-links" href="http://hacksociety.tech/">Link</a></li>
                                <li class="profile-li"><a class="profile-links" href="http://clashhacks.in/">Link</a></li>
                                <li class="profile-li"><a class="profile-links" href="http://clashhacks.in/">Link</a></li>
                                <li class="profile-li"><a class="profile-links" href="http://clashhacks.in/">Link</a></li>
                                <li class="profile-li"><a class="profile-links" href="http://clashhacks.in/">Link</a></li>
                                <li class="profile-li"><a class="profile-links" href="http://clashhacks.in/">Link</a></li>
                            </ul>
                        </li>
                        <li class="upper-links">
                            <div>
                                <div class="account-info" id="showAccountBox">
                                    <img src="../images/man1.jpeg" alt="" class="account-images">
                                    <span>username</span>
                                </div>       
                                <div class="account-show-box" id="showAccountDetailBox">
                                    <div class="account-box">
                                        <div class="account-arrow"></div>
                                        <ul>
                                            <li class="account-detail">
                                                <a href="#" class="account-link">
                                                    <span><i class="fas fa-user"></i>
                                                    Profile</span>
                                                </a>   
                                            </li>                                                              
                                            <li class="account-detail">
                                                <a href="#" class="account-link">
                                                    <span><i class="fa fas fa-door-open"></i>
                                                        Logout</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                median row
                <div class="row row2">
                    title
                    <div class="col-sm-2 header-content-box">
                        <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Masamon</span></h2>
                        <h1 style="margin:0px;"><span class="logobox largenav">
                            <img src="../images/user.png" alt="" width=100% height=100%>
                        </span></h1>  默认情况下 web的样子
                    </div>
                    search
                    <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
                        <div class="row">
                            <input class="flipkart-navbar-input col-xs-11" type="" placeholder="Search for Products, Brands and more" name="">
                            <button class="flipkart-navbar-button col-xs-1">
                                <svg width="15px" height="15px">
                                    <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    shopping cart icon
                    <div class="cart largenav col-sm-2" id="shoppingbag">
                        <a class="cart-button">
                            <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 ">
                                <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path> cart的形状
                            </svg> Link
                            <span class="item-number ">0</span>
                        </a>
                        <div class="shopping-bag-detail" id="shoppingbagdetail">
                            <div class="demo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        手机模式的左边slider
    <div id="mySidenav" class="sidenav">
        <div class="container" style="background-color: #2874f0; padding-top: 10px;">
            <span class="sidenav-heading">Home</span>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        </div>
        <a href="http://clashhacks.in/">Link</a>
        <a href="http://clashhacks.in/">Link</a>
        <a href="http://clashhacks.in/">Link</a>
        <a href="http://clashhacks.in/">Link</a>
    </div>

  </div> End header -->
  <?php require '../user/header.php' ?>

   <!-- 内容 -->
   <div class="content home-page-content">
        <div class="content-box">
            <div class="slide-ad-box">
            <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../images/p1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../images/p2.jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" style="width: 100%">
            <img src="../images/p3.jpeg" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>-->

                <!-- <div class="carousel-slide-home">
                        <img src="../images/p2.jpeg" id="lastClass" alt="">
                        <img src="../images/p1.jpg" alt="">
                        <img src="../images/p2.jpeg" alt="">
                        <img src="../images/p3.jpeg" alt="">
                        <img src="../images/p1.jpg" alt="">
                        <img src="../images/p2.jpeg" alt="">
                        <img src="../images/p1.jpg" id="firstClass" alt="">
                </div>
            </div>    
                <button id="prevBtn">Prev</button>
                <button id="nextBtn">Next</button> -->

                 <div id="carouselExampleCaptions" class="carousel slide"  data-ride="carousel">
                      <!-- under line point  -->
                    <ol class="carousel-indicators ad-line-place">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="../images/carousel1.webp" class="d-block wh-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="../images/carousel2.webp" class="d-block wh-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="../images/carousel.jpg" class="d-block wh-100" alt="...">
                        </div>
                    </div>
                     <!-- arrow  -->
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon text-dark" data-toggle="tooltip" title="Previous" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon text-dark" data-toggle="tooltip" title="Next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div> 
          </div><!-- End carousel -->


            <div class="category-box">
                <div class="category-header-text">
                    <div class="category-text">CATEGORIES</div>
                </div>
                <div class="category-content-box">
                    <div class="category-row">
                        <ul style="display:inline-flex">
                            <li class="category-image-list">
                                <div class="category-list-group">
                                    <a href="../user/searchProduct.php?categoryid=4" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/wc.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Women's Clothing</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=5" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/mb.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Men's Bags & Wallets</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                         <a href="../user/searchProduct.php?categoryid=0" class="category-link">
                                            <div>
                                                <div class="category-pic"><img src="../images/categories/mc.png" alt="" class="category-pic-images" width=100 height=100></div>
                                                <div class="category-type"><h3>Men's Clothing</h3></div>
                                            </div>
                                        </a>
                                        <a href="../user/searchProduct.php?categoryid=6" class="category-link">
                                            <div>
                                                <div class="category-pic"><img src="../images/categories/cs.png" alt="" class="category-pic-images" width=100 height=100></div>
                                                <div class="category-type"><h3>Computer & Accessories</h3></div>
                                            </div>
                                        </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                <a href="../user/searchProduct.php?categoryid=3" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/hb.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Health&Beauty</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=7" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/gp.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Groceries & Pets</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                <a href="../user/searchProduct.php?categoryid=2" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/mg.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Mobile & Gadgets</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=8" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/s.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Sports & Outdoor</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                <a href="../user/searchProduct.php?categoryid=9" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/bt.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Baby & Toys</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=10" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/ws.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Women's Shoes</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                    <a href="../user/searchProduct.php?categoryid=11" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/w.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Watches</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=12" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/ms.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Men's Shoes</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                <a href="../user/searchProduct.php?categoryid=13" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/hl.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Home & Living</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=14" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/fa.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Fashion Accessories</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                <a href="../user/searchProduct.php?categoryid=15" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/ha.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Home Appliances</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=16" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/g.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Games, Bookss & Hobbies</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="category-image-list">
                                <div class="category-list-group">
                                <a href="../user/searchProduct.php?categoryid=17" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/wb.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Women's Bags</h3></div>
                                        </div>
                                    </a>
                                    <a href="../user/searchProduct.php?categoryid=18" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/categories/o.png" alt="" class="category-pic-images" width=100 height=100></div>
                                            <div class="category-type"><h3>Others</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <!-- <li class="category-image-list">
                                <div class="category-list-group">
                                <a href="#" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/css.png" alt="" width=100 height=100></div>
                                            <div class="category-type"><h3>Women's Clothing</h3></div>
                                        </div>
                                    </a>
                                    <a href="#" class="category-link">
                                        <div>
                                            <div class="category-pic"><img src="../images/css.png" alt="" width=100 height=100></div>
                                            <div class="category-type"><h3>Men's Clothing</h3></div>
                                        </div>
                                    </a>
                                </div>
                            </li> -->
                        </ul>
                    </div>                 
                </div>
            </div>

            <div class="auction-box">
                <div class="auction-text">
                    <h2 class="auction-text-h2">Auction Product</h2>
                    <!-- <div class="count-times-box">
                        <div class="times-number-box"><span id="demo"></span></div>
                        <span class="countdown-text">days</span>
                        
                        <div class="times-number-box"><span id="demo1"></span></div>
                        <span class="countdown-text">hours</span>
                        
                        <div class="times-number-box"><span id="demo2"></span></div>
                        <span class="countdown-text">minutes</span>
                        
                        <div class="times-number-box"><span id="demo3"></span></div>
                        <span class="countdown-text">seconds</span>
                    </div> -->
                    <!-- <a href="../user/auctionProduct.php" style="line-height:60px;color:black">View More</a> -->
                </div>
                <div class="auction-product">
                    <div class="container">
                        <div class="row">
                            <div class="row">
                                <!-- <div class="col-md-9">
                                    <h3>
                                        Carousel Product Cart Slider</h3>
                                </div> -->
                                <div class="col-md-3">
                                    <!-- Controls -->
                                    <div class="controls pull-right hidden-xs">
                                        <a class="left fa fa-chevron-left btn btn-danger col-auction-prev-btn" href="#carousel-example" data-slide="prev"><span>&#10094;</span></a>
                                        <a class="right fa fa-chevron-right btn btn-danger col-auction-next-btn" href="#carousel-example" data-slide="next"><span>&#10095;</span></a>
                                    </div>
                                </div>
                            </div>
                            <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">

                                    <div class="item active">
                                        <div class="row mobile-auction-row-size">

                                        <?php
                                            $getAuctionProduct = "
                                            SELECT * FROM `product` WHERE auctionStatus = 'yes' AND status = '' AND auctionEnd = '' ORDER BY created_time DESC LIMIT 0,4";
                                            $resultgetgetAuctionProduct=$conn->query($getAuctionProduct);

                                            if($resultgetgetAuctionProduct->num_rows>0){
                                                while($row = $resultgetgetAuctionProduct->fetch_assoc()){
                                                $ProductId = $row['id'];
                                                $AuctionProductId = $row['auctionId'];
                                                $AuctionProductName = $row['name'];
                                                $AuctionProductPrice=$row['price'];  
                                                // $goodsDescription = $row['description'];
                                                $AuctionProductImage=$row['coverImage'];  
                                                // $goodsColor = $row['color'];
                                                // $goodsBrand=$row['brand'];  
                                                // $goodsMaterial = $row['material'];
                                                // $goodsGender=$row['gender'];  
                                                // $goodsSoldRecord = $row['soldRecord'];
                                                // $goodsCategoryId = $row['categoryId'];
                                                // $goodsAuctionStatus = $row['auctionStatus'];
                                                $AuctionProductDueDate = $row['auctionDueDate'];
                                                // $goodsImagesId = $row['imagesId'];
                                                // id
                                                // $goodsInventoryId=$row['InventoryId'];  
                                                // $goodstCategoryId = $row['categoryId'];
                                                // $goodsImageId = $row['imagesId'];

                                                // echo $AuctionProductDueDateNew = strtotime($row['auctionDueDate']);
                                                // echo $Hformat = date(" h:i:s a ",$AuctionProductDueDateNew);


                                                //calculate due date
                                                // $CurrentDate = date("Y-m-d h:i:s");
                                                // echo strtotime($AuctionProductDueDate) +  "</br>";
                                                // echo time() + "</br>";
                                                // echo $CurrentDate;

                                                $changCurrentDate = strtotime($AuctionProductDueDate);
                                                $CurrentDate = date("Y-m-d h:i:s a",$changCurrentDate);

                                            //     echo "duedate: $changeDueDate, today: $changCurrentDate",'<br>';

                                            //    echo  $countTime = $changeDueDate - time();
                                            //     $days = floor($countTime / 1000 * 60 * 60 * 24);
                                            //     $hours = floor(($countTime % ( 1000 * 60 * 60 * 24)) / ( 1000 * 60 * 60));
                                            //     $minutes = floor(($countTime % (1000 *60 * 60)) / (1000 *60));
                                            //     $seconds = floor(($countTime % (1000 * 60)) / 1000 );

                                            //     echo "days : $days, hours: $hours, minutes : $minutes, seconds: $seconds" ;
                                            if( strlen( $AuctionProductName ) > 25 ) {
                                                $AuctionProductName = substr( $AuctionProductName, 0, 25 ) . '...';
                                            }

                                        ?>
                                    
                                            <div class="col-sm-3 mobile-mode-auction">
                                                <!-- <div class="view-count-down">
                                                    <h4 class="auction-duedate-text">Due Date</h4>
                                                    <input type="hidden" name="duedate[]" class="duedate" id="endtimeID" value="<?php echo $AuctionProductDueDate;?>">
                                                    <div class="counttimes-box"><span id="DaysId" class="auction-set-D"></span></div>                                                    
                                                    <div class="counttimes-box"><span id="HoursId" class="auction-set-H"></span></div>                                                    
                                                    <div class="counttimes-box"><span id="MinutesId" class="auction-set-M"></span></div>                                                    
                                                    <div class="counttimes-box"><span id="SecondsId" class="auction-set-S"></span></div>
                                                </div> -->

                                                <div class="col-item">
                                                    <div class="photo" style="height: 192px;">
                                                        <img src="../images/productImage/<?php echo $AuctionProductImage;?>" class="img-responsive" width=100% height=100% alt="a"/>
                                                    </div>
                                                    <input type="hidden" id="duedatecal" value="<?php echo $AuctionProductDueDate;?>">
                                                    <div class="info">
                                                        <div class="row">
                                                            <div class="price col-md-6">
                                                                <h5>
                                                                    <?php echo $AuctionProductName;?></h5>
                                                                <h5 class="price-text-color">
                                                                   <?php echo $AuctionProductPrice;?></h5>
                                                            </div>
                                                            <div class="rating hidden-sm col-md-6">
                                                                <h5>Due Date: </h5>
                                                                <h5><?php echo $CurrentDate;?></h5>
                                                                <!-- <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                                                </i><i class="fa fa-star"></i> -->
                                                            </div>
                                                        </div>
                                                        <div class="separator clear-left">
                                                            <p class="btn-add">
                                                                <i class="fa fa-shopping-cart"></i><a href="../user/auctionProductDetail.php?auctionId=<?php echo $ProductId ?>" class="hidden-sm mobile-auction-text">Join Auction</a></p>
                                                            <p class="btn-details">
                                                                <i class="fa fa-list"></i><a href="../user/auctionProductDetail.php?auctionId=<?php echo $ProductId ?>" class="hidden-sm mobile-auction-text">More details</a></p>
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                            }
                                            }
                                        ?>
                                        
                                        </div> <!--End row-->                                
                                    </div><!--End item-->

                                    <div class="item">                    
                                        <div class="row mobile-auction-row-size">
                                        <?php
                                            $getAuctionProduct1 = "
                                            SELECT * FROM `product` WHERE auctionStatus = 'yes' AND status = '' AND auctionEnd = '' ORDER BY created_time DESC LIMIT 4,8";
                                            $resultgetAuctionProduct1=$conn->query($getAuctionProduct1);

                                            if($resultgetAuctionProduct1->num_rows>0){
                                                while($row = $resultgetAuctionProduct1->fetch_assoc()){
                                                $AuctionProduct_id = $row['id'];
                                                $AuctionProductId1 = $row['auctionId'];
                                                $AuctionProductName1 = $row['name'];
                                                $AuctionProductPrice1=$row['price'];  
                                                // $goodsDescription = $row['description'];
                                                $AuctionProductImage1=$row['coverImage'];  
                                                // $goodsColor = $row['color'];
                                                // $goodsBrand=$row['brand'];  
                                                // $goodsMaterial = $row['material'];
                                                // $goodsGender=$row['gender'];  
                                                // $goodsSoldRecord = $row['soldRecord'];
                                                // $goodsCategoryId = $row['categoryId'];
                                                // $goodsAuctionStatus = $row['auctionStatus'];
                                                $AuctionProductDueDate1 = $row['auctionDueDate'];
                                                // $goodsImagesId = $row['imagesId'];
                                                // id
                                                // $goodsInventoryId=$row['InventoryId'];  
                                                // $goodstCategoryId = $row['categoryId'];
                                                // $goodsImageId = $row['imagesId'];
                                                if( strlen( $AuctionProductName1 ) > 25 ) {
                                                    $AuctionProductName1 = substr( $AuctionProductName1, 0, 25 ) . '...';
                                                }
                                               
                                        ?>
                                    
                                            <div class="col-sm-3 mobile-mode-auction">
                                                <!-- <div class="view-count-down">
                                                    <h4 class="auction-duedate-text">Due Date</h4>
                                                    <div class="counttimes-box"><span id="auction"></span></div>                                                    
                                                    <div class="counttimes-box"><span id="auction1"></span></div>                                                    
                                                    <div class="counttimes-box"><span id="auction2"></span></div>                                                    
                                                    <div class="counttimes-box"><span id="auction3"></span></div>
                                                </div> -->

                                                <div class="col-item">
                                                    <div class="photo" style="height: 192px;">
                                                        <img src="../images/productImage/<?php echo $AuctionProductImage1;?>" class="img-responsive" width=100% height=100% alt="a"/>
                                                    </div>
                                                    <input type="hidden" id="duedatecal" value="<?php echo $AuctionProductDueDate1;?>">
                                                    <div class="info">
                                                        <div class="row">
                                                            <div class="price col-md-6">
                                                                <h5>
                                                                    <?php echo $AuctionProductName1;?></h5>
                                                                <h5 class="price-text-color">
                                                                   <?php echo $AuctionProductPrice1;?></h5>
                                                            </div>
                                                            <div class="rating hidden-sm col-md-6">
                                                                <h5>Due Date: </h5>
                                                                <h5><?php echo $AuctionProductDueDate1;?></h5>
                                                                <!-- <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                                                </i><i class="fa fa-star"></i> -->
                                                            </div>
                                                        </div>
                                                        <div class="separator clear-left">
                                                            <p class="btn-add">
                                                                <i class="fa fa-shopping-cart"></i><a href="../user/auctionProductDetail.php?auctionId=<?php echo $AuctionProduct_id ?>" class="hidden-sm mobile-auction-text">Join Auction</a></p>
                                                            <p class="btn-details">
                                                                <i class="fa fa-list"></i><a href="../user/auctionProductDetail.php?auctionId=<?php echo $AuctionProduct_id ?>" class="hidden-sm mobile-auction-text">More details</a></p>
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                            }
                                            }
                                        ?>
        

                                        </div> <!--End row-->
                                    </div><!--End item-->
                                </div> <!--End carousel-->
                            </div><!--End wrapper carousel-->
                        </div><!--End row-->
                    </div><!--End container-->
                </div> <!--End auction product-->
            </div><!--End auction box-->




            <div class="recommed-box">
                <div class="recommed-text">
                    <h2 class="recommend-title">Recommend For You</h2>
                </div>

                <div class="recommend-product-box">
                <?php
                    $getAuctionProduct = "SELECT * FROM product WHERE auctionStatus = 'no' AND status= '' ORDER BY created_time DESC LIMIT 0,20";
                    $resultgetgetAuctionProduct=$conn->query($getAuctionProduct);

                    if($resultgetgetAuctionProduct->num_rows>0){
                        while($row = $resultgetgetAuctionProduct->fetch_assoc()){
                            $goodsId=$row['id'];
                            $goodsName = $row['name'];
                            $goodsPrice=$row['price'];  
                            $goodsDescription = $row['description'];
                            $goodsCoverImage=$row['coverImage'];  
                            $goodsColor = $row['color'];
                            $goodsBrand=$row['brand'];  
                            $goodsMaterial = $row['material'];
                            $goodsGender=$row['gender'];  
                            $goodsSoldRecord = $row['soldRecord'];
                            $goodsCategoryId = $row['categoryId'];
                            $goodsAuctionStatus = $row['auctionStatus'];
                            $goodsAuctionId = $row['auctionId'];
                            $goodsAuctionDueDate = $row['auctionDueDate'];
                            $goodsImagesId = $row['imagesId'];

                            if( strlen( $goodsName ) > 30 ) {
                                $goodsName = substr( $goodsName, 0, 30 ) . '...';
                            }
                                               
                ?>

                    <div class="product-cart shadow p-3 mb-5 bg-white rounded"   onclick="location.href='../user/productDetail.php?productId=<?php echo $goodsId; ?>'">
                        <div class="product-cart-images">
                            <img src="../images/productImage/<?php echo $goodsCoverImage;?>" alt="" width="100%" height="100%">
                        </div>
                        <div class="product-cart-info">
                            <div class="product-text-box">
                               <h5 class="product-cart-name"><?php echo $goodsName; ?></h5>
                                <h5 class="product-cart-price">RM <?php echo $goodsPrice; ?></h5> 
                            </div>                            
                            <button trpe="submit" class="view-product-btn">View Detail</button>
                        </div>
                    </div>

                <?php
                        }
                    }
                ?>



                </div>               
            </div>
        </div>
   </div>


   <!-- scroll back to top -->
   <button data-toggle="tooltip" class="back-top-btn" id="backToTop" title="Go to top">Top</button>

    <!-- adveiting modal box -->
    <div class="ad-modal-box" id="myModal">
        <div class="ad-modal-content">
            <span class="ad-modal-close">&times;</span>
            <!-- <a href="../seller/sellerhome.php">
                <img src="../images/css.png" alt="" width="100" height="100">
            </a> -->
        </div>        
    </div>

   <!-- footer -->
   <footer>
      <div class="footer" style="margin-top:110%">
        <section id="footer">
		<div class="container d-flex justify-content-center">
			<div class="row "style="margin-left: 30%">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<ul class="list-unstyled quick-links row ">
                        <li><a href="home.php"><i class="fa fa-angle-double-right col"></i>Home</a></li>
						<li><a href="#"><i class="fa fa-angle-double-right col"></i>About Us</a></li>
						<li><a href="#"><i class="fa fa-angle-double-right col"></i>FAQ</a></li>
						<li><a href="#"><i class="fa fa-angle-double-right col"></i>Contact Us</a></li>
						<li><a href="#"><i class="fa fa-angle-double-right col"></i>Manual</a></li>
					</ul>
				</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p>©All Copyright by Masomon Online Shopping - Final Year Project develop by <u>WX</u><sup>2</sup> </p>
				</div>
				<hr>
			</div>	
		</div>
	</section>    
   </div>
   </footer><!--  End footer  --> 
   
    

    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/homescript.js"></script>
    <!-- <script src="../js/searchAjax.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    <!-- scroll back to top --> 
    <script>
    // back top button
    $("#backToTop").click(function() {
        $("html, body").animate({scrollTop: 0}, 1000);
    });

    $(document).ready(function(){

        // $('#searchProductBtn').click(function(){
        //     var keyword = $('#inputKeyword').val();
        //     // var getInput = prompt(keyword);
        //     localStorage.setItem("temporayKeyword",keyword);
        //     window.location.href = "../user/searchProduct.php";
        // });

        $('#inputKeyword').change(function(){
            var keyword = $('#inputKeyword').val(); 
            window.location.href = "../user/searchProduct.php?query="+keyword;
        });

        $('#searchProductBtn').click(function(){
            var keyword = $('#inputKeyword').val();
            window.location.href = "../user/searchProduct.php?query="+keyword;
        });

    });
    </script>
    <!-- <script src="../js/userDateCal.js"></script> -->
</html>
