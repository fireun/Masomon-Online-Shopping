<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Ymdhis");// current year-month-days hours:minut:seconts

$sellerId = $_SESSION['sellerId'];

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action == "exportAllOrder"){
        $actionType = "AllOrder";
        $actionSql = " AND cartintegration.cancelRequest = '0' AND cartintegration.returnRequest = '0'";
        $actionCenterSelect = " ";
        $actionCenterSql = " ";
        
    }else if($action == "exportAllCancelOrder"){
        $actionType = "AllCancelOrder";
        $actionCenterSelect = ", actioncenter.*, actioncenter.created_time AS 'requestDate'";
        $actionCenterSql = " LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId";
        $actionSql = " AND cartintegration.cancelRequest = '1' AND cartintegration.returnRequest = '0'";

    }else if($action == "exportAllReturnOrder"){
        $actionType = "AllReturnOrder";
        $actionCenterSelect = ", actioncenter.*, actioncenter.created_time AS 'requestDate'";
        $actionCenterSql = " LEFT JOIN actioncenter ON cartintegration.cartIntegrationId = actioncenter.cartIntegrationId";
        $actionSql = " AND cartintegration.cancelRequest = '0' AND cartintegration.returnRequest = '1'";
    }

    $filename = $date.''.$actionType;
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=$filename.xls");  
    header("Pragma: no-cache"); 
    header("Expires: 0");

    $sql = "SELECT cartintegration.*, orderlist.*, orderlist.created_time AS 'orderDate', payment.*, user.userName, cartintegration.status AS 'cartStatus', payment.status AS 'paymentStatus', cart.*, product.* ".$actionCenterSelect." FROM `cartintegration` LEFT JOIN orderlist ON cartintegration.cartId = orderlist.cartId LEFT JOIN payment ON orderlist.orderId = payment.order_id LEFT JOIN product ON cartintegration.productId = product.id LEFT JOIN user ON cartintegration.userId = user.userId LEFT JOIN cart ON cartintegration.cartId = cart.cartId ".$actionCenterSql." WHERE cartintegration.sellerId ='$sellerId' AND cartintegration.status != '' ".$actionSql."";
    $resultSql = $conn->query($sql);

    if($resultSql->num_rows > 0){
    echo '<table border="1">';
    //make the column headers what you want in whatever order you want
    echo '<tr>
            <th>Order Id</th>
            <th>User Name</th>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Variation</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>SubTotal</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Unified Delivery</th>
            <th>Unified Delivery Discount</th>
            <th>Total Price</th>
            <th>Order Date</th>
          ';
          if($action == "exportAllCancelOrder"){
              echo '  
                    <th>Cancel Reason</th>
                    <th>Additional Reason</th>
                    <th>Cancel Status</th>
                    <th>Cancel Comment</th>
                    <th>Request Date</th>
                ';
          }else if($action == "exportAllReturnOrder"){
                echo '  
                    <th>Return Reason</th>
                    <th>Additional Reason</th>
                    <th>Return Status</th>
                    <th>Return Comment</th>
                    <th>Request Date</th>
                ';
          }
    echo '
          </tr>';

    //loop the query data to the table in same order as the headers
    while($row = $resultSql->fetch_assoc()){
        $subtotal = $row['quantity']*$row['price'];
        $subtotal_Fee = $subtotal + 5;
        if($row['unifiedDelivery'] == 0){
            $unifiedDelivery = "Agree";
            $subtotal_Unified = $subtotal * 0.10;
        }else{
            $unifiedDelivery = "Disagree";
            $subtotal_Unified = $subtotal;
        }
        $totalPrice = $subtotal_Fee + $subtotal_Fee;
        
        echo '<tr>
                <td>'.$row["orderId"].'</td>
                <td>'.$row["userName"].'</td>
                <td>'.$row["id"].'</td>
                <td>'.$row["name"].'</td>
                <td>'.$row["variation"].'</td>
                <td>'.$row["quantity"].'</td> 
                <td>'.$row["price"].'</td> 
                <td>'.$subtotal_Fee.'</td> 
                <td>'.$row["cartStatus"].'</td> 
                <td>'.$row["paymentMethod"].'</td> 
                <td>'.$row["paymentStatus"].'</td>         
                <td>'.$unifiedDelivery.'</td>
                <td>'.$subtotal_Unified.'</td> 
                <td>'.$totalPrice.'</td>
                <td>'.$row["orderDate"].'</td>
            ';
        if($action == "exportAllCancelOrder"){
            echo '  
                  <td>'.$row["actionReason"].'</td>
                  <td>'.$row["actionAddtionalReason"].'</td>
                  <td>'.$row["actionStatus"].'</td>
                  <th>'.$row["actionSellerComment"].'</th>
                  <td>'.$row["requestDate"].'</td>
              ';
        }else if($action == "exportAllReturnOrder"){
              echo '  
                  <td>'.$row["actionReason"].'</td>
                  <td>'.$row["actionAddtionalReason"].'</td>
                  <td>'.$row["actionStatus"].'</td>
                  <th>'.$row["actionSellerComment"].'</th>
                  <td>'.$row["requestDate"].'</td>
              ';
        }
        echo '
             </tr>        
        ';
    }
    echo '</table>';
    exit();
    }

    echo "<script>window.history.back();</script>";  
}