
<!-- header -->
   <div class="header-box">
    <div id="flipkart-navbar">
            <div class="container">
                <!-- top row higher -->
                <div class="row row1">
                    <ul class="largenav pull-right">
                        <li class="upper-links"><a class="links" href="../user/searchProduct.php?query=Laptop">Laptop</a></li>
                        <!-- <li class="upper-links"><a class="links" href="https://campusbox.org/">Bluetooth Earphone</a></li> -->
                        <li class="upper-links"><a class="links" href="../user/searchProduct.php?query=Speaker">Speaker</a></li>
                        <li class="upper-links"><a class="links" href="../user/searchProduct.php?query=Face Mask">Face Mask</a></li>
                        <li class="upper-links"><a class="links" href="../user/searchProduct.php?query=Smartphone">Smartphone</a></li>
                        <li class="upper-links"><a class="links" href="../user/auctionProduct.php">More Auction</a></li>
                        <li class="upper-links">
                            <a class="links" href="#">
                                <svg class="" width="16px" height="12px" style="overflow: visible;" title="notification">
                                    <path d="M8.037 17.546c1.487 0 2.417-.93 2.417-2.417H5.62c0 1.486.93 2.415 2.417 2.415m5.315-6.463v-2.97h-.005c-.044-3.266-1.67-5.46-4.337-5.98v-.81C9.01.622 8.436.05 7.735.05 7.033.05 6.46.624 6.46 1.325v.808c-2.667.52-4.294 2.716-4.338 5.98h-.005v2.972l-1.843 1.42v1.376h14.92v-1.375l-1.842-1.42z" fill="#fff"></path>
                                </svg>
                            </a>
                        </li>

                        <li class="upper-links">
                            <!-- <div> -->
                                <div class="account-info" id="showAccountBox">
                                    <?php
                                    
                                    if(isset($_SESSION['username'])){
                                        $user = $_SESSION['username'];
                                        $GetImage = "select image from user where userName ='$user'";
                                        $resultgetImage=$conn->query($GetImage);
    
                                        if($resultgetImage->num_rows>0){
                                            while($row = $resultgetImage->fetch_assoc()){
                                                $userImage = $row['image'];

                                                if(empty($userImage)){
                                                    $userImage = "userIcon.png";
                                                }

                                    ?>
                                        <img src="../images/profileImage/<?php echo $userImage;?>" alt="" class="account-images">
                                        <span><?php echo $user ;?></span>
                                    <?php
                                                }
                                            }
                                        }else{ ?>                              
                                    <img src="../images/userIcon.png" alt="" class="account-images">
                                    <span>unlogin</span>
                                   <?php
                                   }
                                   ?>

                                </div>       
                                <div class="account-show-box" id="showAccountDetailBox">
                                    <div class="account-box">
                                        <div class="account-arrow"></div>
                                        <ul>

                                            
                                            <?php if(isset($_SESSION['username'])){ ?>
                                                <li class="account-detail">
                                                    <a href="../user/profile.php" class="account-link">
                                                        <span>My Account</span>
                                                    </a>
                                                </li>  
                                                <li class="account-detail">
                                                    <a href="../user/purchasePage.php" class="account-link">
                                                        <span>My Purchase</span>
                                                    </a>
                                                </li>                                                             
                                                <li class="account-detail">
                                                    <form action="../user/home.php" method="post">
                                                        <button type="submit" name="logout" class="account-link account-link-logout">
                                                             <span>Logout</span>                                                      
                                                        </button>
                                                    </form>    
                                                </li>

                                            <?php
                                            }else{ ?>
                                                <li class="account-detail">                                                
                                                <a href="../user/login.php" class="account-link">
                                                    <span>Login</span></a>
                                            </li>
                                            <?php
                                            }
                                            ?>                                              
                                            
                                        </ul>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </li>
                    </ul>
                </div>

                <!-- median row -->
                <div class="row row2">
                    <!-- title -->
                    <div class="col-sm-2 header-content-box">
                        <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Masamon</span></h2>
                        <a href="../user/home.php" style="text-decoration:none;color:black">
                        <h1 style="margin:0px;"><span class="logobox largenav">
                            <img src="../images/user.png"  title="home page" alt="masomon logo" width=100% height=100%>
                        </span></h1>  <!--默认情况下 web的样子 -->
                        </a>
                    </div>

                    <!-- search -->
                    <form id="nav-search">
                        <div class="flipkart-navbar-search smallsearch col-sm-7 col-xs-11">
                            <div class="row mobile-mode-search-bar">
                                <input class="flipkart-navbar-input col-xs-11" type="text" placeholder="Search for Products, Brands and more" name="query" id="inputKeyword">
                                <button type="button" id="searchProductBtn" class="flipkart-navbar-button col-xs-1" name="search">
                                    <svg width="15px" height="15px">
                                        <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                                    </svg>
                                </button>
                            </div>
                    
                    
                    <!-- shopping cart icon -->
                    <div class="cart largenav col-sm-2" id="shoppingbag">
                        <a class="cart-button" href="../user/cart.php">
                            <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 ">
                                <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path> <!-- cart的形状 -->
                            </svg> Cart
                            <?php
                            if(isset($_SESSION['username'])){
                                date_default_timezone_set("Asia/Kuala_Lumpur");
                                $created_date =  date("Y-m-d H:i:s");
                                $userId = $_SESSION['userId'];
                                $countSql = "select count(cartIntegrationId) as countTotal from cartIntegration where userId = '$userId' and cartintegration.cartId = '' AND (cartintegration.detentionPeriod = '0000-00-00 00:00:00' OR cartintegration.detentionPeriod >= '$created_date')";
                                $resultCount = $conn->query($countSql);
                                
                                if($resultCount->num_rows > 0){ //over 1 database(record) so run
                                    while($row = $resultCount->fetch_assoc()){
                                        $CartAvailableCount = $row['countTotal'];
                                    }
                            ?>
                                <span class="item-number "><?php echo $CartAvailableCount;?></span>
                            <?php }else { ?>
                                <span class="item-number ">0</span>

                            <?php } 
                            }?>
                        </a>
                        <div class="shopping-bag-detail" id="shoppingbagdetail">
                            <?php if(isset($_SESSION['username'])){ 
                                    $userId = $_SESSION['userId'];
                                    $getCartItem = "select * from cartintegration left join product on cartintegration.productId = product.id where cartintegration.userId = '$userId' and cartintegration.cartId = '' AND (cartintegration.detentionPeriod = '0000-00-00 00:00:00' OR cartintegration.detentionPeriod >= '$created_date') LIMIT 1";
                                    $resultCart = $conn->query($getCartItem);

                                    if($resultCart->num_rows > 0){ //over 1 database(record) so run
                                        while($row = $resultCart->fetch_assoc()){
                                            $CartIntegrationId = $row['cartIntegrationId'];
                                            $CartProductId = $row['productId'];
                                            $CartVariation = $row['variation'];
                                            $CartQuantity = $row['quantity'];
                                            $CartProductName = $row['name'];
                                            $CartProductPrice = $row['price'];
                                            $CartProductImage = $row['coverImage'];
                                            
                                ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="../images/productImage/<?php echo $CartProductImage;?>" alt="" width="100" height="100">
                                        </div>
                                        <div class="col-md-5" style="color:black">
                                            <h4><?php echo $CartProductName;?></h4>
                                            <h5>Variation: <?php echo $CartVariation;?></h5>
                                        </div>
                                        <div class="col-md-2" style="color:black">
                                            <div class="row"><?php echo $CartProductPrice;?></div>
                                            <!-- <div class="row">x <?php echo $CartQuantity;?></div>
                                            <div class="row"><?php echo $CartProductPrice*$CartQuantity;?></div> -->
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                            <p style="color:black;position:absolute;bottom:0px;;left:10px;">Available <strong><?php echo $CartAvailableCount;?></strong> in cart</p>
                                            <a href="../user/cart.php" class="btn btn-danger" style="width:50%;font-size:15px;margin:5% 0% 0% 46%">View Shopping Cart</a>
                                    </div>
                                    <!-- <div class="demo" style="z-index:100;color:black">User shopping cart item</div> -->
                            <?php } 
                        }else{ ?>
                                    <div class="demo" style="z-index:100;color:black;padding:20%;font-size:15px;text-align:center;">Empty Cart</div>                            
                            <?php        
                            }
                         }else { ?>
                                    <div class="demo" style="z-index:100;padding:20%;font-size:15px;text-align:center;">
                                        <a href="../user/login.php" style="color:#cd5c5c;font-size:25px">Login</a>
                                    </div>                            
                            <?php } ?>
                            
                        </div><!--End shopping bag item-->
                    </div><!--End shopping cart icon-->
                    </form>
                </div><!--End row 2-->

            </div>
        </div><!--End container-->
    </div><!--Enf filpkart-navbar-->
        
        <!-- 手机模式的左边slider -->
    <div id="mySidenav" class="sidenav" style="z-index:7;margin-top:-19px">
        <div class="container" style="background-color: #2874f0; padding-top: 10px;">
            <a href="../user/home.php"><span class="sidenav-heading">Home</span></a>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        </div>
        <a href="../user/home.php" class="side-bar-link">Home</a>
        <a href="../user/profile.php" class="side-bar-link">My Profile</a>
        <a href="../user/address.php" class="side-bar-link">My Address</a>
        <a href="../user/changePassword.php" class="side-bar-link">Change Password</a>
        <a href="../user/cart.php" class="side-bar-link">View Cart</a>
        <a href="../user/auctionProduct.php" class="side-bar-link">View More Auction</a>

        <?php if(isset($_SESSION['username'])){?>
                <form action="../user/home.php" method="post">
                    <button type="submit" name="logout" class="account-link-logout">
                            <span class=" side-bar-link"><i class="fa fas fa-door-open"></i>
                                Logout</span>                                                      
                    </button>
                </form>
        <?php
        }else{?>
                <form action="../user/login.php" method="post">
                    <button type="submit" name="logout" class="account-link-logout">
                            <span class=" side-bar-link"><i class="fa fas fa-door-open"></i>
                                Login</span>                                                      
                    </button>
                </form>
        <?php
        }
        ?>
        
        
    </div>

  </div> <!--End header-->