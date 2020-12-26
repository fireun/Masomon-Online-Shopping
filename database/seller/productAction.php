<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");// current year-month-days hours:minut:seconts

//remove product - for all product page
if( isset($_GET['removeId']) ){
    $remove_product_id = $_GET['removeId'];
    $updateRemoveStatus ="UPDATE `product` SET `status`= 'remove', `uploadTime`= '$date' WHERE id = '$remove_product_id'";
    $resultUpdateRemoveStatus = $conn->query($updateRemoveStatus);

    if($resultUpdateRemoveStatus == true){
        $_SESSION['m'] = "remove-product-success-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back()</script>";
    }else{
        $_SESSION['m'] = "remove-product-failed-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back()</script>";
    }
}

//recover product status - for all product page
if( isset($_GET['recoverId']) ){
    $recover_product_id = $_GET['recoverId'];

    $updateRecoverStatus ="UPDATE `product` SET `status`= '', `uploadTime`= '$date' WHERE id = '$recover_product_id'";
    $resultUpdateRecoverStatus = $conn->query($updateRecoverStatus);

    if($resultUpdateRecoverStatus == true){
        $_SESSION['m'] = "recover-product-success-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back()</script>";
    }else{
        $_SESSION['m'] = "recover-product-failed-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back()</script>";
    }
}

//delete product - all order page
if( isset($_GET['deleteId']) ){
    $delete_product_id = $_GET['deleteId'];

    $updateRecoverStatus ="UPDATE `product` SET `status`= 'delete', `uploadTime`= '$date' WHERE id = '$delete_product_id'";
    $resultUpdateRecoverStatus = $conn->query($updateRecoverStatus);

    if($resultUpdateRecoverStatus == true){
        $_SESSION['m'] = "delete-product-success-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back()</script>";
    }else{
        $_SESSION['m'] = "delete-product-failed-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back()</script>";
    }
}

