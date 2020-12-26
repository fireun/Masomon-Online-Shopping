<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d h:i:s");// current year-month-days hours:minut:seconts

if($_GET['cartIntegrationID']){
    $cartIntegration_Id = $_GET['cartIntegrationID'];
    $userId = $_SESSION['userId'];
    $getBuyProduct = "SELECT cartintegration.* FROM cartintegration WHERE cartIntegrationId = '$cartIntegration_Id' AND userId = '$userId'";
    $resultGetBuyProduct=$conn->query($getBuyProduct);

    if($resultGetBuyProduct->num_rows>0){
        while($row = $resultGetBuyProduct->fetch_assoc()){
            $BuyAgain_product_id = $row['productId'];
            $BuyAgain_product_sellerId = $row['sellerId'];
            $BuyAgain_cart_variation = $row['variation'];
            $BuyAgain_cart_qty = $row['quantity'];
        }

        $generateCartIntegrationId = uniqid();
        $insertBuyAgain = "insert into cartintegration (cartIntegrationId,cartId,productId,userId, sellerId,variation,quantity,status,returnRequest,cancelRequest,detentionPeriod,created_time,update_time) values ('$generateCartIntegrationId',' ','$BuyAgain_product_id','$userId','$BuyAgain_product_sellerId','$BuyAgain_cart_variation','$BuyAgain_cart_qty','','','','','$date','$date')";
        $resultInsertBuyAgain = $conn->query($insertBuyAgain);
        
        if($resultInsertBuyAgain == true){
            $_SESSION['m'] = "BuyAgain-Success-Alert-01";
            $_SESSION['m_last_action'] = time();
        }else{
            $_SESSION['m'] = "BuyAgain-Failed-Alert-01";
            $_SESSION['m_last_action'] = time();
        }
        echo '<script>window.history.back(); </script>';
    }
}

?>