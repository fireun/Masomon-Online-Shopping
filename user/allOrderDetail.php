<?php
include("../config.php");
include '../limitTimeSession.php';

if(isset($_POST['logout'])){
    session_destroy();
    echo "<script>alert('logout success !!!');
    window.location.href= '../user/home.php';</script>";
}
date_default_timezone_set("Asia/Kuala_Lumpur");
$date =  date("Y-m-d H:i:s");

if($_GET['orderID']){
    $order_id = $_GET['orderID'];
    $getOrderDetail = "select orderlist.*, COUNT(cartintegration.cartIntegrationId) AS 'TotalItem' from orderlist LEFT JOIN cartintegration ON orderlist.cartId = cartintegration.cartId where orderlist.orderId = '$order_id'";
    $resultGetOrderDetail=$conn->query($getOrderDetail);

    if($resultGetOrderDetail->num_rows>0){
        while($row = $resultGetOrderDetail->fetch_assoc()){
            $order_id = $row['orderId'];
            $order_cartId = $row['cartId'];
            $order_shipId = $row['shipId'];
            $order_amount = $row['amount'];
            // $order_return = $row['returnRequest'];
            // $order_cancel = $row['cancelRequest'];
            $order_status = $row['status'];
            $order_date = $row['created_time'];
            $order_item = $row['TotalItem'];
            
        }
    }

    $PalcedOrderDate = date('d-m-Y h:i:s a',strtotime($order_date));


    if($order_status == "waiting pay"){
        $order_status = "TO PAY";

    }else if($order_status == "waiting receive"){
        $order_status = "TO RECEIVE";

    }else if($order_status == "closed"){
        $order_status = "COMPLETED";
    
    }else if($order_status == "waiting comfirm" || $order_status = "waiting ship" ){
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
        }
    }else{
        header("Location: ../user/404.html");
        die();
    }
}else{
    header("Location: ../user/404.html");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
    
    <link rel="stylesheet" href="../css/reset.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #f2f2f2!important;">

    <!-- top nav bar -->
    <?php require '../user/subheader.php' ?>
    <!-- End top nav bar -->

    <!-- content here -->
    <div class="container" style="margin-top:5%;">

        <!-- Part One -->
        <div class="row shadow-sm p-3 mb-3 bg-white rounded">
            <div class="col-8">
                <?php echo $order_id;?> <br>
                <span class="text-muted">Place On <?php echo $PalcedOrderDate;?></span>
            </div>
            <div class="col-4 pt-2 pl-4">
                <div class="row float-right">
                    <h5 class="pr-3"><span class="text-muted">Item:</span> <?php echo $order_item;?></h5>
                    |
                    <h5 class="pl-3 "><span class="text-muted">Total:</span> RM <?php echo $payment_total;?></h5> 
                </div>

            </div>
        </div>

        <!-- Part Two -->
        <?php 
        $printOrderProduct = "SELECT cartintegration.status AS 'cartStatus', cartintegration.*, cartintegration.update_time AS 'statusUpdateDate', product.*, orderlist.update_time AS 'orderDate' FROM orderlist LEFT JOIN cartintegration ON orderlist.cartId = cartintegration.cartId LEFT JOIN product ON cartintegration.productId = product.id WHERE orderlist.orderId = '$order_id' ORDER BY cartintegration.created_time DESC";
        $resultPrintOrderDetail=$conn->query($printOrderProduct);
    
        if($resultPrintOrderDetail->num_rows>0){
            while($row = $resultPrintOrderDetail->fetch_assoc()){
                $cart_id = $row['cartIntegrationId'];
                $cart_status = $row['cartStatus'];
                $cart_variation = $row['variation'];
                $cart_qty = $row['quantity'];
                $cart_ReturnRequest = $row['returnRequest'];
                $cart_CancelRequest = $row['cancelRequest'];
                $cart_name = $row['name'];
                $cart_price = $row['price'];
                $cart_image = $row['coverImage'];
                $cart_update_time = $row['statusUpdateDate'];
                $product_id = $row['id'];
                $product_type = $row['auctionStatus'];
                $returnDate = $row['orderDate'];


                if($cart_variation != " "){
                    $cart_variation = "Variation: ($cart_variation)";
                }

                if($cart_status == NULL){
                    $cart_status = "Processing";
                }else if(($cart_status == "closed") || ($cart_status == "shipping")){
                    $return_valid_time = date('d-m-Y h:i:s a',strtotime($cart_update_time));
                    $estimated_valid_return_time = date('D M d-m-Y', strtotime($return_valid_time . ' + 14 days') );//D=days星期几 M=month j=1-31号
                
                }

                $checkReturnAndCancel = "SELECT * FROM actioncenter WHERE cartIntegrationId = '$cart_id' AND actionStatus = 'approve'";
                $resultCheckReturnAndCancel = $conn->query($checkReturnAndCancel);
    
                if($resultCheckReturnAndCancel->num_rows>0){

                }else{

        ?>
        <div class="row shadow-sm p-3 mb-3 bg-white rounded">
            <div class="row col-sm-12">
                <div class="col-2 col-sm-3">
                    <a href="productDetail.php?productId=<?php echo $product_id;?>">
                        <img src="../images/productImage/<?php echo $cart_image;?>" alt="" width="150" hieght="120">
                    </a>
                </div>
                <div class="col-3 col-sm-4 mt-4">
                    <div class="col">
                        <a href="productDetail.php?productId=<?php echo $product_id;?>" class="text-decoration-none text-dark">
                            <?php echo $cart_name;?></div>
                        </a>
                    <div class="col"><?php echo $cart_variation;?></div>
                </div>
                <div class="col-2 col-sm-2 mt-4">
                    <h5><span class="text-muted">Qty:</span> <?php echo $cart_qty;?></h5>
                </div>
                <div class="col-2 col-sm-1 mt-4">
                    <h5>RM <?php echo $cart_price * $cart_qty;?></h5>
                </div>
                <div class="col-3 col-sm-2 mt-4">
                    <span class="badge badge-pill badge-secondary" style="font-size:14px;"><?php echo $cart_status;?></span><br>
                    <a href="orderDetail.php?cart=<?php echo $cart_id;?>&order=<?php echo $order_id;?>" class="text-decoration-none pt-2">Track Package</a>
                    <?php 
                        if(($cart_status == "comfirm") || ($cart_status == "Processing") || ($cart_status == "submitted") || ($cart_status == "unpaid") || ($cart_status == "packging")){
                            if($cart_CancelRequest == "0"){
                    ?>
                            <br>
                            <a href="cancelOrder.php?productId=<?php echo $cart_id;?>" class="text-decoration-none pt-2">Cancel</a>

                    <?php
                            }else if($cart_CancelRequest == "1"){
                    ?>
                            <br>
                            <a href="cancelOrder.php?productId=<?php echo $cart_id;?>&action=view" class="text-decoration-none pt-2">Cancel</a>
                    <?php
                            }
                        }else if( ($cart_status == "shipping") || ($cart_status == "closed") ){
                            if($cart_status == "shipping"){
                    ?>
                            <a href="../database/user/receiverPackage.php?productId=<?php echo $cart_id;?>&order=<?php echo $order_id;?>" class="text-decoration-none  ml-1 mr-1">Comfirm Receive</a>
                    <?php
                            }
                            if($returnDate > $date){
                                if($cart_ReturnRequest == "0"){
                    ?>
                        <br>
                        <a href="returnProduct.php?productId=<?php echo $cart_id;?>" value="<?php echo $cart_id;?>" class="text-decoration-none pt-2">Return Request</a>
                        <br>
                        <small>Valid Until: <span class="text-danger">* <?php echo $estimated_valid_return_time;?></span></small>
                    <?php
                                }else if($cart_ReturnRequest == "1"){
                    ?>
                    <br>
                        <a href="returnProduct.php?productId=<?php echo $cart_id;?>&action=view" value="<?php echo $cart_id;?>" class="text-decoration-none pt-2">Return Request</a>
                    <?php
                                }
                          }//check is over valid time or no
                        }
                        
                        if($cart_status == "unpaid"){
                    ?>
                        <br>
                        <a href="../database/user/repaid.php?ORDER=<?php echo $order_id;?>&amount=<?php echo $order_amount;?>" class="text-decoration-none pt-2">Go Pay</a>
                    <?php
                        }

                        if($cart_status == "closed"){   
                            if($product_type == "no"){
                    ?>
                        <br>
                        <a href="../database/user/buyAgain.php?cartIntegrationID=<?php echo $cart_id;?>"  class="text-decoration-none pt-2 buyAgainBtnJs">Buy Again</a>
                        <!-- <input type="hidden" name="cartIntegrationID" value="<?php echo $cart_id;?>"> -->
                        <br>
                        <a href="review.php?productId=<?php echo $cart_id;?>" class="text-decoration-none pt-2">Review</a>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
                }//end 
            }
        }
        ?>



        <?php 
        if(($cart_status == NULL) && ($order_status = "waiting pay")){
            $_SESSION['Total'] = $payment_total;
        ?>
        <!-- Unpaid Part -->
        <div class="row shadow-sm p-3 mb-3 bg-white rounded">
            <div class="col-8">
                <h3>UnPaid Order</h3> 
            </div>
            <div class="col-4">
                <div class="row float-right">
                    <h5 class="pr-3 pt-2"><span class="text-muted">Total:</span> RM <?php echo $payment_total;?></h5> 
                    <a href="../database/user/repaid.php?ORDER=<?php echo $order_id;?>" class="text-decoration-none btn btn-outline-success">GO PAY</a>
                </div>

            </div>
        </div>
        <?php
        }
        ?>


        <!-- Part Three -->
        <div class="row">
            <div class="col shadow-sm p-3 mb-3 mr-3 bg-white rounded">
                <h5>Shipping Address | Biling Address</h5> <br>  
                <?php echo $received_name;?> <br>
                (+60-<?php echo $received_phone;?>) <br>
                <?php echo $received_address?>&#44;
                <?php echo $received_city?>&#44;
                <?php echo $received_state?>&#44; <br>
                <?php echo $received_postalCode?>&#44;
                <?php echo $received_country?> <br>
            </div>

            <div class="col shadow-sm p-3 mb-3 bg-white rounded">
               <h5>Total Summary</h5>
               <div class="row">
                    <div class="col">Payment Method</div>
                    <div class="col ml-3"><?php echo $payment_method;?></div>
               </div>
               <div class="row">
                    <div class="col">Merchandise Subtotal</div>
                    <div class="col ml-3">RM <?php echo $payment_subtotal;?></div>
               </div>
               <div class="row">
                    <div class="col">Shipping Fee</div>
                    <div class="col ml-3">RM <?php echo $payment_subtotal_fee;?></div>
               </div>
               <div class="row">
                    <div class="col">Discount Delivery</div>
                    <div class="col">- RM <?php echo $payment_discount_delivery;?></div>
               </div>
               <div class="row">
                    <div class="col">Total</div>
                    <div class="col ml-3">RM <?php echo $payment_total;?></div>
               </div>
            </div>
        </div>
    </div>


    <?php 
    if(isset($_SESSION['m'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
    <?php } ?>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script><!-- Sweet Alert JS  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script><!--Ajaxx-->
<script>

    //sweet alert
    var flashdata = $('.flash-data').data('flashdata');
    if(flashdata == "BuyAgain-Success-Alert-01"){
        Swal.fire(
            'Add To Cart Success!',
            'Your buy again action is accepted!',
            'success'
        )
    }else if(flashdata == "BuyAgain-Failed-Alert-01"){
        Swal.fire({
            icon: 'error',
            title: 'Oops...Buy Again Failed',
            text: 'Something went wrong!',
            footer: '<a href>Why do I have this issue?</a>'
        })
    }else if(flashdata == "update-comfirm-status-success-Notic-001"){
        Swal.fire(
            'Update Comfirm Receiver Success!',
            'Thank You Purchase This Product!',
            'success'
        )
    }else if(flashdata == "update-track-Package-status-Failed-Notic-001"){
        Swal.fire({
            icon: 'error',
            title: 'Oops...Comfirm Receiver Failed',
            text: 'Something went wrong!',
            footer: '<a href>Why do I have this issue?</a>'
        })
    }
// $(document).ready(function(){
//     $(".buyAgainBtnJs").click(function(e){
//       BuyAgainUrl = $(this).attr('href');
//       console.log(BuyAgainUrl); / can be removed just included for testing
//       e.preventDefault();
      
//         $.ajax({
//             url:"../database/user/buyAgain.php",
//             method:"POST",
//             data:{cartIntegrationID:BuyAgainUrl}, /this is what data send between hyperlink
//             success:function(data)
//             {
//                 / console.log(data);
//             / $('#displayCancelContent').html(data); /show in this dynaimic_content place
//             }
//         }); 
//     });  
// });
</script>
</html>