//delete product variation - edit product
if(isset($_GET['deleteVariationId'])){
    $delete_VariationId = $_GET['deleteVariationId'];
    $delete_Edit_Product_Id = $_GET['editProduct'];

    $deleteStatement = "DELETE FROM variation WHERE variationId = '$delete_VariationId'";
    $resultDeleteStatement = $conn->query($deleteStatement);

    if($resultDeleteStatement == true){
        $_SESSION['m'] = "delete-product-success-notic-01";
        $_SESSION['m_last_action'] = time();
    }else{
        $_SESSION['m'] = "delete-product-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }

    echo "<script>window.history.back();</script>";
    // header("location: ../../business/createProduct.php?edit-product-id=$delete_Edit_Product_Id");
}


//delete product image - edit product
if(isset($_GET['deleteMultiMediaId'])){
    $delete_Edit_Mutlimedia_mediaId_Product_Id = $_GET['deleteMultiMediaId'];
    $delete_Edit_Mutlimedia_Product_Id = $_GET['editProduct'];

    $deleteStatement = "DELETE FROM productmedia WHERE mediaId = '$delete_Edit_Mutlimedia_mediaId_Product_Id'";
    $resultDeleteStatement = $conn->query($deleteStatement);

    if($resultDeleteStatement == true){
        $_SESSION['m'] = "delete-product-success-notic-01";
        $_SESSION['m_last_action'] = time();
    }else{
        $_SESSION['m'] = "delete-product-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }
    echo "<script>window.history.back();</script>";
    // header("location: ../../business/createProduct.php?edit-product-id=$delete_Edit_Mutlimedia_Product_Id");
}


//update new coverImage
if(isset($_POST['updateNewCoverImage'])){
    $update_coverimage_productId = $_POST['updateProductId'];
    $update_cover_image = basename($_FILES["newCoverImage"]["name"]); 
    $update_escape_product_coverImage = mysqli_real_escape_string($conn,basename($_FILES["newCoverImage"]["name"]));

    if(!empty($_FILES['newCoverImage']['name'])){
        $updateNewCoverImageStatement ="UPDATE `product` SET `coverImage`= '$update_escape_product_coverImage', `uploadTime`= '$date' WHERE id = '$update_coverimage_productId'";
        $resultUpdateNewCoverImageStatement = $conn->query($updateNewCoverImageStatement);
        
        if($resultUpdateNewCoverImageStatement == true){
             $target_dir = '../../images/productImage/'; //images floder name destination
             $target = $target_dir.$update_cover_image;//get destination + original image name
             move_uploaded_file($_FILES["newCoverImage"]["tmp_name"],$target);//cover image
             
             $_SESSION['m'] = "update-product-success-notic-01";
             $_SESSION['m_last_action'] = time();
        }else{
            $_SESSION['m'] = "update-product-failed-notic-01";
             $_SESSION['m_last_action'] = time();
        }
    }else{
        $_SESSION['m'] = "update-product-failed-notic-01";
         $_SESSION['m_last_action'] = time();
    }
    echo "<script>window.history.back();</script>";
    // header("location: ../../business/createProduct.php?edit-product-id=$update_coverimage_productId");
   
}


//update cartIntegration Status - for changeOrderStatusModal
if(isset($_POST['updateCartIntegrationStatus'])){
    $update_cart_staus_cartIntegrationId = $_POST['cartIntegrationId'];
    $update_cart_staus_option = $_POST['selectUpdateStatus'];
    $update_cart_staus_cartId = $_POST['cartId'];

    $updateCartStatusSql = "UPDATE `cartintegration` SET `status`= '$update_cart_staus_option', `update_time`= '$date' WHERE cartIntegrationId = '$update_cart_staus_cartIntegrationId'";
    $resultUpdateCartStatusSql = $conn->query($updateCartStatusSql);

    if($resultUpdateCartStatusSql == true){

        if($update_cart_staus_option == "shipping"){
            $checkExitsOrder = "SELECT * FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.cartId = '$update_cart_staus_cartId' AND ( cartintegration.status = 'submitted' OR cartintegration.status = 'packging')";
            $resultCheckOrder = $conn->query($checkExitsOrder);

            if($resultCheckOrder ->num_rows == '0'){ //no more 
                $updateOrderStatus = "UPDATE orderlist SET status = 'waiting receive', update_time = '$date' WHERE cartId = '$update_cart_staus_cartId'";
                $resultUpdateOrderStatus  = $conn->query($updateOrderStatus );
            }

            $getDetail = "SELECT * FROM `cartintegration` LEFT JOIN cart ON cart.cartId = cartintegration.cartId LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId LEFT JOIN seller ON cartintegration.sellerId = seller.sellerId WHERE cartintegration.cartIntegrationId = '$update_cart_staus_cartIntegrationId'";
            $resultGetDetail = $conn->query($getDetail);
            if($resultGetDetail ->num_rows>0){
                while($row = $resultGetDetail ->fetch_assoc()){
                    $order_id = $row['orderId'];
                    $order_unifiedDelivery = $row['unifiedDelivery'];
                    $shipForm = $row['state'];
                    $shipId = $row['shipId'];
                }

                $trackIntegrationId = uniqid("TrackIntegration",true);
                $trackId = uniqid("Track");
                $trackHistoryId = uniqid("TrackHistory",true);
                $status="In Transit";
                $estimateArrived = date("Y-m-d H:i:s", strtotime($date . '+ 7 day'));

                if($order_unifiedDelivery == "0"){
                    $insertToTrackIntegration = "INSERT INTO `trackintegration`(`trackIntegrationId`, `cartIntegrationId`, `orderId`, `shipId`, `currentLocation`, `status`, `estimate_Arrived`, `created_time`, `update_time`) VALUES ('$trackIntegrationId', '$update_cart_staus_cartIntegrationId', '$order_id', '$shipId','$shipForm', '$status', '$estimateArrived', '$date', '$date')";
                    $resultInsertToTrackIntegration = $conn->query($insertToTrackIntegration);
                    $temporyTrackId = $trackIntegrationId;
                    
                    $checkSameTrack  = "SELECT * FROM `track` WHERE orderId = '$order_id'";
                    $resultCheckSameTrack = $conn->query($checkSameTrack);
                    if($resultCheckSameTrack ->num_rows>0){
                        $updateAvailable = "UPDATE `track` SET `currentLocation`='$shipForm',`status`='$status',`estimate_Arrived`='$estimateArrived', `update_time`='$date' WHERE orderId = '$order_id'";
                        $resultUpdatedTrack = $conn->query($updateAvailable); 
                        
                    }else{
                        $insertToTrack = "INSERT INTO `track`(`trackId`, `orderId`, `trackIntegrationId`, `unifiedDelivery`, `userReceiverName`, `adminReceiveName`, `shipId`, `currentLocation`, `userReceiverDate`, `adminPickUpDate`, `status`, `estimate_Arrived`, `created_time`, `update_time`) VALUES ('$trackId', '$order_id', '$update_cart_staus_cartIntegrationId', 'Agree', '', '', '$shipId', '$shipForm', '', '', '$status', '$estimateArrived', '$date', '$date')";
                        $resultInsertToTrack = $conn->query($insertToTrack); 
                    }

                }else if($order_unifiedDelivery == "1"){
                    $insertToTrack = "INSERT INTO `track`(`trackId`, `orderId`, `trackIntegrationId`, `unifiedDelivery`, `userReceiverName`, `adminReceiveName`, `shipId`, `currentLocation`, `userReceiverDate`, `adminPickUpDate`, `status`, `estimate_Arrived`, `created_time`, `update_time`) VALUES ('$trackId', '$order_id', '$update_cart_staus_cartIntegrationId', 'Disagree', '', '', '$shipId', '$shipForm', '', '', '$status', '$estimateArrived', '$date', '$date')";
                    $resultInsertToTrack = $conn->query($insertToTrack); 
                    $temporyTrackId = $trackId;
                }
                
                $insertTrackHistory = "INSERT INTO `trackhistory`(`trackHistoryId`, `trackOrderId`, `trackCartIntegrationId`, `location`, `status`, `created_time`, `update_time`) VALUES ('$trackHistoryId', '$order_id', '$temporyTrackId', '$shipForm', '$status', '$date', '$date')";
                $resultInsertTrackHistory = $conn->query($insertTrackHistory);

            }
            
        }

        $_SESSION['m'] = "update-status-success-notic-01";
        $_SESSION['m_last_action'] = time();
    }else{
        $_SESSION['m'] = "update-status-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }
    
    echo "<script>window.history.back();</script>";
}


//update cancel Order Status - for view all cancel order page
if(isset($_POST['updateCancelStatus'])){
    $update_cancel_order_id = mysqli_real_escape_string($conn,$_POST['cartIntegrationId']);
    $update_cancel_order_select =  mysqli_real_escape_string($conn,$_POST['selectUpdateStatus']);
    $update_cancel_actionMethod =  mysqli_real_escape_string($conn,$_POST['actionMethod']);

   
    if($update_cancel_order_select == "approve"){
        if($update_cancel_actionMethod == "cancel"){
            $update_cancel_order_rejectReason = " ";

            $getPrice = "SELECT SUM(product.price * cartintegration.quantity) AS 'productPrice', cartintegration.* FROM `cartintegration` LEFT JOIN product ON cartintegration.productId = product.id WHERE cartIntegrationId = '$update_cancel_order_id'";
            $resultGetPrice = $conn->query($getPrice);
            if($resultGetPrice ->num_rows > 0){
                while($row = $resultGetPrice ->fetch_assoc()){
                    $cancel_cartPrice = $row['productPrice'];
                    $cancel_cart_id = $row['cartId'];
                }

                $checkExitsOrder = "SELECT * FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId WHERE cartintegration.cartId = '$cancel_cart_id' AND cartintegration.cancelRequest = '0'";
                $resultCheckOrder = $conn->query($checkExitsOrder);

                if($resultCheckOrder ->num_rows > 0){
                    while($row = $resultCheckOrder ->fetch_assoc()){
                        $amount = $row['amount'];
                        $cancelOrderId = $row['orderId'];
                    }
                    $newAmount = $amount - $cancel_cartPrice;
                   //if one product in this order
                   $updateCancelOrder = "UPDATE orderlist SET amount = '$newAmount', update_time = '$date' WHERE cartId = '$cancel_cart_id'";
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
                            $newCacnel_subtotal = $cancel_subtotal - $cancel_cartPrice;
                            $newCancel_subtotal_Fee = $cancel_subtotal_Fee - $sF;
                            $newCancel_Total = $newCacnel_subtotal + $newCancel_subtotal_Fee; 

                            $updateCancelPayment = "UPDATE `payment` SET `order_item`= '$newCancel_OrderItem',`subtotal`='$newCacnel_subtotal',`subtotal_Fee`='$newCancel_subtotal_Fee',`Total`='$newCancel_Total', `update_time`='$date' WHERE `order_id`='$cancelOrderId'";
                            $resultUpdateCancelPayment = $conn->query($updateCancelPayment);
                        }
                   }
                }
            }//end cal price

        }else if($update_cancel_actionMethod == "return"){
             $update_cancel_order_rejectReason =  mysqli_real_escape_string($conn,$_POST['approveShip']);
        }
    }else if($update_cancel_order_select == "reject"){
        $update_cancel_order_rejectReason =  mysqli_real_escape_string($conn,$_POST['rejectReason']);
    }

    if($update_cancel_actionMethod == "cancel"){
        $sql = "  AND action = 'cancel'";
    }else if($update_cancel_actionMethod == "return"){
        $sql = "  AND action = 'return'";
    }

    $updateCancelOrderSql = "UPDATE `actioncenter` SET `actionStatus`= '$update_cancel_order_select', `actionSellerComment`='$update_cancel_order_rejectReason', `update_time`= '$date' WHERE cartIntegrationId = '$update_cancel_order_id' ".$sql."";
    $resultUpdateCancelOrderSql = $conn->query($updateCancelOrderSql);

    if($resultUpdateCancelOrderSql == true){

        if($update_cancel_order_select == "reject"){

            if($update_cancel_actionMethod == "cancel"){
                $updateCartIntegrationSqlCancel = "UPDATE `cartintegration` SET `cancelRequest`= 0, `update_time`= '$date' WHERE cartIntegrationId = '$update_cancel_order_id'";
                $resultUpdateCartIntegrationSqlCancel = $conn->query($updateCartIntegrationSqlCancel);
            
            }else if($update_cancel_actionMethod == "return"){
                $updateCartIntegrationSql = "UPDATE `cartintegration` SET `returnRequest`= 0, `update_time`= '$date' WHERE cartIntegrationId = '$update_cancel_order_id'";
                $resultUpdateCartIntegrationSql = $conn->query($updateCartIntegrationSql);
            }
        }

        $_SESSION['m'] = "update-status-success-notic-01";
        $_SESSION['m_last_action'] = time();
    }else{
        $_SESSION['m'] = "update-status-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }
    
    echo "<script>window.history.back();</script>";
}

//update order cart status - for orderDetail.php?orderId= &cartIntegrationId=
if(isset($_POST['updateOrderCartIntegrationStatus'])){
}



//update product stock - for viewAllProduct.php
if(isset($_POST['updateProductStock'])){
    $updateStock_productId = $_POST['productId'];
    $updateStock_productStock = $_POST['productStock'];

    $update_spaceInventory = $updateStock_productStock * 0.1;   
    $update_stock = $updateStock_productStock - $update_spaceInventory; 

    $updateStockSql = "UPDATE `inventory` SET `totalStock`= '$updateStock_productStock', `stock`='$update_stock', `spaceInventory` = '$update_spaceInventory',`recordDate`= '$date' WHERE productId = '$updateStock_productId'";
    $resultUpdateSql = $conn->query($updateStockSql);

    if($resultUpdateSql == true){
        $_SESSION['m'] = "update-stock-success-notic-01";
        $_SESSION['m_last_action'] = time();
    }else{
        $_SESSION['m'] = "update-stock-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }
    
    echo "<script>window.history.back();</script>";

}


//post new comment - orderDetail.php
if(isset($_POST['postNewComment'])){
    $newComment_generateCommentId = uniqid("Comment-");
    $newComment_ratingId = $_POST['ratingId'];
    // $newComment_FileBaseName = basename($_FILES["commentFeedback"]["name"]); 
    $newComment_commentText = mysqli_real_escape_string($conn,$_POST['commentText']);
    $sellerId = $_SESSION['sellerId'];

    $insertNewComment = "INSERT INTO `comment`(`commentId`, `ratingId`, `comment_personId`, `commentText`, `created_time`, `update_time`) VALUES ('$newComment_generateCommentId','$newComment_ratingId','$sellerId','$newComment_commentText','$date','$date')";
    $resultInsertComment = $conn->query($insertNewComment);

    if($resultInsertComment == true){

        //check if insert media
        if(!empty($_FILES['commentFeedback']['name'][0])){

            foreach($_FILES['commentFeedback']['name'] as $key=>$insertFile){
                $feedback_media_id = uniqid("Feedback-");
                $filetype = " ";
            
                $target_dir = '../../images/feedback-images/'; //images floder name destination
                $target = $target_dir.$insertFile;//get destination + original image name
                $images_extensions_arr = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF");
                $video_extensions_arr = array("mp4","mp3","avi","3gp","mov","mpeg","wma","MP4","MP3","AVI","3GP","MOV","MPEG","WMA");
            
                $getFileType = pathinfo($_FILES['commentFeedback']['name'][$key],PATHINFO_EXTENSION); //get file type
                
                if( in_array($getFileType,$video_extensions_arr) ){
                    $filetype = "video";
                }else if( in_array($getFileType,$images_extensions_arr) ){
                    $filetype = "image";
                }else{
                    $_SESSION['m_last_action'] = time();
                    $_SESSION['m'] = "insert-comment-image-media-type-invalid-notic-01";
                    echo "<script>window.history.back();</script>";//wrong file type
                }
            
                if(move_uploaded_file($_FILES['commentFeedback']['tmp_name'][$key], $target)){
                    // Insert record
                    $insertImage = "INSERT INTO `feedback_image`(`feedbackId`, `feedback_sourceId`, `feedback_location`, `feedback_filetype`, `created_time`, `update_time`) VALUES ('$feedback_media_id','$newComment_generateCommentId','$insertFile','$filetype','$date','$date')";
                    $resultInsertImage =$conn->query($insertImage);
                }
            }   
        } //end check empty media 

        $_SESSION['m'] = "insert-comment-success-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back();</script>";  
    }   
}

// ------------------------------------------------------------------------------------------------------------------------------------------


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $output= " ";

    //show auction Recorde - for viewAllAuctionProduct.php
    if($action == "viewAuctioRecord"){
        $auctionRecordId = $_POST['auctionId'];
        $countRow = 0;
        $checkAvaliableAnyBid = "SELECT auctionrecord.*, user.userName, product.name FROM `auctionrecord` LEFT JOIN user on auctionrecord.userId = user.userId LEFT JOIN product ON auctionrecord.productId = product.id WHERE productId = '$auctionRecordId' ORDER BY bid DESC";
        $resultCheckAvaliableAnyBid = $conn->query($checkAvaliableAnyBid);

        if(mysqli_num_rows($resultCheckAvaliableAnyBid)>0){
            while($row = mysqli_fetch_array($resultCheckAvaliableAnyBid)){
            $auction_Date_Format = date('d-m-Y h:i:s a',strtotime($row['date']));
              
              $countRow++;

              $output .= '
                <tr>
                    <td>'.$countRow.'</td>
                    <td>'.$row['userName'].'</td>
                    <td>'.$row['bid'].'</td>
                    <td>'.$auction_Date_Format.'</td>
                </tr>
             ';

            }
        }else{
            $output .= '
                <tr class="text-center">
                    <td colspan="6" >
                        No participants yet
                    </td>
                </tr>
            ';
        }




        //search & filter - for all order page
    }else if($action == "searchOrder"){
        $Order_page = 0;
        $sellerId = $_SESSION['sellerId'];

        if(!empty($_POST['id'])){
            $Order_id = $_POST['id'];
            $OrderIdSql = " AND orderlist.orderId LIKE '%$Order_id%'";
        }else{
            $OrderIdSql = " ";
        }

        if(!empty($_POST['filterName'])){
            $orderSearchName = $_POST['filterName'];
            $OrderNameSql = " AND product.name LIKE '%$orderSearchName%'";        
        }else{
            $OrderNameSql = " ";
        }

        if(!empty($_POST['filterPrice'])){
            $Order_search_price = $_POST['filterPrice'];
            if($Order_search_price != "normal"){
                $OrderPriceSql = " ORDER BY cartintegration.quantity * product.price $Order_search_price";
            }else{
                $OrderPriceSql = " ";
            }
        }else{
            $OrderPriceSql = " ";
        }

        if(!empty($_POST['filterStatus'])){
            $Order_search_status = $_POST['filterStatus'];
            if($Order_search_status != "all"){
                $OrderStatusSql = " AND cartintegration.status = '$Order_search_status'";
            }else{
                $OrderStatusSql = " ";
            }
        }else{
            $OrderStatusSql = " ";
        }

        if(!empty($_POST['filterDate'])){
            $Order_search_orderDate = date('Y-m-d 00:00:00',strtotime($_POST['filterDate']));
            $Order_search_orderDate_after = date('Y-m-d 00:00:00', strtotime($Order_search_orderDate . ' + 1 days') );
            
            $OrderDateSql = " AND (orderlist.created_time >= '$Order_search_orderDate' AND orderlist.created_time <= '$Order_search_orderDate_after') ";
        }else{
            $OrderDateSql = " ";
        }

        if(!empty($_POST['filterRowData'])){
            $Order_search_showRow = $_POST['filterRowData'];
            if($Order_search_showRow == "all"){
                $OrderRowSql = " ";
            }else{
                $OrderRowSql = " LIMIT 0,$Order_search_showRow";
            }
        }else{
            $OrderRowSql = " LIMIT 0,5";
        }

        $orderFun = " ORDER BY cartintegration.created_time DESC";
        $combinaOrderFilter = "SELECT cartintegration.*, orderlist.orderId,  orderlist.created_time, orderlist.created_time AS 'orderDate', product.name, cartintegration.quantity*product.price AS 'totalPrice' FROM cartintegration LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId LEFT JOIN product ON cartintegration.productId = product.id WHERE cartintegration.sellerId = '$sellerId' AND cartintegration.status != 'unpaid' AND cartintegration.status != '' AND cartintegration.cancelRequest = '' AND cartintegration.returnRequest ='' ".$OrderIdSql.$OrderNameSql.$OrderStatusSql.$OrderDateSql.$OrderPriceSql.$orderFun.$OrderRowSql."";
        $resultCombinaFilterOrder = $conn->query($combinaOrderFilter) or die('<tr class="text-center"><td colspan="8"> No Found Result </td></tr>');
        
        if(mysqli_num_rows($resultCombinaFilterOrder)>0){
            while($row = mysqli_fetch_array($resultCombinaFilterOrder)){
                $search_order_id = $row['orderId'];
                $search_order_name = $row['name'];
                $search_order_status = $row['status'];
                $search_order_date = $row['orderDate'];
                $search_order_date_Format = date('Y-m-d h:i:s a',strtotime($search_order_date));
                
                if( strlen( $search_order_name ) > 40 ) {
                    $search_order_name = substr( $search_order_name, 0, 40 ) . '...';
                }
                
                //hightlight
                if(!empty($_POST["id"])) {
                    $search_order_id = highlightKeywords($row["orderId"],$_POST["id"]);
                }

                if(!empty($_POST["filterName"])) {
                    $search_order_name = highlightKeywords($row["name"],$_POST["filterName"]);
                }

                if(!empty($_POST["filterStatus"])) {
                    $search_order_status = highlightKeywords($row["status"],$_POST["filterStatus"]);
                }

                if(!empty($_POST["filterDate"])) {
                    $search_order_date_Format = highlightKeywords($search_order_date_Format,$_POST["filterDate"]);
                }


                $output .='
                    <tr>
                        <td>
                            '. $search_order_id .'
                        </td>
                        <td>
                            '. $search_order_name .'
                        </td>
                        <td>
                            '. $row["variation"] .'
                        </td>
                        <td>
                            '. $row["quantity"] .'
                        </td>
                        <td>
                            RM '. $row["totalPrice"] .'
                        </td>
                        <td>
                            '. $search_order_date_Format  .'
                        </td>
                        <td>
                            '. $search_order_status .'
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="orderDetail.php?orderId='.$row['orderId'].'&cartIntegrationId='.$row['cartIntegrationId'].'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Detail" ><i class="fas fa-eye"></i></a>
                ';
                if( ($search_order_status != "closed") && ($search_order_status != "shipping")){
                    $output .='
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuOrderPage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <!-- <span class="sr-only">Toggle Dropdown</span> -->
                                </button>
                                <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuOrderPage">
                                <button class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#changeOrderStatusModal" value="'.$row['cartIntegrationId'].'" data-id="'. $row['cartId'] .'" onclick="updateOrderStatus(this)">Edit Status</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    ';
                }//end check order status
            }
        }else{
            $output .= '
                <tr>
                    <td colspan="8" class="text-center">
                        No Found Result
                    </td>
                </tr>
            ';
        }//end this filter

        //show cart status - for changeCartStatus Page
    }else if($action == "showCartIntegrationStatus"){
        $showOrderStatus_cartIntegrationId = $_POST['cartIntegrationId'];
        $showOrderStatusSql = "SELECT * FROM cartintegration WHERE cartIntegrationId = '$showOrderStatus_cartIntegrationId'";
        $resultShowOrderStatusSql = $conn->query($showOrderStatusSql) or die('<option class="text-center" disable>No Found Result</option>');

        if(mysqli_num_rows($resultShowOrderStatusSql)>0){
            while($row = mysqli_fetch_array($resultShowOrderStatusSql)){
                $showStatus = $row['status'];

                if($showStatus == "submitted"){
                    $output .='
                        <option selected> -- Choose One Option --</option>
                        <option value="packging">Packging</option>
                        <option value="shipping">Shipping</option
                    ';
                }else if($showStatus == "packging"){
                    $output .='
                        <option selected value="shipping">Shipping</option
                    ';
                }
            }
        }
    }else if($action == "showStockContent"){
        $showStock_productId = $_POST['productId'];
        $showStock = "SELECT * FROM inventory WHERE productId = '$showStock_productId'";
        $resultShowStock = $conn->query($showStock);
        if(mysqli_num_rows($resultShowStock)>0){
            while($row = mysqli_fetch_array($resultShowStock)){
                $output .='
                        <input type="number" name="productStock"  min="10" max="999" class="form-control"  onkeypress="return isNumber(event)" placeholder="Product Stock (miniman 10 & maximun 999)" value="'.$row['totalStock'].'" required>
                    ';
            }
        }
    }


    echo $output;

}//end all




//hight light search text 2
function highlightKeywords($text, $keyword) {
    $wordsAry = explode(" ", $keyword);
    $wordsCount = count($wordsAry);
    
    for($i=0;$i<$wordsCount;$i++) {
        $highlighted_text = "<span style='font-weight:bold;background:yellow'  class='rounded p-1'>$wordsAry[$i]</span>";
        $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
    }

    return $text;
}
