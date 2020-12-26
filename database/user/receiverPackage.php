<?php
include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");

if(isset($_GET['productId'])){
    $cartIntegrationID = $_GET['productId'];
    $orderId = $_GET['order'];

    $checkUnified = "SELECT * FROM cartintegration LEFT JOIN cart ON cartintegration.cartId = cart.cartId WHERE cartintegration.cartIntegrationId = '$cartIntegrationID'";
    $result = $conn->query($checkUnified);
    if($result ->num_rows>0){
        while($row = $result ->fetch_assoc()){
            $check_unifiedDelivery = $row['unifiedDelivery'];
            $check_cartId = $row['cartId'];
        }

        //agree, check track status is donr closed or no 
        if($check_unifiedDelivery == "0"){
            $trackPackage = "SELECT * FROM `track` WHERE orderId = '$orderId' AND status = 'Closed'";

        //diagree, check track status is done closed just update userReceiverTime
        }else if($check_unifiedDelivery == "1"){
            $trackPackage = "SELECT * FROM `track` WHERE trackIntegrationId = '$cartIntegrationID' AND status ='Closed'";
        }

        $resultTrackPackage = $conn->query($trackPackage);
        if($resultTrackPackage ->num_rows>0){
            while($row = $resultTrackPackage ->fetch_assoc()){
                $trackId = $row['trackId'];
            }

            //update user receiver date( conmfirm receiver )
            $updateTrackClosed = "UPDATE `track` SET `userReceiverDate`= '$date' WHERE `trackId` = '$trackId'";
            $resultUpdateTrackPackage = $conn->query($updateTrackClosed);

            if($resultUpdateTrackPackage == true){ //update cartintegration status, check order available order in process

                $checkOtherOrder = "SELECT * FROM `cartintegration` LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE orderlist.orderId = '$orderId' AND cartintegration.status != 'shipping' AND cartintegration.cancelRequest = '0' AND cartintegration.returnRequest = '0'";
                $resultCheckOtherOrder = $conn->query($checkOtherOrder);
                if($resultCheckOtherOrder ->num_rows < 1){
                    $updateOrderstatus = "UPDATE `orderlist` SET `status`='closed', `update_time`='$date' WHERE `orderId`='$orderId'";
                    $resultUpdateOrderStatus = $conn->query($updateOrderstatus);
                }

                //update cartintegration status
                if($check_unifiedDelivery == "0"){
                    $updateCartStatusAgree = "UPDATE `cartintegration` SET `status`='closed', `update_time`='$date' WHERE cartId = '$check_cartId' AND cancelRequest = '0' AND returnRequest = '0'";
                    $resultUpdateCartStatus = $conn->query($updateCartStatusAgree);

                }else if($check_unifiedDelivery == "1"){
                    $updateCartStatusDisagree = "UPDATE `cartintegration` SET `status`='closed', `update_time`='$date' WHERE cartIntegrationId = '$cartIntegrationID'";
                    $resultUpdateCartStatusDisagree = $conn->query($updateCartStatusDisagree);
                }

                $_SESSION['m'] = "update-comfirm-status-success-Notic-001";
                $_SESSION['m_last_action'] = time();
                echo "<script>window.history.back()</script>";   

            }else{ //package never closed status
                $_SESSION['m'] = "update-track-Package-status-Failed-Notic-001";
                $_SESSION['m_last_action'] = time();
                echo "<script>window.history.back()</script>";
            }
            
        }else{ //package never closed status
            $_SESSION['m'] = "update-track-Package-status-Failed-Notic-001";
            $_SESSION['m_last_action'] = time();
            echo "<script>window.history.back()</script>";
        }
        
       
    }
}