<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
$date =  date("Y-m-d H:i:s");


if(isset($_POST['cancelOrder'])){
    $generateCancelId = uniqid("Cancel-");
    $cancelCartIntegrationId = mysqli_real_escape_string($conn,$_POST['cartIntegrationId']);
    $cancelCartId = mysqli_real_escape_string($conn,$_POST['cartId']);
    $cancelCartPrice = mysqli_real_escape_string($conn,$_POST['cartPrice']);    
    $cancelCartStatus = mysqli_real_escape_string($conn,$_POST['cartStatus']);
    $cancelReason = mysqli_real_escape_string($conn,$_POST['reasonOption']);
    $cancelAddtionalreason = mysqli_real_escape_string($conn,$_POST['cancelText']);
    $action = "cancel";
    $actionStatus_forinsert = "approve";

    $checkAvaiableCancelCart = "SELECT * FROM actioncenter WHERE cartIntegrationId = '$cancelCartIntegrationId' AND action = 'cancel'";
    $resultCheckAvailbleCancelCart = $conn->query($checkAvaiableCancelCart);
    
    if($resultCheckAvailbleCancelCart ->num_rows == '0'){
        //update cancel requet to cart
        $updateCancelCart = "UPDATE cartintegration SET cancelRequest = '1' WHERE cartIntegrationId = '$cancelCartIntegrationId'";
        $resultUpdateCancelCart = $conn->query($updateCancelCart);

        if($resultUpdateCancelCart == true){
            //check any more product in order


            if($cancelCartStatus == "packging"){
                $actionStatus_forinsert = "pending";//neeed seller approve
            
            }else{
                $checkExitsOrder = "SELECT * FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.cartId = '$cancelCartId' AND cartintegration.cancelRequest = '0'";
                $resultCheckOrder = $conn->query($checkExitsOrder);

                if($resultCheckOrder ->num_rows > 0){
                    while($row = $resultCheckOrder ->fetch_assoc()){
                        $amount = $row['amount'];
                        $cancelOrderId = $row['orderId'];
                    }
                    $newAmount = $amount - $cancelCartPrice;
                   //if one product in this order
                   $updateCancelOrder = "UPDATE orderlist SET amount = '$newAmount', update_time = '$date' WHERE cartId = '$cancelCartId'";
                   $resultUpdateCancelOrder = $conn->query($updateCancelOrder);

                   if($resultUpdateCancelOrder == true){

                        $minutPayment = "SELECT * FROM payment WHERE order_id = '$cancelOrderId'";
                        $resultCheckPayment = $conn->query($minutPayment);
                        if($resultCheckPayment ->num_rows > 0){
                            while($row = $resultCheckPayment ->fetch_assoc()){
                                $cancel_order_item = $row['order_item'];
                                $cancel_subtotal = $row['subtotal'];
                                $cancel_subtotal_Fee = $row['subtotal_Fee'];
                                $cancel_total = $row['Total'];
                            }
                            $Item = '1';
                            $sF = '5.00';
                            $newCancel_OrderItem  = $cancel_order_item - $Item;
                            $newCacnel_subtotal = $cancel_subtotal - $cancelCartPrice;
                            $newCancel_subtotal_Fee = $cancel_subtotal_Fee - $sF;
                            $newCancel_Total = $newCacnel_subtotal + $newCancel_subtotal_Fee; 

                            $updateCancelPayment = "UPDATE `payment` SET `order_item`= '$newCancel_OrderItem',`subtotal`='$newCacnel_subtotal',`subtotal_Fee`='$newCancel_subtotal_Fee',`Total`='$newCancel_Total', `update_time`='$date' WHERE `order_id`='$cancelOrderId'";
                            $resultUpdateCancelPayment = $conn->query($updateCancelPayment);
                        }
                   }

                }else{
                    //if one product in this order
                    $updateCancelOrder = "UPDATE orderlist SET status = 'closed', update_time = '$date' WHERE cartId = '$cancelCartId'";
                    $resultUpdateCancelOrder = $conn->query($updateCancelOrder);
                }
            }
            $insertCancelSql = "INSERT INTO actioncenter(actionId, cartIntegrationId, action, actionReason, actionAddtionalReason, actionStatus, created_time, update_time) VALUES ('$generateCancelId', '$cancelCartIntegrationId', '$action', '$cancelReason', '$cancelAddtionalreason', '$actionStatus_forinsert', '$date', '$date')";
            $resultInsertCancel = $conn->query($insertCancelSql);

            if($resultInsertCancel == true){
                $_SESSION['m_last_action'] = time();
                $_SESSION['m'] = "Cancel-Product-Successful-01-Notic";
                header("Location: ../../user/cancelOrder.php?productId=$cancelCartIntegrationId&action=view");
            }  
        }//end update cart cancenl request

    //end Check Available cartintegrationId in table
    }else{
        $_SESSION['m_last_action'] = time();
        $_SESSION['m'] = "Cancel-Request-Exist-InProcessing-01-Notic";
        header("Location: ../../user/cancelOrder.php?productId=$cancelCartIntegrationId&action=view");
    }

}
//end cancel



