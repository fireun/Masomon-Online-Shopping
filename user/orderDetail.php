<?php
include("../config.php");
session_start();

// unset($_SESSION['m']);//clear the alert

if(isset($_POST['logout'])){
    session_destroy();
    echo "<script>alert('logout success !!!');
    window.location.href= '../user/home.php';</script>";
}

if($_GET['cart'] && $_GET['order']){
    $cart_id = $_GET['cart'];//cart integration id
    $order_id = $_GET['order'];
    $getOrderDetail = "SELECT cartintegration.*, orderlist.*, cartintegration.status AS 'cartStatus', cart.unifiedDelivery FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId LEFT JOIN cart ON cartintegration.cartId = cart.cartId  WHERE cartintegration.cartIntegrationId = '$cart_id' AND orderlist.orderId = '$order_id'";
    $resultGetOrderDetail=$conn->query($getOrderDetail);

    if($resultGetOrderDetail->num_rows>0){
        while($row = $resultGetOrderDetail->fetch_assoc()){
            $order_id = $row['orderId'];
            $order_cartIntegrationId = $row['cartIntegrationId'];
            $order_cartId = $row['cartId'];
            $order_shipId = $row['shipId'];
            $order_amount = $row['amount'];
            $order_return = $row['returnRequest'];
            $order_cancel = $row['cancelRequest'];
            $order_status = $row['status'];
            $order_unfied = $row['unifiedDelivery'];
            $order_date = $row['created_time'];
            $order_cart_status = $row['cartStatus'];
        }

    }else{
        header("Location: ../user/404.html");
        die();
    }

    $new_order_date = date('Y/m/d h:i:s a ', strtotime($order_date));

    if($order_cart_status == "unpaid"){
        $order_status = "TO PAY";

    }else if($order_cart_status == "shipping"){
        $order_status = "TO RECEIVE";

        if($order_unfied == "0"){
            $checkTrack = "SELECT * FROM track WHERE orderId = '$order_id'";
        }else if($order_unfied == "1"){
            $checkTrack = "SELECT * FROM track WHERE trackIntegrationId = '$cart_id'";
        }
        $resultCheckTrack = $conn->query($checkTrack);
        if($resultCheckTrack->num_rows>0){
            while($row = $resultCheckTrack->fetch_assoc()){
                $order_track_status = $row['status'];
            }
        }

    }else if($order_cart_status == "closed"){
        $order_status = "COMPLETED";
    
    }else if($order_cart_status == "submitted" || $order_cart_status = "packging" ){
        $order_status = "TO SHIP";
    }
    
    $getShipAddress = "select * from address_shipping where ship_id = '$order_shipId'";
    $resultGetShipAddress = $conn->query($getShipAddress);

    if($resultGetShipAddress->num_rows>0){
        while($row = $resultGetShipAddress->fetch_assoc()){
            $received_name = $row['recipient_name'];
            $received_phone = $row['recipient_phone'];
            $received_address = $row['recipient_address'];
            $received_city = $row['recipient_city'];
            $received_state = $row['recipient_state'];
            $received_postalCode = $row['recipient_postalCode'];
            $received_country = $row['recipient_country'];
        }
    }

    $getPaymentDetail = "SELECT * FROM payment where order_id = '$order_id'";
    $resultGetPaymentDetail = $conn->query($getPaymentDetail);

    if($resultGetPaymentDetail->num_rows>0){
        while($row = $resultGetPaymentDetail->fetch_assoc()){
            $payment_id = $row['payment_id'];
            $payment_order_id = $row['order_id'];
            $payment_method = $row['paymentMethod'];
            $payment_order_item = $row['order_item'];
            $payment_subtotal = $row['subtotal'];
            $payment_subtotal_fee = $row['subtotal_Fee'];
            $payment_discount_delivery = $row['Discount_Delivery'];
            $payment_total = $row['Total'];
            $payment_payer_id = $row['paypal_payer_id'];
            $payment_paypal_id = $row['paypal_payment_id'];
            $payment_status = $row['status'];
            $payment_updateTime = $row['update_time'];  

            $new_payment_updateTime = date('Y/m/d h:i:s a ', strtotime($payment_updateTime));
        }

        if($payment_status != "paid"){
            $payment_status = "UNPAID";
        }else{
            $payment_status = "PAID";
        }
    }
}else{
    header("Location: ../user/404.html");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Track Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="../css/reset.css">
    <!-- <link rel="stylesheet" href="../css/homestyle.css"> -->
    <title>View Order Detail</title>
    <style>
        /* body{margin-top:20px;} */

        .steps .step {
            display: block;
            width: 100%;
            margin-bottom: 35px;
            text-align: center
        }

        .steps .step .step-icon-wrap {
            display: block;
            position: relative;
            width: 100%;
            height: 80px;
            text-align: center
        }
        /* middle line - uncompleted */
        .steps .step .step-icon-wrap::before,
        .steps .step .step-icon-wrap::after {
            display: block;
            position: absolute;
            top: 50%;
            width: 50%;
            height: 3px;
            margin-top: -1px;
            background-color: #e1e7ec;
            content: '';
            z-index: 1
        }

        .steps .step .step-icon-wrap::before {
            left: 0
        }

        .steps .step .step-icon-wrap::after {
            right: 0
        }
        /* circle - uncompleted */
        .steps .step .step-icon {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            border: 1px solid #e1e7ec;
            border-radius: 50%;
            background-color: #f5f5f5;
            color: #374250;
            font-size: 38px;
            line-height: 81px;
            z-index: 5
        }


        .steps .step .step-icon i {
            font-size:25px;
        }

        .steps .step .step-title {
            margin-top: 16px;
            margin-bottom: 0;
            color: #606975;
            font-size: 14px;
            font-weight: 500
        }

        .steps .step:first-child .step-icon-wrap::before {
            display: none
        }

        .steps .step:last-child .step-icon-wrap::after {
            display: none
        }
        /* middle line - completed */
        .steps .step.completed .step-icon-wrap::before,
        .steps .step.completed .step-icon-wrap::after {
            background-color: #2dc258;
        }
        /* circle - completed */
        .steps .step.completed .step-icon {
            border-color: #2dc258;
            background-color: #2dc258;
            color: #fff
        }

        @media (max-width: 576px) {
            .flex-sm-nowrap .step .step-icon-wrap::before,
            .flex-sm-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        @media (max-width: 768px) {
            .flex-md-nowrap .step .step-icon-wrap::before,
            .flex-md-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        @media (max-width: 991px) {
            .flex-lg-nowrap .step .step-icon-wrap::before,
            .flex-lg-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        @media (max-width: 1200px) {
            .flex-xl-nowrap .step .step-icon-wrap::before,
            .flex-xl-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        /* default uncomplete */
        .bg-faded, .bg-secondary {
            background-color: #f5f5f5 !important;
        }

        /* timeline */
        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline > li {
            margin: 20px 40px;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }

        .word-break {
            word-break: inherit;
        }

        .cursor-pointer{
            cursor:pointer;
        }
    </style>
</head>
<body style="background-color: #f2f2f2!important;">
    <!-- Top Nav Bar -->
    <?php require '../user/subheader.php' ?>
    <!-- End Top NavBar -->

    <!-- Content here -->
    <div class="container bg-white mt-5">
        <div class="row">
            <div class="col-1 mt-3 cursor-pointer" onclick="window.history.back();">
                <svg t="1603184269921" class="icon custome-cursor-pointer gobackButton" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3167" width="32" height="32"><path d="M153.858 493.991 528.321 868.42c0 0 37.435-74.63 37.435-76.056 0-0.181-299.557-298.575-299.557-298.364 0 0.716 299.557-299.645 299.557-299.561 0 0.768-37.435-74.886-37.435-74.886L153.858 493.991zM303.898 456.568l598.849 0 0 74.875L303.898 531.443l-37.699-37.444L303.898 456.568z" p-id="3168"></path></svg>Back                
            </div>
            <div class="col-7 mt-3"></div>
            <div class="col-4 mt-3">
                <span class="pl-2 pr-2"><?php echo $order_id;?></span> 
                <span class="pl-2 pr-2">|</span>
                <span class="pl-2 pr-2" style="color:#CD5C5C"><?php echo $order_status;?></span>
            </div>
        </div>
        <div class="card-body">
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
              <div class="step completed" id="PlaceOrder">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-cart"></i></div>
                </div>
                <h4 class="step-title">Place Order</h4>
                <!-- <h5 class="step-title text-muted">(2020 11 04 05:20 pm)</h5> -->
              </div>
              <div class="step" id="PaidOrder">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-cash"></i></div>
                </div>
                <h4 class="step-title">Paid Order</h4>
              </div>
              <div class="step" id="ProcessingOrder">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-config"></i></div>
                </div>
                <h4 class="step-title">Processing Order</h4>
              </div>
              <div class="step" id="ShipOrder">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-plane"></i></div>
                </div>
                <h4 class="step-title">Shipping Order</h4>
              </div>
              <div class="step" id="ReceivedOrder">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-gift"></i></div>
                </div>
                <h4 class="step-title">Received Order</h4>
              </div>
              <div class="step" id="DeliveryOrder">
                <div class="step-icon-wrap" >
                  <div class="step-icon"><i class="pe-7s-home"></i></div>
                </div>
                <h4 class="step-title">Product Delivered</h4>
              </div>
            </div>
        </div>
        <!-- 如果到那个阶段了 就加class complete in css -->

        <!-- address - shipping place -->
        <div class="row border border-left-0 border-right-0 border-bottom-0">
            <div class="col-12">
                <h3 class="font-weight-bold">Delivery Address</h3>
            </div>
            
            <div class="col ml-4 mr-4 mt-4">
                <div class="row">
                <table class="table table-bordered shadow-sm bg-white rounded">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $received_name;?></th>
                            <th scope="col">(+60- <?php echo $received_phone;?>)</th>
                            <th scope="col">
                                <?php echo $received_address?>&sbquo;&nbsp;
                                <?php echo $received_city?>&sbquo;&nbsp;
                                <?php echo $received_state?>&sbquo;&nbsp;
                                <?php echo $received_postalCode?>&sbquo;&nbsp;
                                <?php echo $received_country?>
                            </th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>

        <hr>

        <?php
            if( ($order_cart_status == "shipping") || ($order_cart_status == "closed") ){
                if($order_unfied == "0"){
                    $trackIdSql = "SELECT * FROM `track` WHERE orderId = '$order_id'";
                }else if($order_unfied == "1"){
                    $trackIdSql = "SELECT * FROM `track` WHERE trackIntegrationId = '$cart_id'";
                }
                $resultTrackIdSql = $conn->query($trackIdSql); 
                if($resultTrackIdSql->num_rows>0){
                    while($row = $resultTrackIdSql->fetch_assoc()){
                        $trackId = $row['trackId'];
                    }
                }else{
                    $trackId = " ";
                }
        ?>
        <div class="">
            <h3 class="font-weight-bold">Track Timeline</h3>
                <div class="row mt-4 border border-left-0 border-right-0 mt-2">
                    <div class="col-2 border border-left-0 border-top-0 border-bottom-0">
                            <div class="row mt-3 ml-1"  style="word-break: break-all;">
                                Standard Delivery 
                            </div>
                            <div class="row mt-1 ml-1" style="color:#CD5C5C;word-break: break-all;">
                               <?php echo $trackId;?>
                            </div>

                    </div>
                    <div class="col-10 mt-2">
                        <ul class="timeline">
                            <?php
                                if($order_unfied == "0"){
                                    $trackPackage = "SELECT *,trackhistory.created_time AS 'processTime', trackhistory.status AS 'processStatus' FROM `trackhistory` LEFT JOIN trackintegration ON trackhistory.trackCartIntegrationId = trackintegration.trackIntegrationId LEFT JOIN track ON track.orderId = trackintegration.orderId WHERE trackhistory.trackOrderId = '$order_id' GROUP BY trackhistory.status ORDER BY trackhistory.created_time DESC";
                                }else if($order_unfied == "1"){
                                    $trackPackage = "SELECT *,trackhistory.created_time AS 'processTime', trackhistory.status AS 'processStatus' FROM track LEFT JOIN trackhistory ON track.trackId = trackhistory.trackCartIntegrationId WHERE track.trackIntegrationId = '$cart_id' GROUP BY trackhistory.status ORDER BY trackhistory.created_time DESC";
                                }
                                $resultTrackPackage = $conn->query($trackPackage);
                                if($resultTrackPackage ->num_rows>0){
                                    while($row = $resultTrackPackage ->fetch_assoc()){
                                        $monthAndDay = date("d F",strtotime($row['processTime']));
                                        $year = date("Y",strtotime($row['processTime']));
                                        $time = date("h:i a",strtotime($row['processTime']));
                                        $packageStatus = $row['processStatus'];
                                        $currentLocation = $row['location'];    

                                        if($packageStatus == "In Transit"){
                            ?>
                            <li>
                                <a class="text-capitalize text-decoration-none"><?php echo $packageStatus;?></a>
                                <a class="float-right text-decoration-none"><?php echo $monthAndDay;?>, <?php echo $year;?>   <span><?php echo $time;?></a>
                                <p>Shipment designated to <?php echo $received_state;?> [<?php echo $received_state;?> Warehouse]
                                    <br><span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span>
                                </p>
                            </li>
                            <?php
                                        }else if($packageStatus == "pending"){
                            ?>
                            <li>
                                <a class="text-capitalize text-decoration-none"><?php echo $packageStatus;?></a>
                                <a class="float-right text-decoration-none"><?php echo $monthAndDay;?>, <?php echo $year;?>  <span><?php echo $time;?></a>
                                <p>Shipment arrived at [<?php echo $received_state;?> Warehouse] , MALAYSIA station.
                                    <br><span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span>
                                </p>
                            </li>
                            <?php
                                        }else if($packageStatus == "picked up"){
                            ?>
                            <li>
                                <a class="text-capitalize text-decoration-none"><?php echo $packageStatus;?></a>
                                <a class="float-right text-decoration-none"><?php echo $monthAndDay;?>, <?php echo $year;?>  <span><?php echo $time;?></a>
                                <p>Your parcel has been succesfully picked up by <?php echo $received_state;?> Warehouse (Tracking ID: <?php echo $trackId;?>)
                                    <br><span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span>
                                </p>
                            </li>
                            <?php
                                        }else if($packageStatus == "Out Of Delivery"){
                            ?>
                            <li>
                                <a class="text-capitalize text-decoration-none"><?php echo $packageStatus;?></a>
                                <a class="float-right text-decoration-none"><?php echo $monthAndDay;?>, <?php echo $year;?>  <span><?php echo $time;?></a>
                                <p>Your parcel is now out for delivery. 
                                    <br><span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span>
                                </p>
                            </li>
                            <?php
                                        }else if($packageStatus == "Closed"){
                            ?>
                            <li>
                                <a class="text-capitalize text-decoration-none"><?php echo $packageStatus;?></a>
                                <a class="float-right text-decoration-none"><?php echo $monthAndDay;?>, <?php echo $year;?>  <span><?php echo $time;?></a>
                                <p>Your parcel has been delivered succesfully.  You parcel received by [ <span class="text-primary font-weight-bold"><?php echo $row['userReceiverName'];?></span> ] 
                                    <br><span><?php echo $currentLocation;?> MALAYSIA, MALAYSIA</span>
                                </p>
                            </li>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </ul>                    
                    </div>
                </div>
        </div>
        <?php
            }
        ?>

        <!-- product place  -->
        <div class="mt-2">
            <h3 class="font-weight-bold">Product Detail</h3>
            <div class="col-12 bg-white mt-4">

                <?php 
                    $getOrderProduct = "SELECT cartintegration.*, orderlist.*, product.* FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId LEFT JOIN product ON cartintegration.productId = product.id WHERE cartintegration.cartIntegrationId = '$cart_id' AND orderlist.orderId = '$order_id'";
                    $resultGetOrderProduct=$conn->query($getOrderProduct);

                    if($resultGetOrderProduct->num_rows>0){
                        while($row = $resultGetOrderProduct->fetch_assoc()){
                            $cart_variation = $row['variation'];
                            $cart_qty = $row['quantity'];
                            $cart_status = $row['status'];
                            $cart_name = $row['name'];
                            $cart_price = $row['price'];
                            $cart_image = $row['coverImage'];
                            $cart_productId = $row['id'];

                            if($cart_variation != " "){
                                $cart_variation = "Variation: ($cart_variation)";
                            }
                ?>
                <div style="border: 1px solid rgba(0,0,0,.1)"></div>
                <div class="row mt-3 mb-3">
                    <div class="col-2">
                        <a href="productDetail.php?productId=<?php echo $cart_productId;?>">
                        <img src="../images/productImage/<?php echo $cart_image;?>" alt="" class="w-100 h-100">
                        </a>
                    </div>
                    <div class="col-8 p-3">
                        <div class="col text-break text-decoration-none">
                            <a href="productDetail.php?productId=<?php echo $cart_productId;?>">
                            <?php echo $cart_name;?>
                            </a>
                        </div>
                        <div class="col text-muted"><?php echo $cart_variation;?></div>
                        <div class="col">x <?php echo $cart_qty;?></div>
                    </div>
                    <div class="col-2 p-3">
                        <span style="color:#CD5C5C;" class=""> RM <?php echo $cart_qty*$cart_price;?></span> 
                        <br>
                        <span class="badge badge-pill badge-secondary mt-2 mb-2" style="font-size:14px;"><?php echo $cart_status;?></span>
                        <br>
                        <!-- <a href="cancelOrder.php?productId=<?php echo $order_cartIntegrationId;?>" class="text-decoration-none">Cancel Order</a> -->
                    </div>
                </div>

                <?php
                        }
                    }
                ?>

                <!-- Purchase Detail -->
                <div class="row" style="border-top:1px solid rgba(0,0,0,0.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Payment Method :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-normal word-break"><?php echo $payment_method;?></span>
                    </div>
                </div>
                <div class="row" style="border-top:1px solid rgba(0,0,0,0.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Payment Status :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-normal word-break"><?php echo $payment_status;?></span>
                    </div>
                </div>
                <div class="row" style="border-top:1px solid rgba(0,0,0,0.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Order Date & Time :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-normal word-break" style="font-size:20px"><?php echo $new_order_date;?></span>
                    </div>
                </div>
                <div class="row" style="border-top:1px solid rgba(0,0,0,0.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Payment Date & Time :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-normal word-break" style="font-size:20px"><?php echo $new_payment_updateTime;?></span>
                    </div>
                </div>
                <div class="row" style="border-top:1px dotted rgba(0,0,0,.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Merchandise Subtotal :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-normal word-break" style="font-size:20px"> RM <?php echo $payment_subtotal;?></span>
                    </div>
                </div>
                <div class="row" style="border-top:1px dotted rgba(0,0,0,.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Shipping Fee :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-normal word-break" style="font-size:20px">  RM <?php echo $payment_subtotal_fee;?></span>
                    </div>
                </div>
                <div class="row" style="border-top:1px dotted rgba(0,0,0,.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Shipping Discount :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-normal word-break" style="font-size:20px"> - RM <?php echo $payment_discount_delivery;?></span>
                    </div>
                </div>
                <div class="row mb-3" style="border-top:1px dotted rgba(0,0,0,.3);border-left:1px solid rgba(0,0,0,0.3);border-right:1px solid rgba(0,0,0,0.3);border-bottom:1px solid rgba(0,0,0,.3);background:#f3f3f1;">
                    <div class="col-6"></div>
                    <div class="col-3 pt-2 text-right p-3" style="border-right:1px dotted rgba(0,0,0,.3)">
                        <span style="font-size:1rem" class="word-break"> Order Total :</span>
                    </div>
                    <div class="col-3 text-right p-3">
                        <span class="font-weight-bold word-break" style="color:#CD5C5C;font-size:20px"> RM <?php echo $order_amount;?></span>
                    </div>
                </div>
                <!-- <div class="row mt-3 mb-5">
                    <div class="col-12">   
                        <a href="cancelOrder.php?productId=<?php echo $order_cartIntegrationId;?>" class="btn btn-outline-info btn-lg pull-right ml-2 mb-4">Cancel Order</a>
                        <button type="button" class="btn btn-outline-info btn-lg pull-right ml-2 mb-4">Cancel Order</button>
                    </div>
                </div> -->
            </div>
        </div>

</body>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        var status = "<?php echo $order_status;?>";
        var cartStatus = "<?php echo $order_cart_status;?>";

        // console.log(status);
        if((status == "TO PAY") || (cartStatus == "unpaid")){
            $("#PaidOrder").addClass("completed");

        }else if((status == "TO SHIP") && ( (cartStatus == "submitted") || (cartStatus == "comfirm") || (cartStatus == "packging") )){
            $("#PaidOrder").addClass("completed");
            $("#ProcessingOrder").addClass("completed");

        }else if((status == "TO SHIP") && (cartStatus == "shipping")){
            $("#PaidOrder").addClass("completed");
            $("#ProcessingOrder").addClass("completed");
            $("#ShipOrder").addClass("completed");

        }else if(status == "TO RECEIVE"){
            var trackStatus = "<?php echo $order_track_status;?>";
            if(trackStatus == "Out Of Delivery"){
                $("#PaidOrder").addClass("completed");
                $("#ProcessingOrder").addClass("completed");
                $("#ShipOrder").addClass("completed");
                $("#ReceivedOrder").addClass("completed"); 
            }else{
                $("#PaidOrder").addClass("completed");
                $("#ProcessingOrder").addClass("completed");
                $("#ShipOrder").addClass("completed");
            }
            

        }else if(status == "COMPLETED"){
            $("#PaidOrder").addClass("completed");
            $("#ProcessingOrder").addClass("completed");
            $("#ShipOrder").addClass("completed");
            $("#ReceivedOrder").addClass("completed");
            $("#DeliveryOrder").addClass("completed");
        }
        // $("button").click(function(){
        //     $("p:first").addClass("intro");
        // });
    });
</script>
</html>