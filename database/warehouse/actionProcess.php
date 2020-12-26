<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");// current year-month-days hours:minut:seconts

$warehouseAdminId = $_SESSION['warehouseAdminId'];
$warehouseAdminname = $_SESSION['warehouseAdminName'];

//pick up
if(isset($_GET['orderId'])){
    $pickUp_orderId = $_GET['orderId'];
    $pickUp_trackId = $_GET['trackId'];
    $pickUp_unified = $_GET['unified'];
    $trackHistoryId = uniqid("TrackHistory",true);

    $updateSql = "UPDATE `track` SET `currentLocation`='warehousre', `adminReceiveName`='$warehouseAdminId', `adminPickUpDate`='$date',`status`='picked up', `update_time`='$date' WHERE trackId = '$pickUp_trackId'"; 
    $resultUpdateSql = $conn->query($updateSql);

    $insertTrackHistory = "INSERT INTO `trackhistory`(`trackHistoryId`,`trackOrderId`, `trackCartIntegrationId`, `location`, `status`, `created_time`, `update_time`) VALUES ('$trackHistoryId', '$pickUp_orderId', '$pickUp_trackId', 'warehouse', 'picked up', '$date', '$date')";
    $resultInsertTrackHistory = $conn->query($insertTrackHistory);

    $updateSql2 = "UPDATE `trackintegration` SET `currentLocation`='warehouse',`status`='closed', `update_time`='$date' WHERE `orderId` = '$pickUp_orderId'";
    $resultUpdateSql2 = $conn->query($updateSql2);

    if( ($resultUpdateSql == true) && ($resultInsertTrackHistory == true) ){
        $_SESSION['m'] = "pickup-status-success-notic-01";
        $_SESSION['m_last_action'] = time();
    }else{
        $_SESSION['m'] = "pickup-status-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }
    echo "<script>window.history.back();</script>";
}

//update package status
if(isset($_GET['updateTrack'])){
    $update_TrackId = $_GET['updateTrack'];
    $update_OrderId = $_GET['updateOrder'];
    $update_Status = "Out Of Delivery";
    $trackHistoryId = uniqid("TrackHistory",true);

    $updateSql = "UPDATE `track` SET `status`='$update_Status', `update_time`='$date' WHERE trackId = '$update_TrackId'"; 
    $resultUpdateSql = $conn->query($updateSql);

    $insertTrackHistory = "INSERT INTO `trackhistory`(`trackHistoryId`,`trackOrderId`, `trackCartIntegrationId`, `location`, `status`, `created_time`, `update_time`) VALUES ('$trackHistoryId', '$update_OrderId', '$update_TrackId', 'warehouse', '$update_Status', '$date', '$date')";
    $resultInsertTrackHistory = $conn->query($insertTrackHistory);

    if( ($resultUpdateSql == true) && ($resultInsertTrackHistory == true) ){
        $_SESSION['m'] = "OutOfDelivery-status-success-notic-01";
        $_SESSION['m_last_action'] = time();
    }else{
        $_SESSION['m'] = "OutOfDelivery-status-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }
    echo "<script>window.history.back();</script>";
}


if(isset($_POST['updatedClosedPackage'])){
    $trackHistoryId = uniqid("TrackHistory",true);
    $update_track_id = $_POST['trackId'];
    $update_order_id = $_POST['ordedrId'];
    $update_track_status = mysqli_real_escape_string($conn,$_POST['status']);
    $update_track_receiverInfo = mysqli_real_escape_string($conn,$_POST['receiverInfo']);

    //get receiver address
    $update_Add = "SELECT CONCAT(address_shipping.recipient_address,', ',address_shipping.recipient_city,', ',address_shipping.recipient_state,', ',address_shipping.recipient_postalCode,',', address_shipping.recipient_country) AS 'address' FROM `track` LEFT JOIN address_shipping ON track.shipId = address_shipping.ship_id WHERE track.trackId = '$update_track_id'";
    $resultUpdateAdd = $conn->query($update_Add);
    if($resultUpdateAdd ->num_rows>0){
        while($row = $resultUpdateAdd ->fetch_assoc()){
            $currentLocation = $row['address'];
        }

        $updateSql = "UPDATE `track` SET `userReceiverName`='$update_track_receiverInfo', `currentLocation`='$currentLocation' ,`status`='$update_track_status', `update_time`='$date' WHERE trackId = '$update_track_id'"; 
        $resultUpdateSql = $conn->query($updateSql);

        $insertTrackHistory = "INSERT INTO `trackhistory`(`trackHistoryId`,`trackOrderId`, `trackCartIntegrationId`, `location`, `status`, `created_time`, `update_time`) VALUES ('$trackHistoryId', '$update_order_id', '$update_track_id', '$currentLocation', '$update_track_status', '$date', '$date')";
        $resultInsertTrackHistory = $conn->query($insertTrackHistory); 
        
        //check payment method
        $checkPaymentMethod = "SELECT * FROM `track` LEFT JOIN `payment` ON track.orderId = payment.order_id WHERE track.trackId = '$update_track_id'";
        $resultCheckPayment = $conn->query($checkPaymentMethod);
        
        if($resultCheckPayment ->num_rows>0){
            while($row = $resultCheckPayment ->fetch_assoc()){
                $updateTrack_paymentMethod = $row['paymentMethod'];
            }
            //payment method = cash on delivery
            if($updateTrack_paymentMethod == "Cash On Delivery"){

                //check available in process order
                $checkAllOrderIsClose = "SELECT * FROM orderlist LEFT JOIN cartintegration ON orderlist.cartId = cartintegration.cartId WHERE cartintegration.cancelRequest = '0' AND cartintegration.status != 'shipping' AND cartintegration.returnRequest = '0' AND orderlist.orderId = '$update_order_id'";
                $resultCheckAvailableOrder = $conn->query($checkAllOrderIsClose);
                if($resultCheckAvailableOrder ->num_rows < 1){
                   
                    //no more order, update payment method
                    $updatePaymentMethod = "UPDATE `payment` SET `status`= 'paid', `update_time`='$date' WHERE `order_id` = '$update_order_id'";
                    $resultUpdatePaymentMethod = $conn->query($updatePaymentMethod);
                }
            }
        }
        
        if( ($resultUpdateSql == true) && ($resultInsertTrackHistory == true) ){
            $_SESSION['m'] = "closed-status-success-notic-01";
            $_SESSION['m_last_action'] = time();
        }else{
            $_SESSION['m'] = "closed-status-failed-notic-01";
            $_SESSION['m_last_action'] = time();
        }
    }else{
        $_SESSION['m'] = "closed-status-failed-notic-01";
        $_SESSION['m_last_action'] = time();
    }

    echo "<script>window.history.back();</script>";
}


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $output = " ";

    //search all package for this admin accepter
    if($action == "filter"){
        $package_page = 0;

        if(!empty($_POST['filterTrackId'])){
            $filterTrackId = $_POST['filterTrackId'];
            $TrackSql = " AND track.trackId LIKE '%$filterTrackId%'";
        }else{
            $TrackSql = " ";
        }

        if(!empty($_POST['filterOrderId'])){
            $filterOrderId = $_POST['filterOrderId'];
            $OrderSql = " AND track.orderId LIKE '%$filterOrderId%'";
        }else{
            $OrderSql = " ";
        }

        if(!empty($_POST['filterUnified'])){
            $filterUnified = $_POST['filterUnified'];

            if($filterUnified == "all"){
                $unifiedSql = " ";
            }else{
                $unifiedSql = " AND track.unifiedDelivery = '$filterUnified'";
            }
        }else{
            $unifiedSql = " ";
        }

        if(!empty($_POST['filterStatus'])){
            $filterStatus = $_POST['filterStatus'];
            if($filterStatus == "all"){
                $statusSql = " ";
            }else{
                $statusSql = " AND track.status = '$filterStatus'";
            }
        }else{
            $statusSql = " ";
        }

        if(!empty($_POST['filterDate'])){
            $Order_search_orderDate = date('Y-m-d 00:00:00',strtotime($_POST['filterDate']));
            $Order_search_orderDate_after = date('Y-m-d 00:00:00', strtotime($Order_search_orderDate . ' + 1 days') );

            $dateSql = " AND (track.adminPickUpDate >= '$Order_search_orderDate' AND track.adminPickUpDate <= '$Order_search_orderDate_after')";
        }else{
            $dateSql = " ";
        }

        if(!empty($_POST['filterRowData'])){
            $filterRow = $_POST['filterRowData'];
            if($filterRow == "all"){
                $RowSql = " ";
            }else{
                $RowSql = " LIMIT 0,$filterRow";
            }
        }else{
            $RowSql = " LIMIT 0,5";
        }

        $filterPackageSql = "SELECT *,track.status AS 'currentStatus', track.update_time AS 'lastModified' FROM `track` LEFT JOIN address_shipping ON track.shipId = address_shipping.ship_id WHERE (track.status != 'In Transit' OR  track.status != 'pending')  AND adminReceiveName = '$warehouseAdminId' ".$TrackSql.$OrderSql.$unifiedSql.$statusSql.$dateSql." ORDER BY `track`.`update_time` DESC ".$RowSql."";
        $resultFilterPackage = $conn->query($filterPackageSql);
        if(mysqli_num_rows($resultFilterPackage)>0){
            while($row = mysqli_fetch_array($resultFilterPackage)){
                $trackId = $row['trackId'];
                $orderId = $row['orderId'];
                $unified = $row['unifiedDelivery'];
                $status = $row['currentStatus'];
                $searchDate = date('Y-m-d h:i:s a',strtotime($row['adminPickUpDate']));
                $lastModified = date('Y-m-d h:i:s a',strtotime($row['lastModified']));
               

                if(!empty($_POST["filterTrackId"])) {
                    $trackId = highlightKeywords($row["trackId"],$_POST["filterTrackId"]);
                }

                if(!empty($_POST["filterOrderId"])) {
                    $orderId = highlightKeywords($row["orderId"],$_POST["filterOrderId"]);
                }

                if(!empty($_POST["filterUnified"])) {
                        $unified = highlightKeywords($row["unifiedDelivery"],$_POST["filterUnified"]);
                }

                if(!empty($_POST["filterStatus"])) {
                    $status = highlightKeywords($row["currentStatus"],$_POST["filterStatus"]);
                }

                if(!empty($_POST["filterDate"])) {
                    $searchDate = highlightKeywords($searchDate,$_POST["filterDate"]);
                }

                $output .= '
                                <tr>
                                    <td>'.$trackId.'</td>
                                    <td>'.$orderId.'</td>
                                    <td>'.$row["recipient_state"].'</td>
                                    <td>'.$unified.'</td>
                                    <td class="text-capitalize">'.$status.'</td>
                                    <td>'.$searchDate.'</td>
                                    <td>'.$lastModified.'</td>
                                    <td>
                                        <a href=".././warehouse/packageDetail.php?trackId='.$trackId.'"  class="btn btn-primary w-75 m-1" title="View Detail" ><i class="fas fa-info"></i></a>
                                       
                                    ';
                    if($status == "picked up"){
                    $output .='
                                        <button type="button" class="btn btn-danger w-75 m-1" title="Out Of Delivery" data-order="'.$orderId.'" data-track="'.$trackId.'" data-status="Out Of Delivery" onclick="changeStatus(this)"><i class="fas fa-shipping-fast"></i></button>
                            ';
                    }else if($status == "Out Of Delivery"){
                        $output .='
                                        <button type="button" class="btn btn-success w-75 m-1" title="closed" data-order="'.$orderId.'" data-track="'.$trackId.'" onclick="closedStatus(this)" data-toggle="modal" data-target="#updateTrack"><i class="far fa-times-circle"></i></button>
                                ';
                    }
                    $output .='
                                    </td>
                                </tr>
                            ';

            }
        }else{
            $output .= '
                <tr>
                    <td colspan="8" class="text-center">
                        No Found Result
                    </td>
                </tr>
            ';
        }
    }else if($action == "searchTrack"){ //filter track id -- for search page
        $searchTrackId = $_POST['id'];

        $search_SQL = "SELECT * FROM `track` WHERE trackId LIKE '%$searchTrackId%'  AND adminReceiveName = '$warehouseAdminId'";
        $resultSearchSql = $conn->query($search_SQL);
        if(mysqli_num_rows($resultSearchSql)>0){
            while($row = mysqli_fetch_array($resultSearchSql)){
                $searchResult_TrackId = $row['trackId'];

                if(!empty($_POST["id"])) {
                    $searchResult_TrackId = highlightKeywords($row["trackId"],$_POST["id"]);
                }

                $output .= '
                        <tr>
                            <td>'.$searchResult_TrackId.'</td>
                            <td>'.$row['currentLocation'].'</td>
                            <td class="text-capitalize">'.$row['status'].'</td>
                            <td>'.$row['update_time'].'</td>
                            <td>
                                 <a href=".././warehouse/packageDetail.php?trackId='.$row['trackId'].'"  class="btn btn-primary w-75 m-1" title="View Detail" ><i class="fas fa-info"></i></a>
                ';
                if($row["status"] == "picked up"){

                $output .= '
                                <button type="button" class="btn btn-danger w-75 m-1" title="Out Of Delivery" data-order="'.$row["orderId"].'" data-track="'.$row["trackId"].'" data-status="Out Of Delivery" onclick="changeStatus(this)"><i class="fas fa-shipping-fast"></i></button>
                            ';
                }
                if($row["status"] == "Out Of Delivery"){
                $output .= '
                                <button type="button" class="btn btn-success w-75 m-1" title="closed" data-order="'.$row["orderId"].'" data-track="'.$row["trackId"].'" onclick="closedStatus(this)" data-toggle="modal" data-target="#updateTrack"><i class="far fa-times-circle"></i></button>
                            </td>
                        </tr>
                            ';
                }
            }
        }else{
            $output .= '
            <tr>
                <td colspan="5" class="text-center">No Found Related TrackID : '.$searchTrackId.'</td>
            </tr>
            ';
        }
    }
echo $output;   
}



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