//for return
if(isset($_POST['returnProduct'])){
    $returnEstimatedValidTime = $_POST['validTime'];// in 14 days
    $returnCartId = mysqli_real_escape_string($conn,$_POST['cartId']);
    $returnCartIntegrationId = mysqli_real_escape_string($conn,$_POST['cartIntegrationId']);
    $returnCartStatus = mysqli_real_escape_string($conn,$_POST['cartStatus']);
    $returnReason = mysqli_real_escape_string($conn,$_POST['reasonOption']);
    $returnAddtionalReason = mysqli_real_escape_string($conn,$_POST['addtionalReason']);
    $returnId = uniqid("Return-");
    $returnRequestStatus = "pending";
    $action = "return";

    $today = date('Y-m-d');
    if($returnCartStatus == "closed"){
        if($today <= $returnEstimatedValidTime){

            //check already in table or no
            $checkAvaiableReturnCart = "SELECT * FROM actioncenter WHERE cartIntegrationId = '$returnCartIntegrationId' AND action = 'return'";
            $resultCheckAvailbleReturnCart = $conn->query($checkAvaiableReturnCart);
            if($resultCheckAvailbleReturnCart ->num_rows == '0'){

                $updateReturnCart = "UPDATE cartintegration SET returnRequest = '1' WHERE cartIntegrationId = '$returnCartIntegrationId'";
                $resultUpdateReturnCart = $conn->query($updateReturnCart);
                if($resultUpdateReturnCart == true){
                    //check any more product in order
                    // $checkExitsOrder = "SELECT * FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.cartId = '$returnCartId' AND cartintegration.returnRequest = '0' AND cartintegration.cancelRequest = '0'";
                    // $resultCheckOrder = $conn->query($checkExitsOrder);
                
                    // if($resultCheckOrder ->num_rows == '0'){
                    //     //if one product in this order
                    //     $updateCancelOrder = "UPDATE orderlist SET status = 'closed', update_time = '$date' WHERE cartId = '$returnCartId'";
                    //     $resultUpdateCancelOrder = $conn->query($updateCancelOrder);
                    // }

                    //check if insert media
                    if(!empty($_FILES['input44']['name'][0])){

                        foreach($_FILES['input44']['name'] as $key=>$insertFile){
                            $generateFeedbackId = uniqid("Feedback-");
                        
                            $target_dir = '../../images/feedback-images/'; //images floder name destination
                            $target = $target_dir.$insertFile;//get destination + original image name
                            $images_extensions_arr = array("jpg","jpeg","png","gif");
                            $video_extensions_arr = array("mp4","avi","3gp","mov","mpeg","wma");
                        
                            $getFileType = pathinfo($_FILES['input44']['name'][$key],PATHINFO_EXTENSION); //get file type
                        
                            if( in_array($getFileType,$video_extensions_arr) ){
                                $filetype = "video";
                            }else if( in_array($getFileType,$images_extensions_arr) ){
                                $filetype = "image";
                            }else{
                                $_SESSION['m_last_action'] = time();
                                $_SESSION['m'] = "Insert-Midea-Failed-type-01-Notic";
                                echo "<script>window.history.back();</script>";//wrong file type
                            }
                        
                            if(move_uploaded_file($_FILES['input44']['tmp_name'][$key], $target)){
                                // Insert record
                                $insertImage = "INSERT INTO feedback_image(feedbackId, feedback_sourceId, feedback_location, feedback_fileType,created_time, update_time) VALUES('".$generateFeedbackId."','".$returnId."','".$insertFile."', '".$filetype."', '".$date."','".$date."')";
                                $resultInsertImage =$conn->query($insertImage);
                            }
                        }   
                    } //end check empty media 

                    $insertReturnSql = "INSERT INTO actioncenter(actionId, cartIntegrationId, action, actionReason, actionAddtionalReason, actionStatus, created_time, update_time) VALUES ('$returnId', '$returnCartIntegrationId', '$action', '$returnReason', '$returnAddtionalReason', '$returnRequestStatus', '$date', '$date')";
                    $resultInsertReturnSql = $conn->query($insertReturnSql);
                    
                    if($resultInsertReturnSql == true){
                        $_SESSION['m_last_action'] = time();
                        $_SESSION['m'] = "Return-Request-Successful-Submitted-01-Notic";
                        header("Location: ../../user/returnProduct.php?productId=$returnCartIntegrationId&action=view");
                    }  

                }else{ //return failerd
                    $_SESSION['m_last_action'] = time();
                    $_SESSION['m'] = "Return-Request-Failed-01-Notic";
                    echo "<script>window.history.back()</script>";
                }
            }else{
                $_SESSION['m_last_action'] = time();
                $_SESSION['m'] = "Return-Request-Exist-InProcessing-01-Notic";
                header("Location: ../../user/returnProduct.php?productId=$returnCartIntegrationId&action=view");
            }

        }else{ //over 14 days
            $_SESSION['m_last_action'] = time();
            $_SESSION['m'] = "Return-Request-Over-requestDays-01-Notic";
            header("Location: ../../user/returnProduct.php?productId=$returnCartIntegrationId");
        }

 

    }else{ //no closed status
        //check already in table or no
        $checkAvaiableReturnCart = "SELECT * FROM actioncenter WHERE cartIntegrationId = '$returnCartIntegrationId' AND action = 'return' ";
        $resultCheckAvailbleReturnCart = $conn->query($checkAvaiableReturnCart);
        if($resultCheckAvailbleReturnCart ->num_rows == '0'){
            
            $updateReturnCart = "UPDATE cartintegration SET returnRequest = '1' WHERE cartIntegrationId = '$returnCartIntegrationId'";
            $resultUpdateReturnCart = $conn->query($updateReturnCart);
            if($resultUpdateReturnCart == true){
                //check any more product in order
                // $checkExitsOrder = "SELECT * FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.cartId = '$returnCartId' AND cartintegration.returnRequest = '0' AND cartintegration.cancelRequest = '0'";
                // $resultCheckOrder = $conn->query($checkExitsOrder);
    
                // if($resultCheckOrder ->num_rows == '0'){
                //     //if one product in this order
                //     $updateCancelOrder = "UPDATE orderlist SET status = 'closed', update_time = '$date' WHERE cartId = '$returnCartId'";
                //     $resultUpdateCancelOrder = $conn->query($updateCancelOrder);
                // }

                //check if insert media
                if(!empty($_FILES['input44']['name'][0])){

                    foreach($_FILES['input44']['name'] as $key=>$insertFile){
                        $generateFeedbackId = uniqid("Feedback-");
            
                        $target_dir = '../../images/feedback-images/'; //images floder name destination
                        $target = $target_dir.$insertFile;//get destination + original image name
                        $images_extensions_arr = array("jpg","jpeg","png","gif");
                        $video_extensions_arr = array("mp4","avi","3gp","mov","mpeg","wma");
            
                        $getFileType = pathinfo($_FILES['input44']['name'][$key],PATHINFO_EXTENSION); //get file type
            
                        if( in_array($getFileType,$video_extensions_arr) ){
                            $filetype = "video";
                        }else if( in_array($getFileType,$images_extensions_arr) ){
                            $filetype = "image";
                        }else{
                            $_SESSION['m_last_action'] = time();
                            $_SESSION['m'] = "Insert-Midea-Failed-type-01-Notic";
                            echo "<script>window.history.back();</script>";//wrong file type
                        }
            
                        if(move_uploaded_file($_FILES['input44']['tmp_name'][$key], $target)){
                            // Insert record
                            $insertImage = "INSERT INTO feedback_image(feedbackId, feedback_sourceId, feedback_location, feedback_fileType,created_time, update_time) VALUES('".$generateFeedbackId."','".$returnId."','".$insertFile."', '".$filetype."', '".$date."','".$date."')";
                            $resultInsertImage =$conn->query($insertImage);
                        }
                    }   
                } //end check empty media 

                $insertReturnSql = "INSERT INTO actioncenter(actionId, cartIntegrationId, action, actionReason, actionAddtionalReason, actionStatus, created_time, update_time) VALUES ('$returnId', '$returnCartIntegrationId', '$action', '$returnReason', '$returnAddtionalReason', '$returnRequestStatus', '$date', '$date')";
                $resultInsertReturnSql = $conn->query($insertReturnSql);
    
                if($resultInsertReturnSql == true){
                    $_SESSION['m_last_action'] = time();
                    $_SESSION['m'] = "Return-Request-Successful-Submitted-01-Notic";
                    header("Location: ../../user/returnProduct.php?productId=$returnCartIntegrationId&action=view");
                }  

            }else{ //return failerd
                $_SESSION['m_last_action'] = time();
                $_SESSION['m'] = "Return-Request-Failed-01-Notic";
                echo "<script>window.history.back()</script>";
            }
        }else{
            $_SESSION['m_last_action'] = time();
            $_SESSION['m'] = "Return-Request-Exist-InProcessing-01-Notic";
            header("Location: ../../user/returnProduct.php?productId=$returnCartIntegrationId&action=view");
        }
    }//end cart status check
}//end return
?>