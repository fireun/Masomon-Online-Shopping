<?php
require_once "../../vendor/autoload.php";
 
use Omnipay\Omnipay;
 
define('CLIENT_ID', 'your_paypal_REST_API_ID');//REST API
define('CLIENT_SECRET', 'your_paypal_REST_API_serect');//REST API
 
define('PAYPAL_RETURN_URL', 'http://localhost/testProject/database/PayPal/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/testProject/user/purchasePage.php');
define('PAYPAL_CURRENCY', 'MYR'); // set your currency here
 
 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live
