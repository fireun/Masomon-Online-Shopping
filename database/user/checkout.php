<?php

include("../../config.php");
session_start();

$userId = $_SESSION['userId'];
if(isset($_POST['remove'])){

    if(empty($_POST['cartIntegrationID'])){ //No item checked
        // echo'<script type=text/javascript>window.alert("No Fill Product Size")</script> ';
        $_SESSION['m_last_action'] = time();      
        $_SESSION['m'] = "SomethingError404-COE-C1-UCK";
        header('refresh:0;url=../../user/cart.php');       
    }else{
        foreach($_POST['cartIntegrationID'] as $dID){
        
            $remover="delete from cartintegration where cartIntegrationId = '$dID' and userId='$userId' and cartId = ''";
            $removerResult=$conn->query($remover);
            
            if($removerResult == true){
                // echo '<script>window.alert("Product Is Remove from Cart")</script>';
                // header('refresh:0.5;url=../user/cart.php');
                $_SESSION['m_last_action'] = time();      
                $_SESSION['m'] = "Delect-Cart-1-Success-1Notif";
                header('refresh:0;url=../../user/cart.php');                
            }else{
                $_SESSION['m_last_action'] = time();      
                $_SESSION['m'] = "Delect-Cart-2-Failed-2Notif";
                header('refresh:0;url=../../user/cart.php');
            }
        }   
    }

}

if(isset($_POST['update'])){
    $user=$_SESSION['username'];
    $userId=$_SESSION['userId'];
    $EditVariation = $_POST['editVariation'];
    $EditQuantity = $_POST['editQuantity'];
    $EditCart = $_POST['EditCartIntegrationId'];
   
    if(empty($EditQuantity)){
        // echo '<script>window.alert("Quantity Empty")</script>';
         $EditQuantity = $_POST['oldQty'];
    }
    
    if(empty($EditCart)){
        $_SESSION['m_last_action'] = time();      
        $_SESSION['m'] = "Upload-Cart-Qty-Failed-1Notif";
        header('refresh:0;url=../../user/cart.php');

    }else{
        echo $UpdateCart = "update cartintegration set variation = '$EditVariation', quantity = '$EditQuantity' where cartIntegrationId ='$EditCart'";
        $resultUpdate = $conn->query($UpdateCart);
        if($resultUpdate == true){
            $_SESSION['m_last_action'] = time();      
            $_SESSION['m'] = "Upload-Cart-Qty-Success-1Notif";
            header('refresh:0;url=../../user/cart.php');

        }else{
            $_SESSION['m_last_action'] = time();      
            $_SESSION['m'] = "Upload-Cart-Qty-Failed-1Notif";
            header('refresh:0;url=../../user/cart.php');

        }
    }
}


if(isset($_POST['checkout'])){  
    $generateCartId = uniqid();
    $totalPrice = $_POST['totalPrice'];
    $unifiedDelivery = '';
    $userId = $_SESSION['userId'];

    
    date_default_timezone_set("Asia/Kuala_Lumpur");
    // echo date('d-m-Y H:i:s'); //Returns IST
    $created_date =  date("Y-m-d H:i:s");
    
    if($_SESSION['userId']){
        if(empty($_POST['cartIntegrationID'])){ //No item checked
            // echo'<script type=text/javascript>window.alert("No Fill Product Size")</script> ';
            $_SESSION['m_last_action'] = time();      
            $_SESSION['m'] = "SomethingError404-COE-C1-UCK";
            header('refresh:0;url=../../user/cart.php');
        }else{
            foreach($_POST['cartIntegrationID'] as $UpdateCartID){
    
                $update= "update cartintegration set cartId = '$generateCartId', update_time = '$created_date' where cartIntegrationId = '$UpdateCartID'";
    
                //run sql
                $updateresult=$conn->query($update);
            }
    
            if( empty($_POST["unifiedDelivery"]) ){ 
            $unifiedDelivery = 1 ; //disagree
            }else { 
                $unifiedDelivery = 0; //agree
            }
    
            $in_ch=mysqli_query($conn,"insert into cart(cartId,userId,total,unifiedDelivery,create_time,update_time) values ('$generateCartId','$userId','$totalPrice','$unifiedDelivery','$created_date','$created_date')");  
    
            if($in_ch==1 && $updateresult == 1){  
                // echo'<script>alert("Inserted Successfully")</script>';  
                header('refresh:0;url=../../user/CheckOut.php?cartId='.$generateCartId.'');
    
            }else {  
                // echo'<script>alert("Failed To Insert")</script>'; 
                $_SESSION['m_last_action'] = time();      
                $_SESSION['m'] = "SomethingError404-COE-C2-DE";
                header('refresh:0;url=../../user/cart.php');
            }  
        }
    }else{
        header('refresh:0;url=../../user/login.php');

    }
    
}  