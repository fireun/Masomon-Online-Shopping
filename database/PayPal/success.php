<?php
require_once 'Paypal.php';
require '../../config.php';
$db = new mysqli('localhost', 'root', '', 'masomononlineshopping');
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();

    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();
 
        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        // $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];
        $payment_order_id = $_SESSION['GenerateOrderID'];
        $changeStatus = "waiting comfirm";
        $cart_status = "submitted";
        $cart_id = $_SESSION['paypalcartId'];
        $update_payment_status = "paid";
        
        // Insert transaction data into the database
        $insert = $db->query("UPDATE payment SET paypal_payer_id = '". $payer_id ."', paypal_payment_id = '". $payment_id ."', status = '". $update_payment_status."', update_time = '$date' where order_id = '$payment_order_id'");
        $update = $db->query("UPDATE orderlist SET status = 'waiting comfirm', update_time = '$date' where orderId = '$payment_order_id'");
        $updateCart = $db->query("UPDATE cartintegration SET status = '$cart_status', update_time = '$date' where cartId = '$cart_id'");
        

        unset($_SESSION['GenerateOrderID']);
        unset($_SESSION['paypalcartId']);
        $_SESSION['m'] = "Place-Order-Success-PaymentMethod-CashOnDelivery-01";
        echo "<script>window.location.href= '../../user/purchasePage.php';</script>";

    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}