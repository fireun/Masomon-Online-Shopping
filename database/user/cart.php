<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");



if(isset($_POST['AddToCart'])){

    if(isset($_SESSION['username'])){
        $generateCartIntegrationId = uniqid();
        $generateCartId = "";
        $productId = $_POST['productId'];
        $sellerId = $_POST['sellerId'];
        $user = $_SESSION['username'];
        $userId = $_SESSION['userId'];
        $variation = $_POST['SelectVariation'];
        $CartQuantity = $_POST['quantity'];

        $storeCart = "INSERT INTO cartintegration (cartIntegrationId,cartId,productId,userId, sellerId,variation,quantity,status,returnRequest,cancelRequest,detentionPeriod,created_time,update_time) values ('$generateCartIntegrationId',' ','$productId','$userId','$sellerId','$variation','$CartQuantity','','','','','$date','$date')";
        $resultStoreCart = $conn->query($storeCart);

        if($resultStoreCart == true){
            $_SESSION['m_last_action'] = time();      
            $_SESSION['m'] = "Add-To-Cart-Success-1Notif";
            echo "<script>window.location.href= '../../user/cart.php';</script>";
        }else{
            $_SESSION['m_last_action'] = time();      
            $_SESSION['m'] = "Add-To-Cart-failed-1Notif";
            echo "<script>window.history.back();</script>";
        }
    }else{
        echo "<script>alert('Please Login First');window.location.href= '../../user/login.php';</script>";
    }

}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $output = '';

    if($action == "updateCart"){
        $cartIntegrationId = $_POST['cartIntegrationId'];
        $checkCart="SELECT * FROM cartintegration WHERE cartIntegrationId = '$cartIntegrationId'";
            
        $resultDisplay = $conn->query($checkCart);
        if($resultDisplay->num_rows>0){
            while($row = mysqli_fetch_array($resultDisplay)){
                $cartProductId = $row['productId'];
                $cartQty = $row['quantity'];
                $cartVariation = $row['variation'];
            }

            $output .= '
            <div class="row">
                <div class="form-group">
                    <label for="sel1">Select Variation (select one):</label>
                    <input type="hidden" name="EditCartIntegrationId" id="showCartIntegrationId" value="'.$cartIntegrationId.'">
                    <select class="form-control" id="variation" name="editVariation" style="width: 150%;">
                        ';

            $getVariation = "SELECT * FROM variation WHERE productId = '$cartProductId'";
            $resultShowVariation = $conn->query($getVariation);
            if($resultShowVariation->num_rows>0){
                while($row = mysqli_fetch_array($resultShowVariation)){
                    
                    $output .= '
                            <option name="size" value="'.$row['variation'].'">'.$row['variation'].'</option>
                                ';
                }
            }

            $getQuantity = "SELECT * FROM inventory WHERE productId = '$cartProductId'";
            $resultShowQuantity = $conn->query($getQuantity);
            if($resultShowQuantity->num_rows>0){
                while($row = mysqli_fetch_array($resultShowQuantity)){
                    $output .= '
                    </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" min="1" max="'.$row['stock'].'" name="editQuantity" id="quantity" placeholder="'.$cartQty.'">
                        <span class="text-muted">Available Stock: '.$row['stock'].'</span>
                        <input type="hidden" name="oldQty" value="'.$cartQty.'">
                        <span id="ErrorQuantityMessage"></span>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" name="update" class="btn btn-outline-danger btn-xs mobile-edit-mode-btn">Update</button>
                </div>
                                ';
                }
            }

        }
    }
    echo $output;

}
?>