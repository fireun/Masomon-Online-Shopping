<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");

// ../database/PayPal/charge.php\\
//../database/user/paymentCash.php"
// echo '<script>window.alert("PlaceOrder")</script>';
// $_SESSION['totalAmount']; 
if($_POST['PaymentMethod'] == " ") {
    echo '<script>window.history(-1)</script>';
}else{

    $generateOrderId = uniqid("OrderID-");
    $generatePaymentId = uniqid("PaymentID-");
    $cart_id = $_SESSION['Page_link_Id'];//cart ID
    $user_id = $_SESSION['userId'];
    $ship_id = $_SESSION['newShipId']; //ship_id

    $OrderItem = $_SESSION['i'];
    $Subtotal = $_SESSION['subtotal'];
    $SubShipFee = $_SESSION['SubShipTotal'];
    $total = $_SESSION['Total'];
    $status = "waiting pay";
    
    if($ship_id == "noAddress"){
        $_SESSION['m_last_action'] = time();      
        $_SESSION['m'] = "Place-Order-Failed-NoShipAddress-01";
        echo "<script>window.history.back();</script>";
    }else{

    if($_SESSION['DiscountUifiedDelivery'] == ' '){
        $Discount = " ";    
    }else{
        $Discount = $_SESSION['DiscountUifiedDelivery'];   
    }
    
    // get payment method
    if($_POST['PaymentMethod'] == "CashOnDelivery"){
        $paymentMethod = "Cash On Delivery";
        $status = "waiting comfirm";
        $status_payment = "unpaid"; //approve = agress confirm order / unpaid = until before payment done /  completed = the order is done cash on delivery
    }else{
        $paymentMethod = "PayPal";
        $status_payment = " ";
        // echo "<script>window.location.href= ' ../PayPal/charge.php';</script>";
    }

    //get Ship id
    // if($_SESSION['newShipId'] == " "){
    //     $userId = $_SESSION['userId'];
    //     $getShip = "select * from address_shipping where user_id = '$userId'";
    //     $resultGetShip=$conn->query($getShip);

    //     if($resultGetShip->num_rows>0){
    //         while($row = $resultGetShip->fetch_assoc()){
    //             $_SESSION['newShipId'] = $row['ship_id'];
    //         }
    //     }
    // }

    //save orderlist 
    $CountQuantity = "SELECT cart.cartId, cartintegration.productId, cartintegration.quantity, inventory.totalStock, inventory.stock, inventory.spaceInventory, product.soldRecord AS 'Sold' FROM cart left join cartintegration on cart.cartId = cartintegration.cartId LEFT JOIN product on cartintegration.productId = product.id LEFT JOIN inventory on cartintegration.productId = inventory.productId WHERE cart.userId = '$user_id' AND cart.cartId = '$cart_id'";
    $resultCountQuantity = $conn->query($CountQuantity);
                                
    if($resultCountQuantity->num_rows > 0){ //over 1 database(record) so run
        while($row = $resultCountQuantity->fetch_assoc()){
            $ProductId = $row['productId'];
            $CartQty = $row['quantity'];
            $ProductTotalStock = $row['totalStock'];
            $ProductStock = $row['stock'];
            $ProductSpaceInventory = $row['spaceInventory'];
            $ProductSold = $row['Sold'];


            //notic seller need add more stock => over stock //now using space stock
            if($CartQty >= $ProductStock){
                //send email to seller
                // echo "Stock Warning!!";
                $NewStock = $ProductTotalStock - $CartQty;            
                // echo $Stock = $ProductSpaceInventory + $NewStock; 
                $updateNewStock = "UPDATE inventory SET stock = '$NewStock', spaceInventory = '0',totalStock = '$NewStock' WHERE productId = '$ProductId'";
                $resultUpdateNewStock=$conn->query($updateNewStock);
            
            }else{
                $PassNewStock = $ProductStock - $CartQty; 
                $NewProductTotalStock = $PassNewStock + $ProductSpaceInventory;            
                $updateStock = "UPDATE inventory SET stock = '$PassNewStock', totalStock = '$NewProductTotalStock' WHERE productId = '$ProductId'";
                $resultUpdateStock=$conn->query($updateStock);
            }
            $newProductSold = $ProductSold + $CartQty;
            //updated stock
            $updateSaleRecord = "UPDATE product SET soldRecord = '$newProductSold' WHERE id = '$ProductId'";
            $resultUpdateSaleRecord = $conn->query($updateSaleRecord);
            
        }

        //MAKE INSERT
        $insertOrder = "INSERT INTO orderlist (orderId, userId, cartId, shipId, amount, status, created_time, update_time)
        VALUES ('$generateOrderId', '$user_id', '$cart_id', '$ship_id', '$total', '$status', '$date', '$date')";
        
        $insertPayment = "INSERT INTO payment (payment_id, order_id, paymentMethod, order_item, subtotal, subtotal_Fee, Discount_Delivery, Total, paypal_payer_id, paypal_payment_id, status, created_time, update_time)
        VALUES ('$generatePaymentId', '$generateOrderId', '$paymentMethod', '$OrderItem', '$Subtotal', '$SubShipFee', '$Discount', '$total', '', '','$status_payment', '$date', '$date')";
        
        $resultInsertOrder = $conn->query($insertOrder);
        $resultInsertPayment = $conn->query($insertPayment);
    
        if($resultInsertOrder == true && $resultInsertPayment == true){
            
            if($_POST['PaymentMethod'] == "CashOnDelivery"){
                $cart_status = "submitted";
                $updateCartStatus = "update cartintegration set status = '$cart_status', update_time = '$date' where cartId = '$cart_id'";
                $resultupdateCartStatus = $conn->query($updateCartStatus);
    
                if($resultupdateCartStatus == true){
                    $_SESSION['m_last_action'] = time();      
                    $_SESSION['m'] = "Place-Order-Success-PaymentMethod-CashOnDelivery-01";
                    echo "<script>window.location.href= ' ../../user/purchasePage.php';</script>";
                }
            }else if($_POST['PaymentMethod'] == "Paypal"){
    
                $cart_status = "unpaid";
                $_SESSION['paypalcartId'] = $cart_id;
                $updateCartStatus = "update cartintegration set status = '$cart_status', update_time = '$date' where cartId = '$cart_id'";
                $resultupdateCartStatus = $conn->query($updateCartStatus);
    
                $_SESSION['GenerateOrderID'] = $generateOrderId;
                echo "<script>window.location.href= ' ../PayPal/charge.php';</script>";
            }
    
            unset($_SESSION['Page_link_Id']);
            unset($_SESSION['newShipId']);
            unset($_SESSION['i']);
            unset($_SESSION['subtotal']);
            unset($_SESSION['SubShipTotal']);
            unset($_SESSION['DiscountUifiedDelivery']);
    
        }else{
            $_SESSION['m_last_action'] = time();      
            $_SESSION['m'] = "Place-Order-Failed-01";
            echo "<script>window.history.back();</script>";
        }
    

    }



    // echo nl2br("$ProductId \n $CartQty \n $ProductStock \n $ProductSpaceInventory \n");

    // echo nl2br("$NewStock");

//     UPDATE
//     Table_A
// SET
//     Table_A.col1 = Table_B.col1,
//     Table_A.col2 = Table_B.col2
// FROM
//     Some_Table AS Table_A
//     INNER JOIN Other_Table AS Table_B
//         ON Table_A.id = Table_B.id
// WHERE
//     Table_A.col3 = 'cool'
    }
}