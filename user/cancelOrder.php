<?php
include("../config.php");
include '../limitTimeSession.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
$date =  date("Y-m-d H:i:s");

//return cancel action to here check product
$userId = $_SESSION['userId'];
if($_GET['productId']){
    $cartIntegrationId = $_GET['productId'];
    
    //is done cancel
    if(isset($_GET['action'])){
        $getCancelDetail = "SELECT *, cartintegration.status AS 'cartStatus' FROM cartintegration LEFT JOIN product ON cartintegration.productId = product.id LEFT JOIN orderlist ON orderlist.cartId = cartintegration.cartId LEFT JOIN payment ON payment.order_id = orderlist.orderId WHERE cartintegration.cartIntegrationId = '$cartIntegrationId' AND cartintegration.userId = '$userId'";
        $resultGetProductDetail = $conn->query($getCancelDetail); 

        if($resultGetProductDetail ->num_rows>0){
            while($row = $resultGetProductDetail ->fetch_assoc()){
                $cancelDetail_cart_cartIntegration_Id = $row['cartIntegrationId'];
                $cancelDetail_cart_status = $row['cartStatus'];
                $cancelDetail_cart_qty = $row['quantity'];
                $cancelDetail_cart_variation = $row['variation'];
                $cancelDetail_product_id = $row['id'];
                $cancelDetail_product_name = $row['name'];
                $cancelDetail_product_price = $row['price'];
                $cancelDetail_product_coverImages = $row['coverImage'];
                $cancelDetail_payment_method = $row['paymentMethod'];
            } 

            if($cancelDetail_cart_variation == NULL){
                $cancelDetail_cart_variation = " ";
            }else{
                $cancelDetail_cart_variation = "Variation: ($cancelDetail_cart_variation)";
            }

            //get cancel detail from actioncenter table
            $GetActionCenterSql = "SELECT * FROM actioncenter WHERE cartIntegrationId = '$cancelDetail_cart_cartIntegration_Id'";
            $resultGetActionCenterSql = $conn->query($GetActionCenterSql);
            if($resultGetActionCenterSql ->num_rows>0){
                while($row = $resultGetActionCenterSql ->fetch_assoc()){
                    $cancelDetail_actionId = $row['actionId'];
                    $cancel_action = $row['action'];
                    $cancelDetail_reason = $row['actionReason'];
                    $cancelDetail_AddtionalReason = $row['actionAddtionalReason'];
                    $cancelDetail_sellerComment = $row['actionSellerComment'];
                    $cancelDetail_actionStatus = $row['actionStatus'];
                    $cancelDetail_created_time = $row['created_time'];
                    $cancelDetail_update_time = $row['update_time'];

                    $estimid_refund_day = date("Y-m-d h:i:s a",strtotime($cancelDetail_update_time .'+ 5 days'));
                }
            }
        }else{
            header("Location: ../user/404.html");
            die();
        }//for edit productId error

    //never do cancel before 
    }else{
        $getProduct = "SELECT *, cartintegration.status AS 'cartStatus' FROM cartintegration LEFT JOIN product ON cartintegration.productId = product.id WHERE cartintegration.cancelRequest = '0' AND cartintegration.cartIntegrationId = '$cartIntegrationId' AND cartintegration.userId = '$userId'";
        $resultGetProduct = $conn->query($getProduct);

        if($resultGetProduct ->num_rows>0){
            while($row = $resultGetProduct ->fetch_assoc()){
                $cancel_cart_cartIntegration_Id = $row['cartIntegrationId'];
                $cancel_cart_Id = $row['cartId'];
                $cancel_cart_status = $row['cartStatus'];
                $cancel_cart_qty = $row['quantity'];
                $cancel_cart_variation = $row['variation'];
                $cancel_product_id = $row['id'];
                $cancel_product_name = $row['name'];
                $cancel_product_price = $row['price'];
                $cancel_product_coverImages = $row['coverImage'];
            }
            
            if($cancel_cart_variation == NULL){
                $cancel_cart_variation = " ";
            }else{
                $cancel_cart_variation = "Variation: ($cancel_cart_variation)";
            }

            if($cancel_cart_status == NULL){
                $cancel_cart_status = "Processing";
            } 
        }else{
            header("Location: ../user/404.html");
            die();
        }//for edit productId 'usCancelRequest' error

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel</title>

    <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/homestyle.css">
    <link rel="stylesheet" href="../css/userAccount.css">


    <!-- header and footer link -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> <!--Icon Footer-->

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <?php require '../user/header.php' ?>
    
    <div class="col-md-12 profile-container">
        <div class="row">

            <!-- left list -->
            <div class="col-md-3 mobile-account-changePassword-box" style="padding-left:5%;">

                <!-- left image box -->
                <div class="col-md-12 border border-top-0 border-left-0 border-right-0 p-sm-2 imges-box-underline">
                    <a href="../user/profile.php">
                        <div class="row">
                      
                            <?php
                                if($_SESSION['userId']){
                                    $user_id = $_SESSION['userId'];
                                    $User = "SELECT userName,image FROM user WHERE userId = '$user_id'";
                                    $resultUser = $conn->query($User);

                                    if($resultUser ->num_rows>0){
                                        while($row = $resultUser ->fetch_assoc()){
                                            $user_name = $row['userName'];
                                            $user_image = $row['image'];

                                            if(empty($user_image)){
                                                $user_image = "userIcon.png";
                                            }
                            ?>
                                <!-- pic -->
                                <div class="col-md-4 p-2 images-position">
                                    <img src="../images/profileImage/<?php echo $user_image;?>" class="rounded-circle" alt="" width="60%" height="60%">
                                </div>
                                <!-- name -->
                                <div class="col-md-8">
                                    <h3 class="imges-box-underline"><?php echo $user_name;?></h3>
                                    <h5 class="imges-box-underline">
                                    <svg t="1597480699000" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="20632" width="15" height="15"><path d="M920.2 831.8H103.8c-22.1 0-40 17.9-40 40s17.9 40 40 40h816.5c22.1 0 40-17.9 40-40s-18-40-40.1-40zM788.1 340.2c15.7-16.1 23.9-37.9 23-61.4-1-28.1-14.7-56.1-37.7-76.7L703.9 140c-17.8-15.9-40.1-25.7-62.8-27.5-25.7-2-49.9 6.6-66.5 23.6L135.7 587l-34.4 243.2 252.4-43.7 434.4-446.3zM631.4 192.4c2.7-0.8 11.3 0.1 19.1 7.1l69.5 62.2c7.9 7.1 11 15.1 11.1 19.8 0.1 1.8-0.3 2.7-0.4 2.9l-57.3 58.9-101-90.3 59-60.6zM195.8 732.6l15.4-108.5 305.4-313.7 101 90.3-303.1 311.4-118.7 20.5z" p-id="20633" fill="#333333"></path></svg>
                                    Edit Profile</h5>
                                </div>
                            <?php
                                        }
                                    }else{
                            ?>
                                <!-- pic -->
                                <div class="col-md-4 p-2 images-position">
                                    <img src="../images/userIcon.png" class="rounded-circle" alt="" width="60%" height="60%">
                                </div>

                                <!-- name -->
                                <div class="col-md-8">
                                    <h3 class="imges-box-underline">username</h3>
                                    <h5 class="imges-box-underline">
                                    <svg t="1597480699000" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="20632" width="15" height="15"><path d="M920.2 831.8H103.8c-22.1 0-40 17.9-40 40s17.9 40 40 40h816.5c22.1 0 40-17.9 40-40s-18-40-40.1-40zM788.1 340.2c15.7-16.1 23.9-37.9 23-61.4-1-28.1-14.7-56.1-37.7-76.7L703.9 140c-17.8-15.9-40.1-25.7-62.8-27.5-25.7-2-49.9 6.6-66.5 23.6L135.7 587l-34.4 243.2 252.4-43.7 434.4-446.3zM631.4 192.4c2.7-0.8 11.3 0.1 19.1 7.1l69.5 62.2c7.9 7.1 11 15.1 11.1 19.8 0.1 1.8-0.3 2.7-0.4 2.9l-57.3 58.9-101-90.3 59-60.6zM195.8 732.6l15.4-108.5 305.4-313.7 101 90.3-303.1 311.4-118.7 20.5z" p-id="20633" fill="#333333"></path></svg>
                                    Edit Profile</h5>
                                </div>
                            <?php
                                    }
                                }
                            ?>  

                        </div>
                    </a>
                </div> <!--End left images box-->

                <div class="col-md-12 pt-3">

                    <!-- my account -->
                    <div class="row pl-5">
                        <svg t="1597479502750" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="16828" width="25" height="25"><path d="M723.43 508.6c-54.123 47.75-125.977 77.056-205.163 77.056-80.364 0-153.4-30.259-207.765-79.421C184.05 539.325 105.81 652.308 105.81 787.277v68.782c0 160.968 812.39 160.968 812.39 0v-68.782c-0.005-131.415-74.22-242.509-194.77-278.677z m-205.163 28.13c140.165 0 254.095-109.44 254.095-244.64S658.668 47.218 518.267 47.218c-139.93 0-253.855 109.675-253.855 244.874 0 135.204 113.925 244.639 253.855 244.639z m0 0" p-id="16829"></path></svg>
                        <a href="../user/profile.php" class="profile-account-link">My Account</a>
                        <!-- <div class="row"> -->
                            <ul class="account-ul-text">
                                <li class="pt-1 profile-bar-link" onclick='window.location.href="../user/profile.php"'> Profile </li>
                                <li class="pt-1 profile-bar-link"  onclick='window.location.href="../user/address.php"'> Address </li>
                                <li class="pt-1 profile-bar-link  "  onclick='window.location.href="../user/changePassword.php"'>Change Password </li>
                            </ul>
                        <!-- </div> -->
                    </div>

                    <!-- my purchase -->
                    <div class="row pl-5 pt-2">
                        <svg t="1597479675271" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="19618" width="25" height="25"><path d="M832 96H192c-52.935 0-96 43.065-96 96v640c0 52.935 43.065 96 96 96h640c52.935 0 96-43.065 96-96V192c0-52.935-43.065-96-96-96z m-192 64v32c0 17.645-14.355 32-32 32H416c-17.645 0-32-14.355-32-32v-32h256z m224 672c0 17.645-14.355 32-32 32H192c-17.645 0-32-14.355-32-32V192c0-17.645 14.355-32 32-32h128v32c0 52.935 43.065 96 96 96h192c52.935 0 96-43.065 96-96v-32h128c17.645 0 32 14.355 32 32v640z" p-id="19619" fill="#333333"></path><path d="M672 516H471.426l62.851-36.287c15.306-8.836 20.55-28.408 11.713-43.713s-28.406-20.551-43.713-11.713l-166.277 96c-0.044 0.025-0.085 0.053-0.128 0.079-0.352 0.206-0.698 0.418-1.041 0.637-0.134 0.085-0.267 0.169-0.399 0.256-0.275 0.181-0.545 0.367-0.814 0.556-0.193 0.135-0.386 0.27-0.575 0.409-0.184 0.136-0.365 0.276-0.546 0.415-0.259 0.199-0.518 0.399-0.77 0.605l-0.277 0.233c-0.325 0.272-0.646 0.547-0.959 0.831l-0.025 0.023a31.78 31.78 0 0 0-5.803 7.031c-0.127 0.208-0.245 0.423-0.368 0.634-0.125 0.216-0.254 0.43-0.373 0.649a31.75 31.75 0 0 0-3.186 8.538l-0.008 0.035a29.96 29.96 0 0 0-0.239 1.243c-0.021 0.12-0.044 0.239-0.064 0.359-0.052 0.319-0.096 0.64-0.138 0.962-0.031 0.23-0.062 0.459-0.088 0.69a31.94 31.94 0 0 0-0.066 0.694c-0.03 0.33-0.056 0.66-0.075 0.991-0.009 0.156-0.015 0.312-0.022 0.468-0.018 0.409-0.029 0.818-0.031 1.229 0 0.049-0.004 0.097-0.004 0.146 0 0.056 0.004 0.111 0.004 0.167 0.002 0.447 0.013 0.895 0.034 1.343l0.014 0.269a30.933 30.933 0 0 0 0.132 1.636 31.515 31.515 0 0 0 0.408 2.707c0.036 0.185 0.072 0.37 0.111 0.554 0.064 0.298 0.134 0.596 0.206 0.893 0.058 0.239 0.117 0.477 0.18 0.714a36.85 36.85 0 0 0 0.468 1.584c0.059 0.18 0.12 0.36 0.182 0.539 0.117 0.342 0.239 0.681 0.368 1.017 0.051 0.133 0.104 0.265 0.156 0.397 0.151 0.38 0.308 0.756 0.474 1.129 0.043 0.098 0.088 0.195 0.132 0.292a29.47 29.47 0 0 0 0.698 1.436c0.204 0.395 0.417 0.785 0.637 1.17 0.029 0.05 0.054 0.102 0.083 0.152 0.019 0.033 0.041 0.064 0.06 0.097a31.993 31.993 0 0 0 2.214 3.309 35.719 35.719 0 0 0 1.164 1.432c0.185 0.216 0.367 0.433 0.557 0.643 0.342 0.378 0.694 0.747 1.053 1.108 0.265 0.266 0.538 0.521 0.811 0.777 0.18 0.168 0.359 0.336 0.543 0.499 0.266 0.238 0.535 0.472 0.808 0.7 0.204 0.171 0.413 0.335 0.622 0.5 0.365 0.29 0.735 0.573 1.111 0.845 0.334 0.242 0.67 0.482 1.014 0.711 0.203 0.135 0.409 0.264 0.615 0.394 0.355 0.226 0.714 0.444 1.078 0.656 0.162 0.094 0.322 0.188 0.485 0.279a31.854 31.854 0 0 0 5.432 2.397l0.056 0.019c1.281 0.425 2.596 0.774 3.944 1.037l0.06 0.011c0.582 0.112 1.169 0.206 1.762 0.286 0.165 0.023 0.331 0.043 0.497 0.063 0.444 0.053 0.89 0.096 1.34 0.13 0.221 0.017 0.441 0.038 0.662 0.05 0.421 0.024 0.845 0.034 1.27 0.041 0.195 0.004 0.388 0.019 0.583 0.019 0.051 0 0.102-0.005 0.153-0.005H672c17.673 0 32-14.327 32-32S689.673 516 672 516zM672 672H352c-17.673 0-32 14.327-32 32s14.327 32 32 32h320c17.673 0 32-14.327 32-32s-14.327-32-32-32z" p-id="19620" fill="#333333"></path></svg>
                        <a href="../user/purchasePage.php" class="profile-account-link">My Purchase</a>
                        <!-- <div class="row"> -->
                            <!-- <ul class="account-ul-text">
                                <li class="link-active"><a href="../user/profile.php"></a> Profile </li>
                                <li class=""><a href="../user/"></a> Address </li>
                                <li class=""><a href="../user/"></a> Change Password </li>
                            </ul> -->
                        <!-- </div> -->
                    </div>

                    <!-- my review -->
                    <div class="row pl-5 pt-2 ">
                    <svg t="1606103804449" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3617" width="25" height="25"><path d="M365.677958 780.174785 201.729979 927.116439 201.729979 780.174785 61.942259 780.174785 61.942259 98.902544l897.396557 0 0 681.271218L365.677958 780.173762zM924.823722 133.417639l-828.366368 0 0 604.136443 139.78772 0 0 103.275131 115.225301-103.275131 573.352323 0L924.822698 133.417639zM521.190825 392.543328c27.588335 0 49.935296 21.100574 49.935296 47.146786 0 26.038026-22.346961 47.146786-49.935296 47.146786-27.563776 0-49.910737-21.10876-49.910737-47.146786C471.280088 413.643901 493.627049 392.543328 521.190825 392.543328zM729.849098 392.543328c27.571962 0 49.937342 21.100574 49.937342 47.146786 0 26.038026-22.364357 47.146786-49.937342 47.146786-27.588335 0-49.935296-21.10876-49.935296-47.146786C679.913802 413.643901 702.260763 392.543328 729.849098 392.543328zM312.539714 486.836901c-27.563776 0-49.910737-21.10876-49.910737-47.146786 0-26.046213 22.346961-47.146786 49.910737-47.146786 27.580149 0 49.927109 21.100574 49.927109 47.146786C362.466823 465.72814 340.119863 486.836901 312.539714 486.836901z" p-id="3618" fill="#8a8a8a"></path></svg>
                        <a href="../user/myReview.php" class="profile-account-link ">My Review</a>
                        <!-- <div class="row"> -->
                            <!-- <ul class="account-ul-text">
                                <li class="link-active"><a href="../user/profile.php"></a> Profile </li>
                                <li class=""><a href="../user/"></a> Address </li>
                                <li class=""><a href="../user/"></a> Change Password </li>
                            </ul> -->
                        <!-- </div> -->
                    </div>

                    <!-- my report -->
                    <div class="row pl-5 pt-2">
                        <svg t="1597479396964" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="13217" width="25" height="25"><path d="M399.36 327.68h225.28c11.264 0 20.48-9.216 20.48-20.48v-40.96c0-33.792-27.648-61.44-61.44-61.44H440.32c-33.792 0-61.44 27.648-61.44 61.44v40.96c0 11.264 9.216 20.48 20.48 20.48z m337.92-71.68h-20.48c-6.144 0-10.24 4.096-10.24 10.24v40.96c0 45.056-36.864 81.92-81.92 81.92H399.36c-45.056 0-81.92-36.864-81.92-81.92v-40.96c0-6.144-4.096-10.24-10.24-10.24h-20.48c-33.792 0-61.44 27.648-61.44 61.44v440.32c0 33.792 27.648 61.44 61.44 61.44h450.56c33.792 0 61.44-27.648 61.44-61.44V317.44c0-33.792-27.648-61.44-61.44-61.44zM440.32 675.84c0 11.264-9.216 20.48-20.48 20.48h-20.48c-11.264 0-20.48-9.216-20.48-20.48V573.44c0-11.264 9.216-20.48 20.48-20.48h20.48c11.264 0 20.48 9.216 20.48 20.48v102.4z m102.4 0c0 11.264-9.216 20.48-20.48 20.48h-20.48c-11.264 0-20.48-9.216-20.48-20.48V481.28c0-11.264 9.216-20.48 20.48-20.48h20.48c11.264 0 20.48 9.216 20.48 20.48v194.56z m102.4 0c0 11.264-9.216 20.48-20.48 20.48h-20.48c-11.264 0-20.48-9.216-20.48-20.48V522.24c0-11.264 9.216-20.48 20.48-20.48h20.48c11.264 0 20.48 9.216 20.48 20.48v153.6z" p-id="13218" fill="#515151"></path></svg>
                        <a href="../user/" class="profile-account-link" style="pointer-events:none">My Report</a>
                        <!-- <div class="row"> -->
                            <ul class="account-ul-text pt-1">
                                <li class="pt-2 profile-bar-link" onclick='window.location.href="../user/cancellationRequest.php"'>Cancellation Request</li>
                                <li class="pt-2 profile-bar-link" onclick='window.location.href="../user/returnRequest.php"'>Return Request</li>
                            </ul>
                        <!-- </div> -->
                    </div>

                </div>
            </div> <!--End left box-->

            <!-- right box -->
            <div class="col-md-8 changePassword-container">

                    <div class="row m-3 shadow-sm p-3 bg-white ">
                        <h3 class="font-weight-bold">Request Cancellation</h3>
                    </div>

                    <?php 
                        if(isset($_GET['action'])){
                    ?>
                        <div class="row m-3 shadow-sm p-3 bg-white">
                            <div class="col-md-2 col-sm-2 col-lg-2 col-xg-2">
                                <a href="productDetail.php?productId=<?php echo $cancelDetail_product_id;?>">
                                    <img src="../images/productImage/<?php echo $cancelDetail_product_coverImages;?>" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="col-md-5 col-sm-5 col-lg-5 col-xg-5">
                                <div class="col text-break">
                                    <a class="text-decoration-none text-dark" href="productDetail.php?productId=<?php echo $cancelDetail_product_id;?>">
                                        <?php echo $cancelDetail_product_name;?>
                                    </a>
                                </div>
                                <div class="col text-muted"><?php echo $cancelDetail_cart_variation;?></div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 col-xg-2">
                                <h5><span class="text-muted">Qty:</span> <?php echo $cancelDetail_cart_qty;?></h5>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3 col-xg-3">
                                <h5><span class="text-muted">RM:</span> <?php echo $cancelDetail_product_price*$cancelDetail_cart_qty;?></h5>
                                <h5><span class="badge badge-pill badge-secondary" style="font-size:14px;"><?php echo $cancelDetail_cart_status;?></span><br></h5>
                            </div>
                        </div>

                        <div class="row m-3 shadow-sm p-3 bg-white">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Return Reason</th>
                                        <th>Status</th>
                                        <th>Process Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $cancelDetail_reason;?>
                                            <br>
                                            <?php echo $cancelDetail_AddtionalReason;?>
                                        </td>
                                        <td>
                                            <?php
                                                if($cancelDetail_actionStatus == "reject"){
                                            ?>
                                                    <span class="text-capitalize font-weight-bold text-danger"><?php echo $cancelDetail_actionStatus;?></span>
                                            <?php
                                                }else if($cancelDetail_actionStatus == "approve"){
                                            ?>
                                                    <span class="text-capitalize font-weight-bold text-success"><?php echo $cancelDetail_actionStatus;?></span>
                                            <?php
                                                }else if($cancelDetail_actionStatus == "pending"){
                                            ?>
                                                    <span class="text-capitalize font-weight-bold text-primary"><?php echo $cancelDetail_actionStatus;?></span>
                                            <?php
                                                }
                                            
                                                if( ($cancelDetail_actionStatus == "reject") && !empty($cancelDetail_sellerComment) ){
                                            ?>
                                                <br>
                                                <span class="font-weight-bold text-capitalize">Reject Reason:  <?php echo $cancelDetail_sellerComment;?></span>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $cancelDetail_update_time;?></td>
                                    </tr>
                                </tbody>
                            </table>  
                            <?php
                                if( ($cancelDetail_payment_method == "paypal") && ($cancelDetail_actionStatus == "approve")){
                            ?>
                                    <span class="text-danger">* Your balance will be refund on <?php echo $estimid_refund_day;?> before</span>
                            <?php
                                }
                            ?>
                           
                        </div>
                        
                    <?php
                        }else{
                        //never do cancel before (new cancel action)
                    ?>
                    
                    <div class="row m-3 shadow-sm p-3 bg-white">
                        <div class="col-md-2 col-sm-2 col-lg-2 col-xg-2">
                            <a href="productDetail.php?productId=<?php echo $cancel_product_id;?>">
                                <img src="../images/productImage/<?php echo $cancel_product_coverImages;?>" alt="" class="w-100 h-100">
                            </a>
                        </div>
                        <div class="col-md-5 col-sm-5 col-lg-5 col-xg-5">
                            <div class="col text-break">
                                <a class="text-decoration-none text-dark" href="productDetail.php?productId=<?php echo $cancel_product_id;?>">
                                    <?php echo $cancel_product_name;?>
                                </a>
                            </div>
                            <div class="col text-muted"><?php echo $cancel_cart_variation;?></div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-lg-2 col-xg-2">
                            <h5><span class="text-muted">Qty:</span> <?php echo $cancel_cart_qty;?></h5>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3 col-xg-3">
                            <h5><span class="text-muted">RM:</span> <?php echo $cancel_product_price*$cancel_cart_qty;?></h5>
                            <h5><span class="badge badge-pill badge-secondary" style="font-size:14px;"><?php echo $cancel_cart_status;?></span><br></h5>
                        </div>
                    </div>

                    <form action="../database/user/actionProcess.php" method="post" onSubmit="return checkform()">
                        <div class="row m-3 shadow-sm p-3 bg-white">
                            <div class="col-12">
                                <h5 class="font-weight-bold">Cancel Reason</h5>
                                <input type="hidden" name="cartIntegrationId" value="<?php echo $cancel_cart_cartIntegration_Id;?>">
                                <input type="hidden" name="cartStatus" value="<?php echo $cancel_cart_status;?>">
                                <input type="hidden" name="cartId" value="<?php echo $cancel_cart_Id;?>">
                                <input type="hidden" name="cartPrice" value="<?php echo $cancel_product_price;?>">
                            </div>
                            <div class="col-11 mb-3">
                                <select class="custom-select" id="inputGroupSelect01" name="reasonOption" required>
                                    <option selected value=" " disabled >Choose a reason...</option>
                                    <option value="Change payment method">Change payment method</option>
                                    <option value="Change/combine order">Change/combine order</option>
                                    <option value="Delivery time too long">Delivery time too long</option>
                                    <option value="Duplicate Order">Duplicate Order</option>
                                    <option value="Change Of Delivery Address">Change Of Delivery Address</option>
                                    <option value="Change of mind">Change of mind</option>
                                    <option value="Found cheaper elsewhere">Found cheaper elsewhere</option>    
                                </select>
                                <span id="errorMessage" style="display:none" class="text-danger"></span>
                            </div>
                            <div class="col-12 from-group">
                                <textarea name="cancelText" placeholder="e.g. i found cheaper elsewhere.." cols="86" rows="5" minlength="20" maxlength="250" id="checkChar" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="float-right">( <span id="calChar">0</span>/ 250)</div>
                            </div>
                        </div>

                        <div class="row m-3 shadow-sm p-3 bg-white">
                            <div class="col-12">
                                <h5 class="font-weight-bold">Cancellation Policy</h5>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-11 bg-light p-3 m-3">
                                        <h5>Before cancelling the order, kindly read thoroughly our following terms & conditions:</h5>
                                        <p>1. Once you submit this form you agree to cancel the selected item(s) in your order. We will be unable to retrieve your order once it is cancelled.</p>
                                        <p>2. Once you confirm your item(s) cancellation, we will process your refund within 24 hours, provided the item(s) has not been handed over to the logistics partner yet. Please note that, if your item has already been handed over to the logistics partner we will be unable to proceed with your cancellation request and we will inform you accordingly.</p>
                                        <p>3. If you are cancelling your order partially, ie. not all the items in your order, then we will be unable to refund you the shipping fee.</p>
                                        <p>4. Once your item(s) has been successfully cancelled you will receive a notification from us with your refund summary.</p>                                    
                                    </div>
                                </div>
                                <div class="row ml-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                                        <label class="form-check-label" for="defaultCheck1">
                                            I have read and accepted the Cancellation Policy for Masomon Online Shopping 
                                        </label>
                                        <span id="errorMessage3" style="display:none" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row float-right mr-4">
                            <button type="submit" name="cancelOrder" class="btn btn-secondary btn-lg">Submit</button>
                        </div>
                    </form>

            <?php
                }
            ?>
            </div><!--End right box-->



        </div> <!--End row-->
    </div><!--End profile container-->

    <?php require '../user/footer.php' ?>

    <?php 
    if(isset($_SESSION['m'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
    <?php } ?>


</body>
<script src="../js/homescript.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script><!-- Sweet Alert JS  -->
<script>
//check textarea text
$('#checkChar').keyup(function() {
    $('#calChar').html(this.value.length);
});

//sweet alert
var flashdata = $('.flash-data').data('flashdata');
    if(flashdata == "Cancel-Product-Successful-01-Notic"){
        Swal.fire(
            'Cancel Request Success!',
            'Your cancel request is accepted, Please waiting the notic in 3-5 working days!',
            'success'
        
        )
    }else if(flashdata == "Cancel-Request-Exist-InProcessing-01-Notic"){
        Swal.fire({
            icon: 'warning',
            title: 'Cancel Request already exists！',
            text: 'Please be patient and wait for the latest notification! Thank you!',
            footer: '<a href>Why do I have this issue?</a>'
        })
    }

//validtion form
function checkform()
{
    var selectReason = $('#inputGroupSelect01').val();
	if( selectReason == null)
	{
        var unselect = "* Please At Least Choose One Reason!";
		// something is wrong
		$("#errorMessage").attr('style',  'display:block');
        $("#errorMessage").html(unselect)
		return false;
	}

    if($("#defaultCheck1-1").prop('checked') == false){
        var unCheck = "* Please Read & Agree The Cancellation Policy!";
        $("#errorMessage3").attr('style',  'display:block');
        $("#errorMessage3").html(unCheck)
		return false;
    //do something
    }
	// If the script gets this far through all of your fields
	// without problems, it's ok and you can submit the form

	return true;
}

$(document).ready(function(){
        $('#searchProductBtn').click(function(){
            var keyword = $('#inputKeyword').val();
            window.location.href = "../user/searchProduct.php?query="+keyword;
        });
    });
</script>
</html>