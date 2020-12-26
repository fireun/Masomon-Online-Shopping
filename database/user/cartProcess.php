<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d h:i:s");// current year-month-days hours:minut:seconts

//for auction Product update bid
if(isset($_POST['InsertBid'])){
    $duedate = $_POST['duedate'];

    if($duedate < $date){

        if(isset($_SESSION['username'])){
            $generateAuctionRecordId = uniqid();
            $productId = $_POST['productId'];
            $user = $_SESSION['username'];
            $userId = $_SESSION['userId'];
            $bid = $_POST['bid'];

            $checkAvailableUser = "select * from auctionRecord where userId = '$userId' and productId = '$productId'";
            $resultcheckAvailableUser = $conn->query($checkAvailableUser);
            
            if($resultcheckAvailableUser->num_rows > 0){ //over 1 database(record) so run
                $UpdatestoreRecord = "update auctionRecord set bid ='$bid',date = '$date' where userId = '$userId' and productId = '$productId'";
                $resultUpdatestoreRecord = $conn->query($UpdatestoreRecord);
                if($resultUpdatestoreRecord == true){
                    $_SESSION['m'] = "update-bid-success-notic-01";
                    $_SESSION['m_last_action'] = time();
                    echo "<script>window.history.back();</script>";
                }else{
                    $_SESSION['m'] = "update-bid-failed-notic-01";
                    $_SESSION['m_last_action'] = time();
                    echo "<script>window.history.back();</script>";
                }

            //NO SAME USER
            }else{  
                $storeRecord = "insert into auctionRecord (auctionRecordId,productId,userId,bid,date) values ('$generateAuctionRecordId','$productId','$userId','$bid','$date')";
                $resultstoreRecord = $conn->query($storeRecord);
                if($resultstoreRecord == true){
                    $_SESSION['m'] = "insert-bid-success-notic-01";
                    $_SESSION['m_last_action'] = time();
                    echo "<script>window.history.back();</script>";
                }else{
                    $_SESSION['m'] = "insert-bid-failed-notic-01";
                    $_SESSION['m_last_action'] = time();
                    echo "<script>window.history.back();</script>";
                }
            }
        }else{
            echo "<script>alert('must login first');
            window.location.href= '../user/login.php';</script>";
        }

    }else{
        $_SESSION['m'] = "insert-bid-overTime-failed-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back();</script>";
    }

}